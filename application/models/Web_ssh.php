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

class Web_ssh extends CI_model {
	
	protected $messages;
	protected $errors;
	
	
	public function __construct()
	{
		parent::__construct();
		$this->messages = array();
		$this->errors = array();
		
		$this->load->database();
		
		$this->load->library('ion_auth');
		$this->load->model('server_model');
		
	}
	
	
	public function register($name, $host, $password, $location, $service, $port) {
		
		
		if( $this->check_name($host) ) {
			
			$this->set_error('nama_server_ini_sudah_ada');
			return FALSE;
		}
	  	
		
		$data = array(
		
			'name' => $name,
			'host' => $host,
			'password' => $password,
			'created_on' => time()
		);
		
		$location = $this->db->get_where('location', array('name'=>$location))->row();
		
		if(!isset($location->id)) {
			
			$this->set_error('lokasi_tidak_ditemukan');
			return FALSE;
		}
		
		$this->db->insert('server', $data);
		$id = $this->db->insert_id();
		
		$service = $this->db->get_where('service', array('name'=>$service))->row();
		
		if (! isset( $service->id ) ) {
			$this->set_error('service_not_found');
			return FALSE;
		}
		
		$pCount = 0;
		
		
		
		
		$this->db->insert('server_service', array('server_id' => $id,'service_id'=> $service->id));
		
		
		
		if (!empty($port)) {
			
			
			$port_id = array();	
			
			if (! is_array($port)) { $port = Array($port);}
			
			foreach ($port as $p) {
				
				$port = $this->db->get_where('port', array('name'=>$p))->row();
				
				if ( isset($port->id )) {
					
					array_push($port_id, $port->id);
				}
			}
			$pCount = $this->add_to_port($port_id,$service->id,$id);
				
		}
		
		if (isset($id)) {
			
			if ($pCount < 1) {
				//hapus server jika port tidak tersedia
				
				$this->delete($id);
				$this->set_error('Port not founds');
				return FALSE;
			}
		
		}
		
		
		$this->set_message('service port add '. $pCount);
		
		
		if ($this->web_ssh->add_to_location($location->id, $id, $location->continent_id)) {
			
			return $id;
		}
		
	}
	public function servers($locations=false, $config=false) {
		
		if (!empty($locations))
		{
			
			$this->db->select(array(
			    'server.*',
			    'server.id as id',
			    'server.id as server_id'
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
				    'location_group.server_id=server.id',
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
		$this->db->order_by("id","desc");
		
		if ($this->ion_auth->logged_in() && ! $this->ion_auth->is_admin() ) {
			
			$this->db->where('premium',TRUE);
		}
		
		
		if (!empty($config)) {
			
			return $this->db->get('server', $config['per_page'], $this->uri->segment($config['uri_segment']));
		}
		else {
			return $this->db->get('server');
		}
	}

	public function public_servers($locations=false, $config=false) {
		
		if (!empty($locations))
		{
			
			$this->db->select(array(
			    'server.*',
			    'server.id as id',
			    'server.id as server_id'
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
				    'location_group.server_id=server.id',
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
		
		
		$this->db->order_by("id","desc");
		$this->db->where('premium',FALSE);
		
		
		
		if (!empty($config)) {
			
			return $this->db->get('server', $config['per_page'], $this->uri->segment($config['uri_segment']));
		}
		else {
			return $this->db->get('server');
		}
	}

	
/*
	public function public_servers($locations=false) {
		
		if (!empty($locations))
		{
			
			$this->db->select(array(
			    'server.*',
			    'server.id as id',
			    'server.id as server_id'
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
				    'location_group.server_id=server.id',
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
		$this->db->order_by("id","desc");
		$this->db->where('price', null);
		return $this->db->get('server');
	}
	*/
	
	public function server($id) {
		$this->db->where('id', $id);
		return $this->db->get('server');
	}
	
	public function update($id, $data_server) {
		
		$this->load->model('server_model');
		
		$data_server['updated_on'] = time();
		
		if ((int) $data_server['price'] < 1 ) {
			$data_server['premium'] = FALSE;
			
		}
		elseif ((int) $data_server['price'] > 0) {
			$data_server['premium'] = TRUE;
		}
		$server_data = array_merge($this->_filter_data('server', $data_server), $data_server);
		
		if ( ! $this->server_model->update($id, $server_data)) {
			$this->set_error('server_updated_unsuccessfull');
			return false;
		}
		$this->set_message('server_updated_successfull');
		return true;
		
	}
	
	
	public function delete($id) {
		
		return $this->db->delete('server', array('id' => $id));
	}
	
	public function get_server_services($id = FALSE)
	{
		
		$service = array();
		
		if (empty($id)) {
			
			$hasil = $this->db->select('server_service.service_id as id, service.name, service.desc')
		                
		                ->join('service', 'server_service.service_id=service.id')
		                ->get('server_service');
		                
		    $get = $this->db->get('service')->result();
		    
		    foreach ($get as $g) {
					foreach ($hasil->result() as $hs) {
						if  ($g->id === $hs->id) {
							
							$array = array ('id'=>$hs->id, 'name'=>$hs->name);
							array_push($service, $array);
							break;
							
						}
					}
			}
			return $service;
		}
		else {
			
			return $this->db->select('server_service.service_id as id, service.name, service.desc')
		                ->where('server_service.server_id', $id)
		                ->join('service', 'server_service.service_id=service.id')
		                ->get('server_service');
		}
	}
	public function get_server_continents($location_id = FALSE)
	{
		
		$continent = array();
		
		if (empty($location_id)) {
			
			$hasil = $this->db->select('location_group.continent_id as id, continent.name, continent.desc')
		                
		                ->join('continent', 'location_group.continent_id=continent.id')
		                ->get('location_group');
		                
		    $get = $this->db->get('continent')->result();
		    
		    foreach ($get as $g) {
					foreach ($hasil->result() as $hs) {
						if  ($g->id === $hs->id) {
							
							//$array = array ();
							array_push($continent, $hs);
							break;
							
						}
					}
			}
			return $continent;
		}
		else {
			
			return $this->db->select('server_service.service_id as id, service.name, service.desc')
		                ->where('server_service.server_id', $id)
		                ->join('service', 'server_service.service_id=service.id')
		                ->get('server_service');
		}
	}
	
	public function get_service_ports($service_id=false, $server_id=false)
	{
		$port = array();
		
		if ($service_id === FALSE && $server_id === FALSE )
		{
			
			$hasil =  $this->db->select('server_port.port_id as id, port.name')
		
					->join('port', 'server_port.port_id=port.id')
					->get('server_port');
			$get = $this->db->get('port')->result();
		    
		    foreach ($get as $g) {
					foreach ($hasil->result() as $hs) {
						if  ($g->id === $hs->id) {
							
							$array = array ('id'=>$hs->id, 'name'=>$hs->name);
							array_push($port, $array);
							break;
							
						}
					}
			}
			return $port;
		} 
		else {
			
		return $this->db->select('server_port.port_id as id, port.name')
					->where('server_id', $server_id)
					->where('service_id', $service_id)
		
		
					->join('port', 'server_port.port_id=port.id')
					->get('server_port');
		}          

	}
	public function isPortServer($port_id, $server_id) {
		
		$query = $this->db->get_where('server_port', array ('server_id'=>$server_id, 'port_id'=>$port_id));
		if ($query->num_rows() > 0 ) {
			return true;
		}
		return false;
	}
			
	public function portExist($id) {
		//return boolean
		
		
		$query = $this->db->get_where('port', array('id'=>$id) )->row();
		
	    if (isset($query->id) ) {
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function serviceExist($id) {
		//return boolean
		
		
		$query = $this->db->get_where('service', array('id'=>$id) )->row();
		
	    if (isset($query->id) ) {
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function add_to_port($port_id, $service_id, $server_id) {
		
		//dibutuhkan service id aktiv
		
		
		$count = 0;
		
		if (! is_array($port_id) ) {
			$port_id = Array($port_id);
		}
		foreach ($port_id as $pId ) {
			
			if( ! $this->portExist($pId) ) { continue; }
			if ($this->isPortServer($pId, $server_id)) {
					continue;
					///redirect('admin/servers.html', 'refresh');
				}
			$port_check = $this->db->get_where('server_port', array('server_id' => $server_id, 'service_id'=>$service_id, 'port_id'=>$pId))->row();
			
			if (! isset ($port_check) ) {
				
				$service = $this->db->get_where('server_service', array('server_id' => $server_id, 'service_id'=>$service_id))->row();
				if (isset($service->id))
				{
					$this->db->insert('server_port', array('server_id' => $server_id,'service_id'=> $service_id, 'port_id'=>$pId));
					$count++;
				}
			}
			
			
		}
		if ($count < 1) {
			$this->set_error('Unknown error add port');
			return FALSE;
		}
		$this->set_message('Success added port');
		return $count;
		
	}
	
	public function remove_from_port($port_id=false, $service_id, $server_id) {
		 
		    if (empty($port_id)) {
				
				$this->db->delete('server_port', array('server_id' => $server_id,'service_id'=> $service_id));
				return true;
			}
		
			if(!is_array($port_id)) {
				
				$port_id = Array($port_id);
			}
			
			foreach ($port_id as $pID) {
				
				$port = $this->db->get_where('server_port', array('server_id' => $server_id, 'service_id'=>$service_id, 'port_id'=>$pID))->row();
				
				if (isset($port->id)) {
					
					$this->db->delete('server_port', array('server_id' => $server_id,'service_id'=> $service_id, 'port_id'=>$pID));
					
				}
				continue;
				
				
			}
			return true;
		
		
	}
	
	public function add_to_service($service_id, $server_id, $port_id=false) {
		
		$service = $this->db->get_where('server_service', array('server_id' => $server_id, 'service_id'=>$service_id))->row();
		
		if (! isset($service->id)) {
				
			if (!empty($port_id) && empty($service->id) ) {
				
				if(!is_array($port_id)) { $port_id = Array($port_id);}
				
				
				if ($this->serviceExist($service_id)) {
					//jika service id ada
					
					$count = 0;
				
					$this->db->insert('server_service', array('server_id' => $server_id,'service_id'=> $service_id));
					
					
					foreach ($port_id as $pID) {
						
						if (! $this->portServerExist($server_id, $pID) ) {
							
							if ($this->portExist($pID)) {
								
								$this->add_to_port($pID, $service_id, $server_id);
								$count++;
								
							}
								
						}
						continue;
					}
					if ($count < 1) {
						
						$this->db->delete('server_service', array('server_id' => $server_id, 'service_id'=>$service_id));
						$this->set_error('port_already_used_or_not_add');
						return FALSE;
					}
					$this->set_message('Service berhasil diimport');
					return TRUE;
					
				} else {
					
					$this->set_error('service_id_not_found');
					return FALSE;
					
						
				}
				
				
			}
			//$this->set_message('service_add_success')
			//return TRUE;			
		}
		else {
			$this->set_error('service ini sudah ada');
			return FALSE;
		} 
	}
	
	
	public function add_to_location($location_id, $server_id, $continent_id) {
		
		$location_group = $this->db->get_where('location_group', array('server_id' => $server_id, 'location_id'=>$location_id, 'continent_id'=>$continent_id ))->row();
		
		if (!isset($location_group->id)) {
				
		  return $this->db->insert('location_group', array('server_id' => $server_id,'location_id'=> $location_id, 'continent_id'=>$continent_id));
				
		}
		else {
			return false;
		}
		
	
		
	}
	
	public function remove_from_location($location_id=FALSE, $server_id=FALSE) {
		
		if (empty($location_id)) {
			$this->db->delete('location_group', array('server_id' => $server_id));
		}
		else {
		
			if (! is_array ($location_id) ) { $location_id = Array($location_id); }
		
			foreach ($location_id as $id)
			{
				$this->db->delete('location_group', array('server_id' => $server_id,'location_id'=> $id));
			
			}
		}
		
	}
	public function portServerExist($server_id, $port_id=false) {
		
		
		
		//return false if not exisit
		return $this->db->where('port_id', $port_id)
						->where('server_id', $server_id)
						->limit(1)
						->count_all_results('server_port') > 0;
		
	}
	public function serviceServerExist($server_id, $service_id=false) {
		
		
		
		//return false if not exisit
		return $this->db->where('server_id', $server_id)
						->where('service_id', $service_id)
						->limit(1)
						->count_all_results('server_service') > 0;
		
	}
	
	public function remove_from_service($service_id, $server_id) {
		
		if (! is_array ($service_id) ) { $service_id = Array($service_id); }
		foreach ($service_id as $id)
		{
				$this->db->delete('server_service', array('server_id' => $server_id,'service_id'=> $id));
				$this->db->delete('server_port', array('server_id' => $server_id,'service_id'=> $id));
			
		}
		
		
	}
	
	public function activate($id) {
		
		if ( ! $this->server_model->update($id, array('active'=>true, 'updated_on'=>time() ))) {
			$this->set_error('server_activated_unsuccessfull');
			return false;
		}
		
		$this->set_message('server_activated_successfull');
		return true;
	}
	public function deactivate($id) {
		
		if (! $this->server_model->update($id, array('active'=>false, 'updated_on'=>time() ))) {
			
			$this->set_error('server_deactivated_unsuccessfull');
			return false;
		}
		
		
		$this->set_message('server_deactivated_successfull');
		return true;
		
	}
	
	protected function _filter_data($table, $data)
	{
		$filtered_data = array();
		$columns = $this->db->list_fields($table);

		if (is_array($data))
		{
			foreach ($columns as $column)
			{
				if (array_key_exists($column, $data))
					$filtered_data[$column] = $data[$column];
			}
		}

		return $filtered_data;
	}
	public function set_message($message)
	{
		$this->messages[] = $message;

		return $message;
	}

	public function messages()
	{
		$_output = '';
		foreach ($this->messages as $message)
		{
			$messageLang ='' . $message . '';
			$_output .= $messageLang;
		}

		return $_output;
	}

	

	public function set_error($error) {
		
		$this->errors[] = $error;
		return $error;
	}

	
	public function errors()
	{
		$_output = '';
		foreach ($this->errors as $error)
		{
			$errorLang = '' . $error . '';
			$_output .= $errorLang;
		}

		return $_output;
	}
	protected function check_name($name) {
		
		if (empty($name))
		{
			return FALSE;
		}

		return $this->db->where('host', $name)
						->limit(1)
						->count_all_results('server') > 0;
	}	
}
