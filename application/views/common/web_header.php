<?php
if ($this->uri->rsegment(1) == "home") {

	$home = "active";

} else if ($this->uri->rsegment(1) == "about") {
	$about = "active";
} else if ($this->uri->rsegment(1) == "portfolio") {
	$portfolio = "active";
} else if ($this->uri->rsegment(1) == "career") {
	$career = "active";
} else if ($this->uri->rsegment(1) == "inquery") {
  $inquery = "active";
} else if ($this->uri->rsegment(1) == "training_program") {
	$career = "active";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KHNSJRP');</script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131532088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-131532088-1');
    </script>
    <meta charset="utf-8">
    <?php if($this->uri->segment(1)=="home"){?>
    <title> SEO, Web Design & Development Company in Anand & Surat</title>
   <?php  }elseif($this->uri->segment(1)=="about"){?>
    <title>SEO Service Provider Company: Phoenix Binary System | Surat & Anand</title>
   <?php }elseif($this->uri->segment(1)=="contact"){?>
    <title>Custom Software Development Company Anand | Contact Us-Surat</title>
   <?php }elseif($this->uri->segment(1)=="services"){?>
    <title>Web Design & Development Company in Anand & Surat | Phoenix Binary System</title>
    <?php }elseif($this->uri->segment(1)=="portfolio"){?>
      <title> Web & Mobile App Design Portfolio by Phoenix Binary System</title>
    <?php }elseif($this->uri->segment(1)=="career"){?>
      <title>Career at Phoenix Binary System in Anand & Surat, Gujarat.</title>
    <?php }elseif($this->uri->segment(1)=="seo"){?>
      <title>SEO Company in Surat | SEO Company in Anand , Gujarat</title>
    <?php }elseif($this->uri->segment(1)=="training_program"){?>
    <title>Web Development Company in Surat: Training Program at Phoenix Binary System</title>
    <?php }else{?>
      <title>Phoenix Binary System Pvt Ltd | Anand Gujarat India</title>
    <?php }?>

    <!-- <title>Phoenix Binary System Pvt Ltd | Anand Gujarat India</title> -->
    <?php if($this->uri->segment(1)=="home"){?>
      <meta name="description" content="We are a website design and development company in Anand and Surat. We also provide SEO Service & Mobile App Development. You get a User-friendly & Responsive website.">
    <?php  }elseif($this->uri->segment(1)=="about"){?>
      <meta name="description" content="We are a professional web development company & specialize in SEO for organic traffic to rank over SE with a dedication to meet the business requirements of our clients worldwide.">
    <?php  }elseif($this->uri->segment(1)=="contact"){?>
      <meta name="description" content="If you have any queries regarding SEO Services, Web Design & Development, Mobile Application & Custom Software Development then contact us  OR Visit Office in Surat & Anand.">
    <?php  }elseif($this->uri->segment(1)=="services"){?>
      <meta name="description" content="Phoenix Binary System is a professional Website Design & Development Company in Anand & Surat, Gujarat. Mobile App, SEO company in Anand, Web Design Company in Surat.">
    <?php  }elseif($this->uri->segment(1)=="portfolio"){?>
      <meta name="description" content="Check it out Website & Application Design made by Web designer to engage visitors with an audience in the center. Phoenix Binary System Pvt ltd Surat - Anand.">
      <?php  }elseif($this->uri->segment(1)=="seo"){?>
      <meta name="description" content="Are you Looking for SEO Services Company for Organic Traffic by implementing On-Page, Off-Page, Link Building activities. Phoenix Binary System is here for you.">
      <?php  }elseif($this->uri->segment(1)=="career"){?>
      <meta name="description" content="Phoenix Binary System is a Leading IT company. Web Development Company in Surat, SEO Company in Anand, Web Design Company in Surat, Mobile Application Development">
      <?php  }elseif($this->uri->segment(1)=="training_program"){?>
      <meta name="description" content="Get a Training of Website Development, WebDesign & SEO at Our Company. SEO Company in Anand,  Web designer company Surat, Mobile App Development Company Surat.">
    <?php }else{?>
    <meta name="description" content="Phoenix Binary System Pvt Ltd">
    <?php }?>

    <?php if($this->uri->segment(1)=="seo"){?>
    <meta name="keywords" content="SEO Company in Anand, SEO service provider company in Anand, best website design and developer company anand, SEO Company in Surat, Web Development Company anand, Mobile Application Development & SEO services in Anand">
    <?php }else{?>
      <meta name="keywords" content="Web Design Company in Anand, SEO Company in Anand, Mobile App Development Company Anand, SEO service provider company in Anand, best website design and developer company anand, Custom Software Development Company Anand,   SEO Company in Surat, Mobile App Development Company Surat,  Web designer company Surat, web Development Company in Surat, Web Design Company in Surat,  Website Development Company In Anand, Phoenix Binary System, Web designer company Anand, Web Development Company anand, Mobile Application Development & SEO services in Anand">
    <?php }?>
    
    <meta name="author" content="Phoenix Binary System Pvt Ltd">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=asset_path()?>favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=asset_path()?>favicon.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" color="#343b43" href="safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" media="screen" href="<?=asset_path()?>css/vendor.min.css">

    <link rel="stylesheet" media="screen" href="<?=asset_path()?>css/theme.min.css">

    <script src="<?=asset_path()?>js/modernizr.min.js"></script>
  </head>

  <body>
    <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KHNSJRP"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <div class="offcanvas-container is-triggered offcanvas-container-reverse" id="mobile-menu"><span class="offcanvas-close"><i class="fe-icon-x"></i></span>
      <div class="px-4 pb-1">
        <h6>Menu</h6>
        <div class="d-flex justify-content-between">

        </div>
      </div>
      <div class="offcanvas-scrollable-area border-top" style="height:calc(100% - 235px); top: 144px;">

        <div class="accordion mobile-menu" id="accordion-menu">

          <div class="card">
            <div class="card-header"><a class="mobile-menu-link <?=$home?>" href="<?=base_url()?>index.php/home">Home</a></div>

          </div>
          <div class="card">
            <div class="card-header"><a class="mobile-menu-link <?=$about?>" href="<?=base_url()?>index.php/about">About Us</a></div>

          </div>

          <div class="card">
            <div class="card-header"><a class="mobile-menu-link" href="<?=base_url()?>index.php/services">Services</a><a class="collapsed" href="#services-submenu" data-toggle="collapse"></a></div>
            <div class="collapse" id="services-submenu" data-parent="#accordion-menu">
              <div class="card-body">
                <ul>
                  <li class="dropdown-header"><i class="fe-icon-briefcase"></i>&nbsp;&nbsp;OUR CORE SERVICES</li>
                  <li class="dropdown-item"><a href="#">Product Development</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services/website_development">Website Development</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services/mobile_app_development">Mobile App Development</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services/seo">Search Engine Optimization</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services/cryptocurrency_development">Cryptocurrency Development</a></li>
                  <li class="dropdown-header"><i class="fe-icon-shopping-bag"></i>&nbsp;&nbsp;GRAPHIC DESIGN SERVICES</li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services">Branding</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services">Brochure Design</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services">Business Card</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services">Enevelop</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services">Letterheads</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services">Logo Design</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services">Packing Design</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services">Print Design</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services">UI / UX Design</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/services">Stationary Design</a></li>

                </ul>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header"><a class="mobile-menu-link" href="#">Our Products</a><a class="collapsed" href="#product-submenu" data-toggle="collapse"></a></div>
            <div class="collapse" id="product-submenu" data-parent="#accordion-menu">
              <div class="card-body">
                <ul>
                  <li class="dropdown-item"><a target="_blank" href="<?=asset_path()?>brochure/Mobility-Service-Provider-System.pdf">Mobility Services</a></li>
                  <li class="dropdown-item"><a target="_blank" href="<?=asset_path()?>brochure/Chartered-Accountant-CRM-System.pdf">CA Products</a></li>
                  <li class="dropdown-item"><a target="_blank" href="<?=asset_path()?>brochure/School-Management-System.pdf">School Management System</a></li>
                  <li class="dropdown-item"><a target="_blank" href="<?=asset_path()?>brochure/Social-Media-Management.pdf">Social Media Management</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header"><a class="mobile-menu-link <?=$portfolio?>" href="<?=base_url()?>index.php/portfolio">Portfolio</a></div>

          </div>

          <div class="card">
            <div class="card-header"><a class="mobile-menu-link <?=$career?>" href="#">Career</a><a class="collapsed" href="#career-submenu" data-toggle="collapse"></a></div>
            <div class="collapse" id="career-submenu" data-parent="#accordion-menu">
              <div class="card-body">
                <ul>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/career">Job Seeker</a></li>
                  <li class="dropdown-item"><a href="<?=base_url()?>index.php/training_program">Training Program</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header"><a class="mobile-menu-link" href="<?=asset_path()?>brochure/Phoenix-Binary-System-Pvt-Ltd-Profile.pdf" target="_blank">Our brochure</a></div>
          </div>
          <div class="card">
            <div class="card-header"><a class="mobile-menu-link" href="<?=base_url()?>index.php/inquiry">Inquiry</a></div>
          </div>
          <div class="card">
            <div class="card-header"><a class="mobile-menu-link" href="<?=base_url()?>index.php/contact">Contact</a></div>
          </div>
        </div>
      </div>
      <div class="offcanvas-footer px-4 pt-3 pb-2 text-center"><a class="social-btn sb-style-3 sb-twitter" href="https://twitter.com/phoenixbinary" target="_blank"><i class="socicon-twitter"></i></a><a class="social-btn sb-style-3 sb-facebook" target="_blank" href="https://www.facebook.com/phoenixbinarysystem/"><i class="socicon-facebook"></i></a><a class="social-btn sb-style-3 sb-instagram" target="_blank" href="https://www.instagram.com/phoenixbinarysystem/"><i class="socicon-instagram"></i></a><a class="social-btn sb-style-3 sb-linkedin" target="_blank" href="https://in.linkedin.com/company/phoenix-binary-system-pvt-ltd"><i class="socicon-linkedin"></i></a></div>
    </div>

    <header class="navbar-wrapper navbar-sticky">
      <div class="d-table-cell align-middle pr-md-3"><a style="width: 170px !important;" class="navbar-brand mr-1" href="<?=base_url()?>index.php/home"><img src="<?=asset_path()?>img/logo/phoenix_logo.png" alt="Phoenix Binary System LOGO"/></a></div>
      <div class="d-table-cell w-100 align-middle pl-md-3">
        <div class="navbar-top d-none d-lg-flex justify-content-between align-items-center">
          <div><a class="navbar-link mr-3" href="tel:+918866220223"><i class="fe-icon-phone"></i>+91 88662 20223</a><a class="navbar-link mr-3" href="mailto:phoenix8155@gmail.com"><i class="fe-icon-mail"></i>phoenix8155@gmail.com</a><a target="_blank" class="social-btn sb-style-3 sb-twitter" href="https://twitter.com/phoenixbinary"><i class="socicon-twitter"></i></a><a target="_blank" class="social-btn sb-style-3 sb-facebook" href="https://www.facebook.com/phoenixbinarysystem/"><i class="socicon-facebook"></i></a><a target="_blank" class="social-btn sb-style-3 sb-linkedin" href="https://in.linkedin.com/company/phoenix-binary-system-pvt-ltd"><i class="socicon-linkedin"></i></a><a target="_blank" class="social-btn sb-style-3 sb-instagram" href="https://www.instagram.com/phoenixbinarysystem/"><i class="socicon-instagram"></i></a></div>
          <div>

          </div>
        </div>
        <div class="navbar justify-content-end justify-content-lg-between">

          <ul class="navbar-nav d-none d-lg-block">

            <li class="nav-item <?=$home?>"><a class="nav-link" href="<?=base_url()?>index.php/home">Home</a></li>
            <li class="nav-item <?=$about?>"><a class="nav-link" href="<?=base_url()?>index.php/about">About Us</a></li>

            <li class="nav-item mega-dropdown-toggle"><a class="nav-link" href="<?=base_url()?>index.php/services">Services</a>
              <div class="dropdown-menu mega-dropdown">
                <div class="d-flex">
                  <div class="column">
                    <div class="widget widget-custom-menu">
                      <ul>
                        <li class="dropdown-header font-weight-medium text-info border-info text-uppercase pl-0"><i class="fe-icon-briefcase"></i>&nbsp;&nbsp;Our Core Services</li>
                        <li><a href="#">Product Development</a></li>
                         <li><a href="<?=base_url()?>index.php/services/website_development">Website Development</a></li>
                        <li><a href="<?=base_url()?>index.php/services/mobile_app_development">Mobile App Development</a></li>
                        <li><a href="<?=base_url()?>index.php/services/cryptocurrency_development">Cryptocurrency Development</a></li>
                        <li><a href="<?=base_url()?>index.php/services/seo">Search Engine Optimization</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="column">
                    <div class="widget widget-custom-menu">
                      <ul>
                        <li class="dropdown-header font-weight-medium text-info border-info text-uppercase pl-0"><i class="fe-icon-home"></i>&nbsp;&nbsp;Graphic Design Services</li>
                        <li><a href="<?=base_url()?>index.php/services">Branding</a></li>
                        <li><a href="<?=base_url()?>index.php/services">Brochure Design</a></li>
                        <li><a href="<?=base_url()?>index.php/services">Business Card</a></li>
                        <li><a href="<?=base_url()?>index.php/services">Enevelop</a></li>
                        <li><a href="<?=base_url()?>index.php/services">Letterheads</a></li>
                        <li><a href="<?=base_url()?>index.php/services">Logo Design</a></li>
                        <li><a href="<?=base_url()?>index.php/services">Packing Design</a></li>
                        <li><a href="<?=base_url()?>index.php/services">Print Design</a></li>
                        <li><a href="<?=base_url()?>index.php/services">UI / UX Design</a></li>
                        <li><a href="<?=base_url()?>index.php/services">Stationary Design</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="nav-item dropdown-toggle"><a class="nav-link" href="#">Our Products</a>
              <ul class="dropdown-menu">
                <?php /*<?=base_url()?>index.php/mobility_services  <?=base_url()?>index.php/schooling_services <?=base_url()?>index.php/schooling_services*/?>
                <li class="dropdown-item"><a target="_blank" href="<?=asset_path()?>brochure/Mobility-Service-Provider-System.pdf">Mobility Service Provider System</a></li>
                <li class="dropdown-item"><a target="_blank" href="<?=asset_path()?>brochure/Chartered-Accountant-CRM-System.pdf">CA Products</a></li>
                <li class="dropdown-item"><a target="_blank" href="<?=asset_path()?>brochure/School-Management-System.pdf">School Management System</a></li>
                <li class="dropdown-item"><a target="_blank" href="<?=asset_path()?>brochure/Social-Media-Management.pdf">Social Media Management</a></li>

              </ul>
            </li>
            <li class="nav-item <?=$portfolio?>"><a class="nav-link" href="<?=base_url()?>index.php/portfolio">Portfolio</a></li>

            <li class="nav-item dropdown-toggle <?=$career?>"><a class="nav-link" href="#">Career</a>
              <ul class="dropdown-menu">
                <li class="dropdown-item"><a href="<?=base_url()?>index.php/career">Job Seeker</a></li>
                <li class="dropdown-item"><a href="<?=base_url()?>index.php/training_program">Training Program</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" target="_blank" href="<?=asset_path()?>brochure/Phoenix-Binary-System-Pvt-Ltd-Profile.pdf">Our brochure</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=base_url()?>index.php/inquiry">Inquiry</a></li>
          </ul>
          <div>
              <ul class="navbar-buttons d-inline-block align-middle">
                <li class="d-block d-lg-none"><a href="#mobile-menu" data-toggle="offcanvas"><i class="fe-icon-menu"></i></a></li>
              </ul><a class="btn btn-gradient ml-3 d-none d-xl-inline-block" href="<?=base_url()?>index.php/contact">Contact</a>
            </div>

        </div>
      </div>
    </header>