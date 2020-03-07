<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fees_collection extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_admin()){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		
		ob_start();
		
		ob_end_flush();
		
   		$this->load->model('admin/Fees_collection_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

		
 	}
	
	public function view($usercode=NULL,$suid=NULL){
		

		$data['html']				=	$this->listing($usercode,$suid);
		
		$data['unpaid_invoice']		=	$this->comman_fun->get_table_data('invoice_master',array('usercode'=>$usercode,'sub_uid'=>$suid,'bill_paid'=>'No'));

		$page_info['menu_id']		=	'menu-client';
		
		$page_info['page_title']	=	'Fee Collection List';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function listing($usercode,$suid){
	
	
		$result=$this->ObjM->get_all($usercode,$suid);
		
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
			
				
				//$record	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$result[$i]['usercode']));
			
				//$record_client	=	$this->comman_fun->get_table_data('sub_membermaster',array('id'=>$result[$i]['sub_id']));
			
				
				
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['date_info'].'</td>
						<td>'.$result[$i]['amount'].' /-</td>
						<td>'.$result[$i]['discount_amount'].' /-</td>
						<td><a target="_blank" href="'.file_path('admin').''.$this->uri->rsegment(1).'/print_order/'.$result[$i]['id'].'/'.$result[$i]['usercode'].'/'.$result[$i]['sub_uid'].'">Print Invoice</a></td>
						<td>'.$result[$i]['pay_type'].'</td>
						<td>'.$result[$i]['description'].'</td>
						<td>'.$result[$i]['bank_name'].'</td>
						<td>'.$result[$i]['cheque_dd_no'].'</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle '.$cls.' btn_custom" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right">
							
							';
							
							$html.='<li><a class="delete_record" href="'.file_path('admin').''.$this->uri->rsegment(1).'/delete_record/'.$result[$i]['id'].'">Delete</a></li>';
							
							
						$html.='</ul>
						</div>
						
						</td>
					</tr>';
		}		
		
		return $html;
	}
	//<li><a href="'.file_path('admin').''.$this->uri->rsegment(1).'/addnew/edit/'.$result[$i]['usercode'].'/'.$result[$i]['sub_uid'].'/'.$result[$i]['id'].'">Edit</a></li>
	
	
	
	
	function addnew($mode=NULL, $usercode=NULL,$suid=NULL, $eid=NULL){
		
		
		if($mode=='edit')
		{
			$data['form_set']	=	array('mode'=>'edit','eid'=>$eid,'usercode'=>$usercode,'suid'=>$suid);
			
			$data['result']		=	$this->ObjM->get_record($eid);
			
		}else{
			$data['form_set']=array('mode'=>'add','usercode'=>$usercode,'suid'=>$suid);
			
		}
		
		$data['unpaid_invoice']		=	$this->ObjM->get_unpaid_invoices($usercode,$suid);
		
		$page_info['menu_id']		=	'menu-client';
		
		$page_info['page_title']	=	'Fee Collection';
	
		
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_add',$data);
		
		$this->load->view('comman/footer_admin');
		
	}
	
	function insert()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST'){	
			
			$this->form_validation->set_rules('invoice_no', 'Invoice No', 'required');
			
			$this->form_validation->set_rules('date_info', 'Date', 'required');
			
			$this->form_validation->set_rules('pay_type', 'Payment Type', 'required');
			
			$this->form_validation->set_rules('amount', 'Amount', 'required|callback_check_amount');//|callback_check_amount
			
			$this->form_validation->set_rules('discount_amount', 'Discount Amount', 'required|callback_check_damount');
			
			$this->form_validation->set_rules('description', 'Description', 'required');
			
			if ($this->form_validation->run() === FALSE){
				
				$this->addnew($_POST['mode'],$_POST['usercode'],$_POST['suid'],$_POST['eid']);
			}
			else
			{	
			
				
				$this->_insert();

				echo '<script>window.location.href="'.file_path('admin').''.$this->uri->rsegment(1).'/view/'.$_POST['usercode'].'/'.$_POST['suid'].'"</script>';
				
				header('Location: '.file_path('admin').''.$this->uri->rsegment(1).'/view/'.$_POST['usercode'].'/'.$_POST['suid'].'');
				
				exit;

			}
			
			

		}
	}
	
	function check_amount() {
			
			$amount=$_POST['amount'];
		
			$invoice_no=$_POST['invoice_no'];
			
			$record	=	$this->comman_fun->get_table_data('invoice_master',array('invoice_id'=>$invoice_no,'bill_paid'=>'No','status'=>'Active'));
			
			if (sprintf('%0.2f',$amount)>$record[0]['due_amount']){
				
				$this->form_validation->set_message('check_amount', 'The Amount is not grater than due amount.');

				return FALSE;
				

			}else {

				return TRUE;
			}
			
			
			
		
	}
	
	function check_damount() {
			
			$amount		=	$_POST['amount'];
		
			$due_amount	=	$_POST['due_amount'];
		
			$damount	=	$_POST['discount_amount'];
		
			$total_amt	=	$_POST['amount'] + $_POST['discount_amount'];
			
			$record	=	$this->comman_fun->get_table_data('invoice_master',array('invoice_id'=>$invoice_no,'bill_paid'=>'No','status'=>'Active'));
			
			if (sprintf('%0.2f',$total_amt)>sprintf('%0.2f',$due_amount)){
				
				$this->form_validation->set_message('check_damount', 'Please Enter Valid Amount. Your Discount Limit is Over.');

				return FALSE;
				

			}else {

				return TRUE;
			}
		
	}
	
	
	protected function _insert(){
		
		$data=array();
		
		$data['invoice_no']		=	$_POST['invoice_no'];
		
		$data['usercode']		=	$_POST['usercode'];
		
		$data['sub_uid']		=	$_POST['suid'];
		
		$data['date_info']		=	date('Y-m-d',strtotime($_POST['date_info']));
		
		$data['pay_type']		=	$_POST['pay_type'];
	
		$data['amount']			=	$_POST['amount'];
		
		$data['discount_amount']=	$_POST['discount_amount'];
		
		$data['tot_amt']		=	$_POST['amount']+$_POST['discount_amount'];
		
		$data['description']	=	$_POST['description'];
		
		$data['cheque_dd_no']	=	($_POST['pay_type']=='cash' || $_POST['pay_type']=='Net Banking') ? "-" : $_POST['cheque_dd_no']; 
		
		$data['bank_name']		=	($_POST['pay_type']=='cash' || $_POST['pay_type']=='Net Banking') ? "-" : $_POST['bank_name'];
		
		$data['cheque_dd_date']	=	($_POST['pay_type']=='cash' || $_POST['pay_type']=='Net Banking') ? "0000-00-00" :date('Y-m-d',strtotime($_POST['cheque_dd_date']));
		
		
		if($_POST['mode']=='add')
		{
			$data['status']			=	'Active';
			
			$data['create_date']	=	date('Y-m-d h:i:s');
			
			$data['update_date']	=	date('Y-m-d h:i:s');	
		
			$this->comman_fun->additem($data,'fee_income_master');
			
			$this->session->set_flashdata("success", "Record Insert Successfully.....");
			
		}
		if($_POST['mode']=='edit')
		{
			
			$data['update_date']	=	date('Y-m-d h:i:s');	
			
			$this->comman_fun->update($data,'fee_income_master',array('id'=>$_POST['eid']));
			
			$this->session->set_flashdata("success", "Record Update Successfully.....");
		}
		
		
		$this->fee_calculation($_POST['usercode'],$_POST['suid'],$_POST['invoice_no']);
			
	}
	
	function fee_calculation($usercode,$suid,$invoice_no){
		
		
		$record	=	$this->comman_fun->get_table_data('invoice_master',array('invoice_id'=>$invoice_no,'usercode'=>$usercode,'sub_uid'=>$suid,'bill_paid'=>'No'));
		
		$total_amt=$record[0]['total_amt'];
		
		$total_due_amt=$record[0]['due_amount'];
		
		if($total_amt!=$total_due_amt){
			
			$post_amt=$_POST['amount']+$_POST['discount_amount'];
			
			$due_amount=$total_due_amt-$post_amt;
			
			if($total_due_amt==$post_amt){
			//if($total_due_amt==$_POST['amount']){	
			
				$udata['bill_paid']='Yes';

			}
			
		}else{
			
			$post_amt=$_POST['amount']+$_POST['discount_amount'];
			
			$due_amount=$total_amt-$post_amt;
			//$due_amount=$total_amt-$_POST['amount'];
			
			if($total_amt==$post_amt){
			//if($total_amt==$_POST['amount']){	
			
				$udata['bill_paid']='Yes';

			}
			
		}
		
		$udata['due_amount']=$due_amount;
		
	
		$this->comman_fun->update($udata,'invoice_master',array('invoice_id'=>$invoice_no,'usercode'=>$usercode,'sub_uid'=>$suid));
		
		
		//$result_due_price = $this->ObjM->get_due_amt($usercode,$suid);
		//echo $this->db->last_query();
		//$sub_data['due_amount']=$result_due_price[0]['tot_due_amt'];
		//echo "<br>";
		
		//var_dump($result_due_price);exit;
		//$this->comman_fun->update($sub_data,'sub_membermaster',array('usercode'=>$usercode,'id'=>$suid));
		
		
	}
	
	function get_price($eid){
		
			$result_price = $this->ObjM->get_price_by_invoice($eid);
			
			echo $result_price[0]['due_amount'];
	
	}

	function status_update($st,$eid){
		
		$record	=	$this->comman_fun->get_table_data('fee_income_master',array('id'=>$eid));
		
		$data['status'] = $st;
		
		$this->comman_fun->update($data,'fee_income_master',array('id'=>$eid));
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Status '.$st.' Successfully.....'));
		
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		
		
	}
	
	
	
	function delete_record($eid){
		
		$record	=	$this->comman_fun->get_table_data('fee_income_master',array('id'=>$eid));
		
		$record_invoice	=	$this->comman_fun->get_table_data('invoice_master',array('invoice_id'=>$record[0]['invoice_no']));
		
		$data['status'] = 'Delete';
	
		$this->comman_fun->update($data,'fee_income_master',array('id'=>$eid));
		
		$amt=$record_invoice[0]['due_amount']+$record[0]['amount']+$record[0]['discount_amount'];
		
		$data_im['due_amount'] = $amt;
		
		$data_im['bill_paid'] = 'No';
		
		$this->comman_fun->update($data_im,'invoice_master',array('invoice_id'=>$record[0]['invoice_no']));
		
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Delete Successfully.....'));
		
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view/".$record[0]['usercode']."/".$record[0]['sub_uid']);
		
	}
	
	
	function print_order($eid,$usercode,$sub_uid){
	
		$data['invoice_master']	=	$this->comman_fun->get_table_data('fee_income_master',array('id'=>$eid,'status'=>'Active'));	
		
		$data['invoice_date']	=	$this->comman_fun->get_table_data('invoice_master',array('invoice_id'=>$data['invoice_master'][0]['invoice_no'],'status'=>'Active'));
		
		//$data['user_details']	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$usercode));
		
		$data['user_details']	=	$this->comman_fun->get_table_data('sub_membermaster',array('usercode'=>$usercode,'id'=>$sub_uid));
		
		//$data['invoice_det']	=	$this->comman_fun->get_table_data('invoice_details',array('invoice_id'=>$eid));
		
		$data['rs_in_words']	=	$this->no_to_words(round($data['invoice_master'][0]['tot_amt']));
	
		$this->load->view('comman/topheader');
		
		$this->load->view('admin/payment_reciept',$data);
	
		
	}
	
	function no_to_words($no)
	{   
			 $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fourteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
				if($no == 0){
					return ' ';
				}else {
					
					$novalue='';
					$highno=$no;
					$remainno=0;
					$value=100;
					$value1=1000; 

						while($no>=100){
							
							if(($value <= $no) &&($no  < $value1)){
								
								$novalue=$words["$value"];
								
								$highno = (int)($no/$value);
								
								$remainno = $no % $value;

								break;
							}
							
							$value= $value1;
							
							$value1 = $value * 100;
							
						} 
					
					  if(array_key_exists("$highno",$words)){
						  
						  return $words["$highno"]." ".$novalue." ".$this->no_to_words($remainno);
						  
					  }else{
						  
						 $unit=$highno%10;
						  
						 $ten =(int)($highno/10)*10;  
						  
						 return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".$this->no_to_words($remainno);
					   }
				}
	}
	
	
	
}


