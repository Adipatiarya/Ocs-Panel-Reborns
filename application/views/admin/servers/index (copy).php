<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="warper container-fluid" style="font-size:10px;">
	<div class="page-header">
		<h1>Servers LIST</h1>
	</div>
	<div class="page-header">
		
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
				<?php echo form_open(); ?>
				<select name="id" onchange="this.form.submit();">
				<?php if (isset($this_id)) { ?>
					<option><?php echo $this_id; ?> </option>
				<?php } else {?>
					<option>All Location: </option>
				<?php } ?>
			
				<?php foreach($locations as $location) {
					if (isset($this_id) && $this_id === $location->name ) continue; ?>
					<option select="<?php echo $location->id; ?>" class="form-control">
						<?php echo $location->name; ?>
					</option>
				<?php } ?>
				</select>
		<?php echo form_close(); ?>
		
		</div>
		<div class="panel-body">
			<?php if (!empty($servers)) { ?>
							<?php foreach($servers as $server): ?>
				<div class="col-sm-4">
					<div class="panel panel-default">
						<div class="panel-heading"><i class="fa fa-server"></i> <?php echo $server->name; ?></div>
						<div class="panel-body" style="height:320px;">
							
						 <table class="table">
							<thead>
								<tr>
									<td>Host</td>
									<td>:</td>
									<td><?php echo $server->host; ?></td>
								</tr>
									<tr>
									<td>Location</td><td>:</td>
									<td>
										<?php if (!empty($server->locations)) {?>
											<?php foreach ($server->locations as $locate) { 
											if (count($server->locations) > 1) {
												echo '['.$locate->name .']';
											}
											else {echo $locate->name;}
										} ?>
										<?php } else { echo '<small class="text-danger">Belum diset</small>';} ?>
									</td>
									</tr>
								<?php if (!empty($server->services)) {?>
									<?php foreach ($server->services as $service) { ?>
										<tr>
											<td><?php echo $service->name; ?></td>
											<td>:</td>
											<td><?php foreach($service->ports as $port) { echo '['.$port->name .']'; } ?>
											</td>
										</tr>
									<?php }?>
								<?php } ?>
								
									
									
									<tr><td>Price</td><td>:</td><td><?php echo $server->price; ?></td></tr>
									
									
									<tr><td>Max User</td><td>:</td><td><?php echo $server->limit_user; ?></td></tr>
							
									
									<tr><td>Config Vpn</td><td>:</td><td><?php echo $server->desc; ?></td></tr>
									
								<tr>
									<td>Status</td>
									<td>:</td>
									<td><?php echo (! $server->active) ? '<i class="fa fa-lock"></i>' : '<i class="fa fa-unlock"></i>'; ?></td>
								</tr>
							</thead>
							
						 </table>
						 
						</div>
						<div class="panel-footer"><a href="<?php echo site_url('admin/server/'.$server->id.'/update.html');?>" class="btn btn-default"><i class="fa fa-pencil"></i> Edit..</a></div>
						
					</div>
				</div>
			<?php endforeach; ?>

			<?php }  else { ?>
				<?php if(isset($this_id)){ ?>
					Tidak ada server dilokasi  <?php echo $this_id; ?>
				<?php } ?>
				
			<?php }?>
			

		</div>
		<div class="panel-footer">
			<a class="btn btn-default btn-sm" href="<?php echo site_url('admin/server/add.html');?>"> <i class="fa fa-server"></i> Add server</a>
		</div>
	</div>
	
</div>
	 
	
