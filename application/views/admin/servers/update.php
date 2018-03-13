<div class="warper container-fluid">
        	
            <div class="page-header"><h1>UPDATE Server</h1></div>
            <div class="row">
            	<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<?php echo $server->name ?>
							<span>
							<?php echo (! $server->active) ? '<a class="btn btn-default pull-right" href="'.site_url('admin/servers/activate/'.$server->id).'"><i class="fa fa-lock"></i></a>' : '<a class="btn btn-default pull-right" href="'.site_url('admin/servers/deactivate/'.$server->id).'"><i class="fa fa-unlock"></i></a>'; ?>
							</span>
						</div>
						<div class="panel-body">
					<?php echo $message; ?>
					
					<?php echo form_open(); ?>
					<div class="form-group">
						<label for="continent">
							Nama server
						</label>
						<?php echo form_input($name); ?>
					</div>
					<div class="form-group">
							<label>Location</label>
							<br/>
						<?php foreach ($locations as $group):?>
							<?php
								$gID=$group['id'];
								$checked = null;
								$item = null;
								foreach($currentLocations as $grp) {
									if ($gID == $grp->id) {
										$checked= ' checked="checked"';
										break;
									}
								}
							?>
							<input type="radio" name="location" value="<?php echo $group['id'];?>"<?php echo $checked;?>> <span><?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?></span>
							
						<?php endforeach?>
						<br/>
						<span class="text-info"> <a class="btn btn-default btn-xs" href="<?php echo site_url('admin/server/location/add.html') ?>"><i class="fa fa-plus"></i></a></span>
						</div>

					<div class="form-group">
						<label>Hostname</label>
						<?php echo form_input($host); ?>
					</div>
					
					
					<div class="form-group">
							<label>Service:Port</label>
							<br/>
							
							
							<?php if (! empty($currentServices) ) {
								foreach($currentServices as $srv) { ?>
									
									<!--
									<a class="label label-default" href="<?php echo site_url('admin/servers/update_service_port/'.$server->id.'/'.$srv->id) ?>"><?php echo $srv->name; ?> <i class="fa fa-edit"></i></a>
									
									-->
									<a data-toggle="modal" class="label label-default" href="#<?php echo $srv->id ?>"><?php echo $srv->name; ?> <i class="fa fa-edit"></i></a>
									
									<div class="modal fade" id="<?php echo $srv->id;?>" tabindex="-1" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content" role="document">
											<div class="modal-header">
												<?php echo ucwords($srv->name) ?>
											</div>
										
											<div class="modal-body">
												<div class="form-group">
													<label>Port</label>
													<input type="text" placeholder="Port yang lain" class="form-control" name="port_name" maxlength="5" name="port">
												</div>
												<label>Port Exists</label>
												<br>
												<?php foreach ($ports as $port):?>
												
										
													<?php
													$checked = null;
													$item = null;
													foreach($srv->currentPorts as $cp) {
														if ($port->id == $cp->id) {
															$checked= ' checked="checked"';
															break;
														}
													}
													?>
												<input type="checkbox" name="port[]" value="<?php echo $port->id;?>"<?php echo $checked;?>> <?php echo $port->name ?>
											
												<?php endforeach;?>
											
											</div>
											<div class="modal-footer">
												<input type="hidden" name="serviceid" value="<?php echo $srv->id ?>">
												<input type="submit" class="btn btn-primary" value="Save">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
											</div>
										
											</div>
									</div>
									</div>

									<?php if (!empty($srv->currentPorts) ){ ?>
									<?php foreach ($srv->currentPorts as $port) { ?>
											<div class="label label-warning"><?php echo $port->name; ?></div>
									<?php  } ?> 
									<?php } ?>
									
									<a class="label label-default" href="<?php echo site_url('admin/servers/add_service/'.$server->id)?>"> <i class="fa fa-plus"></i></a>
							
									
									<br/>
									
								<?php } } else { ?>
									<a class="btn btn-default btn-sm" href="<?php echo site_url('admin/servers/add_service/'.$server->id) ?>"> <i class="fa fa-plus">ADD SERVICE</i></a>
								<?php } ?>
						
						</div>

					
					<div class="form-group">
						<label>Root Password</label>
						<?php echo form_input($password); ?>
					</div>
					<div class="form-group">
						<label>Price</label>
						<?php echo form_input($price); ?>
						<small class="text-info">Jika price dikosongkan, server juga akan muncul di halaman root</small>
					</div>
					<div class="form-group">
						<label>Maksimal User</label>
						<?php echo form_input($limit); ?>
					</div>
					<div class="form-group">
						<label>Config VPN (Tidak wajib)</label>
						
						<textarea name="config" rows="5" class="form-control" placeholder="http://192.168.1.9/vpn/config.zip"></textarea>
					</div>
					<a class="btn btn-default" href="<?php echo site_url('admin/servers.html') ?>"><i class="fa fa-angle-left"></i></a>													
					<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
					
					<?php echo form_close(); ?>
						</div>
					</div>
                </div>
            
            
            </div>
       </div>
        
