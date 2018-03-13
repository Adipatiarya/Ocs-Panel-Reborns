
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="warper container-fluid">
	<div class="page-header">
		<h1>Akun List</h1>
	</div>
<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>NO</th>
						<th>
							User
						</th>
						<th>Type</th>
						<th>price</th>
					</tr>
				</thead>
				<tbody>
					
					<?php foreach ($servers_created as $sc) { ?>
						<tr style="font-size:10px;">
						<td style="width:10px;"><a data-toggle="modal" href="#<?php echo $sc->id;?>"><?php echo $sc->id;?></a></td>
						<td><a data-toggle="modal" href="#<?php echo $sc->id;?>" class="<?php if ($sc->expired_on <= time() ) {echo 'label label-danger'; } else { echo 'text-muted';} ?>"><?php echo $sc->username?></a>
						</td>
						<td><?php if ($sc->trial) {
									echo ' <label class="label label-danger">Trial</label>';
								}
								
								else {
									echo '<label class="label label-primary">30 hari</label>';
								}
							?>
						</td>
						<td><?php echo $sc->price ?></td>
						</tr>
					<?php } ?>
					
				</tbody>
			</table>
			<p>
				Showing
				<?php echo count($servers_created) ?> of
				<?php echo $ini['total_rows'] ?>
				
			</p>
			<div class="pull-right">
				<?php echo $link; ?>
			</div>
			<div>
				<small class="text-muted">Warna merah pada user menandakan user sudah expired.</small>
			</div>
			
		</div>
		<div class="panel-footer">Total Pembelian : Rp. <?php echo $total ?></div>
</div>
	
</div>
<?php foreach ($servers_created as $sc): ?>
<div class="modal fade" id="<?php echo $sc->id;?>" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content" role="document">
			<div class="modal-body">
				<p>Username : <?php echo $sc->username ?> </p>
				<p>Password : <?php echo $sc->password ?> </p>
				<p>On server : <?php echo $sc->server; ?></p>
				
				<p>Created ON : <?php echo date('d-m-y',$sc->created_on) ?></p>
				<p>Expired ON : <?php echo date('d-m-y',$sc->expired_on) ?> </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-btn-default" data-dismiss="modal">close</button>
			</div>
		</div>
	</div>
</div>
					
<?php endforeach; ?>
