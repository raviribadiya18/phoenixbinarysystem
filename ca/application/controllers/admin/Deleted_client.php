<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deleted_client extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_admin()){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		date_default_timezone_set('Asia/Calcutta'); 
		
		
   		$this->load->model('admin/Client_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

		
 	}
	
	public function view(){
		

		$data['html']		=	$this->listing();

		$page_info['menu_id']		=	'menu-dclient';
		
		$page_info['page_title']	=	'Client';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function listing(){
	
	
		$result=$this->ObjM->get_deleted_client();
		
		$html='';
		
		for($i=0;$i<count($result);$i++){
				
				if($result[$i]['status']=='Delete'){
					$current_status='Delete';
					$update_status='Active';
					$cls='btn-danger';
				}
				
			
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['company_name'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['password'].'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td>'.$result[$i]['city'].'</td>
						
						<td><div class="btn-group">
						<button class="btn dropdown-toggle '.$cls.' btn_custom" data-toggle="dropdown">'.$current_status.' <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right myDropDown">
							<li><a class="status_change" href="'.file_path('admin').''.$this->uri->rsegment(1).'/status_update/'.$update_status.'/'.$result[$i]['usercode'].'">'.$update_status.'</a></li>';
							
							
						$html.='</ul>
						</div>
						
						</td>
					</tr>';
		}		
		
		return $html;
	}
	
	
		

	function status_update($st,$eid){
		
		$record	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));
		
		$data['status'] = $st;
		
		$this->comman_fun->update($data,'membermaster',array('usercode'=>$eid));
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Status '.$st.' Successfully.....'));
		
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		
		
	}
	
	
	
	
	function export_income_report()
	{
		
		$start_date	= filter_data(date('Y-m-d',strtotime($_POST['start_date'])));
			
		$end_date	= filter_data(date('Y-m-d',strtotime($_POST['end_date'])));
		
		$result = $this->ObjM->get_income_report_new($start_date,$end_date);
		
		if(count($result)>0){
			
			$output="";
			$output .= '"Client Name",';
			$output .= '"Sub Member Name",';
			$output .= '"Total Amount",';
			$output .= '"Total Recieved Amount",';
			$output .= '"Total Due Amount",';
			$output .="\n";

			for($i=0;$i<count($result);$i++)
			{
				$tot_rec_amt=$result[$i]['tot_amt']-$result[$i]['tot_due_amt'];

				$output .='"'.$result[$i]['main_client'].'",';
				$output .='"'.$result[$i]['sub_client'].'",';
				$output .='"'.$result[$i]['tot_amt'].'",';
				$output .='"'.$tot_rec_amt.'",';
				$output .='"'.$result[$i]['tot_due_amt'].'",';
				$output .="\n";
			}

			$dt=date("d-m-Y");

			$filename = "Income_Report".$dt.".csv";

			header('Content-type: application/csv');

			header('Content-Disposition: attachment; filename='.$filename);

			header('Cache-Control: max-age=0'); //no cache

			ob_get_contents();
			echo $output;
			
		}else{
			
			
			$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'No Data found.!'));
			
			header('Location: '.file_path('admin').''.$this->uri->rsegment(1).'/view');
		}

		
	}
	
}


