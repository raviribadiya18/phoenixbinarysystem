<script src="<?=base_url('assets/')?>popover/jquery.webui-popover.min.js"></script>

<script src="<?=base_url('assets/')?>popover/app.js"></script>

<link rel="stylesheet" href="<?=base_url('assets/')?>popover/jquery.webui-popover.min.css">

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>popover/jquery.mCustomScrollbar.min.css">

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>popover/theme-styles.css">

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>popover/blocks.css">

<style>

	.notification-list .selectize-dropdown-content > *, .notification-list li {
    	padding: 13px 25px !important;
	}

	.webui-popover-content{
			max-height:350px !important;
	}

	.theme-txt1{
		  color: #47A247!important;
		  font-weight:bold;
	}

	.theme-txt2{
		color:#888da8 !important;
	}
	.unseen{
		background-color: gainsboro;
	}
  .navbar-header:before{
    height: 155px;
  }
</style>

<div id="container" class="effect aside-float aside-bright mainnav-lg print-content">
<header id="navbar">
  <div id="navbar-container" class="boxed">
    <div class="navbar-header">
      <!-- <a href="#" class="navbar-brand" style=" background-color: #FFF;"> <img src="<?=base_url('assets/')?>web/img/logos/kt-logo.png" alt="Logo" class="brand-icon" style="width:100%;"> </a>  -->
        <a href="#" class="navbar-brand" style="height: 155px;background-color: #FFF;">
          <img class="img-md" src="<?=base_url('assets/')?>web/img/logos/logo-symbol.png" alt="Profile Picture" style="width: 70px;height: 70px;margin-left: auto;margin-right: auto;margin-top: 20px;">
          <p class="mnp-name" style="margin-top: 15px;text-align: center;"><b>KT Consultancy</b></p>
        </a>
    </div>
    <div class="navbar-content">
      <ul class="nav navbar-top-links">
        <li class="tgl-menu-btn"> <a class="mainnav-toggle" href="#"> <i class="demo-pli-list-view"></i> </a> </li>
        <li>
          <div class="custom-search-form">
            <label class="btn btn-trans" for="search-input" data-toggle="collapse" data-target="#nav-searchbox"> <i class="demo-pli-magnifi-glass"></i> </label>
            <!--<form>-->
              <div class="search-container collapse" id="nav-searchbox">
                <input id="search-input" type="text" class="form-control" placeholder="Type for search...">
              </div>
            <!--</form>-->
          </div>
        </li>
      </ul>
      <ul class="nav navbar-top-links" >

		 <li class="dropdown">
				<a href="<?=file_path('admin')?>dashboard/get_gen_notification" data-toggle="dropdown" class="dropdown-toggle notifiction-popover">
					<i class="demo-pli-bell"></i>
					<span class="badge badge-header badge-danger" id="notification_counter"></span>
				</a>


				<!--Notification dropdown menu-->
				<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
					<div class="nano scrollable">
						<div class="nano-content">
							<ul class="head-list">



							</ul>
						</div>
					</div>

					<!--Dropdown footer-->
					<div class="pad-all bord-top">
						<a href="#" class="btn-link text-main box-block">
							<i class="pci-chevron chevron-right pull-right"></i>Show All Notifications
						</a>
					</div>
				</div>
         </li>

        <li id="dropdown-user" class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right"> <span class="ic-user pull-right"> <i class="demo-pli-male"></i> </span> </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
            <ul class="head-list">
              <li> <a href="<?=file_path('admin')?>dashboard/change_password"><i class="demo-pli-lock-2 icon-lg icon-fw"></i> Change Password</a> </li>
              <li> <a href="<?=file_path()?>login/logout"><i class="demo-pli-arrow-left icon-lg icon-fw"></i> Logout</a> </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</header>
<nav id="mainnav-container">
  <div id="mainnav">
    <div id="mainnav-menu-wrap">
      <div class="nano">
        <div class="nano-content">
          <div id="mainnav-profile" class="mainnav-profile">
            <div class="profile-wrap text-center">
              <div class="pad-btm">

                <!-- <img class="img-circle img-md" src="<?=base_url('assets/')?>web/img/logos/logo-symbol.png" alt="Profile Picture" style="width: 70px;height: 70px;"> -->
                <p class="mnp-name" style="margin-top: 35px;"></p>
              </div>
               </div>

          </div>
          <div id="mainnav-shortcut" class="hidden">
            <ul class="list-unstyled shortcut-wrap">
              <li class="col-xs-3" data-content="My Profile"> <a class="shortcut-grid" href="#">
                <div class="icon-wrap icon-wrap-sm icon-circle bg-mint"> <i class="demo-pli-male"></i> </div>
                </a> </li>
              <li class="col-xs-3" data-content="Messages"> <a class="shortcut-grid" href="#">
                <div class="icon-wrap icon-wrap-sm icon-circle bg-warning"> <i class="demo-pli-speech-bubble-3"></i> </div>
                </a> </li>
              <li class="col-xs-3" data-content="Activity"> <a class="shortcut-grid" href="#">
                <div class="icon-wrap icon-wrap-sm icon-circle bg-success"> <i class="demo-pli-thunder"></i> </div>
                </a> </li>
              <li class="col-xs-3" data-content="Lock Screen"> <a class="shortcut-grid" href="#">
                <div class="icon-wrap icon-wrap-sm icon-circle bg-purple"> <i class="demo-pli-lock-2"></i> </div>
                </a> </li>
            </ul>
          </div>
          <ul id="mainnav-menu" class="list-group">
            <li class="list-header">Navigation</li>
            <li> <a id="menu-dashboard" href="<?=file_path('admin')?>dashboard/view/"> <i class="demo-pli-home"></i> <span class="menu-title"> Dashboard </span> </a> </li>

           <!--  <li> <a href="#"> <i class="demo-pli-split-vertical-2"></i> <span class="menu-title">Website CMS</span> <i class="arrow"></i> </a>
              <ul class="collapse">

                <li><a id="menu-contain" href="<?=file_path('admin')?>contain/view/slider">Contain</a></li>
				<li><a id="menu-contact" href="<?=file_path('admin')?>contact_us/view/">Contact</a></li>
				<li><a id="menu-career" href="<?=file_path('admin')?>career/view/">Career</a></li>
              </ul>
            </li> -->

			<!--  <li> <a href="#"> <i class="demo-pli-file-html"></i> <span class="menu-title">Employee Mgmt</span> <i class="arrow"></i> </a>
              <ul class="collapse">

                <li><a id="menu-employee" href="<?=file_path('admin')?>employee/view/">Employee List</a></li>
				<li><a id="menu-task_mgmt" href="<?=file_path('admin')?>task_mgmt/view/">Task Mgmt</a></li>
				<li> <a id="menu-demployee" href="<?=file_path('admin')?>deleted_emp/view">Deleted Employee</a> </li>
              </ul>
            </li>
			  <li> <a href="#"> <i class="demo-pli-file-html"></i> <span class="menu-title">Account Mgmt</span> <i class="arrow"></i> </a>
              <ul class="collapse">

                <li><a id="menu-account" href="<?=file_path('admin')?>account_master/view/">Account List</a></li>
				  <li> <a id="menu-daccount" href="<?=file_path('admin')?>deleted_acc/view">Deleted Accountant</a> </li>

              </ul>
            </li> -->
			 <!-- <li> <a href="#"> <i class="demo-pli-gear"></i> <span class="menu-title">Client Mgmt</span> <i class="arrow"></i> </a> -->
              <!-- <ul class="collapse"> -->
              	<li><a id="menu-client" href="<?=file_path('admin')?>client/view"><i class="demo-pli-gear"></i>Client List</a></li>
				<li><a id="menu-service" href="<?=file_path('admin')?>service/view"><i class="demo-pli-split-vertical-2"></i>Service Master</a></li>
				<!-- <li><a id="menu-service_request" href="<?=file_path('admin')?>service_request/view">Service Request</a></li> -->
				<li> <a id="menu-itr" href="<?=file_path('admin')?>itr_master/view"><i class="fa fa-address-card-o"></i>ITR Document</a> </li>
				<li> <a id="menu-gst" href="<?=file_path('admin')?>gst_master/view"><i class="fa fa-folder-o"></i>GST Document</a> </li>
				<li> <a id="menu-gst" href="<?=file_path('admin')?>roc_master/view"><i class="fa fa-file-pdf-o"></i>ROC Document</a> </li>
				<li> <a id="menu-od" href="<?=file_path('admin')?>other_document/view"><i class="fa fa-id-card"></i>IMP Document</a> </li>
				<!-- <li> <a id="menu-document_master" href="<?=file_path('admin')?>document_master/view"><i class="fa fa-file-text-o"></i>Received Document</a> </li> -->
           		<li> <a id="menu-notification" href="<?=file_path('admin')?>notification/view"><i class="fa fa-envelope-o"></i>Notification</a> </li>
           		<li> <a id="menu-sms" href="<?=file_path('admin')?>SMS/view"><i class="fa fa-envelope-o"></i>SMS Panel</a> </li>
				<li> <a id="menu-support" href="<?=file_path('admin')?>support/view"><i class="fa fa-question-circle"></i>Support</a> </li>
				<li> <a id="menu-dclient" href="<?=file_path('admin')?>deleted_client/view"><i class="fa fa-trash-o" aria-hidden="true"></i>Deleted Client</a> </li>
              <!-- </ul> -->
            </li>

          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<div class="boxed">
<div id="content-container">
<div id="page-head">
  <div id="page-title">
    <h1 class="page-header text-overflow">
      <?=$page_title?>
    </h1>
  </div>
  <ol class="breadcrumb">
    <li><a href="#"><i class="demo-pli-home"></i></a></li>
    <li><a href="#">Home</a></li>
    <li class="active">
      <?=$page_title?>
    </li>
  </ol>
</div>
<div id="page-content">
<?php $top_msg = $this->session->flashdata('show_msg');?>
<?php if (is_array($top_msg)) {?>
<div class="row">
  <?php if ($top_msg['class'] == 'false') {?>
  <div class="alert alert-danger">
    <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
    <strong>Error</strong>
    <?=$top_msg['msg']?>
  </div>
  <?php } else {?>
  <div class="alert alert-success">
    <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
    <strong>
    <?=$top_msg['msg']?>
    </strong> </div>
  <?php }?>
</div>
<?php }?>
<script>

		$(document).ready(function(e) {
            //

			$('#<?=$menu_id?>').parent('li').addClass('active-link');

			$('#<?=$menu_id?>').parent('li').parent('ul').addClass('in');

			$('#<?=$menu_id?>').parent('li').parent('ul').parent('li').addClass('active');

			$('#<?=$menu_id?>').parent('li').parent('ul').parent('li').addClass('active-sub');
        });

   </script>
 <script type="text/javascript" src="<?=base_url('assets/')?>pnotify/pnotify.js"></script>
 <link type="text/css" rel="stylesheet" href="<?=base_url('assets/')?>pnotify/pnotify.css" />
 <link type="text/css" rel="stylesheet" href="<?=base_url('assets/')?>pnotify/pnotify.brighttheme.css" />



<script>



	var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};


	$(document).ready(function(e) {

		get_notifaction();

		get_tot_count_noti();

        setInterval(function(){

    		get_notifaction();

			get_tot_count_noti();

		}, 5000);

    });



	function get_notifaction(){

		var url='<?=file_path('admin')?>dashboard/ajaxGetAllSummery';

		$.ajax({

			url:url,

			dataType : "json",

			success:function(obj){

				$.each( obj, function( key, value ) {

					$('.'+key).html(value)

				});

				var quick = obj['quick'];

				$.each( quick, function( key, value ) {

					quickNotifaction(value);

				});

			}
		});
	}





		function quickNotifaction(text_msg) {

			var opts = {

				title: "",

				text: text_msg,

				addclass: "stack-bottomright",

				stack: stack_bottomright

			};

			opts.type = "success";

			new PNotify(opts);

		}

	function get_tot_count_noti(){

		var url='<?=file_path('admin')?>dashboard/get_tot_unseen_noti';

		$.ajax({

			url:url,

			dataType : "json",

			success:function(obj){
				//alert(obj);
				$("#notification_counter").html(obj);
			}
		});
	}

</script>
