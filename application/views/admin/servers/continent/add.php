<div class="warper container-fluid">
	<div class="page-header"><h1>ADD CONTINENT</h1></div>
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
						<label>Deskripsi</label>
						<?php echo form_textarea($description); ?>
					</div>
					<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
					<?php echo form_close(); ?>
					
                </div>
            
				<div class="col-md-6">
					<?php if (!empty($continents)) { ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Benua</th><th>Act</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($continents as $continent) { ?>
						<tr>
							<td><?php echo $continent->name; ?></td>
							</td>
							<td><a href="<?php echo site_url('admin/server/continent/'.$continent->id.'/update.html')?>">Edit</a> | <a href="<?php echo site_url('admin/server/continent/'.$continent->id.'/delete.html')?>">Del</a></td>
						</tr>
										
						<?php } ?>
						</tbody>
					</table>
							
				<?php } else { ?>
					<p>Continent belum ditambahkan</p>
				<?php } ?>	
	
			</div>
		</div>

</div>
        
