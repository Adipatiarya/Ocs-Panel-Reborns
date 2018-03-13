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

class Service_model extends Crud_Model {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->table='service';
	}
	public function servers($services=false, $ports=false)
	{
		
		
		if (!empty($services))
		{
			
			$this->db->select(array(
			    'server.*',
			    'server.id as id',
			    'server.id as server_id'
			));
			// build an array if only one group was passed
			if (!is_array($services))
			{
				$services = Array($services);
			}
			if (!is_array($ports))
			{
				$ports = Array($ports);
			}
			// join and then run a where_in against the group ids
			if (isset($services) && !empty($services))
			{
				$this->db->distinct();
				$this->db->join(
				    'server_port',
				    'server_port.server_id=server.id',
				    'inner'
				);
			}

			// verify if group name or group id was used and create and put elements in different arrays
			$service_ids = array();
			$service_names = array();
			
			$port_ids = array();
			$port_names = array();
			
			foreach($services as $service)
			{
				if(is_numeric($service)) $service_ids[] = $service;
				else $service_names[] = $service;
			}
			foreach($ports as $port)
			{
				if(is_numeric($port)) $port_ids[] = $port;
				else $port_names[] = $port;
			}
			$or_where_in = (!empty($service_ids) && !empty($service_names)) ? 'or_where_in' : 'where_in';
			// if group name was used we do one more join with groups
			if( !empty($service_names) )
			{
				$this->db->join('service', 'server_port.service_id=service.id', 'inner');
				$this->db->where_in('service.name', $service_names);
				if (!empty($port_names)) {
					$this->db->{$or_where_in}('server_port.port_name', $port_names);
				}
			}
			if(!empty($service_ids))
			{
				$this->db->{$or_where_in}('server_port.service_id', $service_ids);
				if (!empty($port_ids)) {
					$this->db->{$or_where_in}('server_port.port_id', $port_ids);
				}
			}
			return $this->db->get('server');
			
		}
		
		                

	}
	
	
}
