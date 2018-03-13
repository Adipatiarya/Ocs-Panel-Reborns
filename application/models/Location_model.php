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

class Location_model extends Crud_model {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->table='location';
	}
	
	public function getLocationsThisServer($server_id = FALSE)
	{

		return $this->db->select('location_group.location_id as id, location.name')
		                ->where('location_group.server_id', $server_id)
		                ->join('location', 'location_group.location_id=location.id')
		                ->get('location_group');

	}
	
	public function get_id($id) {
		
		$query = $this->db->get_where('port', array('id'=>$id) )->row();
		
		
	    if (isset($query->id) ) {
			
			return $query->id;
		}
		return false;
	}
	public function locations($continents=false) {
		
		
		if (!empty($continents))
		{
			$continents = str_replace('-', ' ', $continents);
			
			$id = $this->continent_model->read($continents)->row();
			$continents = $id->id;
			
			
			$this->db->select(array(
			    'location.*',
			    'location.id as id',
			    'location.id as location_id'
			));
			// build an array if only one group was passed
			if (!is_array($continents))
			{
				$continents = Array($continents);
			}

			// join and then run a where_in against the group ids
			if (isset($continents) && !empty($continents))
			{
				$this->db->distinct();
				$this->db->join(
				    'location_group',
				    'location_group.location_id=location.id',
				    'inner'
				);
			}

			// verify if group name or group id was used and create and put elements in different arrays
			$continent_ids = array();
			$continent_names = array();
			
			
			foreach($continents as $continent)
			{
				if(is_numeric($continent)) $continent_ids[] = $continent;
				else $continent_names[] = $continent;
			}
			$or_where_in = (!empty($continent_ids) && !empty($continent_names)) ? 'or_where_in' : 'where_in';
			// if group name was used we do one more join with groups
			if( !empty($continent_names) )
			{
				$this->db->join('location', 'location_group.location_id=location.id', 'inner');
				$this->db->where_in('continent.name', $continent_names);
			}
			if(!empty($continent_ids))
			{
				$this->db->{$or_where_in}('location_group.continent_id', $continent_ids);
			}
			return $this->db->get('location');
		}
		else {
			return $this->db->get('location');
		}
		
	}
}
	

