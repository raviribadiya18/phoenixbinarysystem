<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contain extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_admin()){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		
		ob_start();
		
		ob_end_flush();
		
   		$this->load->model('admin/Contain_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');
		
		
 	}
	
	public function view($eid){
		
		$data['html']		=	$this->listing($eid);
		
		$data['option']		=	$this->comman_fun->get_table_data('web_option',array('contain_name'=>$eid));
		
		$data['all_option']	=	$this->comman_fun->get_table_data('web_option',array('status'=>'Active'));

		$page_info['menu_id']		=	'menu-contain';
		
		$page_info['page_title']	=	'contain';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function listing($eid){
		
		$option		=	$this->comman_fun->get_table_data('web_option',array('contain_name'=>$eid));
		
		$arr_filed	=	json_decode($option[0]['option'],true);
		
		
		
		
		$result=$this->ObjM->getAll($eid);
		
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
				
				
				
				if(in_array('title',$arr_filed['option'])){
					$td_title	=	"<td>".$result[$i]['title']."</td>";
				}
				if(in_array('date',$arr_filed['option'])){
					$timedt				= 	date('jS F Y', $result[$i]['timedt']);
					$td_timedt	=	"<td>".$timedt."</td>";
				}
				if(in_array('image',$arr_filed['option'])){
					$td_image	=	"<td><img src='".base_url()."upload/web/slider/".$result[$i]['img_name']."' height='50' /></td>";
				}
				
				
				
				
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$option[0]['contain_lable'].'</td>
						'.$td_title.'
						'.$td_timedt.'
						'.$td_image.'
						<td><div class="btn-group">
						<button class="btn dropdown-toggle '.$cls.' btn_custom" data-toggle="dropdown">'.$current_status.' <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right">
							<li><a class="status_change" href="'.file_path('admin').''.$this->uri->rsegment(1).'/status_update/'.$update_status.'/'.$result[$i]['code'].'">'.$update_status.'</a></li>
							<li><a href="'.file_path('admin').''.$this->uri->rsegment(1).'/addnew/edit/'.$result[$i]['code'].'">Edit</a></li>';
							if(in_array('addnew',$arr_filed['option'])){
								$html.='<li><a class="delete_record" href="'.file_path('admin').''.$this->uri->rsegment(1).'/delete_record/'.$result[$i]['code'].'">Delete</a></li>';
							}
							
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
			$data['option']=$this->comman_fun->get_table_data('web_option',array('contain_name'=>$data['result'][0]['option_type']));
		}else{
			$data['form_set']=array('mode'=>'add');
			$data['option']=$this->comman_fun->get_table_data('web_option',array('contain_name'=>$eid));
		}
	
		
		$page_info['menu_id']		=	'menu-dashboard';
		
		$page_info['page_title']	=	'Dashboard';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);;

		$this->load->view('admin/'.$this->uri->rsegment(1).'_add',$data);
		
		$this->load->view('comman/footer_admin');
		
	}
	
	function insert()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST'){	
			$this->handle_upload();
			$this->_insert();
			
			echo '<script>window.location.href="'.file_path('admin').''.$this->uri->rsegment(1).'/view/'.$_POST['option_type'].'"</script>';
			header('Location: '.file_path('admin').''.$this->uri->rsegment(1).'/view/'.$_POST['option_type'].'');
			exit;
		}
	}
	
	
	
	protected function _insert(){
		
		$data=array();
	
		$data['title']				=	isset($_POST['title'])   		?	filter_data($_POST['title']) : "";
		$data['timedt']				=	isset($_POST['timedt'])  		?	filter_data(strtotime($_POST['timedt'])) : "";
		$data['description']		=	isset($_POST['description'])    ? 	filter_data($_POST['description']) : "";
		$data['sort_order']			=	isset($_POST['sort_order'])     ? 	filter_data($_POST['sort_order']) : "";
		
		
		
		
		if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name']))
		{
			$data['img_name']		=	$_POST['file_name'];
		}
			
		if($_POST['mode']=='add')
		{
			$data['status']			=	'Active';
			$data['option_type']	=	filter_data($_POST['option_type']);
			$data['create_date']	=	date('Y-m-d h:i:s');
		
			$this->comman_fun->additem(filter_data($data),'web_contain');
			$this->session->set_flashdata("success", "Record Insert Successfully.....");
			
		}
		if($_POST['mode']=='edit')
		{
			
			$data['update_date']	=	date('Y-m-d h:i:s');	
			//old image delete//
			$this->comman_fun->update(filter_data($data),'web_contain',array('code'=>$_POST['eid']));
			if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name']))
			{
				$url='./upload/web/slider/'.$_POST['old_file'];
				$url2='./upload/web/slider/thum/'.$_POST['old_file'];
				unlink($url);
				unlink($url2);
			}
			$this->session->set_flashdata("success", "Record Update Successfully.....");
		}
		
		
			
	}
	
	
	
	function handle_upload()
	{
		if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name']))
		{
				$config = array();
				$config['upload_path'] 				= 	'./upload/web/slider/';
				$config['allowed_types'] 			= 	'jpg|jpeg|gif|png';
				$config['max_size']      			= 	'0';
				$config['overwrite']     			= 	TRUE;
				$config['remove_spaces'] 			= 	TRUE;
				$_FILES['userfile']['name'] 		= 	$_FILES['upload_file']['name'];
				$_FILES['userfile']['type'] 		= 	$_FILES['upload_file']['type'];
				$_FILES['userfile']['tmp_name']		= 	$_FILES['upload_file']['tmp_name'];
				$_FILES['userfile']['error']		= 	$_FILES['upload_file']['error'];
				$_FILES['userfile']['size']			= 	$_FILES['upload_file']['size'];
				$rand = md5(uniqid(rand(), true));
				$fileName							=	$_POST['option_type'].'_'.$rand.''.$_FILES['upload_file']['name'];
				$fileName 							= 	str_replace(" ","",$fileName);
				$config['file_name'] 				= 	$fileName;
				$this->upload->initialize($config);
					
				if ($this->upload->do_upload())
				{
					$upload_data    	= $this->upload->data();
					$_POST['file_name'] = $upload_data['file_name'];
					
					if($_POST['option_type']=="slider"){
						$this->_create_slider($upload_data['file_name'],1349,500);
					}
					$this->_create_thumbnail($upload_data['file_name'],250,250);
					return true;
				}else{
					
					echo $this->upload->display_errors();
				}
		}
		
	}
	
	
	protected function _create_thumbnail($fileName,$width,$height) 
    {
       
        $config['image_library'] 	= 'gd2';
        $config['source_image']  	= media_path().$fileName;       
        $config['create_thumb']  	= TRUE;
        $config['maintain_ratio'] 	= TRUE;
        $config['width'] 			= $width;
        $config['height'] 			= $height;
        $config['new_image'] 		= media_path().'web/slider/thum/'.$fileName;   
		$config['thumb_marker'] 	= '';   
		
        $this->image_lib->initialize($config);
        if(!$this->image_lib->resize())
        { 
            echo $this->image_lib->display_errors();
        }        
    }
	
		
	protected function _create_slider($fileName,$width,$height) 
    {
       
	   
	   
	   
        $config['image_library'] 	= 'gd2';
        $config['source_image']  	= media_path().$fileName;       
        $config['create_thumb']  	= TRUE;
        $config['maintain_ratio'] 	= TRUE;
        $config['width'] 			= $width.'px';
        $config['height'] 			= $height.'px';
        $config['new_image'] 		= media_path().'web/slider/'.$fileName;   
		$config['thumb_marker'] 	= '';   
		
        $this->image_lib->initialize($config);
		
        if(!$this->image_lib->resize())
        { 
            echo $this->image_lib->display_errors();
        }        
    }
	function status_update($st,$eid){
		
		$record	=	$this->comman_fun->get_table_data('web_contain',array('code'=>$eid));
		$data['status'] = $st;
		$this->comman_fun->update($data,'web_contain',array('code'=>$eid));
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Status '.$st.' Successfully.....'));
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view/".$record[0]['option_type']."");
		
		
	}
	
	
	function delete_record($eid){
		$record	=	$this->comman_fun->get_table_data('web_contain',array('code'=>$eid));
		$data['status'] = 'Delete';
		$this->comman_fun->update($data,'web_contain',array('code'=>$eid));
		
		$url='./upload/web/slider/'.$record[0]['img_name'];
		$url2='./upload/web/slider/thum/'.$record[0]['img_name'];
		unlink($url);
		unlink($url2);
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Delete Successfully.....'));
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view/".$record[0]['option_type']."");
		
	}
	
	
	
	
}


