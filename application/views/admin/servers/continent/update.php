<div class="warper container-fluid">
        	
            <div class="page-header"><h1>UPDATE CONTINENT</h1></div>
            <div class="row">
            	<div class="col-md-6">
					<?php echo $message; ?>
					
					<?php echo form_open(); ?>
					<div class="form-group">
						<label for="continent">
							Nama Benua
						</label>
						<?php echo form_input($name); ?>
					</div>
					<div class="form-group">
						
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<?php echo form_textarea($description); ?>
					</div>
					<?php echo form_hidden('id', $continent->id);?>
					<?php echo form_hidden($csrf); ?>
					<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
					<?php echo form_close(); ?>
                </div>
            </div>
       </div>
        
