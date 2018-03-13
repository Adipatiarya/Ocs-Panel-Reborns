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
class Keranjang extends Member_Controller {
	

	function __construct()
	{
		parent::__construct();
		
	}
	
	function index() {
		
		$user = $this->data['user'];
		
		
		$this->form_validation->set_rules('voucher', 'Required', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->library('pagination');
		//setting variable 
			
			$total_row = $this->keranjang_model->read_user($user->id)->num_rows();
			$config['base_url'] = site_url('member/keranjang/index');
			$config['total_rows'] = $total_row;
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
			$config['user_id']=$user->id;
			$this->pagination->initialize($config);
			$this->data['link'] = $this->pagination->create_links();
			$this->data['config']=$this->uri->segment(4);
			$this->data['keranjangs'] =$this->keranjang_model->pagination($config)->result();
			foreach ($this->data['keranjangs'] as $k => $keranjang) {
			
				$this->data['keranjangs'][$k]->price = $this->voucher_model->read($keranjang->voucher_id)->row()->price;
				$on_process = $this->voucher_invoice->check($keranjang->id);
				if ($on_process) {
					$this->data['keranjangs'][$k]->status = true;
				}
				else {
					$this->data['keranjangs'][$k]->status = false;
				}
		
			
			}
			$voucher = $this->voucher_model->read_unlock()->result();
			$this->data['vouchers'] = $voucher;
			$this->template->member_render('member/keranjang/keranjang', $this->data);
		}
		else {
			$voucher = $this->input->post('voucher');
			redirect('panel/'.$user->username.'/voucher/'.$voucher.'/beli.html', 'refresh');
			//panel/(:any)/voucher/(:num)/beli.html
		}
	}
	
	public function del($keranjang_id='') {
		
		
		if($keranjang_id === null) show_404();

		$user = $this->data['user'];
		
		$keranjang = $this->keranjang_model->read($keranjang_id)->row();
		
		
		if($keranjang_id == null) {
			redirect('panel/'.$user->username.'/keranjang.html', 'refresh');
		}
		if ($keranjang->user_id !== $user->id) {
			redirect('panel/'.$user->username.'/keranjang.html', 'refresh');
		}
		if ($this->keranjang_model->delete($keranjang_id)) {
			
			redirect('panel/'.$user->username.'/keranjang.html', 'refresh');
		}
		else {
			redirect('panel/'.$user->username.'/keranjang.html', 'refresh');
		}
		
		
	}
	public function read($keranjang_id='') {
		if($keranjang_id === null) show_404();
		
		
		//set object user
		$user = $this->data['user'];
		
		$invoice = $this->voucher_invoice->read_keranjang($keranjang_id)->row();
		$keranjang = $this->keranjang_model->read($keranjang_id)->row();
		$voucher = $this->voucher_model->read($keranjang->voucher_id)->row();
		
		
		if($keranjang_id == null) {
			redirect('panel/'.$user->username.'/keranjang.html', 'refresh');
		}
		if ($keranjang->user_id !== $user->id) {
			redirect('panel/'.$user->username.'/keranjang.html', 'refresh');
		}
		$this->data['pembeli'] = $user;
		$this->data['keranjang']=$keranjang;
		$this->data['voucher']=$voucher;
		if(!empty($invoice->id)) {
			
			$this->data['invoice']=$invoice;
		}
		else {
			redirect('panel/'.$user->username.'/voucher/'.$keranjang_id.'/bayar.html', 'refresh');
		}
		
		$this->template->member_render('member/keranjang/detail', $this->data);
		
	}

}
