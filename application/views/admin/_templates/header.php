<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>WEBSSH V1.0</title>

  <meta name="description" content="">
  <meta name="author" content="">
  <!--
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
  -->
  <link rel="stylesheet" href="<?php echo base_url('assets/panel/bootstrap/css/bootstrap.min.css') ?>"/> 
  <link rel="stylesheet" href="<?php echo base_url('assets/panel/font-awesome/css/font-awesome.min.css'); ?>"/>
  <!--
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,300" rel="stylesheet" type="text/css">
  -->
  <link rel="stylesheet" href="<?php echo base_url('assets/panel/custom/css/style.css') ?>"/>
    
</head>
<body>
	
    
    <div class="loading-container">
      <div class="loading">
        <div class="l1">
          <div>
          </div>
        </div>
        <div class="l2">
          <div></div>
        </div>
        <div class="l3">
          <div></div>
        </div>
        <div class="l4">
          <div></div>
        </div>
      </div>
    </div>
    
    	
    <aside class="left-panel">
    		
            <div class="user text-center">

                  <a href="<?php echo site_url('admin/setting/foto.html') ?>"><img src="<?php echo base_url('uploads/profiles/'.$user->image) ?>" class="img-circle" alt="..."></a>
                  <h4 class="user-name">Administrator</h4>
                  <hr/>
                 	 
            </div>
            
            
            
            <nav class="navigation">
            	<ul class="list-unstyled">
					<li class="has-submenu"><a href="<?php echo site_url();?>"><i class="glyphicon glyphicon-globe"></i> <span class="nav-label">GO</span></a></li>
					
                	<li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-bookmark-o"></i><span class="nav-label">Dashboard</span></a></li>
                	<li class="has-submenu"><a href="<?php echo site_url('admin/servers.html'); ?>"><i class="fa fa-server"></i> <span class="nav-label">Servers</span></a></li>
                	<li class="has-submenu"><a href="<?php echo site_url('admin/products.html'); ?>"><i class="fa fa-rocket"></i> <span class="nav-label">List Saldo</span></a></li>
                    <li class="has-submenu"><a href="<?php echo site_url('admin/invoice.html'); ?>"><i class="glyphicon glyphicon-shopping-cart"></i> <span class="nav-label">Invoice <?php if($jumlah_invoice > 0 ) { ?><span class="badge"> <?php echo $jumlah_invoice; ?> <?php } ?></span></span></a></li>
                    <li class="has-submenu"><a href="<?php echo site_url('admin/users/users.html'); ?>"><i class="glyphicon glyphicon-user"></i> <span class="nav-label">Selers List</span></a></li>
                    <li class="has-submenu"><a href="<?php echo site_url('admin/settings.html');?>"><i class="glyphicon glyphicon-lock"></i> <span class="nav-label">Setelan Akun</span></a>
					 <li class="has-submenu"><a href="<?php echo site_url('admin/webssh.html');?>"><i class="glyphicon glyphicon-wrench"></i> <span class="nav-label">WEB SSH</span></a>	
                    </li>
                    <li class="has-submenu"><a href="<?php echo site_url('logout.html');?>"><i class="fa fa-sign-out"></i> <span class="nav-label">logout</span></a>
							
                    </li>
                    
                </ul>
            </nav>
            
    </aside>
	
    <section class="content">
    	
        <header class="top-head container-fluid">
            <button type="button" class="navbar-toggle pull-left">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            
            
           
        </header>
        <!-- Header Ends -->

        
