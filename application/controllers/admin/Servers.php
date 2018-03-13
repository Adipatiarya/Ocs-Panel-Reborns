<?php
/*
 * Copyright (c) 2006-2017 Adipati Arya <jawircodes@gmail.com>,
 * 2006-2017 http://webssh.xyz
 * fb account: : https://www.facebook.com/adipati.aarya
 
 * Permission to use, copy, modify, and distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
 * ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
 * WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
 * ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
 * OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFT
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Servers extends Admin_Controller {
	

	function __construct()
	{
		parent::__construct();
		$this->load->model(array (
		'location_model',
		'continent_model',
		'port_model', 
		'service_model',
		'server_created'
		));

	}
	public function __str_check($str) {
		if (preg_match('/^[a-zA-Z]+$/', $str ) )
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
    }
    public function __int_check($str) {
		if (preg_match('/^[1-9]+$/', $str ) )
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
    }
    function index() {
		
		
		$id = $this->input->post('id');
		
		$this->data['locations'] = $this->location_model->read()->result();
		
		
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('admin/servers/index');
		$config['total_rows'] = $this->web_ssh->servers()->num_rows();
		$config['per_page']=6;
        $config['num_links'] = 2;
        
        $config['uri_segment']=4;
		
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#list'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
 
        $config['first_link']='Pertama ';
        $config['last_link']='Terakhir';
        $config['next_link']='<i class="fa fa-angle-right"></i>';
        $config['prev_link']='<i class="fa fa-angle-left"></i>';
       // $config['created_by'] = $name;
		$this->pagination->initialize($config);
		$this->data['link'] = $this->pagination->create_links();
		$this->data['config']=$this->uri->segment(4);
		
		
		$this->data['ini'] = $config;
		
		$this->data['message'] = $this->session->flashdata('message');
		$servers = $this->web_ssh->servers('', $config)->result();
		
		if(isset($id)) {
			
			$servers = $this->web_ssh->servers($id, $config)->result();
			$this->data['this_id'] = $id;
		}
		foreach($servers as $k=>$server) {
			
			$servers[$k]->locations = $this->location_model->getLocationsThisServer($server->id)->result();
			$servers[$k]->count = $this->server_created->countServerCreated($server->id);
			$servers[$k]->services = $this->web_ssh->get_server_services($server->id)->result();
			foreach($servers[$k]->services as $i=>$j) {
				
				$servers[$k]->services[$i]->ports = $this->web_ssh->get_service_ports($j->id, $server->id)->result();
				
			}
			
			
		}
		$this->data['servers'] = $servers;
		$this->template->admin_render('admin/servers/index', $this->data);
		
	}
	
    /*
	function index() {
		
		
		
		$servers = $this->web_ssh->servers()->result();
		$id = $this->input->post('id');
		
		
		if(isset($id)) {
			
			$servers = $this->web_ssh->servers($id)->result();
			$this->data['this_id'] = $id;
		}
		
		$this->data['locations'] = $this->location_model->read()->result();
		
		foreach($servers as $k=>$server) {
			
			$servers[$k]->locations = $this->location_model->getLocationsThisServer($server->id)->result();
			
			$servers[$k]->services = $this->web_ssh->get_server_services($server->id)->result();
			foreach($servers[$k]->services as $i=>$j) {
				
				$servers[$k]->services[$i]->ports = $this->web_ssh->get_service_ports($j->id, $server->id)->result();
			}
			
		}
		
		
		$this->data['servers'] = $servers;
		//print_r($servers); return;
		
		$this->template->admin_render('admin/servers/index', $this->data);
		
	}
	*/
	function server_config() {
		/*
		
		*/
		
		if (isset($_POST) && !empty($_POST)) {
			
			if (! empty($this->input->post('premium')) && !empty ($this->input->post('trial')) && ! empty($this->input->post('free')) ) {
				
				if (!is_numeric($this->input->post('premium'))) 
				{
					$this->session->set_flashdata('config','<div class="alert alert-danger">Invalid value</div>');
					
					
					redirect ('admin/settings.html', 'refresh');
				}
				elseif (! is_numeric($this->input->post('free'))) {
					$this->session->set_flashdata('config','<div class="alert alert-danger">Invalid value</div>');
					
					
					redirect ('admin/settings.html', 'refresh');
				}
				elseif (! is_numeric($this->input->post('trial'))) {
					
					$this->session->set_flashdata('config','<div class="alert alert-danger">Invalid value</div>');
					
					
					redirect ('admin/settings.html', 'refresh');
				}
				else {
					$data = array(
					'premium'=> $this->input->post('premium'),
					'free' => $this->input->post('free'),
					'trial' => $this->input->post('trial')
					);
				
					$this->server_config->update($data);
					redirect ('admin/settings.html', 'refresh');
				}
			}
			else {
				redirect ('admin/settings.html', 'refresh');
			}
			
		}
		else {
			
			redirect ('admin/settings.html', 'refresh');
		}
	}
	
	public function add() {
		
		$locations = $this->location_model->read()->result();

		
		
		if (empty($locations)) {
			redirect(site_url('admin/server/location/add.html'),'refresh');
		}
		
		$this->form_validation->set_rules('name', 'Nama server', 'required|is_unique[server.host]');
		$this->form_validation->set_rules('host', 'Hostname ', 'trim|required');
		$this->form_validation->set_rules('location', 'Lokasi', 'required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('service', 'Service', 'trim|required|min_length[3]|max_length[10]|callback___str_check');
		$this->form_validation->set_message('__str_check', 'Invalid service name');
		$this->form_validation->set_rules('port', 'Port', 'trim|required|alpha_numeric|min_length[2]|max_length[5]');
		if ($this->form_validation->run() === TRUE) {
			
			$name = $this->input->post('name');
			$host = $this->input->post('host');
			$password = $this->input->post('password');
			$location = $this->input->post('location');
			
			$port =  $this->input->post('port');
			
			$service = $this->input->post('service');
			
			
			if ($this->service_model->check_name($service) === FALSE) {
				
				$this->service_model->create(array('name'=>$service));
			}
			
			if ($this->port_model->check_name($port) === FALSE) {
				
				$this->port_model->create(array('name'=>$port));
			}
			
			
			$id = $this->web_ssh->register($name, $host, $password, $location, $service, $port);
			
			if (!$id) {
				$this->session->set_flashdata('message', $this->web_ssh->errors());
				redirect('admin/server/add.html', 'refresh');
			}
			else {
				
				$this->session->set_flashdata('message', $this->web_ssh->messages());
				
				redirect('admin/servers.html', 'refresh');
			}
			
			
		}
		else {
			
			$this->data['locations'] = $locations;
			
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['name'] = array(
				'name'=>'name',
				'type'=>'text',
				'class'=>'form-control',
				'placeholder'=> 'Server ssl xxs1',
				'required'=>''
			);
			$this->data['host'] = array(
				'name'=>'host',
				'type'=>'text',
				'class'=>'form-control',
				'placeholder'=> 'ssh1.myweb.com',
				'requird'=>''
			);
			$this->data['password'] = array(
				'name'=>'password',
				'type'=>'text',
				'class'=>'form-control',
				'required'=>''
			);
			$this->template->admin_render('admin/servers/add', $this->data);
		}
		
	}
	public function add_service($server_id='') {
		$id = (int) $server_id;
		
		$server = $this->web_ssh->server($id)->row();
		
		if(!isset($server->id)) {
			show_404();
		}
		$ports = $this->port_model->read()->result();
		
		
		$this->form_validation->set_rules('port', 'Port NAME', 'required|max_length[5]|min_length[2]|alpha_numeric');
		$this->form_validation->set_rules('service', 'Service', 'required|max_length[10]|min_length[3]|callback___str_check');
		$this->form_validation->set_message('__str_check', 'Service name invalid');
		
		//$this->form_validation->set_rules('port[]', 'Port NAME', 'required|alpha_numeric');
		if ($this->form_validation->run() === TRUE) {
			$service = $this->input->post('service');
			$port = $this->input->post('port');
			
			$sId=null;
			$pId=null;
			
			
			if ($this->service_model->check_name($service) === FALSE) {
				//jika service belum tersedia
				
				$sId= $this->service_model->create(array('name'=>$service));
			}
			else {
				
				
				$cek = $this->service_model->read($service)->row();
				$sId = (int) $cek->id;
				
				
			}
			if ($this->port_model->check_name($port) === FALSE) {
				
				$pId = $this->port_model->create(array('name'=>$port));
				
			}
			else {
				
				$cek = $this->port_model->port_read($port)->row();
				$pId = (int) $cek->id;
				
			}
			
			
			$add = $this->web_ssh->add_to_service($sId,$server->id, $pId);
			if (!$add) {
				$this->session->set_flashdata('message', $this->web_ssh->errors());
				redirect('admin/servers/add_service/'.$server->id,'refresh');
			}
			
			$this->session->set_flashdata('message', $this->web_ssh->messages());
			redirect('admin/server/'.$server->id.'/update.html','refresh');
			
		}
		else {
			
			
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['server'] = $server;
			
			$this->template->admin_render('admin/servers/add_service', $this->data);
		}
		
	}
	/*
	public function update_service_port($id=null, $service_id=false) {
		
		$id = (int) $id;
		
		$server = $this->web_ssh->server($id)->row();
		$ports = $this->port_model->read()->result_array();
		
		
		$currentPorts = $this->web_ssh->get_service_ports($service_id, $id)->result();
		
		
		if(!isset($server->id) && !isset($service->id) ) {
			show_404();
		}
		
		$this->form_validation->set_rules('port[]', 'Port NAME', 'required|alpha_numeric');
		if ($this->form_validation->run() === TRUE) {
			
			if ($this->web_ssh->remove_from_port('', $service_id, $id) ) {
				
				$this->web_ssh->add_to_port($this->input->post('port'), $service_id, $id);
			}
			
			redirect('admin/servers.html', 'refresh');
			
			
		}
		else {
			
			$service = $this->service_model->read($service_id)->row();
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['server'] = $server;
			$this->data['service'] = $service;
			$this->data['ports'] = $ports;
			$this->data['currentPorts'] = $currentPorts;
			
			$this->data['s_service'] = array(
				'value' => $service->name ,
				'class'=>'form-control',
				'readonly'=>''
			);
			
			
			
			
			$this->template->admin_render('admin/servers/update_service_port', $this->data);
		}
		
		
	}
	
	*/
	public function update_service_port() {
		
		if(isset($_POST) && !empty($_POST)) {
			print_r($_POST);
		}
		echo "OK";
		
		return;
	}
	public function delete_service($server_id=false,$service_id=false) {
		
		if (! $this->web_ssh->serviceServerExist($server_id, $service_id)) show_404();
		
		$this->web_ssh->remove_from_service($service_id, $server_id);
		redirect('admin/server/'.$server_id.'/update.html','refresh' );
	}
	public function update($id='') {
		
		$id = (int) $id;
		$server = $this->web_ssh->server($id)->row();
		
		if (!isset($server->id)) show_404();
		
		$locations = $this->location_model->read()->result_array();
		$currentLocations = $this->location_model->getLocationsThisServer($id)->result();
		
		$currentServices = $this->web_ssh->get_server_services($id)->result();
		$services = $this->service_model->read()->result_array();
		$ports = $this->port_model->read()->result();
		
		foreach ($currentServices as $k=>$serv) {
			
			$currentPorts = $this->web_ssh->get_service_ports($serv->id, $id)->result();
			$currentServices[$k]->currentPorts= $currentPorts;
			
		}
		if (isset($_POST) && !empty($_POST)) {
			
			$data = array();
			
			if ($this->input->post('name')) {
				$data['name'] = $this->input->post('name'); 
			}
			if ($this->input->post('host')) {
				$data['host'] = $this->input->post('host');
			}
			
			if ($this->input->post('location')) {
				
				$locationData = $this->input->post('location');
				
				$continent_id = $this->location_model->read($locationData)->row();
				foreach($currentLocations as $locate) {
					
					if ($locate->id !==  $locationData) {
						
						$this->web_ssh->remove_from_location($locate->id, $server->id);
					}
					
				}
				$this->web_ssh->add_to_location($locationData, $server->id, $continent_id->continent_id);
				
			}
			
			
			if ($this->input->post('password')) {
				$data['password'] = $this->input->post('host');
			}
			$data['price'] = $this->input->post('price');
			
			if ($this->input->post('limit')) {
				$data['limit_user'] = $this->input->post('limit');
				
			}
			if ($this->input->post('config')) {
				$data['desc'] = $this->input->post('config');
			}
			if (!empty($data)) {
				
				$this->web_ssh->update($id, $data);
			}
			
			if ($this->input->post('port_name')) {
				
				$port = $this->input->post('port_name');
				
				$check = $this->port_model->check($port);
				if (!$check) {
					
					//echo "Tambah port lalu ambil ID <br>";
					$data = array('name' => $port);
					
					$input_port_id = $this->port_model->create($data);
					//echo "ID = " . $input_port_id;
					
				}
			}
			if ($this->input->post('port[]')) {
				
				$service_id = $this->input->post('serviceid');
				
				$input_port_array = $this->input->post('port[]');
				
				if ( isset($input_port_id) ) {
					
					array_push($input_port_array, $input_port_id);
				}
				if ($this->web_ssh->remove_from_port('', $service_id, $server->id) ) {
					
					$this->web_ssh->add_to_port($input_port_array, $service_id, $server->id);
				}
				
				
			}
			redirect(site_url('admin/server/'.$id.'/update.html'), 'refresh');
		}
		else {
			$this->data['server']=$server;
			$this->data['locations'] = $locations;
			$this->data['ports']=$ports;
			$this->data['currentServices'] = $currentServices;
			$this->data['services'] = $services;
			$this->data['currentLocations'] = $currentLocations;
			$this->data['message'] = $this->session->flashdata('message');
			$this->data['name'] = array(
				'name'=>'name',
				'type'=>'text',
				'class'=>'form-control',
				'placeholder'=> $server->name,
			);
			$this->data['host'] = array(
				'name'=>'host',
				'type'=>'text',
				'class'=>'form-control',
				'placeholder'=> $server->host,
			);
			$this->data['password'] = array(
				'name'=>'password',
				'type'=>'text',
				'class'=>'form-control',
				'placeholder'=> $server->password,
			);
			$this->data['price'] = array(
				'name'=>'price',
				'type'=>'number',
				'class'=>'form-control',
				'value'=> $server->price,
			);
			$this->data['limit'] = array(
				'name'=>'limit',
				'type'=>'number',
				'class'=>'form-control',
				'placeholder'=>$server->limit_user,
			);
			$this->template->admin_render('admin/servers/update', $this->data);
		}
		
	}
	public function delete($id = NULL)
	{
		

		$id = (int)$id;
		$server = $this->web_ssh->server($id)->row();
		if(!isset($server->id)) show_404();
		
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() === FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['server'] = $server;

			$this->template->admin_render('admin/servers/delete', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					return show_error($this->lang->line('error_csrf'));
				}
			
				echo $this->web_ssh->delete($id);

			}

			// redirect them back to the auth page
			redirect(site_url('admin/servers.html'), 'refresh');
		}
	}
	public function activate($id=false) {
		$this->web_ssh->activate($id);
		redirect(site_url('admin/servers.html'),'refresh');
	}
	
	public function deactivate($id=false) {
		$this->web_ssh->deactivate($id);
		redirect(site_url('admin/servers.html'),'refresh');
	}
	
	
	function add_continent() {
		
		$this->form_validation->set_rules('name', 'Nama Benua', 'required|is_unique[continent.name]');
		$this->form_validation->set_rules('description', 'Descripsi', '');

		if ($this->form_validation->run() === TRUE) {
			$data= array(
					'name' => $this->input->post('name'),
					'desc' => $this->input->post('description')
			);
			
			$this->continent_model->create($data);
			redirect(site_url('admin/server/continent/add.html'), 'refresh');
		}
		
		else {
			$this->data['continents'] = $this->continent_model->read()->result();
		
			
			
			
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['name'] = array (
				'name' => 'name',
				'type' => 'text',
				'class' => 'form-control',
				'placeholder'=>'Contoh: Asia'
			);
			$this->data['description'] = array (
				'name' => 'description',
				'class' => 'form-control',
				'rows' => '5',
				'placeholder'=>'Contoh: Benua ini adalah keren'
			);
			$this->template->admin_render('admin/servers/continent/add', $this->data);
		}
	
		
	}
	function update_continent($id=null) {
		
		$id = (int) $id;
		
		$continent = $this->continent_model->read($id)->row();
		if (!isset($continent->id)) show_404();
		
		
		$this->form_validation->set_rules('description', '', 'trim');
		
		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('name'))
			{
				$this->form_validation->set_rules('name', 'Nama Continent', 'trim|required|is_unique[continent.name]');
				
			}
			
			if ($this->form_validation->run() === TRUE)
			{
				
				
				if ($this->input->post('description')) {
					
					$data['description'] = $this->input->post('description');
				}
				if ($this->input->post('name'))
				{
					$data['name'] = $this->input->post('name');
				}
				$groupData = $this->input->post('groups');
				
				if (isset($groupData) && !empty($groupData))
					{

						$this->web_ssh->remove_from_continent($id, '');

						foreach ($groupData as $grp)
						{
							$this->web_ssh->add_to_continent($id, $grp);
							
						}

					}
				
				
				
				if (isset($data)) {
					
					$this->web_ssh->update_continent($id, $data);
				}
				redirect(site_url('admin/server/continent/add.html'), 'refresh');
			}
		//enf
		}
		
		
		$this->data['csrf'] = $this->_get_csrf_nonce();
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->data['continent']=$continent;
		$this->data['name'] = array(
			'name'=>'name',
			'type'=>'text',
			'class'=>'form-control',
			'placeholder'=> $continent->name
		);
		$this->data['description']=array(
			'name'=>'description',
			'class'=>'form-control',
			'rows'=> '5',
			'placeholder'=> $continent->desc,
		);
		$this->template->admin_render('admin/servers/continent/update', $this->data);
		
	}
	public function delete_continent($id = NULL)
	{
		

		$id = (int)$id;
		$continent = $this->continent_model->read($id)->row();
		if(!isset($continent->id)) show_404();
		
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() === FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['continent'] = $continent;

			$this->template->admin_render('admin/servers/continent/delete', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					return show_error($this->lang->line('error_csrf'));
				}
				
				$cek = $this->continent_model->getLocationId($id)->result();
				
				foreach ($cek as $c) {
					
					$this->location_model->delete($c->location_id);
				}
			
				$this->continent_model->delete($id);

			}

			// redirect them back to the auth page
			redirect(site_url('admin/server/continent/add.html'), 'refresh');
		}
	}
	
	//lov
	
	function add_location() {
		
		
		$this->form_validation->set_rules('name', 'Nama Location', 'required|is_unique[location.name]');
		$this->form_validation->set_rules('description', 'Descripsi', '');
		$this->form_validation->set_rules('id_continent', 'Continent', 'required|alpha_numeric');
		
		
		if ($this->form_validation->run() === TRUE) {
			
			$data = array(
				'name' =>$this->input->post('name'),
				'desc' => $this->input->post('description'),
				'continent_id' => $this->input->post('id_continent')
			);
			$this->location_model->create($data);
			
			redirect(site_url('admin/servers.html'), 'refresh');
		}
		
		else {
			
			
			$this->data['locations'] = $this->location_model->read()->result();
			foreach($this->data['locations'] as $k=>$l) {
				$cont = $this->continent_model->read($l->continent_id)->row();
				$this->data['locations'][$k]->continent =  $cont->name;
			}
			$this->data['continents'] = $this->continent_model->read()->result();
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['name'] = array (
				'name' => 'name',
				'type' => 'text',
				'class' => 'form-control',
				'placeholder'=>'Contoh: Singapore'
			);
			$this->data['description'] = array (
				'name' => 'description',
				'class' => 'form-control',
				'rows' => '5',
				'placeholder'=>'Contoh: The fast Lokation'
			);
			$this->template->admin_render('admin/servers/location/add', $this->data);
		}
	
		
	}
	function update_location($id=null) {
		
		$id = (int) $id;
		
		$location = $this->location_model->read($id)->row();
		if (!isset($location->id)) show_404();
		
		//$servers = $this->web_ssh->servers()->result_array();
		$continents = $this->continent_model->read()->result();
		
		$currentContinents = $this->continent_model->read($location->continent_id)->row();
		
		$this->form_validation->set_rules('description', '', 'trim');
		
		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('name'))
			{
				$this->form_validation->set_rules('name', 'Nama Location', 'trim|required|is_unique[location.name]');
				
			}
			
			if ($this->form_validation->run() === TRUE)
			{
				
				
				if ($this->input->post('description')) {
					
					$data['description'] = $this->input->post('description');
				}
				if ($this->input->post('name'))
				{
					$data['name'] = $this->input->post('name');
				}
				if ($this->input->post('continent')) {
				
						echo 'error'; return;
				
				}
			
				if (isset($data)) {
					
					$this->web_ssh->update_location($id, $data);	
				}
				redirect(site_url('admin/server/location/'.$id.'/update.html'), 'refresh');
			}
		//enf
		}
		$this->data['continents'] = $continents;
		$this->data['currentContinents'] = $currentContinents;
		//$this->data['servers'] = $servers;
		
		$this->data['csrf'] = $this->_get_csrf_nonce();
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->data['location']=$location;
		$this->data['name'] = array(
			'name'=>'name',
			'type'=>'text',
			'class'=>'form-control',
			'placeholder'=> $location->name
		);
		$this->data['description']=array(
			'name'=>'description',
			'class'=>'form-control',
			'rows'=> '5',
			'placeholder'=> $location->desc,
		);
		$this->template->admin_render('admin/servers/location/update', $this->data);
		
	}
	
	
	public function delete_location($id = NULL)
	{

		$location_id = (int)$id;
		$location = $this->location_model->read($location_id)->row();
		if(!isset($location->id)) show_404();
		
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() === FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['location'] = $location;

			$this->template->admin_render('admin/servers/location/delete', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $location_id != $this->input->post('id'))
				{
					return show_error($this->lang->line('error_csrf'));
				}
			
				$this->location_model->delete($location_id);

			}

			// redirect them back to the auth page
			redirect(site_url('admin/server/location/add.html'), 'refresh');
		}
	}
	public function auto() {
		
		
		$port_array = array();
		$service_array = array();
		
		
		$ports = $this->port_model->read()->result();
		foreach($ports as $port) {
			
			array_push($port_array, $port->name);
		}
		
		$services = $this->service_model->read()->result();
		
		foreach($services as $service) {
			
			array_push($service_array, $service->name);
		}
		
		$locations = $this->location_model->read()->result();
		
		foreach($locations as $location) {
			
			
			
			$replace = str_replace(' ', '', $location->name);
			$replace = str_replace(',', '-', $replace);
			//echo $replace. '<br>';
			$host = substr( $replace, 0, 2 );
			$init = substr( $replace, 0, 3 );
			
			
			for($i=1; $i<13; $i++) {
				
				$new = $host .$i. '.'.$_SERVER['HTTP_HOST'];
				$name = 'webssh '. $init . ' '. $i;   
				$host_ok = strtolower($new);
				$service = $service_array[mt_rand(0, count($service_array) - 1)];
				$port = $port_array[mt_rand(0, count($port_array) - 1)];
				
				
				echo 'Server name = '.$name. '<br>';
				echo 'Host = ' .$host_ok. '<br>';
				echo 'Location = ' .$location->name. '<br>';
				echo 'Service = ' .$service.'<br>';
				echo 'Port = ' .$port. '<br>';
				
				
				$this->web_ssh->register($name, $host_ok, uniqid(), $location->name, $service, $port);
				
				echo '<hr>';
				
			
				
			}
			
		}
		//$this->web_ssh->register($name, $host, $password, $location, $service, $port);
	}
	public function del() {
		foreach($this->web_ssh->servers()->result() as $res) {
			$this->web_ssh->delete($res->id);
		}
	}
	
	
}
