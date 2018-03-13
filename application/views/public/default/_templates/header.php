<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>Fast Premium SSH Account | <?php echo ucwords($_SERVER['HTTP_HOST']) ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link href="<?php echo base_url('assets/default/flatly/bootstrap.css');?>" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url('assets/default/_vendor/font-awesome/css/font-awesome.min.css');?>" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url('assets/default/_assets/css/custom.min.css');?>" type="text/css" rel="stylesheet">
	<script src="<?php echo base_url('assets/default/_vendor/jquery/dist/jquery.min.js');?>"></script>	
	<link rel="alternate" href="<?php echo ($_SERVER['HTTP_HOST']) ?>" hreflang="en-US">
    <meta content="#" property="og:url">
    <meta content="Fast Premium SSH Account" property="og:site_name">
    <meta content="Server SSH Account" property="og:title">
    <meta content="website" property="og:type">
    <meta property="fb:app_id" content="#">
    <meta property="fb:admins" content="#">
    <meta name="description" content="Fast Premium SSH Account Server Singapore, US, Japan, Netherlands, France, Indonesia, Vietnam, Germany,  Russia, Canada etc with Unlimited Data and High Speed Connection">
    <meta name="keywords" content="Secure Shell, Fast SSH Premium, Fast Proxy Premium, VPN Premium, Fast Connection, High Bandwidth, Dropbear, Tunneling, Shell Account, Dropbear, OpenSSH">
    <meta name="author" content="<?php echo ($_SERVER['HTTP_HOST']) ?>">
    <meta name="rating" content="general">
    <meta name="distribution" content="global">
    <meta name="copyright" content="<?php echo ucwords($domain) ?>">
  
</head>
<body id="home">
    <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary navbar-transparent">
      <div class="container">
          <a href="<?php echo site_url() ?>" class="navbar-brand"><?php echo ucwords($domain) ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Service <span class="caret"></span></a>
              <div class="dropdown-menu" aria-labelledby="themes">
                <a class="dropdown-item" href="./default/">Default</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Vpn</a>
                <a class="dropdown-item" href="#">Openssh</a>
                <a class="dropdown-item" href="#">Dropbear</a>
                <a class="dropdown-item" href="#">Openvpn</a>
                <a class="dropdown-item" href="#">Softether vpn</a>
                <a class="dropdown-item" href="#">Squiid</a>
                <a class="dropdown-item" href="#">Openssl</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Help</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>
          </ul>

          <ul class="nav navbar-nav ml-auto">
			<?php if ($login) { ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('panel') ?>" target="_blank"><?php echo $user->email ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('logout.html') ?>" target="_blank">Logout</a>
				</li>
            <?php } else { ?>
            
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('login.html') ?>" target="_blank">Account 30 days</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('assets/default/about.html') ?>" target="_blank">About</a>
				</li>
			<?php } ?>
          </ul>

        </div>
      </div>
    </div>
	<div class="splash">
      <div class="container">

        <div class="row">
          <div class="col-lg-12">
			  
            <div class="pull-right">
				<p><small>IP : <?php echo $ipAddr ?><br>Server Time:  <span class="text-danger"><?php echo date('H:i:s d/m/Y') ?></span><br>Account Reset at <span class="text-danger">00:00:01</span></small></p>

			</div>
					
            
          </div>
        </div>

      </div>
    </div>
