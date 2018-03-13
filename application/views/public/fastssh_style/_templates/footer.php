<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!-- start footer -->
<div id="footer">
	<div id="wrapper">	
<div class="footer-cols">
	<div class="col">
		<h2>Menu</h2>
		<ul>
			<li><a href="<?php echo site_url('page/privacy-policy/') ?>">Privacy Policy</a></li>
			<li><a href="#">Contact Us</a></li>
			<li><a href="#">Server Status</a></li>
			<li><a href="<?php echo site_url('page/terms-of-service/') ?>">TOS</a></li>
		</ul>
	</div>
	<div class="col">

	</div>
	<div class="col">

	</div>	
	<div class="col">
		<h2>Total Accounts</h2>
Total Account Created by <?php echo ucwords($domain) ?> : <b><?php echo $total_account ?></b>	</div>	
	<div class="col">

	</div>			
</div>


<div style="clear:both;"></div>
</div>
</div>
<div style="padding:4px;"></div>
</div>

</div>

</body>
</html>
