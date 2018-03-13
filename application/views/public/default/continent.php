<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<?php include 'section-tout.php'; ?>
	
    <div class="section-preview">
		<div class="container">
			<div  class="row">
			<?php foreach ($continents as $continent): ?>
				<div class="col-lg-4 col-sm-6">
					<div class="card border-primary mb-3" style="max-width: 20rem;">
						<h4 class="card-header">
							SSH Server in <?php echo $continent->name; ?>
						</h4>
						<div class="card-body">
							
							<div class="card-title">Available Countries:</div>
							<p class="card-text">
								<?php foreach ($continent->locations as $location): ?>
									 - <?php echo $location->name; ?> <br>
								<?php endforeach; ?>
							</p>
						</div>
						<div class="card-footer">
							<a class ="btn btn-primary" href="<?php echo $continent->link ?>">Select in <?php echo $continent->name ?></a>
						</div>		
					</div>
				</div>
		
			<?php endforeach; ?>
			</div>

		</div>
	</div>
