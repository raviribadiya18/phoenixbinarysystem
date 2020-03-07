<?php

if($result['seen_status']=="No"){
	$bg_color="unseen";
}else{
	$bg_color="";
}

if($result['class_type']=="support"){
	// style=" color: #ffffff;"
	$txt = '<a href="'.file_path('admin').'dashboard/update_seen_status/support/'.$result['id'].'"><font class="theme-txt1">' . $result[ 'member_name' ] . '</font>  <font class="theme-txt2"> sent support query.</font ></a>.';
	
}else if($result['class_type']=="document"){
	
	$txt = '<a href="'.file_path('admin').'dashboard/update_seen_status/document/'.$result['id'].'"><font class="theme-txt1">' . $result[ 'member_name' ] . '</font>  <font class="theme-txt2">  sent document.</font ></a>.';
	
}else if($result['class_type']=="service_request"){
	
	$txt = '<a href="'.file_path('admin').'dashboard/update_seen_status/service_request/'.$result['id'].'" ><font class="theme-txt1">' . $result[ 'member_name' ] . '</font>  <font class="theme-txt2"> sent service request.</font ></a>.';
}else if($result['class_type']=="task_complete"){
	
	$txt = '<a href="'.file_path('admin').'dashboard/update_seen_status/task_complete/'.$result['id'].'" ><font class="theme-txt1">' . $result[ 'member_name' ] . '</font>  <font class="theme-txt2"> has completed a task.</font ></a>';
}





//if($result['class_type']=="support"){
//	// style=" color: #ffffff;"
//	$txt = '<a href="'.file_path('admin').'support/view"><font class="theme-txt1">' . $result[ 'member_name' ] . '</font>  <font class="theme-txt2"> sent support query.</font ></a>.';
//	
//}else if($result['class_type']=="document"){
//	
//	$txt = '<a href="'.file_path('admin').'document_master/view"><font class="theme-txt1">' . $result[ 'member_name' ] . '</font>  <font class="theme-txt2">  sent document.</font ></a>.';
//	
//}else if($result['class_type']=="service_request"){
//	
//	$txt = '<a href="'.file_path('admin').'service_request/req_view/'.$result['rec_id'].'" ><font class="theme-txt1">' . $result[ 'member_name' ] . '</font>  <font class="theme-txt2"> sent service request.</font ></a>.';
//}else if($result['class_type']=="task_complete"){
//	
//	$txt = '<a href="'.file_path('admin').'task_mgmt/view/" ><font class="theme-txt1">' . $result[ 'member_name' ] . '</font>  <font class="theme-txt2"> has completed a task.</font ></a>';
//}

?>


	
<div class="mCustomScrollbar" data-mcs-theme="dark">
  <ul class="notification-list">
    <li class="<?=$bg_color?>">
      <div class="author-thumb"> <img src="<?=base_url('assets/')?>images/profile.png" width="34" alt="author"> </div>
      <div style="width:76%;" class="notification-event">
      	<a href="#">
        <div><?=$txt?></div>
        </a>
        <span class="notification-date">
        <time class="entry-date updated" datetime="2004-07-24T18:18"><?=time_ago($result['timedt'])?></time>
        </span> </div>
    </li>
  </ul>
</div>




