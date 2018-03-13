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

class Keranjang_model extends CI_Model {

	
	public function __construct() {
		parent::__construct();
		$this->load->model('voucher_model');
	}
	
	public function create($data) {
		
		$this->db->insert('keranjang', $data);
		return $this->db->insert_id();
	}
	public function read($id=false) {
		
		if ($id) {
		
			
			$query = $this->db->get_where('keranjang', array('id' => $id));
			
			return $query;
		}
		else
		
		{
			$query = $this->db->get('keranjang');
			return $query;
		}
		
	}
	
	public function read_user($id=false) {
		
		if ($id) {
		
			
			$query = $this->db->get_where('keranjang', array('user_id' => $id));
			
			return $query;
		}
		else
		
		{
			$query = $this->db->get('keranjang');
			return $query;
		}
		
	}
	function pagination($config){
		$this->db->order_by("id","desc");
		$this->db->where('user_id', $config['user_id']);
        return $this->db->get('keranjang', $config['per_page'], $this->uri->segment($config['uri_segment']));
             
    }
	public function read_user_keranjang($user_id, $all=false) {
		
		if ($all == true) {
			
			return $this->db->get_where('keranjang', array('user_id' => $user_id));
		
		}
		else {
			
			return $this->db->get_where('keranjang', array('user_id' => $user_id, 'dibayar'=>false));
			
		}
	}
	public function getPrice($name) {
		$query = $this->db->get_where('keranjang', array('name' => $name))->row();
		
		$voucher = $this->voucher_model->read($query->voucher_id)->row();
		return $voucher->price;
	}
	public function update($id){
		
		$this->db->where('id', $id);
		return $this->db->update('keranjang', array('dibayar'=>true, 'updated_on' => time()));
	}
	
	public function delete($id) {
		
		return $this->db->delete('keranjang', array('id'=>$id));
	}
	
	public function keranjang_check($id = '')
	{
		

		if (empty($id))
		{
			return FALSE;
		}

		return $this->db->where('id', $id)
						->limit(1)
						->count_all_results('keranjang') > 0;
	}
	
	public function record_count() {
		return $this->db->count_all("keranjang");
	}
	
}
