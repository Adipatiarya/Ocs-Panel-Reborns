<div class="warper container-fluid">
        	
            <div class="page-header"><h1><?php echo $title ?></h1></div>
            <div class="row">
				
            	<div class="col-md-6">
                
                	<div class="panel panel-default">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
						<?php echo $message; ?>
								
                          <?php echo form_open();?>
                            
                           <div class="form-group has-feedback">
                                <label for="<?php echo $form_label ?>" class ="control-label">No Telp</label>
                                <br/>
                                <?php echo form_input($number);?>
                            </div>
                           <div class="form-group has-feedback">
                                <label for="<?php echo $form_label ?>" class ="control-label">Pemilik</label>
                                <br/>
                                <?php echo form_input($pemilik);?>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="<?php echo $form_label ?>" class ="control-label">Provider</label>
                                <br/>
                                <?php echo form_input($provider);?>
                            </div>
                             
                            
                            <div class="form-group">
								
								<?php echo form_hidden($csrf); ?>
								<?php echo form_submit('submit', 'Simpan', 'class="btn btn-primary"');?>
                                
                                
                            </div>
                            <?php echo form_close();?>
                                          
                        </div>
                    </div>
                 </div>
                             
                
            </div>
       </div>
        
