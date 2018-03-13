<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page">

<br>
<ol class="form" style="width:850px;background:#fff;">
	<br><li><label>IP Address</label><b> <?php echo $ipAddr; ?></b></li>	
</ol>
<br>


<p style="text-align:center;"> Our SSH Account only for tunnelling protocol (port forwarding)  without shell access.
</p>
<div id="list-server">
	<?php
	
	$step = 0;
	
	
	
	foreach ($locations as $location) {
		$step++;
		
		if($step === 4) {
			//pertiga baris 
			
			echo '<div style="margin-bottom:50px;"></div>';
			$step = 0; 
		} 
		
		?>
		<div id="server">
			<h2 id="server-location">
				SSH Server in <?php echo $location->name; ?>
			</h2>
			<div id="server-detail">
				Click to select <?php echo $location->name ?> Server
			</div>
			<div id="server-account">
				<a href="<?php echo $location->link ?>">Select in <?php echo $location->name ?></a>
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

