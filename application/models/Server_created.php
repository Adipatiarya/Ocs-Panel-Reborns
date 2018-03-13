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

class Server_created extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		
	}
	public function create($data) {
		
		
		$this->db->insert('server_created', $data);
		return $this->db->insert_id();	
	}
	public function countServerCreated($id=false) {
		
		if (!empty($id)) {
			
			$this->db->where('server_id', $id);
			$this->db->where('trial', FALSE);
		}
		$server = $this->db->get('server_created')->num_rows();
		return $server;
		
	}
	public function countLimit($id) {
		
		$date = new DateTime(date('d-m-Y'));
		$date->format('U');
		
		$now = $date->getTimeStamp();
		
		$this->db->where('server_id', $id);
		$this->db->where('created_on', $now);
		
		
		$server = $this->db->get('server_created')->result();
		return count($server);
		
	}
	public function getHasilUang($created_by) {
		
		$uang = 0;
		$this->db->where('created_by', $created_by);
		$this->db->where('trial', FALSE);
		
		$server = $this->db->get('server_created')->result();
		
		
		foreach ($server as $s) {
			
			$uang = $uang + $s->price;
		}
		return $uang;
	}
	public function read($id=false) {
		
		if (!empty($id))
		{
			$this->db->where('id', $id);
		}

		return $this->db->get('server_created');
		
	}
	public function getUserCreated($name=false, $config=false) {
		
		
		$this->db->where('created_by', $name);
		
		if (!empty($config)) {
			
			$this->db->order_by("id","desc");
			return $this->db->get('server_created', $config['per_page'], $this->uri->segment($config['uri_segment']));
		}
		else {
			return $this->db->get('server_created');
		}
		//$this->db->where('created_by', $created_by);
		
		//return $this->db->get('server_created');
		
	}
	
}
