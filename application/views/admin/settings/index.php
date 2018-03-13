<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="warper container-fluid">
	<div class="page-header">PENGATURAN AKUN</div>
	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">
			<?php if($this->session->userdata('profile')) { ?>
				<div class="alert alert-success">
					<?php echo $this->session->userdata('profile'); ?>
				</div>
			<?php } ?>
			<div class="user text-center">
				<img src="<?php echo base_url().'uploads/profiles/'.$user->image; ?>" class="img-circle" alt="...">
				<br/><br/>
				<?php if ($user->image === 'default.png') {echo '<small class="text-danger">Foto profile harap diganti.</small><br>'; } ?>
				<a class="btn btn-default" href="<?php echo site_url('admin/setting/foto.html') ?>"><i class="fa fa-camera"></i></a>
			</div>
			<div class="form-group">
				<label>Full name <span><a class="btn btn-default btn-xs" href="<?php echo site_url('admin/setting/fullname.html');?>"> <i class="fa fa-pencil"></i></a></span></label>
				<input  class="form-control" value="<?php echo $user->first_name . ' ' .$user->last_name; ?>" readonly>
				<?php if (empty($user->first_name) ) { ?>
				<small class="text-danger">Error!! Harus di isi!!</small>
				<?php } ?>
			</div>
			<div class="form-group">
				<label>Username <span><a class="btn btn-default btn-xs" href="<?php echo site_url('admin/setting/username.html');?>"> <i class="fa fa-pencil"></i></a></span></label>
				<input  class="form-control" value="<?php echo $user->username; ?>" readonly>
				<?php if (! preg_match('/^[a-zA-Z0-9]+$/', $user->username ) ) { ?>
				<small class="text-danger">Error!! Harus diganti!!</small>
				<?php } ?>
			</div>
			<div class="form-group">
				<label>Email <span><a class="btn btn-default btn-xs" href="<?php echo site_url('admin/setting/email.html');?>"> <i class="fa fa-pencil"></i></a></span></label>
				<input class="form-control" value="<?php echo $user->email; ?>" readonly>
			</div>
			<div class="form-group">
				<label>Password <span><a class="btn btn-default btn-xs" href="<?php echo site_url('admin/setting/password.html');?>"> <i class="fa fa-pencil"></i></a></span></label>
				<input class="form-control" value="********" readonly>
			</div>
		</div>
	</div>
	<div class="page-header">BANK ACOUNT</div>
	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">
			<?php $count =1;if(!empty($banks)) { foreach ($banks as $bank) { ?>
				<div class="form-group">
					<label>
						<?php echo $count++ .' '. $bank->provider; ?>
						<span>
							<a class="btn btn-default btn-xs" href="<?php echo site_url('admin/setting/bank/'.$bank->id.'/bank.html');?>"> <i class="fa fa-pencil"></i></a>
						</span>
					</label>
					<input class="form-control" value="<?php echo $bank->pemilik.' ['.$bank->name.']'; ?>" readonly>
				</div>
			<?php }} ?>
			<a class="btn btn-default btn-sm pull-right" href="<?php echo site_url('admin/setting/bank/bank_add.html'); ?>"><i class="fa fa-plus"></i> ADD</a>
		</div>
	</div>
	<div class="page-header">TELEPHONES</div>
	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">
			<?php $count =1;if(!empty($telephones)) { foreach ($telephones as $telephone) { ?>
				<div class="form-group">
					<label>
						<?php echo $count++ .' '. $telephone->provider; ?>
						<span>
							<a class="btn btn-default btn-xs" href="<?php echo site_url('admin/setting/phone/'.$telephone->id.'/update.html');?>"> <i class="fa fa-pencil"></i></a>
						</span>
					</label>
					<input class="form-control" value="<?php echo $telephone->pemilik.' ['.$telephone->number.']'; ?>" readonly>
				</div>
			<?php }} ?>
			<a href="<?php echo site_url('admin/setting/phone/phone_add.html'); ?>" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> ADD</a>
		</div>
	</div>
	
	
</div>
