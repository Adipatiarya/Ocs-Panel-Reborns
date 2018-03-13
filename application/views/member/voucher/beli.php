<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="warper container-fluid">
	<?php $this->load->view('member/notif'); ?>
            <div class="row">
            <div class="col-md-6">
                	<div class="panel panel-default">
                        <div class="panel-heading">Silahkan Transfer</div>
                        <div class="panel-body">
                        
                        	<form method="post" class="validator-form form-horizontal bv-form" action="#" novalidate="novalidate"><button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
                            
                                <p>1. Bank BRI : xxxxx<br>
                                2. Pulsa XL : xxxxx<br>
                                3. Pulsa Tsel : xxxxxx<br>
                                4. Bank BCA : xxxxx<br>
                                
                        	</p></form>
                        </div>
                    </div>
                </div>
            	<div class="col-md-6">
                
                	<div class="panel panel-default">
                        <div class="panel-heading">
							Konfirmasi Transfer<br/>
							Id Transaksi : <?php echo $keranjang->name; ?>
						</div>
                        <div class="panel-body">
						
                        	<?php echo form_open(); ?>
                            <div class="form-group">
                                <label class="control-label">Nama Pengirim</label>
                                <?php echo form_input($pengirim); ?>
                             </diV>
                                                     
                            <div class="form-group has-feedback">
                                <label class="control-label">Email</label>
                                <?php echo form_input($email); ?>
                             </div>
                            
                            <div class="form-group has-feedback">
                                <label class="control-label">Jumlah Transfer</label>
                                <?php echo form_input($jumlah); ?>
                             </div>
                            
                             <div class="form-group has-feedback">
                                <label class="control-label">Bukti Transfer</label>
                             </div>
                            
                            <hr class="dotted">
                            
                            <div class="form-group">
                             
                            </div>
                            <?php echo form_close(); ?>
                              
                        </div>
                    </div>
                 </div>
                 
                 
                
                
            </div>
       </div>
       	 
	
