<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="warper container-fluid">
	<div class="page-header">
		<h1>Servers LIST</h1>
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
				</select> <span class="pull-right">Show <?php echo count($servers) .'/'. $ini['total_rows']; ?></span>
				
			<?php echo form_close(); ?>
		</div>
		<div class="panel-body">
			<?php echo $message ?>
			<?php if (!empty($servers)) { ?>
		<?php foreach($servers as $server): ?>
				
				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-laptop"></i> <?php echo $server->name; ?>
							
						</div>
						<div class="panel-body" style="height:30rem;">
							
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
											<td><?php
											    ob_start();
											    foreach($service->ports as $port) { echo $port->name .','; }
											    echo rtrim(ob_get_clean(), ',');
											  ?>
											</td>
										</tr>
									<?php }?>
								<?php } ?>
								
								<tr>
									<td>Limit usr</td>
									<td>:</td>
									<td><?php echo $server->count?> / <?php echo $server->limit_user?></td>
								</tr>
								<?php if(!empty($server->desc)) { ?>
								<tr>
								    <td>Config vpn</td>
								    <td>:</td>
								    <td><a href="<?php echo $server->desc ?>">Download</a></td>
								</tr>
								<?php } ?>
								<tr>
									<td>Price </td>
									<td>:</td>
									<td>
										<?php echo $server->price ?>
									</td>
									
								</tr>
							</thead>
							
						 </table>
						
						</div>
						<div class="panel-footer">
							<a href="<?php echo site_url(). '/panel/'.$user->username.'/server/'.$server->id.'/createuser.html';?>" class="btn btn-default"><i class="fa fa-shopping-cart"></i> Buy</a>
						
						</div>
						
					</div>
				</div>
		<?php endforeach; ?>
		
	<?php }  else { ?>
		<?php if(isset($this_id)){ ?>Tidak ada server dilokasi  <?php echo $this_id; ?> <?php } ?>
				
	<?php }?>
		
		</div>
	
		<div class="panel-footer">
			<?php echo $link ?>
		</div>
	</div>

</div>	

