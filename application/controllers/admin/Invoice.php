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

class Invoice extends Admin_Controller {
	

	function __construct()
	{
		parent::__construct();

	}
	
	function index() {
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('admin/invoice/index');
		$config['total_rows'] = $this->voucher_invoice->read()->num_rows();
		$config['per_page']=4;
        $config['num_links'] = 2;
        
        $config['uri_segment']=4;
		
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
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
        $config['next_link']='> ';
        $config['prev_link']='< ';
		$this->pagination->initialize($config);
		$this->data['link'] = $this->pagination->create_links();
		$this->data['config']=$this->uri->segment(4);
		$this->data['invoices'] =$this->voucher_invoice->pagination($config)->result();
		
		
		
		foreach ($this->data['invoices'] as $k=> $invoice) {
			$this->data['invoices'][$k]->pengirim = $this->__getName($invoice->keranjang_id)->row();
			$this->data['invoices'][$k]->transaksi = $this->keranjang_model->read($invoice->keranjang_id)->row();  
		}
		$this->template->admin_render('admin/invoice/invoice', $this->data);
	}
	private function __getName($id) {
		$keranjang = $this->keranjang_model->read($id)->row();
		return $this->ion_auth->user($keranjang->user_id);
	}
	public function test() {
		echo $this->saldo_model->update(27, 5000);
	}
	public function read($id = NULL)
	{
		
		
		$invoice = $this->voucher_invoice->read($id)->row();
		if(!$invoice->dibaca) $this->voucher_invoice->update($id);
		
		$keranjang = $this->keranjang_model->read($invoice->keranjang_id)->row();
	    $pembeli = $this->__getName($invoice->keranjang_id)->row();
	    $voucher = $this->voucher_model->read($keranjang->voucher_id)->row();
		if (empty($voucher->id)) show_404();
		$id = (int)$id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'Confirm', 'required');
		$this->form_validation->set_rules('id', 'ID', 'required|alpha_numeric');

		if ($this->form_validation->run() === FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			
			$this->data['keranjang'] = $keranjang;
			$this->data['pembeli'] = $pembeli;
			$this->data['voucher'] = $voucher;
			$this->data['invoice'] = $invoice;
			
			//set message
			$this->data['message'] = $this->session->flashdata('message');

			$this->template->admin_render('admin/invoice/accept', $this->data);
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
				
				if($this->keranjang_model->update($keranjang->id)) {
					
					$saldo = $pembeli->saldo;
					
					$hasil =(int)$saldo + (int)$voucher->value;
					$id = (int) $pembeli->id;
					
					
					if($this->ion_auth->update($id, array('saldo'=>$hasil))) {
						
						$this->session->set_flashdata('message', 'Saldo success ditambahkan');
					}
					else {
						$this->session->set_flashdata('message', 'Saldo gagal ditambahkan');
					}
					
					
				}

			}
			
			redirect('admin/invoice/read/'.$invoice->id.'/baca.html', 'refresh');
		}
	}

}
