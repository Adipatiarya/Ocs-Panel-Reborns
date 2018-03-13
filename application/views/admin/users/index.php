<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
       
<div class="warper container-fluid">
	<div class="page-header">SELERS LIST</div>
	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">
			<table class="table table-bordered">
				<thead>
					<tr style="font-size:10px">

						<th>Email</th>
						<th>Status</th>
						<th>Account created</th>
						<th>Saldo</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($sellers as $seller):?>
					<?php if ($seller->id == '1' ) {continue;} ?> 
					<tr style="font-size:10px">

						<td><a href="<?php echo site_url('admin/users/profile/'.$seller->id.'/profile.html'); ?>"><?php echo htmlspecialchars($seller->email,ENT_QUOTES,'UTF-8');?></a></td>
		
						<td>
							<button type ="button" class="btn btn-default btn-xs">
								<?php echo ($seller->active) ? '<a class="text-muted" href="'.site_url('/admin/profile/deactivate/'.$seller->id).'">Active</a>': '<a href="'.site_url('admin/profile/activate/'.$seller->id).'" class="text-danger">Baned</a>'; ?>
							</button>
						</td>
						<td><?php echo $seller->account_dibuat; ?></td>
						<td>Rp. <?php echo htmlspecialchars($seller->saldo,ENT_QUOTES,'UTF-8');?></td>			
					</tr>
					<?php endforeach;?>
								
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">Account Created</div>
		<div class="panel-body">
			<table class="table table-bordered">
				<thead>
					<tr style="font-size:10px">

						<th>Date</th>
						<th>Seller</th>
						<th>On sever</th>
						<th>Type</th>
					</tr>
				</thead>
				<tbody>
					
					<?php foreach($servers_created as $server_created) {
						if(empty($server_created->created_by)) continue; 
					?>
					<tr>
						<td><?php echo date('d-M-y H:i',$server_created->created_on) ?></td>
						<td><?php echo $server_created->created_by ?></td>
						<td><?php echo $server_created->server ?></td>
						<td><?php if($server_created->trial === TRUE) {echo 'Trial'; } else { echo '30 Hr'; } ?></td>
					</tr>
					<?php } ?>
								
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
		    warning: Pantau terus seller yg membuat akun trial berulang ulang tanpa membelinya
		</div>
	</div>


</div>
