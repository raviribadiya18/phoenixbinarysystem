<script type="text/javascript">
$(document).ready(function(e) {
		$('#demo-dt-basic').dataTable( {
		"responsive": true,
		"language": {
		"paginate": {
		"previous": '<i class="demo-psi-arrow-left"></i>',
		"next": '<i class="demo-psi-arrow-right"></i>'
		}
		}
		}); 
		
			$('#demo-dt-basic2').dataTable( {
		"responsive": true,
		"language": {
		"paginate": {
		"previous": '<i class="demo-psi-arrow-left"></i>',
		"next": '<i class="demo-psi-arrow-right"></i>'
		}
		}
		});  
});	
</script>
	<div class="row">
        <div class="col-md-3">
            <div class="panel panel-warning panel-colorful media middle pad-all">
                <div class="media-left">
                    <div class="pad-hor">
                        <i class="demo-pli-data-storage icon-3x"></i>
                    </div>
                </div>
                
                
                
                <div class="media-body">
					<!-- <a href="<?=file_path('admin')?>employee/view/" style="color:#fff;"> -->
						<p class="text-2x mar-no text-semibold"><?=$tot_emp[0]['tot_user'];?></p>
						<p class="mar-no">Due Amount</p>
					<!-- </a> -->	
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-info panel-colorful media middle pad-all">
                <div class="media-left">
                    <div class="pad-hor">
                        <i class="demo-pli-add-user icon-3x"></i>
                    </div>
                </div>
                <div class="media-body">
					<a href="<?=file_path('admin')?>client/view" style="color:#fff;">
						<p class="text-2x mar-no text-semibold"><?=$tot_client[0]['tot_user'];?></p>
						<p class="mar-no">Total Client</p>
					</a>
                </div>
            </div>
        </div>
        <?php /*?><div class="col-md-3">
            <div class="panel panel-mint panel-colorful media middle pad-all">
                <div class="media-left">
                    <div class="pad-hor">
                        <i class="demo-pli-receipt-4 icon-3x"></i>
                    </div>
                </div>
                <div class="media-body">
					<a href="<?=file_path('admin')?>task_mgmt/view/" style="color:#fff;">
						<p class="text-2x mar-no text-semibold"><?=$tot_task[0]['tot_user'];?></p>
						<p class="mar-no">Total Task</p>
					</a>
                </div>
            </div>
        </div><?php */?>
        <div class="col-md-3">
            <div class="panel panel-danger panel-colorful media middle pad-all">
                <div class="media-left">
                    <div class="pad-hor">
                        <i class="demo-psi-monitor-2 icon-3x"></i>
                    </div>
                </div>
                <div class="media-body">
                    <a href="#" style="color:#fff;">
                        <p class="text-2x mar-no text-semibold"><?=$tot_notification[0]['tot_noti'];?></p>
                        <p class="mar-no">Notification</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
 
 
                            <div class="row">
                            
                            <div class="col-md-12">      
                                             
                            <div class="panel">
                            <div class="panel-body">
                            <h3>System Notification</h3>
                            
                            
                            <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                            <th>id</th>
                            <th>User Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            
                            </tr>
                            </thead>
                            <tbody>
                            
                            <?php 
                            $no=1;
                            for($i=0;$i<count($result);$i++){ 
                            
							
								if($result[$i]['class_type']=="support"){
									// style=" color: #ffffff;"
									$txt = '<a href="'.file_path('admin').'support/view"><font>' . $result[$i][ 'member_name' ] . '</font>  <font class="theme-txt2"> sent support query.</font ></a>.';

								}else if($result[$i]['class_type']=="document"){

									$txt = '<a href="'.file_path('admin').'document_master/view"><font>' . $result[$i][ 'member_name' ] . '</font>  <font class="theme-txt2">  sent document.</font ></a>.';

								}else if($result[$i]['class_type']=="service_request"){

									$txt = '<a href="'.file_path('admin').'service_request/req_view/'.$result[$i]['rec_id'].'" ><font>' . $result[$i][ 'member_name' ] . '</font>  <font class="theme-txt2"> sent service request.</font ></a>.';
								}else if($result[$i]['class_type']=="task_complete"){

									$txt = '<a href="'.file_path('admin').'task_mgmt/view/" ><font>' . $result[$i][ 'member_name' ] . '</font>  <font class="theme-txt2"> has completed a task.</font ></a>';
								}
								
								
                            ?>
                            <tr>
                            <td><?=$no++;?></td>
                            <td><?=$result[$i]['member_name']?></td>
                            <td><?=$txt?></td>
                            <td><?=date('d-m-Y H:i:s',$result[$i]['timedt'])?></td>
                          
                            </tr>	
                            <?php } ?>
                            
                            </tbody>
                            </table>
                            
                            </div>
                            </div>
                            
                            
                            </div>
                            
                            
                            <?php /*?> <div class="col-md-6">      
                                    <div class="panel">
                            <div class="panel-body">
                            <h3>New Joining Member</h3>
                            
                            
                            <table id="demo-dt-basic2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                            <th>Usercode</th>
							<th>Name</th>
							<th>Username</th>
							<th>Join Date</th>
                            </tr>
                            </thead>
                            <tbody>
                           
                            
                            </tbody>
                            </table>
                            
                            </div>
                            </div>         
                            
                            
                            
                            </div><?php */?>
                            
                            </div>
