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

class Profile extends Admin_Controller {
	
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('server_created');
		$this->load->model('web_ssh');
	}
	public function index($id = null)
	{	
		if($id === null) show_404();
		$profile = $this->ion_auth->user($id)->row();
		
		
		$servers_created = $this->server_created->getUserCreated($profile->username)->result();
		$this->data['profile'] = $profile;
		
		$this->data['servers_created'] = $servers_created;
		
		foreach ($this->data['servers_created'] as $i=>$j) {
			
			$this->data['servers_created'][$i]->server = $this->web_ssh->server($j->server_id)->row();
		}
		
		//$this->data['server'] = $this->web_ssh->server($server_created->server_id)->row();
		$this->template->admin_render('admin/users/profile', $this->data);
	}
	public function deactivate($id = NULL)
	{

		$id = (int)$id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() === FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->template->admin_render('admin/users/deactivate_user', $this->data);
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

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect(site_url('admin/users/users.html'), 'refresh');
		}
	}
	public function activate($id)
	{
		
		
		$activation = $this->ion_auth->activate($id);
		if ($activation)
		{
		
			redirect(site_url('admin/users/users.html'), 'refresh');
		}
	}


}
