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
                                <label for="<?php echo $form_label ?>" class ="control-label">Nama</label>
                                <br/>
                                <?php echo form_input($name);?>
                            </div>
                           <div class="form-group has-feedback">
                                <label for="<?php echo $form_label ?>" class ="control-label">Price</label>
                                <br/>
                                <?php echo form_input($price);?>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="<?php echo $form_label ?>" class ="control-label">Isi</label>
                                <br/>
                                <?php echo form_input($value);?>
                            </div>
                             
                            <div class="form-group has-feedback">
                                <label for="<?php echo $form_label ?>" class ="control-label">Deskripsi[Opsional]</label>
                                <br/>
                                
                                <textarea placeholder="Ex: Promo Harga murah voucher untuk hari ini" class="form-control" cols ="10" rows="5" name="description"></textarea>
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
        
