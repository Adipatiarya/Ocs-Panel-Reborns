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

class Continent_model extends Crud_model {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->table='continent';
	}
	
	public function getLocationId($continent_id) {
		
		$this->db->where('continent_id', $continent_id);
		return $this->db->get('location_group');
	}
	public function getContinentThisLocation($location_id) {
		
		return $this->db->select('location_group.continent_id as id, continent.name, continent.desc')
					
		                ->where('location_group.location_id', $location_id)
		                
		                ->join('continent', 'location_group.continent_id=continent.id')
		                ->get('location_group');
	}
	public function continents($locations=false) {
		
		if (!empty($locations))
		{
			
			$this->db->select(array(
			    'continent.*',
			    'continent.id as id',
			    'continent.id as continent_id'
			));
			// build an array if only one group was passed
			if (!is_array($locations))
			{
				$locations = Array($locations);
			}

			// join and then run a where_in against the group ids
			if (isset($locations) && !empty($locations))
			{
				$this->db->distinct();
				$this->db->join(
				    'location_group',
				    'location_group.continent_id=continent.id',
				    'inner'
				);
			}

			// verify if group name or group id was used and create and put elements in different arrays
			$location_ids = array();
			$location_names = array();
			
			
			foreach($locations as $location)
			{
				if(is_numeric($location)) $location_ids[] = $location;
				else $location_names[] = $location;
			}
			$or_where_in = (!empty($location_ids) && !empty($location_names)) ? 'or_where_in' : 'where_in';
			// if group name was used we do one more join with groups
			if( !empty($location_names) )
			{
				$this->db->join('location', 'location_group.location_id=location.id', 'inner');
				$this->db->where_in('location.name', $location_names);
			}
			if(!empty($location_ids))
			{
				$this->db->{$or_where_in}('location_group.location_id', $location_ids);
			}
		}
		return $this->db->get('continent');
	}
}
