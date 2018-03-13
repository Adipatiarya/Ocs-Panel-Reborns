<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="warper container-fluid">
        	
           
            <div class="row">
            <div class="col-md-6">
                	<div class="panel panel-default">
                        <div class="panel-heading">Silahkan Transfer</div>
                        <div class="panel-body">
						
                            <p>
								<?php
								$count = 1; 
								foreach($banks as $bank) {
									echo $count++ .'. '.$bank->pemilik. '[Rek ' .$bank->provider. ']'.$bank->name .'<br>';
									
								}
								foreach($phones as $phone) {
									echo $count++ .'. Pulsa '.$phone->provider.'-'.$phone->number.'<br>';
									
								}
								?>
                        	</p>
                        	<br/>
                        	<p class="text-muted">
								
								Note : <br/>Konfirmasi paling lama 1x24 jam untuk pengecekan,
								pastikan di kirim ke rek/no telp diatas,serta sertakan bukti
								berupa screnshoot untuk mempercepat konfirmasi.
                        	</p>
                        </div>
                    </div>
                </div>
            	<div class="col-md-6">
                
                	<div class="panel panel-default">
                        <div class="panel-heading">Konfirmasi Transaksi #<span class="text-danger"><?php echo $keranjang->name; ?></span></div>
                        <div class="panel-body">
							<?php echo $message; ?>
							<?php if($this->session->userdata('success')) { ?>
									<div class="alert alert-success"><?php echo $this->session->userdata('success'); ?></div>
							<?php  } ?>
                        	<?php echo form_open_multipart();?>
                            <div class="form-group">
                                <label class="control-label">Nama Pengirim</label>
                                <br/>
                                <?php echo form_input($email) ?>
                            </div>
                                                     
                            <div class="form-group">
                                <label for="email" class="control-label">Telp</label>
                                <br/>
                                <?php echo form_input($telp) ?>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label">Jumlah Transfer</label>
                                <br/>
                                <?php echo form_input($jumlah) ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Dibayar ke</label>
                                <br/>
                                <select name="to" class="form-control">
									<?php
								$count = 1; 
								foreach($banks as $bank) {
									echo '<option value="'.$bank->name.'-'.$bank->pemilik.'">'.$count++ .'. '.$bank->pemilik. '[Rek ' .$bank->provider. ']'.$bank->name.'</option>';
									
								}
								foreach($phones as $phone) {
									echo '<option value="'.$phone->number.'">'.$count++ .'. Pulsa '.$phone->provider.'-'.$phone->number.'</option>';
									
								}
								?>
                                </select>
                            </div>
                             <div class="form-group">
                                <label class="control-label">Bukti Transfer</label>
                                <?php echo form_input($image) ?>
                                <?php if($this->session->userdata('uploads')) { ?>
									<small class="text-danger"><?php echo $this->session->userdata('uploads')?></small>
								<?php  } ?>
                            </div>
                            
                            <hr class="dotted">
                            
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Konfirmasi"/>
                                <a href="<?php echo site_url('panel/'.$user->username.'/voucher.html');?>" class="btn btn-info" id="resetBtn">Beli Lagi</a>
                            </div>
                            <?php echo form_close(); ?>
                              
                        </div>
                    </div>
                 </div>
                 
                 
                
                
            </div>
       </div>
            	 
	
