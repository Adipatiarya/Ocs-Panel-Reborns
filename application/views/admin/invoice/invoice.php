<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>      
<div class="warper container-fluid">
	<div class="panel panel-default">
		<div class="panel-heading">Invoice</div>
		<div class="panel-body">
			<?php if(empty($invoices)) {
				echo "Belum ada transaksi</div></div>";
				return;
			} ?>
			<div class="page-header">
				Request masuk
			</div>
			<table class="table table-bordered">
				<thead>
				<tr style="font-size:10px;">
					<th style ="width:10px;">ID</th>
					<th style ="width:20px;">User</th>
					<th>Status</th>
					<th>Date</th>
				</tr>
				</thead>
				<tbody>
					<?php if(!empty($invoices)) { foreach ($invoices as $invoice) { ?>
						<tr style="font-size:10px;">
							
							<td><?php echo $invoice->id; ?></td>
							<td><a href="<?php echo site_url('admin/users/profile/'.$invoice->pengirim->id.'/profile.html');?>" data-toggle="tooltip" data-placement="top" title="<?php echo $invoice->pengirim->username; ?>"><img src="<?php echo base_url('uploads/profiles/'.$invoice->pengirim->image);?>" height="15px;" width="15px;"></img></a></td>
							<td>
								<?php if(!$invoice->dibaca) { ?>
											<a href="<?php echo site_url('admin/invoice/read/'.$invoice->id.'/baca.html');?>">Baca..</a>
										<?php } else {?>
											
											<?php if(!$invoice->transaksi->dibayar) { ?>
												<a class ="text-warning" href="<?php echo site_url('admin/invoice/read/'.$invoice->id.'/baca.html');?>">Pending</a>
											<?php } else { ?>
												<a class ="text-success" href="<?php echo site_url('admin/invoice/read/'.$invoice->id.'/baca.html');?>">Success</a>
											<?php } ?>
	
											
										<?php } ?>
							</td>
							<td><?php echo date('d-M-y h:i',$invoice->created_on); ?></td>
							
						</tr>
					<?php } } ?>
				</tbody>
			</table>
			<?php echo $link; ?>
		</div>
	</div>
</div>
