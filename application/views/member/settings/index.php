<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="warper container-fluid">
	<?php $this->load->view('member/notif'); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			Seller INFO
		</div>
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
				<a class="btn btn-default" href="<?php echo site_url('panel/'.$user->username.'/setting/foto.html') ?>"><i class="fa fa-camera"></i></a>
			</div>
			<div class="form-group">
				<label>Full name <span><a class="btn btn-default btn-xs" href="<?php echo site_url('panel/'.$user->username. '/setting/fullname.html');?>"> <i class="fa fa-pencil"></i></a></span></label>
				<input  class="form-control" value="<?php echo $user->first_name . ' ' .$user->last_name; ?>" readonly>
				<?php if (empty($user->first_name) ) { ?>
				<small class="text-danger">Error!! Harus di isi!!</small>
				<?php } ?>
			</div>
			<div class="form-group">
				<label>Username <span><a class="btn btn-default btn-xs" href="<?php echo site_url('panel/'.$user->username. '/setting/username.html');?>"> <i class="fa fa-pencil"></i></a></span></label>
				<input  class="form-control" value="<?php echo $user->username; ?>" readonly>
				<?php if (! preg_match('/^[a-zA-Z0-9]+$/', $user->username ) ) { ?>
				<small class="text-danger">Error!! Harus diganti!!</small>
				<?php } ?>
			</div>
			<div class="form-group">
				<label>Email <span><a class="btn btn-default btn-xs" href="<?php echo site_url('panel/'.$user->username. '/setting/email.html');?>"> <i class="fa fa-pencil"></i></a></span></label>
				<input class="form-control" value="<?php echo $user->email; ?>" readonly>
			</div>
			<div class="form-group">
				<label>Phone <span><a class="btn btn-default btn-xs" href="<?php echo site_url('panel/'.$user->username. '/setting/phone.html');?>"> <i class="fa fa-pencil"></i></a></span></label>
				<input class="form-control" value="<?php echo $user->phone; ?>" readonly>
				<?php if (empty($user->phone) ) { ?>
					<small class="text-default">Disarankan untuk mengisi no telp</small>
				<?php } ?>
			</div>
			<div class="form-group">
				<label>Password <span><a class="btn btn-default btn-xs" href="<?php echo site_url('panel/'.$user->username. '/setting/password.html');?>"> <i class="fa fa-pencil"></i></a></span></label>
				<input class="form-control" value="********" readonly>
			</div>
		
		</div>
		<div class="panel-footer" style="font-size:10px;">
			Terakhir Login: <?php echo date("d-M-y H:i:s",$user->last_login); ?>
		</div>
	</div>
</div>
