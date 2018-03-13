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
class Voucher_model extends CI_Model {

	
	public function __construct() {
		parent::__construct();
		
	}
	
	public function create($data) {
		return $this->db->insert('voucher', $data);
	}
	public function read($id = '') {
		
	
		if(!empty($id))
		{
			$this->db->where('id', $id);
			
		}
		return $this->db->get('voucher');
	}
	public function read_unlock($id=null) {
		
	
		if(!empty($id))
		{
			$this->db->where('id', $id);
			
			
		}
		$this->db->where('active', true);
		return $this->db->get('voucher');
	}
	public function update($id, $data) {
		
		$this->db->where('id', $id);
		return $this->db->update('voucher', $data);
	}
	public function delete($id) {
		
		$this->db->where('id', $id);
		return $this->db->delete('voucher');
	}
}
