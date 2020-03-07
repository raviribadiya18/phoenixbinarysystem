<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_admin()){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		
		ob_start();
		
		ob_end_flush();
		
   		$this->load->model('admin/Notification_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

		
 	}
	
	public function view(){
		

		$data['html']		=	$this->listing();

		$page_info['menu_id']		=	'menu-notification';
		
		$page_info['page_title']	=	'Notification List';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function listing(){
	
	
		$result=$this->ObjM->getAll_noti();
		
		$html='';
		
		for($i=0;$i<count($result);$i++){
				
				if($result[$i]['status']=='Active'){
					$current_status='Active';
					$update_status='Inactive';
					$cls='btn-success';
				}
				else{
					$current_status='Inactive';
					$update_status='Active';
					$cls='btn-danger';
				}
			
				
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['noti_title'].'</td>
						<td>'.$result[$i]['noti_desc'].'</td>
						<td>'.str_replace('_',' ',$result[$i]['send_type']).'</td>
						<td>'.date('d-m-Y',strtotime($result[$i]['create_date'])).'</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle '.$cls.' btn_custom" data-toggle="dropdown">'.$current_status.'  </button>
						<ul class="dropdown-menu pull-right">';
							
						$html.='<li><a class="delete_record" href="'.file_path('admin').''.$this->uri->rsegment(1).'/delete_record/'.$result[$i]['noti_code'].'">Delete</a></li>';
							
							
						$html.='</ul>
						</div>
						
						</td>
					</tr>';
		}		
		
		return $html;
	}
	
	function addnew($mode){
	
		$data['segment']=array('mode'=>$mode);
		
		$page_info['menu_id']		=	'menu-notification';
		
		$page_info['page_title']	=	'Notification List';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		$this->load->view('admin/'.$this->uri->rsegment(1).'_add',$data);
		$this->load->view('comman/footer_admin');	
	}
	
	function insertrecord()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$data = array();
			
			$this->form_validation->set_rules('noti_title', 'Notification title', 'required|trim');
			
			$this->form_validation->set_rules('noti_desc', 'Notification Description', 'required|trim');
			
			$this->form_validation->set_rules('receiver_code', 'Send Receiver', 'required');
	
			if ($this->form_validation->run() == FALSE)
			{
				$this->addnew($this->input->post('mode'));
				
			}else{
				
				
				
				$data['send_type'] 		= 	$this->input->post('receiver_code');
				
				$data['noti_title'] 	= 	filter_data($this->input->post('noti_title'));
				
				$data['noti_desc'] 		= 	filter_data($this->input->post('noti_desc'));


				$data['create_date']	=	date('Y-m-d H:i:s');
				
				$data['create_by']		=	"1";	
				
				$noti_code=$this->comman_fun->additem($data,'notification');
				

				$endcode=$this->input->post('endcode');
				
			if($this->input->post('receiver_code')=='Selected_client'){
				
				for($i=0;$i<count($endcode);$i++){
					
					$info=array();
					
					$info['noti_code'] = $noti_code;
					
					$info['usercode'] = $endcode[$i];
					
					$this->comman_fun->additem($info,'notification_dt');
				}
			}
			
			$list=$this->ger_gcm_id();
			
			$listChunk=array_chunk($list,1000);
				
			foreach($listChunk as $clist){
				
				$message=array('data'=>filter_data($this->input->post('noti_desc')));
				
				
				$this->send_notification($clist,$message);	
			}
			
			
			
			
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		//echo '<script>window.location.href="'.base_url().'index.php/notification"</script>';
		//header('Location: '.base_url().'index.php/notification');
		exit;
		}
		}
	
	}
	
	
	//****Fun For GET All Number List*****//
	protected function ger_gcm_id(){
		
		$client_list=array();
		
		
		if($this->input->post('receiver_code')=='All_client' || $_POST['receiver_code']=='Selected_client'){
			
			$client_list	=	$this->get_client_gcm();
		
		}	
		
		
		$list = $client_list;
		
		return $list;
		
	}
	
	//****Fun For GET Student Number List*****//
	 function get_client_gcm(){
		 
		$list=array();
		 
		$arr=array();
		 
		$receiver_code=$this->input->post('receiver_code');
		 
		
		if($receiver_code=='Selected_client')
		{
			$arr=array('list'=>$this->input->post('endcode'));
		}
	
		$result	=	$this->ObjM->get_client_gcm_q($arr);
		 
		
		for($i=0;$i<count($result);$i++){
			
			$list[]=$result[$i]['app_regid'];
			
		}
		return $list;
	}
	
	function delete_record($eid){
		
		$record	=	$this->comman_fun->get_table_data('notification',array('noti_code'=>$eid));
		
		$data['status'] = 'Delete';
		
		
		
		$this->comman_fun->update($data,'notification',array('noti_code'=>$eid));
		
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Delete Successfully.....'));
		
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		
	}
	
	function get_data_list($receiver_code)
	{
		if($receiver_code=='Selected_client'){
			
			$html=$this->get_client_list();	
			
			echo $html;
		}
		
	
	}
	
	 function get_client_list(){
		 
		$result=$this->ObjM->get_clients();
		
		$html='<table class="table table-bordered" id="data-table">
				<thead>
					<tr class="thefilter"">
						<th><input type="checkbox"  id="checkall" class="checkall" value=""></th>
						<th>Name</th>
						<th>Contact No.</th>
						<th>City</th>
						<th>Email</th>
					</tr>
				</thead>
		<tbody>';
		for($i=0;$i<count($result);$i++){
			
			$name=$result[$i]['fname'].' '.$result[$i]['lname'];
			
			$html.='<tr>
						<td><input type="checkbox" name="endcode[]" class="endcode" value="'.$result[$i]['usercode'].'"></td>
						<td>'.$name.'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.$result[$i]['city'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
				  </tr>';
		}
		$html.='</tbody>
    			</table>';
			return $html;
		
	}
	
	function test_notification12()
	{
		
		$message=array('title'=>'Hi Test','data'=>'Hello Phoenix Binary System 8155  s simply dummy text of the printing and typesetting industry.');
		
	
		$registatoin_ids = array("e0gGXWuxDS4:APA91bFmK2s-_IoOhu7Qasuo-HrMzZpsOLUqb0n4Ll69NpyBSDbsUDWcaWMgujTO83QVCPwlbwA27KL8z2OXEDckdh9lzRHzHBhqrx9P-NMOd4tr30W58S_YzdeM7zZgUylMIOheg96y");

		$this->send_notification($registatoin_ids,$message);	
		
	
	
	}
	
	protected function send_notification($registatoin_ids, $message) {
			
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );
		
        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
		//echo phpinfo();
		
		//var_dump($fields);
       echo $result;
    }
	
}


