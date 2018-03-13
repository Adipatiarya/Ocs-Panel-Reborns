<div class="warper container-fluid">
	<div class="page-header"><h1>GANTI FOTO</h1></div>
	<div class="panel panel-default">
		<?php echo form_open_multipart();?>
		<div class="panel-body">
			<center>
			<?php echo $message ?>
			<img src="<?php echo base_url().'uploads/profiles/'.$user->image; ?>" class="img-circle" alt="...">
			<?php echo form_input($image);?>
			<?php echo form_hidden('id', $user->id);?>
				<?php echo form_hidden($csrf); ?>
				<?php echo form_submit('submit', 'Ganti', 'class="btn btn-primary"');?>
			</center>
		</div>
		<div class="panel-footer"></div>
		<?php echo form_close(); ?>
	</div>
</div>
