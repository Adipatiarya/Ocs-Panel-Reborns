<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
class Servers extends Member_Controller {
	

	function __construct()
	{
		parent::__construct();
		
		
		$this->load->model(array (
			'location_model',
			'continent_model',
			'port_model',
			'service_model',
			'server_config',
			'server_created')
		);

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
    
	function index() {
		
		
		$id = $this->input->post('id');
		
		$this->data['locations'] = $this->location_model->read()->result();
		
		
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('member/servers/index');
		$config['total_rows'] = $this->web_ssh->servers()->num_rows();
		$config['per_page']=4;
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
		$this->template->member_render('member/servers/index', $this->data);
		
	}
	public function create($id=false) {
		
		$this->load->model('server_created');
		$user = $this->data['user'];
		
		
		$server = $this->web_ssh->server($id)->row();
		$config = $this->server_config->read()->row();
		
		if (!isset($server->id)) show_404();
		
		
		if ($user->saldo < $server->price) {
		
			$message = '<div class="alert alert-danger">Saldo anda tidak cukup</div>';
			$this->session->set_flashdata('message', $message);
			redirect(site_url('panel/'.$user->username.'/servers.html'), 'refresh');
		}
		elseif ((int) $this->server_created->countServerCreated($server->id) >= (int) $server->limit_user) {
			
			$data['active'] = FALSE;
			
			$this->web_ssh->update($server->id, $data);
		}
		
		elseif ( ! $server->active) {
			
			$message = '<div class="alert alert-danger">Server Locked</div>';
			$this->session->set_flashdata('message', $message);
			redirect(site_url('panel/'.$user->id.'/servers.html'), 'refresh');
		}
		
		else {
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[10]|callback___str_check|is_unique[server_created.username]');
		$this->form_validation->set_message('__str_check', 'Username not valid');
		$this->form_validation->set_message('is_unique', 'Username sudah dipake');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[10]');
		$this->form_validation->set_rules('id', 'ID ', 'required|alpha_numeric');
		
		
		if ($this->form_validation->run() === TRUE) {
			
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				return show_error($this->lang->line('error_csrf'));
			}
			
			
			
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			
			$data = array(
			
				'server_id' => $server->id,
				'created_by'=> $user->username,
				'username' => $username,
				'password' => $password,
				'created_on'=> time(),
				'price' => (empty ($server->price) ) ? '0' : $server->price,
			);
			
			
			$limit ='';
			
			if ($this->input->post('type')) {
				
				$type = $this->input->post('type');
				
				if ($type === 'trial') {
					
					$data['expired_on'] = strtotime('+'.$config->trial.' day', time());
					$data['trial'] = TRUE; $limit = $config->trial;
				}
				else {
					
					$data['expired_on'] = strtotime('+'.$config->premium.' day', time());
					$limit = $config->premium;
				}
				
				
			}
			
			$ssh = $this->ssh->addAccount($server->host,$server->password, $username, $password, $limit );
			
			
			if ( $ssh !== FALSE ) {
				
				$id = $this->server_created->create($data);
				
				$saldo = (int) $user->saldo - (int) $server->price;
				
				$this->ion_auth->update($user->id, array('saldo' => $saldo));
				
				$this->data['account'] = $this->server_created->read($id);
				
				
				
			}
			else {
			    show_error("SERVER NOT FOUND");
			}
			
			
			

			//echo date('Y-m-d H:i:s', $data['expired_on']);
			
			/*$now = time();
			$next = strtotime('+30 day', $now);
			
			
			echo date('y-m-d h:i:s', $now);
			echo "<br> Besok";
			echo date('y-m-d h:i:s', $next);
			*/
			
			
		}
		
		else {
			
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['server'] = $server;
			$this->data['config'] = $config;
			
			$this->data['username'] = array(
					'name'=>'username',
					'type' => 'text',
					'class'=> 'form-control',
					'required'=>'',
					'placeholder'=>'Username'
			);
			$this->data['password'] = array(
					'name'=>'password',
					'type' => 'password',
					'class'=> 'form-control',
					'required'=>'',
					'placeholder'=>'Password'
			);
			
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['id'] = array('name'=>'id', 'value' => $server->id, 'type'=>'hidden');
			
			
			
			$this->template->member_render('member/servers/create', $this->data);
		}
		
		
	}
	} //endelse
	
}
