<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="warper container-fluid">
	<div class="page-header">
		<h1>List Voucher</h1>
		<small></small>
	</div>
	<?php if($this->session->userdata('message')) { ?>
		<div class ="alert alert-warning">
			<?php echo $this->session->userdata('message'); ?>
		</div>
	<?php } ?>
	
	<?php $this->load->view('member/notif'); ?>
	<div class="row">
		
		<?php foreach ($vouchers as $voucher) { ?>
			<div class="col-md-3 col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading"><i class="fa fa-money"></i> <?php echo $voucher->name ?>
					</div>
					<div class="panel-body">
						Harga : Rp <?php echo $voucher->price ?>
						<br/>
						Isi : <?php echo $voucher->value ?>
						<br/>
						Desc : <?php echo $voucher->description ?>
					</div>
					<div class="panel-footer">
						<a class="btn btn-primary btn-sm" href="<?php echo site_url('panel/'.$user->username.'/voucher/'.$voucher->id.'/beli.html') ?>">Beli</a>
					</div>
				</div>
			</div>
			
		<?php } ?>
	</div>
	Note: Harga dapat berubah sewaktu waktu
</div>
	 
	
