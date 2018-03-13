<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="warper container-fluid">
	<?php if(!empty($message)) { ?>
		<div class="alert alert-success pull-right"><?php echo $message ?></div>
	<?php } ?>
	<?php if($keranjang->dibayar ) { ?>
		<div class="alert alert-info pull-right">
			Transaksi ini telah disetujui pada tanggal <br/>
			<h4><?php echo date('d-M-Y H:i:s',$keranjang->updated_on) ?></h4>
		</div>
	<?php }?>
	<div class="page-header"><h1>INVOICE READ</h1></div>
	<hr/>
	<div class="page-header text-success"><h4>Order ID: #<?php echo strtoupper($keranjang->name) ?> </h4></div>
	<div class="page-header"><h6>Dibuat: <?php echo date('d-M-Y H:i:s',$keranjang->created_on) ?> </h6></div>
	<div class="page-header"><h6>Dibayar: <?php echo date('d-M-Y H:i:s',$invoice->created_on) ?> </h6></div>
	<div class="page-header text-muted"><h6>Message: <?php echo $invoice->message ?> </h6></div>
	<hr/>
	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">
			<div class="user text-center">
				<img src="<?php echo base_url().'uploads/profiles/'.$pembeli->image; ?>" class="img-circle" alt="...">
			</div>
			<div class="page-header text-center"><?php echo $pembeli->username?></div>
			<div class="page-header text-center"><?php echo $pembeli->email?></div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Jenis Voucher</div>
		<div class="panel-body">
			<div class="user text-center"><?php echo strtoupper($voucher->name)?></div>
			<div class="page-header text-center">Harga : Rp.<?php echo $voucher->price?></div>
			<div class="page-header text-center">Isi : <?php echo $voucher->value?></div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Bukti Transfer Image</div>
		<div class="panel-body">
			<center>
				
				<a href ="<?php echo base_url().'uploads/bukti_transfer/'.$invoice->bukti; ?>"><img src="<?php echo base_url().'uploads/bukti_transfer/'.$invoice->bukti; ?>" class="img-circle" alt="bukti" width="225px;" height="225px;">
				</a>
			</center>
		</div>
	</div>
	
	<hr/>
	 <?php if(! $keranjang->dibayar ) { ?>
	<?php echo form_open(site_url('admin/invoice/read/'.$invoice->id.'/baca.html') );?>
	<p>Anda akan menambahkan saldo sebesar <?php echo $voucher->value?> Untuk <?php echo $pembeli->username?> ? </p>
	 
	 <p>
		 <?php echo lang('deactivate_confirm_y_label', 'confirm');?>
		 <input type="radio" name="confirm" value="yes" checked="checked" />
		 <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
		 <input type="radio" name="confirm" value="no" />
		 
	</p>
	<?php echo form_hidden($csrf); ?>
	<?php echo form_hidden(array('id'=>$invoice->id)); ?>
	<?php echo form_submit('submit', 'Konfirmasi', 'class="btn btn-danger pull-right"');?>
	<?php echo form_close();?>
	
	<?php } ?>
</div>
