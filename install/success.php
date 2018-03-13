<?php

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>WEBSSH INSTALLER</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}
h4 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 15px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}
h6 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 12px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}
code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
	<div id="container">
		<h1>Selamat!!</h1>
		
		<h4>WEBSSH BERHASIl DIINSTALL.</h4>
		<?php
		$redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $redir .= "://".$_SERVER['HTTP_HOST'];
        $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
        $redir = str_replace('install/','',$redir);
      
        ?>
	    <h6> LOGIN PANEL	<a href="<?php echo $redir.'login.html';?>"><?php echo $redir.'login.html';?></a>
		</h6>
		<h6>
		    Jangan lupa untuk menghapus folder <?php echo $redir.'install'; ?> dan mengganti akun default administrator
		    <br>
		    <h6>
		        
		        administrator login default
		        <br>
		        Email : webssh@webssh.xyz
		        <br>
		        Passwd : webssh123
		        <br>
		        
		       
		    </h6>
		    
		</h6>
		<br>
		<h6>
		    <center>
		        Copyright &copy; Webssh 2017
		    </center>
		</h6>
	</div>
</body>
</html>