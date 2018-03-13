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

class Captcha_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		
	}
	public function create($data) {
		
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
	}
	public function check($captcha)
	{
		$expiration = time() - 30; // 5 second
		
		//$expiration = time();
		$this->db->where('captcha_time < ', $expiration)
			->delete('captcha');
			
			
		$sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		if ($row->count == 0)
		{
			return FALSE;
		}
		return TRUE;
	}
	
}
