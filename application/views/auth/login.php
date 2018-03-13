<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="login">
  <p class="text-center"><b>Panel Reseller | Login</b></p>
  <hr/>
  
    <?php echo form_open();?>
      <fieldset class="clearfix">
		  
         <p>
			<span class="fontawesome-envelope"></span>
			<?php echo form_input($identity);?>
         </p> <!-- JS because of IE support; better: placeholder="Email" -->
         <p>
			 <span class="fontawesome-lock"></span>
			 <?php echo form_input($password);?>
		</p> <!-- JS because of IE support; better: placeholder="Password" -->	 
         <p>
			 <?php echo form_submit('submit', lang('login_submit_btn'));?>
         </p>
		 <p> <a href="<?php echo site_url('forgot.html');?>">Lupa password ?</a></p>
         <p> <a href="<?php echo site_url('register.html');?>">Buat Akun baru ?</a></p>
         <br/>
      </fieldset>
      <center><font color="red"><?php echo $message;?></font></center>
    <?php echo form_close();?>

        
   </div> <!-- end login -->

