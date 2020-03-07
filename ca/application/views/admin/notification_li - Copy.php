<?php


if($result['class_type']=="support"){
	
	$txt = '<a href="'.file_path('admin').'support/view" style=" color: #ffffff;"><font class="theme-txt1">' . $result[ 'member_name' ] . '</font>  <font class="theme-txt2"> ' . $result[ 'message' ] . '</font ></a>.';
	
}else if($result['class_type']=="document"){
	
	$txt = '<a href="'.file_path('admin').'document_master/view" style=" color: #ffffff;"><font class="theme-txt1">' . $result[ 'member_name' ] . '</font>  <font class="theme-txt2"> ' . $result[ 'message' ] . '</font ></a>.';
	
}else if($result['class_type']=="service_request"){
	
	$txt = '<a href="'.file_path('admin').'service_request/req_view/'.$result['rec_id'].'" style=" color: #ffffff;"><font class="theme-txt1">' . $result[ 'member_name' ] . '</font>  <font class="theme-txt2"> ' . $result[ 'message' ] . '</font ></a>.';
}




?>

<li style="list-style: none; padding: 5px;  margin: 5px; padding-left: 10px; background-color: #47a249;  padding-top: 15px; ">
					<a href="#" class="media add-tooltip" noti_position="top_header_noti" data-container="body" data-placement="bottom">

						<div class="media-body">
							<p class="text-nowrap text-main text-semibold"><?=$txt?></p>

						</div>
					</a>
</li>




	<?php /*?><div class="nano scrollable" style="padding: 10px 10px;height: 20%;" >
		<div class="nano-content">
			<ul class="head-list" style="list-style: none; padding: 0;  margin: 0;">

				<li style="padding: 2px 10px;">
					<a href="#" class="media add-tooltip" noti_position="top_header_noti" data-container="body" data-placement="bottom">

						<div class="media-body">
							<p class="text-nowrap text-main text-semibold"><?=$txt?></p>

						</div>
					</a>
				</li>

			</ul>
		</div>
	</div>

	<!--Dropdown footer-->
	<div class="pad-all bord-top" style="padding: 0px!important;">
		
	
	</div><?php */?>



