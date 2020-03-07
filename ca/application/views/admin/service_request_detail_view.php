

<div class="contentpanel"> 

  <!-------------->
  
  
  <!--------------> 
	<div class="panel">

		<!--Panel heading-->
		<div class="panel-heading">
			
			<h3 class="panel-title"> Request For <?=$result[0]['service_name']?><span class="pull-right"><a href="<?=file_path('admin')?>/<?=$this->uri->rsegment(1)?>/view">Back</a></span></h3>
		</div>

		<!--Panel body-->
		<div class="pad-btm">
			<div class="nano has-scrollbar" style="height: 150px">
				<div class="nano-content" tabindex="0" style="right: -17px;">
					<div class="panel-body">
						<p style="text-align: justify;">
						 <?=$result[0]['request_details']?> </p>
					</div>
				</div>
			<div class="nano-pane"><div class="nano-slider" style="height: 20px; transform: translate(0px, 30.3723px);"></div></div></div>
		</div>
		<div class="panel-footer"><?=$result[0]['fname']." ".$result[0]['lname']?>
			<span class="pull-right"><?=date("d-m-Y H:i",strtotime($result[0]['create_date']))?></span></div>
	</div>
</div>
 

