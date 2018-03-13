<div class="warper container-fluid">
        	
            <div class="page-header"><h1>ADD LOCATION</h1></div>
            <div class="row">
            	<div class="col-md-6">
					<?php echo $message; ?>
					
					<?php echo form_open(); ?>
					<div class="form-group">
						<label for="continent">
							Nama Lokasi
						</label>
						<?php echo form_input($name); ?>
					</div>
					<div class="form-group">
						<label>Kategori continent</label>
						<br/>
						
						<select name="id_continent"> 
							<?php foreach($continents as $continent) { ?>
								<option value="<?php echo $continent->id; ?>"> <?php echo $continent->name; ?></option>
							<?php } ?>
						</select> 
						
						<span><a class="btn btn-primary btn-xs" href="<?php echo site_url('admin/server/continent/add.html')?>"><i class="fa fa-plus"></i></a></span>
						
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<?php echo form_textarea($description); ?>
					</div>
					<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
					<?php echo form_close(); ?>
                </div>
				<div class="col-md-6">
					<?php if (!empty($locations)) { ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Benua</th><th>Act</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($locations as $location) { ?>
						<tr>
							<td><?php echo $location->name; ?> (<?php echo $location->continent; ?>)</td>
							</td>
							<td><a href="<?php echo site_url('admin/server/location/'.$location->id.'/update.html')?>">Edit</a> | <a href="<?php echo site_url('admin/server/location/'.$location->id.'/delete.html')?>">Del</a></td>
						</tr>
										
						<?php } ?>
						</tbody>
					</table>
							
				<?php } else { ?>
					<p>Lokasi belum ditambahkan</p>
				<?php } ?>	
	
            </div>
       </div>
        
