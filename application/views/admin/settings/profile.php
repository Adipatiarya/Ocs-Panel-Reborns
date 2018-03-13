<div class="warper container-fluid">
        	
            <div class="page-header"><h1><?php echo $title ?></h1></div>
            <div class="row">
				
            	<div class="col-md-6">
                
                	<div class="panel panel-default">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
						<?php echo $message; ?>
								
                          <?php echo form_open(uri_string());?>
                            
                           <div class="form-group has-feedback">
                                <label for="<?php echo $form_label ?>" class ="control-label"><?php echo $title ?></label>
                                <br/>
                                <?php echo form_input($data);?>
                            </div>
                            
                            
                            <div class="form-group">
								<?php echo form_hidden('id', $user->id);?>
								<?php echo form_hidden($csrf); ?>
								<?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn btn-primary"');?>
                                
                                <a href ="<?php echo site_url('admin/settings.html') ?>" type="button" class="btn btn-info" id="resetBtn">Cancel</a>
                            </div>
                            <?php echo form_close();?>
                                          
                        </div>
                    </div>
                 </div>
                             
                
            </div>
       </div>
        
