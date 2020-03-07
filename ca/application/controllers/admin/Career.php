<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Career extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_admin()){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		
		//ob_start();
		
		//ob_end_flush();
		
		
		
 	}
	
	public function view(){
		
		$data['html']		=	$this->listing();
		
		$page_info['menu_id']		=	'menu-career';
		
		$page_info['page_title']	=	'career';
		
		
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function listing(){
		
		
		$result=$this->comman_fun->get_table_data('career_master');
		
		$html='';
		
		for($i=0;$i<count($result);$i++){
				
			if($result[$i]['upload_file']!=""){
				$file='<a href="'.base_url().'upload/web/doc/'.$result[$i]['upload_file'].'" download>Download Here.!</a>';
			}else{
				$file='-';
			}
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['name'].'</td>
						<td>'.$result[$i]['email'].'</td>
						<td>'.$result[$i]['phone'].'</td>
						<td>'.$result[$i]['message'].'</td>
						<td>'.$file.'</td>
						<td>'.date('d-m-Y',strtotime($result[$i]['create_date'])).'</td>
						<td><a class="delete_record" href="'.file_path('admin').''.$this->uri->rsegment(1).'/delete_record/'.$result[$i]['id'].'">Delete</a></td>
					</tr>';
		}		
		
		return $html;
		
	
	}
	
	
	function delete_record($eid){
		
		$this->comman_fun->delete('career_master',array('id'=>$eid));
		
		
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		
	}
	
	
}


