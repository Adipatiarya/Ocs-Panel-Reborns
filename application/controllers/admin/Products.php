<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller {
	

	function __construct()
	{
		parent::__construct();
		
	}
	
	function index() {
		
		$this->data['vouchers'] = $this->voucher_model->read()->result();
		
		$this->template->admin_render('admin/products/index', $this->data);
	}
	public function voucher_update($id=null) {
		
		if($id === null) show_404();
		
		
		$voucher = $this->voucher_model->read($id)->row();
		if(empty($voucher->id)) show_404();
		
		if (!empty($this->input->post('name'))) {
			
			$this->form_validation->set_rules('name','Voucher', 'trim|required|is_unique[voucher.name]');
		}	
		
		$this->form_validation->set_rules('price','Price', 'trim|required|callback___number_check');
		$this->form_validation->set_rules('value','Value', 'trim|required|callback___number_check');
		$this->form_validation->set_message(
			array (
				'__number_check' => 'Kesalahan input format price atau value',
				'is_unique' => 'Nama Voucher '.$this->input->post('name').' sudah di gunakan'
				
			)
			
		);
		if (isset($_POST) && !empty($_POST)) {
			if ($this->_valid_csrf_nonce() === FALSE)
			{
				show_error($this->lang->line('error_csrf'));
			}
			if ($this->form_validation->run() === TRUE) {
				
				$data = array(
				
					'price' => $this->input->post('price'),
					'value' => $this->input->post('value')
				);
				if (!empty($this->input->post('description'))) {
					
					$data['description'] = $this->input->post('description');
				}
				if (!empty($this->input->post('name'))) {
					
					$data['name'] = $this->input->post('name');
				}
				if ($this->voucher_model->update($id, $data)) {
					
					//jika success go settings menu
					//$this->session->set_flashdata('profile', '');
					redirect('admin/products.html', 'refresh');
				}
				else {
					//jika gagal back to pages
					
					//$this->session->set_flashdata('error', $this->ion_auth->errors());
					redirect('admin/product/voucher/'.$id.'/update.html', 'refresh');
				}
			}
			
		}
		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();
		//$this->data['user'] = $user;
		$this->data['voucher'] = $voucher;
		//title
		
		$this->data['title'] = 'Voucher Edit';
		$this->data['form_label'] = 'Voucher';
		
		
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['name'] = array(
			'name'  => 'name',
			'id'    => 'name',
			'type'  => 'text',
			'class' => 'form-control',
			'placeholder' => $this->form_validation->set_value('name', $voucher->name),
		);
		$this->data['price'] = array(
			'name'  => 'price',
			'id'    => 'price',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('price', $voucher->price),
		);
		$this->data['value'] = array(
			'name'  => 'value',
			'id'    => 'value',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('value', $voucher->value),
		);
		$this->template->admin_render('admin/products/voucher/update', $this->data);
		
		
	}
	
	public function voucher_lock($id=null) {
		if($id === null) show_404();
		$lock = $this->voucher_model->update($id, array('active'=>false));
		if ($lock) {
			redirect('admin/products.html', 'refresh');
		}
	}
	public function voucher_unlock($id=null) {
		if($id === null) show_404();
		$unlock = $this->voucher_model->update($id, array('active'=>true));
		if ($unlock) {
			redirect('admin/products.html', 'refresh');
		}
	}
	public function voucher_add() {
			
		$this->form_validation->set_rules('name','Voucher', 'trim|required|is_unique[voucher.name]');
		$this->form_validation->set_rules('price','Price', 'trim|required|callback___number_check');
		$this->form_validation->set_rules('value','Value', 'trim|required|callback___number_check');
		$this->form_validation->set_message(
			array (
				'__number_check'=>'Invalid value',
				'is_unique' => 'voucher '.$this->input->post('name').' sudah di gunakan',
				
			)
			
		);
		if (isset($_POST) && !empty($_POST)) {
			if ($this->_valid_csrf_nonce() === FALSE)
			{
				show_error($this->lang->line('error_csrf'));
			}
			if ($this->form_validation->run() === TRUE) {
				
				$data = array(
				
					'name' => $this->input->post('name'),
					'price' => $this->input->post('price'),
					'value' => $this->input->post('value')
				);
				if (!empty($this->input->post('description'))) {
					
					$data['description'] = $this->input->post('description');
				}
				if ($this->voucher_model->create($data)) {
					
					//jika success go settings menu
					//$this->session->set_flashdata('profile', '');
					redirect('admin/products.html', 'refresh');
				}
				else {
					//jika gagal back to pages
					
					//$this->session->set_flashdata('error', $this->ion_auth->errors());
					redirect('admin/product/voucher/add.html', 'refresh');
				}
			}
			
		}
		// display the edit user form
		//$this->data['user'] = $user;
		
		//title
		
		$this->data['title'] = 'ADD Voucher';
		$this->data['form_label'] = 'voucher';
		
		$this->data['csrf'] = $this->_get_csrf_nonce();
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['name'] = array(
			'name'  => 'name',
			'id'    => 'name',
			'type'  => 'name',
			'class' => 'form-control',
			'placeholder' => 'Ex: voucher1',
			'required' =>''
		);
		$this->data['price'] = array(
			'name'  => 'price',
			'id'    => 'price',
			'type'  => 'number',
			'class' => 'form-control',
			'placeholder' => 'Ex: 50000',
			'required' =>''
		);
		$this->data['value'] = array(
			'name'  => 'value',
			'id'    => 'value',
			'type'  => 'number',
			'class' => 'form-control',
			'placeholder' => 'Ex: 55000',
			'required' =>''
		);
		$this->template->admin_render('admin/products/voucher/add', $this->data);
		
		
	}
	public function __number_check($str) {
		if (preg_match('/^[0-9]+$/', $str ) )
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
    }
	
}
