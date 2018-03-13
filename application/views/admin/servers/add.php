
<div class="warper container-fluid">
        	
            <div class="page-header"><h1>ADD Server</h1></div>
            <div class="row">
            	<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-body">
							

					
					<?php echo $message; ?>
					
					<?php echo form_open(); ?>
					<div class="form-group">
						<label for="continent">
							Nama server
						</label>
						<?php echo form_input($name); ?>
					</div>
					<div class="form-group">
						<label>Hostname</label>
						<?php echo form_input($host); ?>
					</div>
					
					<div class="form-group">
						<label>Location: </label>
						<br/>
						<select name="location">
							<?php foreach($locations as $location) {?>
								<option value="<?php echo $location->name; ?>"><?php echo $location->name ?></option>
							<?php } ?>
						</select>
						<span class="text-info"> <a class="btn btn-default btn-xs" href="<?php echo site_url('admin/server/location/add.html') ?>"><i class="fa fa-plus"></i></a></span>
					</div>
					
					<div class="form-group">
						<label>Service</label>
						<input name="service" type="text" class="form-control" placeholder="openssh" required>
					</div>
					<div class="form-group">
						<label>Port</label>
						<input name="port" type="text" class="form-control" placeholder="22" required>
					</div>
					
					<div class="form-group">
						<label>Root Password</label>
						<?php echo form_input($password); ?>
					</div>
																		
					<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
					<?php echo form_close(); ?>
						</div>
					</div>
                </div>
            </div>
       </div>
