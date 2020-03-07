<link href="<?=base_url('assets/')?>css/print.css" rel="stylesheet">
<script>
$(document).ready(function(e) {
	
	var buyer_h		=	parseInt($(".buyer_section").outerHeight());
	var seller_h	=	parseInt($(".seller_section").outerHeight());
	
	if(buyer_h >= seller_h){
		var header_height = buyer_h+20;
	}else{
		var header_height = buyer_h+20;
	}
	$(".buyer_section").css("height",header_height);
	$(".seller_section").css("height",header_height);
		
	var header_h		=parseInt($("#header").outerHeight());
	//alert(header_h);//29
	var footer_h		=parseInt($(".footer").outerHeight());
	//alert(footer_h);//105
	
	var main_section_h	=parseInt($(".main_section").innerHeight());
	//	alert(main_section_h);//684
	//header_height=228
	
	var tbl_height=1127-(header_height);//899//1127
	//var tbl_height=850;//899//1127
	//alert(tbl_height);
	
	var table_height=(tbl_height-275);//649//250

	//alert(table_height);
	var head_tr_height=parseInt($("#head_tr").outerHeight());//30
	//	alert(head_tr_height);
		
	
	
	var header_html  = '<section class="nomargin panel-body main_body" id="main_body"> <div class="background"><section class="main_section"><div id="header" class="header">'+$("#header").html()+'</div>';
	var header_html2 = '<section class="nomargin panel-body main_body" id="main_body"> <div class="background"><section class="main_section"><div id="header" class="header"></div>';
	
	
	var footer_html  = '<div class="footer" >'+$(".footer").html()+'';
	var footer_html2  = '<div class="footer2" >';
	
	var end_html='</div></section></div></section>';
	
	var table_header = '<div class="tb1" style="height:'+tbl_height+'px;" ><table class="table"><thead id="hd"  ><tr id="head_tr" >'+$('#head_tr').html()+'</tr></thead><tbody id="item_tr1" class="item_tr1" style="font-size:12px!important;">'; 
	var table_header2 ='<div class="tb1" style="height:'+tbl_height+'px;"><table class="table"><thead id="hd"  ><tr id="head_tr" style="border-top:2px solid black;">'+$('#head_tr').html()+'</tr></thead><tbody id="item_tr1" class="item_tr1" style="font-size:12px!important;">'; 
	
	var table_tag = ' <div class="tb2" style="height:'+tbl_height+'px;" ><table class="table"><tbody id="item_tr1" class="item_tr1">'; 
	var table_footer = '</tbody></table></div>';
	var page_seprate = '<div class="page_seprate"></div>';	
		
		
		
		
	var page=1;
	var tr_height=head_tr_height;
	
	var page_html={};
	var page_count={};
	//var page_count="1";
	page_html[page]='';
	page_count[page]=0;
	
	$('.item_tr').each( function( i , e ) {
		
		tr_height += parseInt($(this).outerHeight());
		//alert(tr_height);
		//alert(table_height);
		if(tr_height>=table_height){
			
			tr_height=$(this).outerHeight();
			page++;
			
			page_html[page]='';
			page_count[page]=0;
			page_count[page]++;
			
			page_html[page]+='<tr class="item_tr" >'+$(this).html()+'</tr>';
			
			
		} else{
		
			page_count[page]++;
			page_html[page]+='<tr  class="item_tr" >'+$(this).html()+'</tr>';
			
		}
		
		});


	$('#main_body').html('');
	
	for(var i=1 ; i<=page;i++){
		var page_dt='';
		if(i==1)
		{
			page_dt+=header_html;
		}
		else
		{
			page_dt+=header_html2;
		}
		
		
		
		if(page_count[i]>=2){
			
			//page_dt+=table_header;
			page_dt+=table_header2;	
		}
		else{
			
		
		
		page_dt+=table_tag;	
			}
		page_dt+=page_html[i];
		page_dt+=table_footer;
		<!--page_dt+=watermark;-->
		if(i==page)
		{
			page_dt+=footer_html;
		}else
		{
			page_dt+=footer_html2;
		}
		page_dt+='<div style="clear:both;overflow:hidden;"><section class="pull-left"><span class="footer_text_left"> This is computer generated invoice.</span></section><section class="pull-right" style="margin-right:10px">Page '+i+' Of '+page+'</section></div> ';
		page_dt+=end_html;
		page_dt+=page_seprate;
		
		$('#main_body').append(page_dt);
		
		
	}

	 window.print();
});
	

</script>
<section class="main_body" id="main_body">
	
  <section class="main_section">
  	
	  <div id="header" class="header"> 
    
    <!------Page heading ----->
 <section class="nomargin page_section" >
      <div style="clear:both;overflow:hidden;"></div> 
      <span class="order" >INVOICE </span> </section>
		<!------/ Page heading ----->
        
         <!------Buyer & Seller Details ----->
   <!------Company logo and details ----->
      <section class="pull-left seller_section" style="height:208px;"> 
       <img src="<?=asset_path('web/')?>img/logos/pbm-logo.png" class="img pull-left com_img"  width="300px" /><br />
        <table border="0" style="margin-top: 50px;margin-right: 10px; margin-left: 5px;">
          <tbody>
         
            <tr>
              <td width="80px " style="vertical-align: initial;">Address </td>
              <td width="10px" style="vertical-align: initial;">: </td>
              <td style="word-wrap:break-word"><pre>307, Polaris Commercial Mall,
Opp. Bhaiya nagar BRTS station,
Puna canal Road,
Punagam, Surat - 395 010
Gujarat, India
</pre></td>
            </tr>
            <tr>
              <td  style="vertical-align:text-top">Contact </td>
              <td  style="vertical-align:text-top">: </td>
              <td style="">+91 96623 34487</td>
            </tr>
           
            <tr>
              <td> Email </td>
              <td>: </td>
              <td>capbmandco@gmail.com</td>
            </tr>
            
            <!--<tr>
              <td>GST No</td>
              <td>: </td>
              <td>0000000000</td>
            </tr>-->
            
            
            
          </tbody>
        </table>
        </strong> </section>
  
  
  <section class="pull-right buyer_section" style="margin-bottom:0px !important;height:208px;"> 
   <table border="0" class="" style="margin-top: 10px;margin-bottom: 62px;margin-left: 5px;">
      <tbody>
       
        <tr>
          <td  width="128px">Invoice No. </td>
            <td width="10px">: </td>
		
			 <td><?=$invoice = sprintf("%04d", $invoice_master[0]['invoice_id'])?></td>
        <?php /*?>  <td><?=$invoice_master[0]['invoice_id']?></td><?php */?>
        </tr>
        
        
        
        <tr>
          <td>Date </td>
            <td width="10px">: </td>
            
          <td><?=date('d/m/Y',strtotime($invoice_master[0]['invoice_date'])); ?></td>
        </tr>
       <tr>
          <td>Customer Name </td>
            <td width="10px">: </td>
          <td><?=ucfirst($user_details[0]['fname'])?> <?=ucfirst($user_details[0]['lname'])?></td>
        </tr>
        <?php /*?> <tr>
          <td>Customer No </td>
            <td width="10px">: </td>
          <td><?=$customer[0]['cus_id']; ?></td>
        </tr><?php */?>
         <tr>
          <td>Mobile No </td>
            <td width="10px">: </td>
          <td><?=$user_details[0]['mobileno']?></td>
        </tr>
         <tr>
          <td>Address </td>
            <td width="10px">: </td>
          <td style="word-wrap:break-word">
		 <?=$user_details[0]['address']?>
          </td>
        </tr>
        
        
        
        <tr>
          <td>City </td>
          <td width="10px">: </td>
          <td style="word-wrap:break-word">
		  <?=$user_details[0]['city']?>
          </td>
        </tr>
        
        
        
       </tbody>
    </table>
    </strong> </span> </section>
     <!------// Buyer & Seller Details ----->
     
 </div>
  <!-- Item  table -->
  
 	  <div class="tb1" id="itemtable">
      <table class="table" >
        <thead  id="hd">
          <tr id="head_tr">
            <th  width="5%" style="border-bottom:2px solid black;border-right:2px solid black;">Sr.</th>
            <th  width="50%" style="border-bottom:2px solid black;border-right:2px solid black;">Particulars</th>
            <th width="20%" style="border-right:2px solid black;">Amount</th>
           
      </tr>
    </thead>
    <tbody id="item_tr1" class="item_tr1" style="font-size:12px!important;">
      <?php 
		 $sub_tot=0;
		 for($i=0;$i<count($invoice_det);$i++) {
        ?>
		<tr id="item_tr" class="item_tr">
            <td style="border-right:2px solid black;"><?= $i+1; ?></td>
            <td style="word-wrap:break-word;border-right:2px solid black; text-align: left !important;padding-left: 5px !important;"><?=$invoice_det[$i]['service_name']?></td>
            <td style="border-right:2px solid black;text-align:left; padding-left: 5px !important;"><?=$invoice_det[$i]['price']?> /-</td>
        
      </tr>
      <?php }   ?>
      
  	 
     
     
       <tr class="item_tr">
            
          <td colspan="2" style="border-left: 2px solid black !important;border-right: 2px solid black !important;font-weight: bold;font-size: 15px;text-align: right;padding-right: 5px !important;">Total</td>
          <td style="padding-left: 5px !important;border-right:2px solid black; text-align: left;"><?=$invoice_master[0]['total_amt']?> /-</td>		
     </tr>
     <tr  style="" class="item_tr" >
        <td colspan="4" class="inword_txt" style="border-right:2px solid black;border-left: 2px solid black !important;"><span style="margin-left:10px;">In Words :
         <?= ucwords($rs_in_words) ?> Only </span>
        </td>
     </tr>
         
      </tbody>
      </table>
      
      
 </div>
  
 	  
	  <div class="footer"> 
 	
     <?php /*?> <section class="thanks_section " >
    	  <span class="thanks_span" >  Thank you for shopping with us.	</span>
      </section>
 		<?php */?>
      
       <section class="pull-left" style="text-align:justify !important">
		  <span class="footer_text_left">  HDFC BANKs</span> <br/> 
		  <span class="footer_text_left">  Name: PBM AND CO</span> <br /> 
		  <span class="footer_text_left">  IFSC: HDFC0009289</span> <br /> 
		  <span class="footer_text_left">  AC: 50200035416980</span> <br /> 
		   <span class="footer_text_left">  Call Us : +91 96623 34487</span><br /><br />
          
       </section>
    
       <section class="pull-right">
            <?php /*?><span class="footer_text_right"> For https://capbm.in </span><br /><br /><br /><?php */?>
            <span class="footer_text_right">Authorized Signatutory </span><br /><br /><br /><br />
		   <span class="footer_text_right">  Subject to Surat Jurisdiction</span> <br />
          <span class="footer_text_right">  Visit : https://capbm.in </span><br />
         
 	   </section>
      
         
 
 </div>	 
  
  
  
  
    
    <!-- Footer --> 
  </section>
  <!-- panel-body --> 
</section>


<style>
.main_body {
    height:auto; 
    width: 770px;
	margin-bottom:10px;
	margin-bottom:2px;
	
}
.table {
  
   /* width: 746px;*/
	width: 706px;
}
.tt{
/*	width: 717px;*/
}
.main_section {
    margin-left: 20px;
    margin-top: 20px;
}
.footer {
		height: 110px;
	}
.inword_txt{
	text-align: left!important;
    font-size: 16px;
    font-weight: bold
}

.footer2 {
	height: 0px;
}
.footer2 {
     border-top:none ;
}
</style>
