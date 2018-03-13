<?php if (isset($alert)) { ?>
		<div class ="row">
			<div class="col-md-3 col-sm-6 pull-right">
				<div style="font-size:10px;" class ="alert alert-<?php echo $alert['type']; ?>">
					<?php echo $alert['message']; ?>
							
				</div>
			</div>
		</diV>	
<?php } ?>
