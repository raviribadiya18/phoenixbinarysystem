<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_invoices extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 

		
		if(!is_login('client')){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        } 

   		$this->load->model('client/My_invoices_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

 	}
	
	public function index()
	{
		
		$this->view();
		
	}
	
	public function view($sub_uid=NULL){
		
		
		$data['html']		=	$this->listing($sub_uid);
		
		
		$data['all_option']	=	$this->comman_fun->get_table_data('sub_membermaster',array('usercode'=>$this->session->userdata['pbm_client']['usercode'],'status'=>'Active'));
		
		$page_info['menu_id']		=	'menu-myin';
		
		$page_info['page_title']	=	'GST Document List';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_client',$page_info);
		
		$this->load->view('client/my_inovice_list',$data);
		
		$this->load->view('comman/footer_admin');	
			
		
	}
	
	
	
	function listing($sub_uid){
	
		$result=$this->ObjM->get_all_inovice($sub_uid);
		
		$html='';
		
		for($i=0;$i<count($result);$i++){
				
				
			
//				if($result[$i]['is_paid']=="yes"){
					
//						if($result[$i]['upload_file']!=""){
//					
//							$file	=	"<a href='".base_url()."upload/web/itr_doc/".$result[$i]['upload_file']."' download><span style='color:red;font-size:15px;'>Download File Here.</span></a>";
//
//						}else{
//
//							$file	=	"-";
//						}
					
//				}else{
//					
//					$file="<span style='color:red;font-size:15px;'>Please Pay fees to download file.</span>";
//					
//				}
				
				$record_client	=	$this->comman_fun->get_table_data('sub_membermaster',array('id'=>$result[$i]['sub_uid']));
			
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$record_client[0]['fname'].' '.$record_client[0]['lname'].'</td>
						<td><a target="_blank" href="'.file_path('client').''.$this->uri->rsegment(1).'/print_order/'.$result[$i]['invoice_id'].'/'.$result[$i]['usercode'].'/'.$result[$i]['sub_uid'].'">Print Invoice</a></td>
						<td>'.$result[$i]['total_amt'].' /-</td>
						
						<td>'.date('d-M-Y',strtotime($result[$i]['invoice_date'])).'</td>';
					
						$html.='</tr>';
		}		
		
		return $html;
	}
	
	function print_order($eid,$usercode,$sub_uid){
	
		$data['invoice_master']	=	$this->comman_fun->get_table_data('invoice_master',array('invoice_id'=>$eid));
		
		$data['user_details']	=	$this->comman_fun->get_table_data('sub_membermaster',array('usercode'=>$usercode,'id'=>$sub_uid));
		
		$data['invoice_det']	=	$this->comman_fun->get_table_data('invoice_details',array('invoice_id'=>$eid));
		
		$data['rs_in_words']	=	$this->no_to_words(round($data['invoice_master'][0]['total_amt']));
	
		$this->load->view('comman/topheader');
		
		$this->load->view('admin/print_invoice',$data);
	
		
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


