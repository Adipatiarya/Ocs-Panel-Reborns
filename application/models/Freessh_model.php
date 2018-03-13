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

class Freessh_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
	
	}
	public function countServerCreated($id) {
		
		$date = new DateTime(date('d-m-Y'));
		$date->format('U');
		
		$now = $date->getTimeStamp();
		
		$this->db->where('server_id', $id);
		$this->db->where('now', $now);
		
		
		$server = $this->db->get('free_ssh')->result();
		return count($server);
		
	}
	public function create($id) {
		
		$date = new DateTime(date('d-m-Y'));
		$date->format('U');
		$now = $date->getTimeStamp();
		
		$data = array('server_id'=> $id, 'now'=> $now);
		
		$this->db->insert('free_ssh', $data);
		
	}
	
}
