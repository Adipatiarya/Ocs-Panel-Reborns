
<div class="warper container-fluid">
	<div class="page-header"><h1>Tambah Service</h1></div>
	
			<div class="panel panel-primary">
				<div class="panel-heading"><?php echo $server->host ?></div>
				<div class="panel-body">
					
					<?php echo $message; ?>
					
					<?php echo form_open(); ?>
					<div class="form-group">
						<label>SERVICE</label>
						<input type="text" class="form-control" name="service" placeholder="openssh">
					</div>
					<div class="form-group">
						<label>Port: </label>
						<input type="text" class="form-control" name="port" placeholder="22">
					</div>
					<div class="form-group">
					<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
					<?php echo form_close(); ?>
					</div>
														
			
            
				</div>
			</div>
		
</div>
        
