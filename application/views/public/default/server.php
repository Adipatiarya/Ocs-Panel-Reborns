<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <?php if($server_only) : ?>
		<?php include 'section-tout.php'; ?>
	<?php endif; ?>
    
    <div class="section-preview">
		<div class="container">
			<center>
			<div style="border:1px solid #ccc;margin:10px;padding:10px;">
				<?php echo form_open() ?>
					<select name="program" required="required">
						<option value="">--Select  Program--</option>
						<?php foreach($services as $service): ?>
							<option value="<?php echo $service['id'] ?>">
								<?php echo $service['name'] ?>
							</option>
						<?php endforeach ?>
					</select>
					<select name="port">
						<option value="">Any Port</option>
						<?php foreach($ports as $port): ?>
							<option value="<?php echo $port['id'] ?>">
								<?php echo $port['name'] ?>
							</option>
						<?php endforeach ?>
					</select>
					<input type="submit" value="Filter">
			<?php echo form_close() ?>
		</div>
				</center>
		</div>
		<div class="container">
			<div  class="row">
			
			<?php foreach ($servers as $server): ?>
			
				<?php if(count($server->services) > 2): ?>
				<div class="col-lg-4 col-sm-6">
					<div class="card border-primary card-sm">
						<div class="card-header">
							<?php echo $server->name ?>
						</div>
						<div class="card-body">
							<table class="table table-hover">
									<tr><th>Server IP</th><td>:</td><td><?php echo $server->host ?></td></tr>
									<tr>
										<th>Location</th>
										<td>:</td>
										<th>
											<?php foreach ($server->locations as $location): ?>
												<?php echo $location->name; ?>
											<?php endforeach;?>
										</th>
										
									</tr>
									<tr>
										<th>Service</th>
										<td>:</td>
										<td>
											
											<?php
												
												foreach($server->services as $service) {
												echo '- '.$service->name . '(';
												echo '<p class="text-muted"><small>';
												ob_start();
												foreach ($service->ports as $port) {
													echo $port->name.', ' ;
												}
												echo rtrim(ob_get_clean(), ', ');
												echo ')';
												echo '</small></p>';
											}
											
											?>
											
										</td>
									</tr>
									<tr><th>Acc Remaining</th><td>:</td><td><?php echo $server->count ?> / <?php echo $server->limit_user ?></td></tr>
							</table>

						</div>
						<div class="card-footer"><a class="btn btn-primary" href="<?php echo $server->link ?>"> Create Account</a></div>
					</div>
				</div>
				
				<?php continue; endif; ?>
				<div class="col-lg-4 col-sm-6">
					<div class="card border-primary mb-3">
						<div class="card-header">
							<i class="fa fa-server"></i> <?php echo $server->name; ?>
						</div>
						<div class="card-body">
							<table class="table table-hover">
									<tr><th>Server IP</th><td>:</td><td><?php echo $server->host ?></td></tr>
									<tr>
										<th>Location</th>
										<td>:</td>
										<td>
											<?php foreach ($server->locations as $location): ?>
												<?php echo $location->name; ?>
											<?php endforeach;?>
										</td>
									</tr>
									<?php foreach ($server->services as $service): ?>


									<tr>
										<th><?php echo ucwords($service->name) ?></th>
										<td>:</td>
										<td>
											<?php
												ob_start();
													
													foreach ($service->ports as $port) {
														echo $port->name. ',';
													}
													
													echo rtrim(ob_get_clean(), ',');
												?>
												
										</td> 
											
									</tr>
								   	
										
									<?php endforeach;?>
									
									<?php if(!empty($server->desc)) : ?>
										<tr><td>Config Vpn</td><td>:</td><td><a href="<?php echo $server->desc ?>">Download</a></td></tr>
									<?php endif ?>
									
									
									<tr><th>Acc Remaining</th><td>:</td><td><?php echo $server->count ?> / <?php echo $server->limit_user ?></td></tr>
							</table>
						</div>
						
						
						<div class="card-footer"><a class="btn btn-primary" href="<?php echo $server->link ?>"> Create Account</a></div>
					</div>
				</div>
				
			<?php endforeach; ?>
			
			</div>
		</div>
		
	</div>
