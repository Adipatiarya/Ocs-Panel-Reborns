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
class Webssh extends Admin_Controller {
	

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('server_config', 'templates_model'));
		

	}
	
	function index() {
		
		$this->form_validation->set_rules('premium', 'Premium', 'required|numeric');
		$this->form_validation->set_rules('trial', 'Trial', 'required|numeric');
		$this->form_validation->set_rules('free', 'Free', 'required|numeric');
		
		
		if ($this->form_validation->run() === TRUE) {
			$data = array(
				'premium' => $this->input->post('premium'),
				'trial'=> $this->input->post('trial'),
				'free'=> $this->input->post('free')
			);
			if ($this->input->post('set')) {
				$config = $this->input->post('set');
				
				switch($config) {
					case 'continent_only':
							$data['location_only'] = FALSE;
							$data['server_only'] = FALSE;
							$data['continent_only'] = TRUE;
					break;
					
					case 'location_only' :
							$data['location_only'] = TRUE;
							$data['server_only'] = FALSE;
							$data['continent_only'] = FALSE;
					break;
					
					case 'server_only' :
					
							$data['location_only'] = FALSE;
							$data['server_only'] = TRUE;
							$data['continent_only'] = FALSE;
					break;
				 default:
					redirect(site_url('admin/webssh.html'), 'refresh');
						
				}
			}
			$this->server_config->update($data);
			redirect(site_url('admin/webssh.html'), 'refresh');
		}
		
		else {
			
			$this->data['templates'] = $this->templates_model->read()->result();
			
			$this->data['config'] = $this->server_config->read()->row();
			$this->data['message']=$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['theme'] = $this->session->flashdata('theme');
			$this->template->admin_render('admin/web/index', $this->data);
		}
	}
	public function public_enable() {
		
		$this->form_validation->set_rules('public_enable', 'Public', 'required|numeric');
		
		if ($this->form_validation->run() === TRUE) {
			$data['public_enable'] = $this->input->post('public_enable');
			$this->server_config->update($data);
			redirect(site_url('admin/webssh.html'), 'refresh');
		}
		else {
			
			$data['public_enable'] = FALSE;
			$this->server_config->update($data);
			
			redirect(site_url('admin/webssh.html'), 'refresh');
		}
		
	}
	public function change_theme() {
		$this->form_validation->set_rules('template', 'Template', 'required');
		
		if ($this->form_validation->run() === TRUE) {
			
			$data['template'] = $this->input->post('template');
			$this->server_config->update($data);
		redirect(site_url('admin/webssh.html'), 'refresh');
		}
		else {
			
			redirect(site_url('admin/webssh.html'), 'refresh');
		}
	}
}
