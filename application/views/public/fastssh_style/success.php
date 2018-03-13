<div style="width:600px;background:#f5f5f5;min-height:65px;">

[+] <i>creating an username.....</i> <br>
[+]	Username has been successfully created <br>
[+]<i> setting an expiry date.....</i> <br>
[+] Expiry date has been updated  <br>
[+] <i>setting up a password.....</i> <br>
[+] Password has been set  <br>---------------------<br>

<br>Your Username <b class="green"><?php echo $account->username ?></b>
has been successfully created !<br>

<br>
Username SSH : <input value="<?php echo $account->username ?>" type="text" readonly><br>
Password SSH : <input value="<?php echo $account->password ?>" type="text" readonly><br>
Host IP Addr : <input value="<?php echo $account->host ?>" type="text"readonly><br>


Date Created : <?php echo date('d-M-Y', $account->created_on) ?><br>Date Expired : <?php echo date('d-M-Y', $account->expired_on) ?><br><br>
Account will expire on <?php echo date('d-M-Y', $account->expired_on) ?>.<br>
You allowed use this account up to two (2) multi-bitvise, else you will be automatically disconnected from the server

</div>
