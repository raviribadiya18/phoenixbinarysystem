<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_invoice extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_admin()){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		
		
   		$this->load->model('admin/Client_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

		
 	}
	
	public function view(){
		

		$data['html']		=	$this->listing();

		$page_info['menu_id']		=	'menu-client';
		
		$page_info['page_title']	=	'Client';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function listing(){
	
	
		$result=$this->ObjM->getAll_client();
		
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
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['company_name'].'</td>
						<td>'.$result[$i]['username'].'</td>
						<td>'.$result[$i]['password'].'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td>'.$result[$i]['city'].'</td>
						<td>'.$result[$i]['amount'].'</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle '.$cls.' btn_custom" data-toggle="dropdown">'.$current_status.' <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right">
							<li><a href="'.file_path('admin').'change_account/member/'.$result[$i]['usercode'].'">Swap to Client Account</a></li>
							<li><a class="status_change" href="'.file_path('admin').'sub_client/view/'.$result[$i]['usercode'].'">Add Member</a></li>
							<li><a class="status_change" href="'.file_path('admin').''.$this->uri->rsegment(1).'/status_update/'.$update_status.'/'.$result[$i]['usercode'].'">'.$update_status.'</a></li>
							<li><a href="'.file_path('admin').''.$this->uri->rsegment(1).'/addnew/edit/'.$result[$i]['usercode'].'">Edit</a></li>';
							
							$html.='<li><a class="delete_record" href="'.file_path('admin').''.$this->uri->rsegment(1).'/delete_record/'.$result[$i]['usercode'].'">Delete</a></li>';
							
							
						$html.='</ul>
						</div>
						
						</td>
					</tr>';
		}		
		
		return $html;
	}
	
	function addnew($mode=NULL, $eid=NULL){
		
		
		if($mode=='edit')
		{
			$data['form_set']	=	array('mode'=>'edit','eid'=>$eid);
			
			$data['result']		=	$this->ObjM->get_record($eid);
			
		}else{
			$data['form_set']=array('mode'=>'add');
			
		}
	
		
		$page_info['menu_id']		=	'menu-client';
		
		$page_info['page_title']	=	'Client';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);;

		$this->load->view('admin/'.$this->uri->rsegment(1).'_add',$data);
		
		$this->load->view('comman/footer_admin');
		
	}
	
	
	
	
	
	function print_order($eid){
	
		//$data['order']	=	$this->comman_fun->show_where("order_master",array('id' =>$eid));
		//$data['customer']	=	$this->comman_fun->show_where("customer_master",array('id' =>$data['order'][0]['cus_code']));
		//$data['order_det']	=	$this->ObjM->order_det($eid);
		
		//$data['seller']		=	$this->comman_fun->show_where("company_profile_master",array('status' =>'Active'));
		//$data['rs_in_words']	=	$this->no_to_words(round($data['order'][0]['total']));
	
		//$this->load->view('comman/topheader');
		
		$this->load->view('comman/topheader');
		
		$this->load->view('admin/print_invoice',$data);
	
		//$this->load->view('comman/footer_admin');	
		
	}
	
	function print_orderjm(){
	
		//$data['order']	=	$this->comman_fun->show_where("order_master",array('id' =>$eid));
		//$data['customer']	=	$this->comman_fun->show_where("customer_master",array('id' =>$data['order'][0]['cus_code']));
		//$data['order_det']	=	$this->ObjM->order_det($eid);
		
		//$data['seller']		=	$this->comman_fun->show_where("company_profile_master",array('status' =>'Active'));
		//$data['rs_in_words']	=	$this->no_to_words(round($data['order'][0]['total']));
	
		//$this->load->view('comman/topheader');
		
		$this->load->view('comman/topheader');
		
		$this->load->view('admin/print_invoicejmm');
	
		//$this->load->view('comman/footer_admin');	
		
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


