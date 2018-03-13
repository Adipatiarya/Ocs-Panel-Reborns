<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<?php if ($location_only): ?>
	
		<?php include 'section-tout.php'; ?>
		
	<?php endif; ?>
	
    <div class="section-preview">
		<div class="container">
			<center><p>Our SSH Account only for tunnelling protocol (port forwarding) without shell access.</p></center>
		</div>
		<div class="container">
			<div  class="row">
			<?php foreach ($locations as $location): ?>
				<div class="col-lg-4 col-sm-6">
					<div class="card border-primary mb-3" style="max-width: 20rem;">
						<h4 class="card-header">
							SSH Server in <?php echo $location->name; ?>
						</h4>
						<div class="card-body">
							
							<div class="card-title">Click to select in <?php echo $location->name; ?> Servers</div>
						</div>
						<div class="card-footer">
							<a class ="btn btn-primary" href="<?php echo $location->link ?>">Select in <?php echo $location->name ?></a>
						</div>		
					</div>
				</div>
		
			<?php endforeach; ?>
			</div>

		</div>
	</div>
