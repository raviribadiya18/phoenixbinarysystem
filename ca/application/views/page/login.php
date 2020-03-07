<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Login page | KT Consultancy</title>
 <link rel="icon" href="<?=base_url('assets')?>/images/fav-icon.png" sizes="16x16">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
<link href="<?=base_url('assets/')?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url('assets/')?>css/nifty.min.css" rel="stylesheet">
<link href="<?=base_url('assets/')?>css/demo/nifty-demo-icons.min.css" rel="stylesheet">
<link href="<?=base_url('assets/')?>plugins/pace/pace.min.css" rel="stylesheet">
<script src="<?=base_url('assets/')?>plugins/pace/pace.min.js"></script>
<link href="<?=base_url('assets/')?>css/demo/nifty-demo.min.css" rel="stylesheet">
</head>

<body>
<div id="container" class="cls-container">
  <div id="bg-overlay" class="bg-img" style="background-image: url(&quot;<?=base_url('assets/')?>images/bg-img-3.jpg&quot;);"></div>
  <div class="row" style="height: 100px;">
    </div>
  <div class="cls-content" style="padding-top:10px;">
    <div class="cls-content-sm panel">
      <div class="panel-body">
        <div class="mar-ver pad-btm">
        	<img src="<?=base_url('assets/web/img/logos/kt-logo.png')?>" style="width:71%;">
        </div>
        <p class="msg"></p>
        <form method="post" action="<?=file_path()?><?=$this->uri->rsegment(1)?>/check">
        	<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">

          <div class="form-group">
           	<label style="float: left;">Enter Username</label>
            <input type="text" name="username" id="username" required class="form-control" placeholder="Username" autofocus>

          </div>
          <div class="form-group">
            <label style="float: left;">Enter Password</label>
            <input type="password" name="password" id="password" required class="form-control" placeholder="Password">
          </div>
          <button class="btn btn-primary btn-lg btn-block tts" type="submit">Sign In</button>
          <div class="col-12" style="margin-top: 10px;">
            <a class="btn_forget" style="color: #000;margin-top: 10px;cursor: pointer;">Reset Password ?</a>
          </div>
		      <?php if ($show_msg != '') {?>
        	  <p><span class="title-red"><?=$show_msg?></span></p>
          <?php }?>


        </form>
      </div>


    </div>
  </div>
  <!--=-->

  <!-- DEMO PURPOSE ONLY -->
  <!--=-->


 </div>


</div>
<script src="<?=base_url('assets/')?>js/jquery.min.js"></script>
<script src="<?=base_url('assets/')?>js/bootstrap.min.js"></script>
<script src="<?=base_url('assets/')?>js/nifty.min.js"></script>
<script src="<?=base_url('assets/')?>js/demo/bg-images.js"></script>

</body>
</html>

<script type="text/javascript">
  $(function () {
    $('.msg').css('display','none');
    $('.btn_forget').click(function () {
      $.ajax({
        url: "<?php echo file_path(); ?>login/send_resetpass_link",
        type: "POST",
        success:function(data){
          if(data == 1){
            $('.msg').css('display','inline-block');
            $('.msg').css('background-color', '#6dca6d');
            $('.msg').css('color', '#fff');
            $('.msg').css('padding', '5px');
            $('.msg').css('margin', '6px 0 0 0');
            $('.msg').css('border-radius', '5px');
            $('.msg').html('<i class="fa fa-check-circle"></i>&nbsp;&nbsp;Your reset password link send to your emailid.');
          }else{
            $('.msg').css('display','inline-block');
            $('.msg').css('background-color', 'rgb(255, 128, 128)');
            $('.msg').css('color', '#fff');
            $('.msg').css('padding', '5px');
            $('.msg').css('margin', '6px 0 0 0');
            $('.msg').css('border-radius', '5px');
            $('.msg').html('<i class="fa fa-close"></i>&nbsp;&nbsp;Opps! Try again later.');
          }
          window.setTimeout(function(){location.reload()},5000)
        },
      });
    });
  });
</script>

<style>
	.tts{
		background-color:#1b9a43 !important;
		border-color: #1b9a43 !important;
	}
	.tts:hover{
		background-color:#1b9a43 !important;
		border-color: #1b9a43 !important;
	}
	.reg_link a:hover
	{
		color:#1b9a43 !important;
	}
	.forget_pass_link a:hover
	{
		color:#1b9a43 !important;
	}
</style>
