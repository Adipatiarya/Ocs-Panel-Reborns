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

class Users extends Admin_Controller {
	

	function __construct()
	{
		parent::__construct();
		$this->load->model('server_created');
	}
	
	function index() {
		
		$this->data['sellers'] = $this->ion_auth->users()->result();
		$this->data['servers_created'] = $this->server_created->read()->result();
		foreach($this->data['servers_created'] as $i=>$j) {
			
			$host = $this->web_ssh->server($j->server_id)->row();
			if (!isset($host->id)) {
				$this->data['servers_created'][$i]->server = '<strike>Deleted</strike>';
			}
			else {
				
				$this->data['servers_created'][$i]->server = $host->host;
			}
			 
			 
		}
		
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$valid_id = null; $buang = null;
		foreach ($this->data['sellers'] as $k => $seller)
		{
			
			$this->data['sellers'][$k]->group = $this->ion_auth->get_users_groups($seller->id)->row()->name;	
			$this->data['sellers'][$k]->account_dibuat = $this->server_created->getUserCreated($seller->username)->num_rows();
		}
		$this->template->admin_render('admin/users/index', $this->data);
	}
}
