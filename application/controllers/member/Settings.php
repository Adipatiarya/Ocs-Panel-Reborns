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
class Settings extends Member_Controller {
	
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        
		
	}
	public function index()
	{	

		$this->template->member_render('member/settings/index', $this->data);
	}
	
	public function fullname() {
		
		
		function getUser($string) {
			$build = explode(" ", $string);
			if (count($build) < 2) {
					array_push($build, null);
			}
			return $build;
		}
		
		
		$user = $this->data['user'];
		$id = $user->id;
		
		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
		if (isset($_POST) && !empty($_POST)) {
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}
			if ($this->form_validation->run() === TRUE) {
				
				$full_name = getUser($this->input->post('full_name'));
				$data = array(
				
					'first_name' => $full_name[0],
					'last_name' => $full_name[1],
				);
				if ($this->ion_auth->update($user->id, $data)) {
					
					//jika success go settings menu
					
					$this->session->set_flashdata('profile', 'Full name success di update');
					redirect('panel/'.$user->username.'/settings.html', 'refresh');
				}
				else {
					//jika gagal back to pages
					
					$this->session->set_flashdata('error', $this->ion_auth->errors());
					redirect('panel/'.$user->username.'/setting/fullname.html', 'refresh');
				}
			}
			
		}
		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();
		//$this->data['user'] = $user;
		
		//titel
		
		$this->data['title'] = 'Edit nama lengkap';
		$this->data['form_label'] = 'full_name';
		
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['data'] = array(
			'name'  => 'full_name',
			'id'    => 'full_name',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('full_name', $user->first_name ." ". $user->last_name),
		);
		$this->template->member_render('member/settings/profile', $this->data);
		
		
	}
	
	
	public function username() {
			
		$user = $this->data['user'];
		$id = $user->id;
		
		
		$tables = $this->config->item('tables', 'ion_auth');
		$this->form_validation->set_rules('username', $this->lang->line('edit_user_validation_username_label'), 'min_length[5]|callback___username_check|is_unique[' . $tables['users'] . '.username]');
		$this->form_validation->set_message(
			array (
				'__username_check'=>'User ID Hanya diijinkan huruf dan nomor',
				'is_unique' => 'User ID '.$this->input->post('username').' sudah di gunakan',
				
			)
			
		);
		if (isset($_POST) && !empty($_POST)) {
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}
			if ($this->form_validation->run() === TRUE) {
				
				$username = $this->input->post('username');
				$data = array(
				
					'username' => $username
				);
				if ($this->ion_auth->update($user->id, $data)) {
					
					//jika success go settings menu
					$this->session->set_flashdata('profile', 'Username success di update');
					redirect('panel/'.$user->username.'/settings.html', 'refresh');
				}
				else {
					//jika gagal back to pages
					
					$this->session->set_flashdata('error', $this->ion_auth->errors());
					redirect('panel/'.$user->username.'/setting/username.html', 'refresh');
				}
			}
			
		}
		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();
		//$this->data['user'] = $user;
		
		// settitle
		
		$this->data['title'] = 'Edit username';
		$this->data['form_label'] = 'username';
		
		
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['data'] = array(
			'name'  => 'username',
			'id'    => 'username',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('username', $user->username),
		);
		$this->template->member_render('member/settings/profile', $this->data);
		
		
	}
	
	public function phone() {
			
		$user = $this->data['user'];
		$id = $user->id;
		
		$tables = $this->config->item('tables', 'ion_auth');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim|required');
		if (isset($_POST) && !empty($_POST)) {
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}
			if ($this->form_validation->run() === TRUE) {
				
				$data = array(
				
					'phone' => $this->input->post('phone')
				);
				if ($this->ion_auth->update($user->id, $data)) {
					
					//jika success go settings menu
					$this->session->set_flashdata('profile', 'Phone success di update');
					redirect('panel/'.$user->username.'/settings.html', 'refresh');
				}
				else {
					//jika gagal back to pages
					
					$this->session->set_flashdata('error', $this->ion_auth->errors());
					redirect('panel/'.$user->username.'/setting/phone.html', 'refresh');
				}
			}
			
		}
		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();
		//$this->data['user'] = $user;
		//title
		$this->data['title'] = 'Edit telephone';
		$this->data['form_label'] = 'phone';
		
		
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['data'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->template->member_render('member/settings/profile', $this->data);
		
		
	}
	
	public function email() {
			
		$user = $this->data['user'];
		$id = $user->id;
		
		$tables = $this->config->item('tables', 'ion_auth');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
		if (isset($_POST) && !empty($_POST)) {
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}
			if ($this->form_validation->run() === TRUE) {
				
				$data = array(
				
					'email' => $this->input->post('email')
				);
				if ($this->ion_auth->update($user->id, $data)) {
					
					//jika success go settings menu
					$this->session->set_flashdata('profile', 'Email success di update');
					redirect('panel/'.$user->username.'/settings.html', 'refresh');
				}
				else {
					//jika gagal back to pages
					
					$this->session->set_flashdata('error', $this->ion_auth->errors());
					redirect('panel/'.$user->username.'/setting/email.html', 'refresh');
				}
			}
			
		}
		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();
		//$this->data['user'] = $user;
		
		//title
		
		$this->data['title'] = 'Edit email';
		$this->data['form_label'] = 'email';
		
		
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['data'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'email',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('email', $user->email),
		);
		$this->template->member_render('member/settings/profile', $this->data);
		
		
	}
	
	
	public function password()
	{


		//$id = $this->ion_auth->get_user_id();
		$identity_column = $this->config->item('identity', 'ion_auth');
		$user = $this->data['user'];
		$id = $user->id;		
		
		

		if (isset($_POST) && !empty($_POST))
		{
			
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}
			
			$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

			if ($this->form_validation->run() === TRUE)
			{
				
				$data = array(
				
					'password' => $this->input->post('password')
				);

				// check to see if we are updating the user
				
				if ($this->ion_auth->update($user->id, $data))
				{
					
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('profile', 'Success Update password');
					redirect('panel/'.$user->username.'/settings.html', 'refresh');
					

				}
				//end
				
				else
				{
					
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('error', $this->ion_auth->errors());
					redirect('panel/'.$user->username.'/settings/password.html', 'refresh');
					

				}

			}
		}
		
		// display the edit user form
		//$this->data['user'] = $user;
		$this->data['csrf'] = $this->_get_csrf_nonce();
		// title
		$this->data['title'] = 'Ganti Password';
		$this->data['form_label'] = 'Password';

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password',
			'class' => 'form-control',
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password',
			'class' => 'form-control',
		);

		$this->template->member_render('member/settings/password', $this->data);
	}
	function foto()
	{
		$user = $this->data['user'];
		$id = $user->id;
		
		$this->form_validation->set_rules('id','ID', 'required');
		
		
		if($this->form_validation->run()=== TRUE) {
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}
			//echo $this->input->post('image'); return;
			$config['upload_path']          = './uploads/profiles/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['file_name']			= 'image-'.$id.'.jpg';
            $config['overwrite']			= TRUE;
            //$config['max_size']             = 1024;
            //$config['max_width']            = 1024;
            //$config['max_height']           = 768;
            
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('image'))
            {
				$this->session->set_flashdata('uploads', $this->upload->display_errors());
				show_error($this->upload->display_errors());
				//return;
					//redirect('panel/'.$pengirim->username.'/voucher/'.$keranjang_id.'/bayar.html', 'refresh');
            }
            $image = $this->upload->data();
            $this->load->library('convert');
            $this->convert->img($image['full_path']);
            
            
            if ($this->ion_auth->update($id, array('image'=>$image['file_name']))) {
				redirect('panel/'.$user->username.'/setting/foto.html', 'refresh');
			}
		}
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['csrf'] = $this->_get_csrf_nonce();
		$this->data['image'] = array(
				'name' => 'image',
				'id' => 'image',
				'type' => 'file',
		);
		$this->template->member_render('member/settings/foto', $this->data);
	}

	public function __username_check($str) {
		if (preg_match('/^[a-zA-Z0-9]+$/', $str ) )
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
    }
}
