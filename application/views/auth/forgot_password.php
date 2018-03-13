<div id="login">
<p class="text-center"><b>Panel Reseler | <?php echo lang('forgot_password_heading');?></b></p>
<hr/>
<p class="text-center"><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

<br>

<?php echo form_open();?>
	        <fieldset class="clearfix">
      <p>
		<span class="fontawesome-envelope"></span>
      	<?php echo form_input($identity);?>
      </p>

      <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'));?></p>
      </fieldset>
<center><font color="red"></p><?php echo $message;?></font></center>
<?php echo form_close();?>
</div>
