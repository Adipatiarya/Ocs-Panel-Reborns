<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>	
<div class="section-preview">
	<div class="container">
		<ul class="list-group">
			<li class="list-group-item d-flex justify-content-between align-items-center">
				Each account valid for <?php echo $config->free ?> days. Account is only allowed  maximum two (2) 
			multi-bitvise, else your connection will be automatically disconnect 
			from the server. But we recommend using single bitvise. 
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">
			
				SSH Server <?php echo $server->name ?> can create <?php echo $server->limit_user ?> SSH Accounts/Day
				
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">
				<div class="form-group">
					<fieldset disabled="">
						<label class="control-label" for="disabledInput">Server IP</label>
						<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $server->host ?>" disabled="">
					</fieldset>
					<?php foreach($services as $service): ?>
					<fieldset disabled="">
						<label class="control-label" for="disabledInput"><?php echo ucwords($service->name) ?></label>
						<input class="form-control" id="disabledInput" type="text" placeholder="<?php ob_start();foreach($service->ports as $port){echo $port->name.',';}echo rtrim(ob_get_clean(), ',');?>" disabled="">
					</fieldset>
					<?php endforeach; ?>							
				
				</div>
			
			</li>
		</ul>
		<br>
		<ul class="list-group">
			<li class="list-group-item d-flex justify-content-between align-items-center">
			<p><?php echo ucwords($domain) ?> allows you to use your own username as part of your SSH  account with the following format: <?php echo $_SERVER['HTTP_HOST'] ?>-(your username) ; allowing you to easily remember your own account. You can create a new account ANYTIME with a max. of <?php echo $server->limit_user ?> accounts per-day, With various servers ranging from US, Europe, Asia, and Southeast Asia, <?php echo ucwords($domain) ?> offers complimentary better connection speed for many users from around the world in various locations at the same time.</p>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">
			<p>If you receive the following error; The SSH2 session has terminated with error. Reason: Error class: LocalSshDisconn, code: ConnectionLost, message: FlowSshTransport: received EOF. Please press the button below to solved the issue </p>
				<script>
					function reload() {location.reload();}
				</script>
				<input name="serverIP" value="sg-mct.serverip.co" type="hidden">
				<button class="btn btn-primary" onclick="reload();">Repair the Server</button>
			
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">
				Multiple login will causing disconnect and Lagging for your account, we recommend using one account for one device to avoid disconnect when using your account.
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">
			<p>
				When logged into SSH network, the entire login session including the transmission of the password is encrypted; almost impossible for any 
				outsider to collect passwords. Compared to the Telnet remote shell 
				protocols which send the transmission, e.g. the password in a plain 
				text, SSH was basically designed to replace Telnet and other insecure 
				remote shell with encryption to provide anonymity and security through 
				unsecured network. In short, it provides a much safer environment for 
				browsing.
			</p>
			
			</li>
			<li class="list-group-item">
				<p>Another advantage of using Secure Shell tunnel is to use it to bypass the firewall; therefore, accessing blocked websites from the ISPs. It is also useful to access several websites which blocked any foreign access or from certain countries. While using the Secure Shell tunnel, the client’s IP will be changed to the host’s IP; giving the client’s IPaccess to the regional-blocked websites. Connecting to a host closer to your location is recommended to increase your internet connection’s speed.</p>
			</li>
	
		</ul>
		<br/>
		<div class="list-group">
			<div class="list-group-item">
				
				<div class="card border-primary mb-3" style="max-width:50rem;">
				<div class="card-header">
					<?php echo $server->name ?>
				</div>
				<div class="card-body">
						<div id="response"></div>
					<?php echo form_open() ?>
					<div class="form-group">
					<fieldset disabled="">
						<label>Server Ip</label>
						<input class="form-control" type="text" placeholder="<?php echo $server->host ?>" disabled="">
					</fieldset>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" placeholder="Username" maxlength="10" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						
						<input type="password" name="password" class="form-control" placeholder="Password" maxlength="10" required>
					</div>
					<div class="form-group">
						<label>
						 <button onclick="reload();" class="btn btn-default"><?php echo $cap['image'];?></button>
						</label>
						<input name="captcha" class="form-control" placeholder="captcha" required="" type="text">
					</div>
					<input name="serverid" value="<?php echo $server->id ?>" type="hidden">
					<button type="submit" class="btn btn-primary btn-block">Create Account</button>
					<?php echo form_close() ?>
					
				</div>
			</div>
			</div>

		</div>
	</div>
	
</div>
<script>
var loader = '<center><i class="fa fa-spinner fa-spin" style="font-size:5rem;"></i></center>';

$(document).ready(function()
{
	
	$("form").submit(function(event){
		event.preventDefault();
		var serverid=jQuery('input[name="serverid"]').val(),
		username=jQuery('input[name="username"]').val(),
		password=jQuery('input[name="password"]').val(),
		captcha=jQuery('input[name="captcha"]').val();
		$.ajax({
			type:'POST',
			url: $(this).attr('action'),
			data:{
				serverid:serverid,
				username:username,
				password:password,
				captcha:captcha
			},
			error:function(xhr,ajaxOptions,thrownError){
				
				$('#response').html(xhr);
			},
			cache:false,
			beforeSend:function(){
				
				$('#response').html(loader);
				
			},
			success:function(s){
				$('#response').html(s);
			}
		});
	return false;});
});
</div>
