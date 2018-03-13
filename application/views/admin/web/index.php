<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="warper container-fluid">
	<div class="page-header">Servers Config</div>
	<div class="panel panel-default">
		
		<div class="panel-heading">
			<?php echo form_open(site_url('admin/webssh/public_enable')) ?>
			<?php if ( $config->public_enable ) { $checked='checked'; } else { $checked =''; }?>
			Enable Public SSH <input type="checkbox" name="public_enable" onchange="this.form.submit();" value="1" <?php echo $checked; ?>>
			<?php echo form_close() ?>
		</div>
		<div class="panel-body">
			<?php echo $message ?>
			<?php echo form_open() ?>
			<div class="form-group has-feedback">
				<label class="control-label">Expired User premium</label>
				<input class="form-control" type="text" name="premium" value="<?php echo $config->premium ?>">
				<small class="text-info">User akan aktif selama <?php echo $config->premium ?> Hari</small>
			</div>
			<div class="form-group has-feedback">
				<label class="control-label">Expired User Trial</label>
				<input class="form-control" type="text" name="trial" value="<?php echo $config->trial ?>">
				<small class="text-info">User akan aktif selama <?php echo $config->trial ?> Hari</small>
			</div>
			<div class="form-group has-feedback">
				<label class="control-label">Expired User Free</label>
				<input class="form-control" type="text" name="free" value="<?php echo $config->free ?>">
				<small class="text-info">Digunakan untuk free ssh <?php echo $config->free ?> Hari</small>
			</div>
			<hr/>
			<div class="form-group">
				<label class="control-label">Yang Tampil di public (web_ssh)</label>
				<p>
				<input type="radio" name="set" value="continent_only" <?php echo ($config->continent_only) ? 'checked' : ''?>> <label class="label label-default">Continent</label>
				<br/>
				<small class="text-muted">Urutan : continent->location->server->create_user.php</small>
				</p>
				<p>
				<input type="radio" name="set" value="location_only" <?php echo ($config->location_only) ? 'checked' : ''?>> <label class="label label-default">Location</label>
				<br/>
				<small class="text-muted">Urutan : location->server->create_user.php</small>
				</p>
				<p>
				<input type="radio" name="set" value="server_only" <?php echo ($config->server_only) ? 'checked' : ''?>> <label class="label label-default">Server Only</label>
				<br>
				<small class="text-muted">Urutan : server->create_user.php</small>
				</p>
			</div>
			<button type="submit" class="btn btn-info"> Save</button>
			
			<?php echo form_close() ?>
			
		</div>
		
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">TEMPLATE SETTING</div>
		<?php echo form_open(site_url('admin/webssh/change_theme')) ?>
		<div class="panel-body">
			<?php echo $theme ?>
			<?php foreach ($templates as $template) { ?>
				
				<div class="col-sm-4">
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<?php if($config->template !== $template->name) { ?>
							<a data-toggle="modal" href="#<?php echo $template->id;?>" class="btn btn-default btn-xs pull-right"> <i class="fa fa-trash"></i></a>
							<div class="modal fade" id="<?php echo $template->id;?>" tabindex="-1" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content" role="document">
									<div class="modal-body">
											Anda yakin Menghapus <?php echo $template->name ?> ?
									</div>
									<div class="modal-footer">
										<a class="btn btn-danger" href="<?php echo site_url('admin/unziped/delete/'. $template->id) ?>">OK</a>
										<button type="button" class="btn-btn-default" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</div>
						</div>

							<?php } ?>
						</div>
						<div class="panel-body">
							
							<img src="<?php echo base_url('assets/'.$template->name.'/screenshot.png')?>" width="100px;" height="100px;" alt="screenshot.png">
							
						</div>
						<div class="panel-footer">
							<input type="radio" name="template" value="<?php echo $template->name ?>" onchange="this.form.submit();" <?php if($config->template === $template->name) {echo "checked";} ?>> <?php echo $template->name ?>
						</div>
					</div>
					
					
				</div>
				
			<?php }?>
		</div>
		<?php echo form_close() ?>
		<div class="panel-body">
		    <p>Download Sample Template</p>
		    <ul>
		        <li>
		            <a href="<?php echo base_url('docs/template/fastssh_style.zip')?>">fastssh_style.zip</a>
		        </li>
		        <li>
		            <a href="<?php echo base_url('docs/template/default.zip')?>">default.zip</a>
		        </li>
		    </ul>
		</div>
		<div class="panel-footer">
		    <a href ="<?php echo site_url('admin/unziped') ?>" class="btn btn-default">ADD TEMPLATE</a>
		</div>
	</div>
</div>
