<div class="warper container-fluid">
	<div class="page-header"><h1>GANTI FOTO</h1></div>
	<div class="col-md-4 text-center">
		<div class="panel panel-default">
		<div class="panel-body">
			<?php echo $message ?>
			<div class="user">
				<img src="<?php echo base_url().'uploads/profiles/'.$user->image; ?>" class="img-circle" alt="...">
			</div>
			
			<?php echo form_open_multipart();?>
			<div class="form-group">
				<label>Pilih Gambar </label>
				<?php echo form_input($image);?>
			</div>
			<div class="form-group">
				<?php echo form_hidden('id', $user->id);?>
				<?php echo form_hidden($csrf); ?>
				<?php echo form_submit('submit', 'Ganti', 'class="btn btn-primary"');?>
			</div>
			<?php echo form_close(); ?>
			
		</div>
	</div>

	</div>
</div>
