<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Public_Controller {


	function __construct()
	{
		parent::__construct();
		
		$this->load->model('captcha_model');
		
		$this->load->library(array ('ssh'));
		$this->load->helper('url', 'form');
		$this->load->library('captcha');
		
		$this->load->model(array ('location_model','continent_model','port_model', 'service_model', 'server_created', 'server_config'));
		$this->data['domain'] = substr($_SERVER['HTTP_HOST'], 0, strpos($_SERVER['HTTP_HOST'], '.'));
		$this->data['total_account'] = $this->server_created->countServerCreated();
		
		
		$config = $this->server_config->read()->row();
		$this->data['config'] = $config;
		
		$this->data['server_only'] = $config->server_only;
		$this->data['location_only'] = $config->location_only;
		
	}
	public function _captcha($str)
	{
		
		if ( ! $this->captcha_model->check($str) )
		{
			$this->form_validation->set_message('_captcha', 'The %s was not input correctly. Expired on 30 sec.');
			return false;
		}

		return true;
	}

	
	public function index()
	{	
		

		$config = $this->server_config->read()->row();
		//print_r($test);return;
		
		$public_enable = $config->public_enable;
		
		if (! $public_enable) {
			
			redirect(site_url('panel'), 'refresh');
		}
		
		
		$server_only = $config->server_only;
		
		if ($server_only) {
			
			

			$this->server();
			
		}
		else {
			
			
			$location_only = $config->location_only;
			
			if ($location_only) {
				
				
				$this->location();
			
			}
			else {
				$this->continent();
			
			}
			
		}
	}
	public function continent() {
		
		$continents = $this->web_ssh->get_server_continents();
		
		foreach($continents as $k=>$continent) {
			
			$continents[$k]->locations = $this->location_model->locations($continent->id)->result();
			$continents[$k]->link = site_url('page/secure-shell-servers/continent/'.str_replace(' ', '-', $continent->name).'/');
				
		}
		
		$this->data['continents'] = $continents; 
		$this->public_render('continent', $this->data);
			
	}
	public function location($continent_id=false) {
		
		if (empty($continent_id)) {
			
			$locations = $this->location_model->locations()->result();
			
		}
		else {
			$locations = $this->location_model->locations($continent_id)->result();
		}
		
		$this->data['locations'] = $locations;
		
		foreach ($this->data['locations'] as $k=>$location) {
			
			$continent = $this->continent_model->read($location->continent_id)->row();
			$replace = str_replace(' ', '', $location->name);
			$replace = str_replace(',', '-', $replace);
			
			$this->data['locations'][$k]->link = site_url('page/secure-shell-servers/continent/'.str_replace(' ','-',$continent->name).'/'.$replace);
		}
		$this->public_render('location', $this->data);
	}
	public function asu() {
		
		if (isset($_POST) && !empty($POST)) {
			print_r($_POST);
			
		}
	}
	
	public function server($location=false) {
		
		
		$servers = $this->web_ssh->public_servers()->result();
		
		if (!empty($location)) {
			
			$servers = $this->web_ssh->public_servers($location)->result();
			
		}
		
		if (!empty($this->input->post('program'))) {
			
			$program = $this->input->post('program');
			//echo $program; return;
			
			
			$servers = $this->service_model->servers($program)->result();
			//print_r($servers);
			//return;
			if (! empty($this->input->post('port'))) {
				
				$port = $this->input->post('port');
				$servers = $this->service_model->servers($program, $port)->result();
			}
		}
		
		
		
		
		
		
		$this->data['locations'] = $this->location_model->read()->result();
		$this->data['services'] = $this->web_ssh->get_server_services();
		$this->data['ports'] = $this->web_ssh->get_service_ports();
		
		foreach($servers as $k=>$server) {
			
			
			$servers[$k]->locations = $this->location_model->getLocationsThisServer($server->id)->result();
			$servers[$k]->services = $this->web_ssh->get_server_services($server->id)->result();
			$servers[$k]->count = $this->server_created->countLimit($server->id);
			$servers[$k]->link = site_url('page/ssh-account-creator/server/'.$server->id.'/'.str_replace(' ', '-', $server->name).'/');
			foreach($servers[$k]->services as $i=>$j) {
				
					$servers[$k]->services[$i]->ports = $this->web_ssh->get_service_ports($j->id, $server->id)->result();
			}

		
			
		}
			
		$this->data['servers'] = $servers;
		$this->public_render('server', $this->data);
		
	}
	public function create($id=false) {
		
		
		
		$config = $this->server_config->read()->row();
		
		$server = $this->web_ssh->server($id)->row();
		if (!isset($server->id)) { show_404(); }
		
		$services = $this->web_ssh->get_server_services($server->id)->result();
		foreach ($services as $r=>$s) {
			
			$services[$r]->ports = $this->web_ssh->get_service_ports($s->id, $server->id)->result();
			
		}
		
		if (isset($_POST) && !empty($_POST)) {
				
			$this->form_validation->set_rules('serverid', 'Server Id', 'required|numeric');
			$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[10]|is_unique[server_created.username]');
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[10]');
			$this->form_validation->set_rules('captcha', 'CAPTCHA', 'trim|required|callback__captcha');
		
			if ($this->form_validation->run() === FALSE ) {
				
				echo validation_errors('<div style="color:red; ">', '</div>');
				return;
			}
			
			
			
			$server_id = $this->input->post('serverid');
			$username = $_SERVER['HTTP_HOST'].'-'.$this->input->post('username');			
			$password = $this->input->post('password');
			$limit = $config->free;
			$now = new DateTime(date('d-m-Y'));
			$now->format('U');
			
			
			$data = array (
			
					'server_id' => $server_id,
					'username' => $username,
					'password' => $password,
					'created_on' => $now->getTimeStamp(),
					'expired_on' => strtotime('+'.$limit.' day', time())
			);
			
			$cek = $this->server_created->countLimit($server_id);
			
			if ($cek >= $server->limit_user) {
				echo 'Server limit';
				return;
				
			}
			$ssh = $this->ssh->addAccount($server->host,$server->password, $username, $password, $limit );
			
			if ($ssh !== FALSE ) {
				
				$id = $this->server_created->create($data);
				if ($id) {
					
					$read = $this->server_created->read($id)->row();
					$read->host = $server->host;
					
					$this->data['account'] = $read;
					
					$render= $this->success_render('success', $this->data);
				
					echo $render ;
				}
				
			}
			else {
			   echo "Server OFFLINE";
			}
			
			
			
			
		} else {
		
	/*	$this->load->helper('captcha');
		$vals = array(
            'img_path'      => './assets/captcha/',
            'img_url'       => base_url('assets/captcha/')
        );

        $cap = create_captcha($vals);
        $data = array(
            'captcha_time'  => $cap['time'],
            'ip_address'    => $this->input->ip_address(),
            'word'          => $cap['word']
        );
	*/	
		
		$cap = $this->captcha->main();
		$data = array(
			'captcha_time'  => $cap['time'],
			'ip_address'    => $this->input->ip_address(),
			'word'          => $cap['word']
			);
			
		$this->captcha_model->create($data);
		 
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->data['services'] = $services;
		$this->data['server'] = $server;
		$this->data['cap'] = $cap;
		
		$this->public_render('create_account', $this->data);
		
		
		}
	}

	public function privacy() {
		
		$this->public_render('privacy',$this->data);
	}
	public function tos() {
		
		$this->public_render('tos', $this->data);
	}
}
