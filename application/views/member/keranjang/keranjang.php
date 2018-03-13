<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="warper container-fluid">
	<?php $this->load->view('member/notif'); ?>
	<?php if($this->session->userdata('message')) { ?>
		<div class ="alert alert-warning">
			<?php echo $this->session->userdata('message'); ?>
		</div>
	<?php } ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			Deposit
		</div>
		<div class="panel-body">
			<div class="pull-right">
				<a href="<?php echo site_url('panel/'.$user->username. '/voucher.html') ?>"><button type="button" class="btn btn-success" style="font-size:10px;">Voucher Info</button></a>
			</div>
			<br/>
			<?php echo form_open(); ?>
			<div class="form-group" style="font-size:10px;">
				<label for="email">Email</label>
				<input style="font-size:10px;" class="form-control" type="text" value="<?php echo $user->email; ?>" readonly>
			</div>
			<div class="form-group" style="font-size:10px;">
				<label>Jumlah</label>
				<select style="font-size:10px;" name="voucher" class="form-control" required>
					<?php $count=1; foreach($vouchers as $voucher) {?>
						<option value="<?php echo $voucher->id; ?>"> <?php echo $count++.'. '.$voucher->name .' Rp. '.$voucher->price.'[isi '.$voucher->value.']'; ?></option>
					<?php } ?>
				</select>
			</div>
			<button type="submit" class="btn btn-primary" style="font-size:10px;">Deposit</button>
			<?php echo form_close(); ?>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			Transaksi
		</div>
		
		<div class="panel-body">
			
			<?php if(empty($keranjangs)) {
				echo "Belum ada transaksi</div></div>";
				return;
			} ?>
			<div class="page-header">
				History Transaksi
			</div>
			<table class="table table-bordered">
				<thead>
				<tr style="font-size:10px;">
					<th style="width:10px; height:8px;">ID</th>
					<th>Harga</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
					<?php if(!empty($keranjangs)) { foreach($keranjangs as $keranjang) { ?>
						<tr style="font-size:10px;">
							<td>
								<a href="<?php echo site_url('panel/'.$user->username.'/keranjang/'.$keranjang->id. '/read.html') ?>"><?php echo $keranjang->id; ?></a>
							</td>
							<td>Rp.<?php echo $keranjang->price; ?></td>
							<td><?php
										if ($keranjang->status && !$keranjang->dibayar)  {
											
											echo '<a href="'.site_url('panel/'.$user->username.'/keranjang/'.$keranjang->id. '/read.html').'" class="text-warning">Pending..</a>';
										}
										elseif (!$keranjang->dibayar && !$keranjang->status) {
											echo '<a href="'.site_url('panel/'.$user->username.'/keranjang/'.$keranjang->id. '/read.html').'" class="text-danger">Blm bayar</a>';
										}
										else {
											echo '<a href="'.site_url('panel/'.$user->username.'/keranjang/'.$keranjang->id. '/read.html').'" class="text-success">Selesai</a>';
										}
										?>
							</td>
							<td>
										<?php if (!$keranjang->dibayar && !$keranjang->status) { ?>
											
												<a class="btn btn-default btn-xs" href="<?php echo site_url('panel/'.$user->username.'/voucher/'.$keranjang->id. '/bayar.html') ?>"><i class="glyphicon glyphicon-shopping-cart"></i></a> |
												<a class="btn btn-default btn-xs" href="<?php echo site_url('panel/'.$user->username.'/voucher/'.$keranjang->id. '/hapus.html') ?>"><i class="glyphicon glyphicon-trash"></i></a>
											
										<?php } else { ?>
											
										<?php }?>
									</td>
						</tr>
					<?php } } ?>
				</tbody>
			</table>
			<?php echo $link ?>
			<div style="font-size:10px;" class="text-muted">
			INFO: <br>
			Pending menandakan administrator sedang menegecek data.<br>
			Success menandakan Pembayaran berhasil.
			
			</div>	
		</div>
		
	</div>
	
</div>
