<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Web Design Company in Anand, Surat, Website Development Company In Anand, Surat, Phoenix Binary System, SEO Company in Anand, Surat, Gujarat, India, Mobile App Development Company Anand, Surat, SEO Service Provider Company, Web designer company Surat and Anand, web Development Company in Surat, Gujarat, India.">
<meta name="description" content="Phoenix Binary System is a professional web design &amp; website development Company in Anand , Surat, Gujarat &amp; also Provide SEO, SMO Services, Android Development in Gujarat, India.">
<meta name="author" content="">

<link rel="shortcut icon" href="<?=asset_path()?>/images/resource/favicon.png" type="image/x-icon">

<title>Web Design and Website Development Company In  Anand, Surat, Gujarat | Phoenix Binary System</title>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131532088-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131532088-1');
</script>

<link href="<?=asset_path()?>css/font-awesome.css" rel="stylesheet">
<link href="<?=asset_path()?>css/bootstrap.css" rel="stylesheet">
<link href="<?=asset_path()?>css/style.css" rel="stylesheet">
<link href="<?=asset_path()?>css/color.css" rel="stylesheet">
<link href="<?=asset_path()?>css/owl.carousel.css" rel="stylesheet">
<link href="<?=asset_path()?>css/responsive.css" rel="stylesheet">

</head>

<body>

<?php

if($this->uri->segment(1)=='about')
{
	$about_active = 'active';
	$about_a_font = 'a_font';	
}
elseif($this->uri->segment(1)=='services')
{
	$services_active = 'active';
	$services_a_font = 'a_font';		
}
elseif($this->uri->segment(1)=='portfolio')
{
	$portfolio_active = 'active';
	$portfolio_a_font = 'a_font';		
}
elseif($this->uri->segment(1)=='career')
{
	$career_active = 'active';
	$career_a_font = 'a_font';		
}
elseif($this->uri->segment(1)=='contact')
{
	$contact_active = 'active';
	$contact_a_font = 'a_font';		
}
else
{
	$home_active = 'active';
	$home_a_font = 'a_font';		
}


?>

<div class="pagewrap">
    
<div class="container">
    <div class="main-nav-bar">
        <button type="button" class="navbar-toggle navbar-toggle-mb" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
            <span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </span>
        </button><!-- /navbar-toggle -->
        <button type="button" class="navbar-toggle navbar-toggle-dt open">
            <span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </span>
        </button><!-- /navbar-toggle -->
        <div class="logo logo_top_margin"><a style="padding: 0;" href="<?=base_url()?>"><img src="<?=asset_path()?>/images/resource/phoenix_logo.png"></a></div>
        <div class="tp-control">
            <ul class="control-list">
                <li><span><a href="https://www.facebook.com/phoenixbinarysystem/" target="_blank"><i class="fa fa-facebook"></i></a></span></li>
                <li><span><a href="https://www.instagram.com/phoenixbinarysystem/" target="_blank"><i class="fa fa-instagram"></i></a></span></li>
				<li><span><a href="https://twitter.com/phoenixbinary" target="_blank"><i class="fa fa-twitter"></i></a></span></li>
            </ul>
        </div><!-- /tp-control -->
        <nav id="navbar" class="collapse navbar-collapse open">
            <ul class="nav navbar-nav">
                <li class="<?=$home_active?>"><a href="<?=file_path()?>home" class="<?=$home_a_font?>">Home</a></li>
                <li class="<?=$about_active?>"><a href="<?=file_path()?>about" class="<?=$about_a_font?>">About</a></li>
                <li class="<?=$services_active?>"><a href="<?=file_path()?>services" class="<?=$services_a_font?>">Services</a></li>
                <li class="<?=$portfolio_active?>"><a href="<?=file_path()?>portfolio" class="<?=$portfolio_a_font?>">Portfolio</a></li>
                <li class="<?=$career_active?>"><a href="<?=file_path()?>career" class="<?=$career_a_font?>">Career</a></li>
                <li class="<?=$contact_active?>"><a href="<?=file_path()?>contact" class="<?=$contact_a_font?>">Contact</a></li>
            </ul>
        </nav><!--/.nav-collapse -->
    </div><!-- /main-nav-bar -->