<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="warper container-fluid">
	<div class="page-header">
		<h1>DASHBOARD</h1>
		<small><?php echo $user->username; ?></small>
	</div>
	
	<?php $this->load->view('member/notif'); ?>
	<div class="row">
		<div class="col-md-3 col-sm-6">
			<div class="panel panel-default clearfix dashboard-stats rounded">
				<a href="<?php echo site_url('panel/'.$user->username.'/servers.html'); ?>">
					<span id="dashboard-stats-sparkline1" class="sparkline transit">
						<canvas style="display: inline-block; width: 89px; height: 60px; vertical-align: top;" width="89" height="60">
						</canvas>
					</span>
                    <i class="fa fa-server bg-danger transit stats-icon"></i>
                        <h3 class="transit"> <?php echo $total_server; ?>
							<small class="text-green">
								<i class="fa fa-caret-up"></i>
							</small>
						</h3>
					<p class="text-muted transit">Servers List</p>
				</a>
			</div>
		</div>
	
		<div class="col-md-3 col-sm-6">
			<div class="panel panel-default clearfix dashboard-stats rounded">
				<a href="<?php echo site_url('panel/'.$user->username.'/history.html'); ?>">
					<span id="dashboard-stats-sparkline3" class="sparkline transit">
						<canvas style="display: inline-block; width: 89px; height: 60px; vertical-align: top;" width="89" height="60"></canvas>
					</span>
                    <i class="fa fa-user bg-success transit stats-icon"></i>
                    <h3 class="transit"><?php echo $total_akun; ?> <small class="text-green"><i class="fa fa-caret-up"></i> </small></h3>
                    <p class="text-muted transit">Total Akun</p>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
			<div class="panel panel-default clearfix dashboard-stats rounded">
				<a href="<?php echo site_url('panel/'.$user->username.'/voucher.html'); ?>">
					<span id="dashboard-stats-sparkline2" class="sparkline transit">
						<canvas style="display: inline-block; width: 89px; height: 60px; vertical-align: top;" width="89" height="60">
						</canvas>
					</span>
					<i class="fa fa-tags bg-info transit stats-icon"></i>
					<h3 class="transit">
						<small class="text-red">
							<i class="fa fa-caret-up"></i>
						</small>
					</h3>
					<p class="text-muted transit">Tambah Saldo</p>
				</a>
            </div>
        </div>


	</div>
	
</div>
	 
	
