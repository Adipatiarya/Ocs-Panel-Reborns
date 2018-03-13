
<div class="warper container-fluid">
	<div class="page-header">
		BANED USERS
	</div>
	<div class="panel panel-danger">
		<div class="panel-heading">
			<?php echo lang('deactivate_heading');?>
		</div>
		<div class="panel-body">
			<p><?php echo sprintf('Anda yakin ingin menonaktikan user '. $user->username);?></p>

<?php echo form_open(site_url('admin/profile/deactivate/'.$user->id));?>

	<p>Membaned user akan mengakibatkan user tidak bisa login sebelum Anda unban kembali.</p>
  <p>
  	<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
    <input type="radio" name="confirm" value="yes" checked="checked" />
    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
    <input type="radio" name="confirm" value="no" />
  </p>

  <?php echo form_hidden($csrf); ?>
  <?php echo form_hidden(array('id'=>$user->id)); ?>

  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'), 'class="btn btn-danger"');?></p>

<?php echo form_close();?>
		</div>
	</div>
</div>

