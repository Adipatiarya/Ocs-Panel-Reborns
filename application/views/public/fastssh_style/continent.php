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
	
	
	
	foreach ($continents as $continent) {
		$step++;
		
		if($step === 4) {
			//pertiga baris 
			
			echo '<div style="margin-bottom:50px;"></div>';
			$step = 0; 
		} 
		
		?>
		<div id="server">
			<h2 id="server-location">
				SSH Server in <?php echo $continent->name; ?>
			</h2>
			<div id="server-detail">
				Available countries : <br>
				<?php foreach ($continent->locations as $location): ?>
					- <?php echo $location->name; ?> <br>
				<?php endforeach; ?>
			</div>
			<div id="server-account">
				<a href="<?php echo $continent->link ?>">Select in <?php echo $continent->name ?></a>
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
		 <a href="$" target="_BLANK">Europe VPS</a>  |
		 <a href="#" target="_BLANK">North America VPS</a>  |
		 <a href="#" target="_BLANK">Unmetered KVM VPS</a>
	</div>
</div>

