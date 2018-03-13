<div class="warper container-fluid">
        	
            <div class="page-header"><h1>UPDATE LOCATION</h1></div>
            <div class="row">
            	<div class="col-md-6">
					<?php echo $message; ?>
					
					<?php echo form_open(); ?>
					<div class="form-group">
						<label for="location">
							Nama lokasi
						</label>
						<?php echo form_input($name); ?>
					</div>
					<div class="form-group">
						<label>Lokasi continent</label>
						<br>
						<?php foreach ($continents as $group):?>
							<input type="radio" name="continent_id" value="<?php echo $group->id?>"<?php if ($location->continent_id == $group->id) {echo 'checked';} ?>> <?php echo $group->name ?>
							<br/>
						<?php endforeach?>
					</div>
					
					
					
					<div class="form-group">
						<label>Deskripsi</label>
						<?php echo form_textarea($description); ?>
					</div>
					<?php echo form_hidden('id', $location->id);?>
					<?php echo form_hidden($csrf); ?>
					<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
					<?php echo form_close(); ?>
                </div>
            </div>
       </div>
        
