<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>	
<div id="page">
	<div id="box">
		<h2 class="title">Create Account SSH Server <?php echo $server->name ?></h2>
		<ol class="form" style="width:800px;">
			Each account valid for 3 days. Account is only allowed  maximum two (2) 
			multi-bitvise, else your connection will be automatically disconnect 
			from the server. But we recommend using single bitvise. 
		</ol>
		<br>
		<ol class="form" style="width:800px;">
			<b>SSH Server <?php echo $server->name ?></b> can create <b><?php echo $server->limit_user ?></b> SSH Accounts/Day
			<li><label>Host IP</label><input value="<?php echo $server->host ?>" type="text" readonly></li>
			<?php foreach($services as $service): ?>
				<li>
					<label>
						<?php echo ucwords($service->name) ?> Port
					</label>
					<input value="<?php ob_start();foreach($service->ports as $port){echo $port->name.',';}echo rtrim(ob_get_clean(), ',');?>" type="text" readonly>
				</li>
			<?php endforeach; ?>
			
		</ol>
		<center>
		<!-- Disabled ads 
		<script async="" src="Create%20SSH%20Account%20for%20SSH%20Server%20Singapore%20MCT|%20FastSSH.com_files/adsbygoogle.js"></script>

		<ins class="adsbygoogle" style="display:inline-block;width:728px;height:15px" data-ad-client="ca-pub-4990008642516184" data-ad-slot="4598213866" data-adsbygoogle-status="done"><ins id="aswift_1_expand" style="display:inline-table;border:none;height:15px;margin:0;padding:0;position:relative;visibility:visible;width:728px;background-color:transparent;"><ins id="aswift_1_anchor" style="display:block;border:none;height:15px;margin:0;padding:0;position:relative;visibility:visible;width:728px;background-color:transparent;"><iframe marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" allowfullscreen="true" onload="var i=this.id,s=window.google_iframe_oncopy,H=s&amp;&amp;s.handlers,h=H&amp;&amp;H[i],w=this.contentWindow,d;try{d=w.document}catch(e){}if(h&amp;&amp;d&amp;&amp;(!d.body||!d.body.firstChild)){if(h.call){setTimeout(h,0)}else if(h.match){try{h=s.upd(h,i)}catch(e){}w.location.replace(h)}}" id="aswift_1" name="aswift_1" style="left:0;position:absolute;top:0;width:728px;height:15px;" width="728" height="15" frameborder="0"></iframe></ins></ins></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		-->
		</center>
		<ol class="form" style="width:800px;">
			<p><?php echo ucwords($domain) ?> allows you to use your own username as part of your SSH  account with the following format: <?php echo $_SERVER['HTTP_HOST'] ?>-(your username) ; allowing you to easily remember your own account. You can create a new account ANYTIME with a max. of 3 accounts per-day, With various servers ranging from US, Europe, Asia, and Southeast Asia, <?php echo ucwords($domain) ?> offers complimentary better connection speed for many users from around the world in various locations at the same time.</p>
		</ol>
		<ol class="form" style="width:800px;">
			<p>If you receive the following error; The SSH2 session has terminated with error. Reason: Error class: LocalSshDisconn, code: ConnectionLost, message: FlowSshTransport: received EOF. Please press the button below to solved the issue </p>
				<script>
					function reload() {location.reload();}
				</script>
				<input name="serverIP" value="sg-mct.serverip.co" type="hidden">
				<li><button name="submitError" onclick="reload();">Repair the Server</button></li>
			
			<br><br><br>
			<div id="response"></div>
			
			<div style="width:400px;float:left;">
				<?php echo form_open() ?>
					
					<input name="serverid" value="<?php echo $server->id ?>" type="hidden">
					<li><label>Server</label>
						<input value="SSH Server <?php echo ucwords($server->name) ?>" readonly="readonly"></li>
					<li>
						<label>Username</label>
						<input name="username" placeholder="username" maxlength="12" required="" type="text">
					</li>
					<li>
						<label>Password</label>
						<input name="password" placeholder="mypassword" required="" type="password">
					</li>
					<li>
						<?php echo $cap['image'];?>
						<input name="captcha" placeholder="captcha" required="" type="text">
					</li>
					
					<li><button type="submit">Create Account</button></li>
					<?php echo form_close() ?>
			</div>

			<div style="width:350px;float:right;margin-top:60px;">
				<div style="background:#eee;padding:3px;text-align:center;"><h3>Create account for 1 week</h3></div>
				<form method="POST" action="#">
					<li>
						<label>Username</label>
						<input name="user" placeholder="username" maxlength="12" required="" type="text">
					</li>
					<li>
						<input name="go" value="create ssh account" style="margin-left:-0px;" type="submit">
					</li>
				</form>
			</div>
			<div style="clear:both;"></div>
		</ol>
		<ol class="form" style="width:800px;">Multiple login will causing disconnect and Lagging for your account, we recommend using one account for one device to avoid disconnect when using your account.</ol>
		<ol class="form" style="width:800px;">
			<p>
				When logged into SSH network, the entire login session including the transmission of the password is encrypted; almost impossible for any 
				outsider to collect passwords. Compared to the Telnet remote shell 
				protocols which send the transmission, e.g. the password in a plain 
				text, SSH was basically designed to replace Telnet and other insecure 
				remote shell with encryption to provide anonymity and security through 
				unsecured network. In short, it provides a much safer environment for 
				browsing.
			</p>
			<p>Another advantage of using Secure Shell tunnel is to use it to bypass the firewall; therefore, accessing blocked websites from the ISPs. It is also useful to access several websites which blocked any foreign access or from certain countries. While using the Secure Shell tunnel, the client’s IP will be changed to the host’s IP; giving the client’s IPaccess to the regional-blocked websites. Connecting to a host closer to your location is recommended to increase your internet connection’s speed.</p>
		</ol>
	</div>
	<br><br>
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
<script>
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
			error:function(xhr,ajaxOptions,thrownError){$('#response').html(xhr);},
			cache:false,
			beforeSend:function(){
				$('#response').html('<img src="<?php echo base_url().'assets/fastssh_style/css/loader.gif'?>"/>');},
			success:function(s){$('#response').html(s);}});
			return false;});
});
</script>
