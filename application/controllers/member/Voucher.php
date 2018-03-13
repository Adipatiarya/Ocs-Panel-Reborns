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
class Voucher extends Member_Controller {
	
	

	function __construct()
	{
		parent::__construct();
		
	}
	
	function index($id = false) {
		
		$user = $this->data['user'];
		
		if ($id == false)
		{
			
			$this->data['vouchers'] = $this->voucher_model->read_unlock()->result();
			$this->template->member_render('member/voucher/index', $this->data);
			
			
		}
		else {
			
		
			$voucher = $this->voucher_model->read($id)->row();
			$data_keranjang = array (
					'name' => uniqid(),
					'user_id' => $user->id,
					'voucher_id' => $voucher->id,
					'created_on' => time() 
			);
			if ($this->data['jumlah_keranjang'] > 4) {
				
				$this->session->set_flashdata('message', 'Selesaikan transaksi sebelumnya dahulu');
				redirect('panel/'.$user->username.'/keranjang.html', 'refresh');
				
			}
			$keranjang = $this->keranjang_model->create($data_keranjang);
			redirect('panel/'.$user->username.'/voucher/'.$keranjang. '/bayar.html', 'refresh');
			}
	}
	function bayar($keranjang_id='')
	{
		if(! $this->keranjang_model->keranjang_check($keranjang_id)) {
			show_404();
		}
		$id = $this->ion_auth->get_user_id();
		$keranjang = $this->keranjang_model->read($keranjang_id)->row();
		$pengirim = $this->ion_auth->user($keranjang->user_id)->row();
		$jumlah = $this->voucher_model->read($keranjang->voucher_id)->row()->price;
		
		if ($keranjang->user_id !== $id)
		{
			show_404();
		}
		
		
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
		
		
		if ($this->form_validation->run() === TRUE) {
			
				$config['upload_path']          = './uploads/bukti_transfer/';
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['file_name']			= $keranjang->name;
                $config['overwrite']			= TRUE;
                //$config['max_size']             = 2048;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;
                
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('image'))
                {
					$this->session->set_flashdata('uploads', $this->upload->display_errors());
					redirect('panel/'.$pengirim->username.'/voucher/'.$keranjang_id.'/bayar.html', 'refresh');
                }
                
                
				if ($this->voucher_invoice->check($keranjang_id)) {
					
					$this->session->set_flashdata('success', 'Pesanan Anda sedang kami proses.');
					redirect('panel/'.$pengirim->username.'/voucher/'.$keranjang_id. '/bayar.html', 'refresh');
				}
				$image = $this->upload->data();
                
                $voucher_invoice = array (
               
						'keranjang_id'=> $keranjang->id,
						'created_on' =>time(),
						'message' => 'Request saldo via ' .$this->input->post('to'),
						'bukti' => $image['file_name'],
				);  
                
			
		}
		if ($this->form_validation->run() === TRUE && $this->voucher_invoice->create($voucher_invoice) )
		{
			$this->session->set_flashdata('success', 'Terima kasih Telah membeli di server Kami');
			redirect('panel/'.$pengirim->username.'/voucher/'.$keranjang_id. '/bayar.html', 'refresh');
		}
		else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			
			$this->data['telp'] = array(
				'name' => 'phone',
				'id' => 'phone',
				'type' => 'text',
				'value' => $pengirim->phone,
			);
			$this->data['email'] = array(
				'name' => 'email',
				'id' => 'email',
				'type' => 'email',
				'readonly' => 'readonly',
				'value' => $pengirim->email,
			);
			$this->data['jumlah'] = array(
				'name' => 'jumlah',
				'id' => 'jumlah',
				'type' => 'text',
				'readonly' => 'readonly',
				'value' => $jumlah,
			);
			$this->data['image'] = array(
				'name' => 'image',
				'id' => 'image',
				'type' => 'file',
				'size' => '20',
				'required' => null
			);
			$this->data['banks'] = $this->bank_model->read()->result();
			$this->data['phones'] = $this->phone_model->read()->result();	
			$this->data['keranjang'] = $keranjang;
			$this->template->member_render('member/voucher/bayar', $this->data);
		}
	}

}
