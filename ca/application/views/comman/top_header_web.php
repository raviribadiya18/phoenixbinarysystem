<?php 
	
	if($this->uri->rsegment(1)=="home"){
			
			 $home="active-link";
	}

	if($this->uri->rsegment(1)=="about"){
			
			 $about="active-link";
	}

	if($this->uri->rsegment(1)=="services"){
			
			 $services="active-link";
	}

	if($this->uri->rsegment(1)=="contact"){
			
			 $contact="active-link";
	}

	if($this->uri->rsegment(1)=="career"){
			
			 $career="active-link";
	}

?>

<!DOCTYPE html>
<html lang="eng">
<head>
	<title>KT & CO. - Chartered Accountant Surat, Chartered Accountants Firm Gujarat.</title>
    
    <meta name="Description" content="The best prominet Chartered Accountants In Surat Gujarat & Chartered Accountants Firm Gujarat. We are Provid offer and services like that Chartered Accountant India, company formation in India, Business taxation, corporate compliance, starting business in India, registration of foreign companies, transfer pricing, tax due diligence, taxation of expatriates and etc.">
	
  	<meta name="Keywords" content="Chartered Accountant Surat, Chartered Accountants Firm Gujarat, Company Formation in India, Starting Business in India Chartered Accountants Firm Gujarat, Chartered Accountants Firm India. ">
   
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="<?=asset_path('web/')?>img/logos/fav-icon.png" />	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Bootstrap CSS-->
	<link rel="stylesheet" type="text/css" href="<?=asset_path('web/')?>css/bootstrap.min.css">
	
	<!-- Font-Awesome -->
	<link rel="stylesheet" type="text/css" href="<?=asset_path('web/')?>css/font-awesome.css">  

	<!-- Icomoon -->
	<link rel="stylesheet" type="text/css" href="<?=asset_path('web/')?>css/icomoon.css"> 

	<!-- Pogo Slider -->
	<link rel="stylesheet" href="<?=asset_path('web/')?>css/pogo-slider.min.css">
	<link rel="stylesheet" href="<?=asset_path('web/')?>css/slider.css">	
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?=asset_path('web/')?>css/animate.css">	

	<!-- Owl Carousel  -->
    <link rel="stylesheet" href="<?=asset_path('web/')?>css/owl.carousel.css">
	
	<!-- Main Styles -->
	<link rel="stylesheet" type="text/css" href="<?=asset_path('web/')?>css/default.css">
	<link rel="stylesheet" type="text/css" href="<?=asset_path('web/')?>css/styles.css">

	<!-- Fonts Google -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&amp;subset=latin-ext,vietnamese" rel="stylesheet">

</head>
<body>




<!-- Preloader Start-->
<div id="preloader">
	<div class="row loader">
		<div class="loader-icon"></div>
	</div>
</div>
<!-- Preloader End -->



<!-- Top-Bar START -->
<div id="top-bar" class="hidden-xs">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-xs-12">
				<ul class="top-bar-info">				 
					<!--<li><i class="fa fa-clock-o"></i>Time: Monday-Saturday : 9:00am-6:00pm</li>-->
					<li><i class="fa fa-phone"></i> Phone:  +91 96623 34487</li>
					<li><i class="fa fa-envelope-o"></i>Email:  capbmandco@gmail.com</li>
				</ul>					
			</div>
			<div class="col-md-2 col-sm-2 col-xs-12 right-holder hidden-sm">
				<a href="<?=file_path()?>emp" class="top-appoinment">Employee Login</a>							
			</div>
			<div class="col-md-2 col-sm-2 col-xs-12 right-holder hidden-sm">
				<a href="<?=file_path()?>client" class="top-appoinment">Client Login</a>							
			</div>
			<div class="col-md-2 col-sm-1 col-xs-12 right-holder hidden-sm">
				<a href="https://play.google.com/store/apps/details?id=com.phoenix.caapp" target="_blank"><img style="margin-top: 5px;" src="<?=asset_path('web/')?>img/google-app.png" alt="logo"></a>							
			</div>
		</div>
	</div>
</div>	
<!-- Top-Bar END -->



<!-- Navbar START -->
<header>
	<nav class="navbar navbar-default navbar-custom" data-spy="affix" data-offset-top="50">
	  <div class="container">
	  	<div class="row">
		    <div class="navbar-header navbar-header-custom">
		      <button type="button" class="navbar-toggle collapsed menu-icon" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-logo" href="<?=file_path()?>home"><img src="<?=asset_path('web/')?>img/logos/pbm-logo.png" alt="logo"></a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right navbar-links-custom">
		        <li class="<?=$home?>"><a href="<?=file_path()?>home">Home</a></li>
		        <li class="<?=$about?>"><a href="<?=file_path()?>about">About Us</a></li>
				<li class="<?=$services?>"><a href="<?=file_path()?>services">Services</a></li>  
		        <?php /*?><li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
		          <ul class="dropdown-menu dropdown-menu-left">
		            <li><a href="">Statutory Audit & Assurance</a></li>
		            <li><a href="">Corporate Advisory</a></li>
		            <li><a href="">Mergers & Acquisitions </a></li>
		            <li><a href="">International Tax</a></li>
		            <li><a href="">Corporate Tax</a></li>
		            <li><a href="">Management Audit</a></li>
		            
		          </ul>
		        </li><?php */?>	
		        <li class="<?=$contact?>"><a href="<?=file_path()?>contact">Contact</a></li>
				<li class="<?=$career?>"><a href="<?=file_path()?>career">Career</a></li>
				<li class="hidden-md hidden-lg"><a href="https://play.google.com/store/apps/details?id=com.phoenix.caapp" target="_blank">Dowload App</a></li>  
		      </ul>
		    </div>	
	  	</div>
	  </div>
	</nav>	
</header>
<!-- Navbar END -->
<style type="text/css">
    
	
	}
</style>
