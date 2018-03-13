<div class="warper container-fluid">
	<div class="page-header">UPLOADS</div>
	<div class="panel panel-default">
	    <div class="panel-body">
	        <?php echo $message ?>
	        
		   <?php echo form_open_multipart(site_url('admin/unziped/upload')); ?>
				<div class="form-group">
					<input name="zip_file" type="file"/>
					
				</div>
			<input type="submit" value="ADD THEME" class="btn btn-primary">
			<?php echo form_close(); ?>
		</div>
		
		<div class="panel-footer">
			
		</div>
	</div>
        
</div>
        