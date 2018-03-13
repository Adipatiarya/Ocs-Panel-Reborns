<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page">
<center>
			<div style="border:1px solid #ccc;margin:10px;padding:10px;">
				<form method="POST" action="">
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
					<input type="submit" name="filterServers" value="Filter">
			</form>
		</div>
</center>

<div style="margin-bottom:50px;"></div>	
<div id="list-server">
	<?php
	
	$step = 0;
	
	
	
	foreach ($servers as $server) {
		$step++;
		
		if($step === 4) {
			//pertiga baris 
			
			echo '<div style="margin-bottom:50px;"></div>';
			$step = 0; 
		} 
		
		?>
		<div id="server">
			<h2 id="server-location">
				SSH Server <?php echo $server->name; ?>
			</h2>
			<div id="server-detail">
				<table>
					<tr><th>Server IP</th><td>:</td><td><span style="font-size:small;"><?php echo $server->host; ?></span></td></tr>
					<tr><th>Location</th>
					<td>:</td>
					<td>
						<span>
							<?php if (!empty($server->locations)) {?>
															
								<?php
									ob_start();
									foreach ($server->locations as $locate) { 
										echo $locate->name.',';
									}
									echo rtrim(ob_get_clean(), ',');
									?>
								<?php } else { echo '<small class="text-danger">Belum diset</small>';} ?>
							
						</span>
					</td>
					</tr>
														
					<tr><th>Protocol</th><td>:</td><td><span>TCP & UDP</span></td></tr>
					<?php if (!empty($server->services)) {?>
									<?php foreach ($server->services as $service) { ?>
										<tr>
											<th><?php echo $service->name; ?></th>
											<td>:</td>
											<td><span>
												<?php
												
													ob_start();
													foreach($service->ports as $port) {
														 
														echo $port->name.',';
													}
													echo rtrim(ob_get_clean(), ',');
												?>
												</span>
											</td>
										</tr>
									<?php }?>
								<?php } ?>
					<tr><th style="font-size:small;">Acc Remaining</th><td>:</td>
						<td>
							<span>
								<?php if ($server->count >= $server->limit_user) { ?>
									<span style="font-weight:bold;background:#BC0404;color:#fff;padding:2px 5px;border-radius:1px 4px;"> FULL</span>
								<?php } else { ?>
									<span style="font-weight:bold;background:#17993E;color:#fff;padding:2px 5px;border-radius:1px 4px;"> <?php echo $server->count?></span>
								<?php } ?>
								
									FROM <?php echo $server->limit_user?>
							</span>
						</td>
					</tr>
				</table>
			</div>
			<div id="server-account">
				<a href="<?php echo $server->link ?>">Create ssh Account</a>
			</div>		
		</div>
	
	<?php } ?>
	<br>
	<div style="margin-bottom:50px;"></div>
	<div style="clear:both;"></div>	
</div>
<div style="clear:both;"></div>

</div>
<div id="stickinfo">
	<div id="information">
		 Unmetered VPS : 
		 <a href="#" target="_BLANK">Indonesia VPS</a>  |
		 <a href="#" target="_BLANK">Singapore VPS</a>  |
		 <a href="#" target="_BLANK">Europe VPS</a>  |
		 <a href="#" target="_BLANK">North America VPS</a>  |
		 <a href="#" target="_BLANK">Unmetered KVM VPS</a>
	</div>
</div>

