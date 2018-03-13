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
class MY_Model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct(); $this->load->database();		
	}
}

class Crud_model extends MY_Model {
	
	public $table;
	
	public function __construct() { parent::__construct(); }
	
	public function create($data) {
		
		if ($this->check_name($data['name'])) return false;
		
		$this->db->insert($this->table, $data);
		
		$id = $this->db->insert_id($this->table . '_id_seq');
		
		//$id = $this->db->insert_id();
		return $id;

	}
	public function buat($data) {
		
		
		$this->db->insert($this->table, $data);
		
		$id = $this->db->insert_id($this->table . '_id_seq');
		
		//$id = $this->db->insert_id();
		return $id;

	}
	public function read($id='') {
	
		
		if( !empty($id) ) {
			
			if (is_numeric($id)) {
				
				
				$this->db->where('id', $id);
				
			}
			else {
				$this->db->where('name',$id);
			}
			
			
		}
		return $this->db->get($this->table);
		
		
	}
	public function port_read($id='') {
	
		if (!empty($id) ) {
			
			
			if(is_integer($id)) {
				
				$this->db->where('id', $id);
			}
			
			$this->db->where('name', $id);
			
		}
		
		return $this->db->get('port');
		
	}
	
	
	public function update($id, $data) {
		
		if ( $this->check_id($id) )
		{
			if( isset($data['name']) ) {
				
				if ($this->check_name($data['name']) ) {
					
					return false;
				}
				else {
					return $this->db->update($this->table, $data, array('id'=>$id));
				}
				
			}
			else {
				return $this->db->update($this->table, $data, array('id'=>$id));
			}
			
			
		}
		
		return false;
	}
	public function delete($id=false) {
		
		if(!is_numeric($id)) {
			
			
			$this->db->where('name', $id);
			
			$result = $this->db->get($this->table)->row();
			
			$this->db->delete($this->table, array('name' => $result->name));
			
			return true;
			
		}
		else{
			
			$this->db->delete($this->table, array('id' => $id));
			
			return true;
		}
		

	}
	public function check_name($name) {
		
		if (empty($name))
		{
			return FALSE;
		}

		return $this->db->where('name', $name)
						->limit(1)
						->count_all_results($this->table) > 0;
	}
	protected function check_id($id) {
		
		if (empty($id))
		{
			return FALSE;
		}

		return $this->db->where('id', $id)
						->limit(1)
						->count_all_results($this->table) > 0;
	}
	
}  
