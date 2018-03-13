<div class="warper container-fluid">
        	
            <div class="page-header"><h1></h1></div>
            <div class="row">
				
            	<div class="col-md-6">
                
                	<div class="panel panel-default">
                        <div class="panel-heading"><?php echo $server->name ?> </div>
                        <div class="panel-body">
						<?php echo $message; ?>
								
                          <?php echo form_open();?>
                            
                            <div class="form-group has-feedback">
                                <label class ="control-label">Hostname</label>
                                <br/>
                                <input value="<?php echo $server->host ?>" readonly>
                            </div>
                            
                            
                           <div class="form-group has-feedback">
                                <label class ="control-label">Username</label>
                                <br/>
                                <?php echo form_input($username);?>
                            </div>
                            
                            <div class="form-group has-feedback">
                                <label class ="control-label">Password</label>
                                <br/>
                                <?php echo form_input($password);?>
                            </div>
                            <?php if(!empty($server->price)) { ?>
								
								<div class="form-group has-feedback">
                                <label class ="control-label">Jenis Akun</label>
                                <br/>
                                <input type="radio" name="type" value="premium" checked> <?php echo $config->premium ?> Hari
                                <input type="radio" name="type" value="trial"> Trial <?php echo $config->trial ?> Hari
                            </div>
                            
							<?php }?>
                            
                            <div class="form-group">
								<?php echo form_hidden($csrf); ?>
								<?php echo form_input($id); ?>
								<?php if(!empty($server->price)) { ?>
									<?php echo form_submit('submit', 'Buy', 'class="btn btn-primary"');?>
                                <?php } else {?>
									<?php echo form_submit('submit', 'Create user', 'class="btn btn-primary"');?>
								<?php } ?>
                                <a href ="<?php echo site_url('panel/'.$user->username.'/servers.html') ?>" type="button" class="btn btn-info" id="resetBtn">Cancel</a>
                            </div>
                            <?php echo form_close();?>
                                          
                        </div>
                    </div>
                 </div>
                             
                
            </div>
       </div>
        
