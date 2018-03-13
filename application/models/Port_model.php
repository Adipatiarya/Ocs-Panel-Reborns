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

class Port_model extends Crud_Model {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->table='port';
	}
	
	
	public function get_id($id) {
		
		$query = $this->db->get_where('port', array('id'=>$id) )->row();
		
		
	    if (isset($query->id) ) {
			
			return $query->id;
		}
		return false;
	}
	public function check($name) {
		//cek port
		
		if (!is_numeric($name)) {
			
			return TRUE;
		}
		return $this->db->where('name', $name)
						->limit(1)
						->count_all_results('port') > 0;
	}
	
}
