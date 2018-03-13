<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="warper container-fluid">
	<div class="page-header">
		<h1>Product</h1>
		<small><?php echo $user->username; ?></small>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h5>Vouchers</h5>
				<hr/>
			</div>
			
		
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-money"></i> VOUCHER LIST
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Price</th>
								<th>Value</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($vouchers)) { foreach ($vouchers as $voucher) { ?>
								<tr class="odd">
									<td><a href="<?php echo site_url('admin/product/voucher/'.$voucher->id.'/update.html') ?>"><?php echo $voucher->name ?></a></td>
									<td>Rp. <?php echo $voucher->price ?></td>
									<td><?php echo $voucher->value ?></td>
									<td><?php echo ($voucher->active) ? '<small class="text-success">Active</small>':'<small class="text-danger">Non Active</small>' ?></td>
								</tr>
							<?php }} ?>
						</tbody>
					</table>
					<a class="btn btn-default btn-sm pull-right" href="<?php echo site_url('admin/product/voucher/add.html') ?>"><i class="fa fa-plus">Tambah voucher</i></a>
				</div>
			</div>
		</div>
	</div>

</div>
	 
	
