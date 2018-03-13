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
class Voucher_invoice extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function create($voucher_invoice) {
		
		$this->db->insert('voucher_invoice', $voucher_invoice);
		return $this->db->insert_id();
	}
	function pagination($config){
		$this->db->order_by("id","desc");
        return $this->db->get('voucher_invoice', $config['per_page'], $this->uri->segment($config['uri_segment']));
           
    }
	public function read($id=false) {
		
		if ($id) {
			
			$query = $this->db->get_where('voucher_invoice', array('id' => $id));
			
			return $query;
		}
		else
		
		{
			return $this->db->get('voucher_invoice');
		
		}
		
	}
	public function read_keranjang($id) {
		
		return $this->db->get_where('voucher_invoice', array('keranjang_id' => $id));
		
	}
	public function belum_dibaca() {
		return $this->db->get_where('voucher_invoice', array('dibaca'=>false));
	}
	public function update($id) {
		
		$this->db->where('id', $id);
		return $this->db->update('voucher_invoice', array('dibaca' => true));
	}
	public function check($id = '')
	{
		

		if (empty($id))
		{
			return FALSE;
		}

		return $this->db->where('keranjang_id', $id)
						->limit(1)
						->count_all_results('voucher_invoice') > 0;
	}
	public function delete($id) {}
	
	
}
