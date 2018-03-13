
<div id="login">
	 <p class="text-center"><b>Panel Reseller | Register</b></p>
	 <hr/>
<?php echo form_open();?>

	<fieldset class="clearfix">
      <?php
      if($identity_column!=='email') {
          echo '<p>';
          echo lang('create_user_identity_label', 'identity');
          echo '<br />';
          echo form_error('identity');
          echo form_input($identity);
          echo '</p>';
      }
      ?>


      <p>
            <?php echo lang('create_user_email_label', 'email');?> <br />
            <span class="fontawesome-envelope"></span>
            <?php echo form_input($email);?>
      </p>


      <p>
            <?php echo lang('create_user_password_label', 'password');?> <br />
            <span class="fontawesome-lock"></span>
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <span class="fontawesome-ok-sign"></span>
            <?php echo form_input($password_confirm);?>
      </p>

		<p>Sudah punya akun ? <a href="<?php echo site_url('login.html');?>">Login</a></p>
		</br>
      <p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>
      
		</fieldset>
		<center><font color="red"></p><?php echo $message;?></font></center>
<?php echo form_close();?>
