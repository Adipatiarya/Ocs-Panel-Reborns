<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="warper container-fluid">
	<div class="page-header">User Info</div>
	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">
			<div class="user text-center">
				<img src="<?php echo base_url().'uploads/profiles/'.$profile->image; ?>" class="img-circle" alt="...">
				<br/><br/>
				Saldo : Rp. <?php echo $profile->saldo; ?>
				<br/>
				<?php echo $profile->first_name . ' ' .$profile->last_name; ?>
				<hr/>
				Username : <?php echo $profile->username; ?>
				<hr/>
				Email : <?php echo $profile->email; ?>
				<hr/>
				Phone : <?php echo $profile->phone; ?>
				<hr/>
				<?php if($profile->active) { ?>
								 
								 <br/>
								 <p>
								Status:  <label class="label label-success">Active</label>
								</p>
								 <a href="<?php echo site_url('admin/profile/deactivate/'.$profile->id) ; ?>" class="btn btn-danger">NON AKTIVEKAN SELLER INI</a>
							<?php } else { ?>
								<p>
								Status:  <label class="label label-danger">Non active</label>
								</p>
								<a href="<?php echo site_url('admin/profile/activate/'.$profile->id); ?>" class="btn btn-primary">AKTIVEKAN SELLER INI</a>
				<?php } ?>
                        
			</div>
		Terakhir Login: <?php echo date("d-M-Y H:i:s",$profile->last_login); ?>	
		</div>
		<div class="panel-footer">
		</div>
	</div>
	
