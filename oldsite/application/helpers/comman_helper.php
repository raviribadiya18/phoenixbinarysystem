<?php

defined('BASEPATH') OR exit('No direct script access allowed');



if ( ! function_exists('asset_path'))
{
	function asset_path($path=NULL){
		return base_url().'assets/'.$path;
	}	
}


if ( ! function_exists('file_path'))
{
	function file_path($eid=NULL)
	{
		if ($eid != '') {
      		return base_url().'index.php/'.$eid.'/';
    	}
		else
		{
      		return base_url().'index.php/';
    	}
		
	}
}

