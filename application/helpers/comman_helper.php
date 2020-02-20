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


if ( ! function_exists('upload_path'))
{
	function upload_path(){
		return base_url().'upload/';
	}	
}


if ( ! function_exists('media_path'))
{
	function media_path($folder=NULL) 
	{
		$path = FCPATH.'upload/media/';  
		return $path;
	}
}





if ( ! function_exists('filter_data')){
	
	function filter_data( $data ){
		
		$CI 	=	& get_instance();
		
		if (is_array($data)){
			
			foreach ($data as $key => &$value){
				
   				$value = stripslashes($value);
		
   				$value = htmlspecialchars($value);
				
				$value = strip_tags($value);
				
				$data[$key] = $value;
				
			}
		}else{
		
			$data = stripslashes($data);
			
			$data = htmlspecialchars($data);
			
			$data = strip_tags($data);
		
		}
		
		$data = $CI->security->xss_clean($data);
		
  	    return $data;
	}
}

if ( ! function_exists('filter_tag')){
	
	function filter_tag( $text )
	{
		// PHP's strip_tags() function will remove tags, but it
		// doesn't remove scripts, styles, and other unwanted
		// invisible text between tags.  Also, as a prelude to
		// tokenizing the text, we need to insure that when
		// block-level tags (such as <p> or <div>) are removed,
		// neighboring words aren't joined.
		$text = preg_replace(
			array(
				// Remove invisible content
				'@<head[^>]*?>.*?</head>@siu',
				'@<style[^>]*?>.*?</style>@siu',
				'@<script[^>]*?.*?</script>@siu',
				'@<object[^>]*?.*?</object>@siu',
				'@<embed[^>]*?.*?</embed>@siu',
				'@<applet[^>]*?.*?</applet>@siu',
				'@<noframes[^>]*?.*?</noframes>@siu',
				'@<noscript[^>]*?.*?</noscript>@siu',
				'@<noembed[^>]*?.*?</noembed>@siu',
	
				// Add line breaks before & after blocks
				'@<((br)|(hr))@iu',
				'@</?((address)|(blockquote)|(center)|(del))@iu',
				'@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
				'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
				'@</?((table)|(th)|(td)|(caption))@iu',
				'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
				'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
				'@</?((frameset)|(frame)|(iframe))@iu',
			),
			array(
				' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
				"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
				"\n\$0", "\n\$0",
			),
			$text );
	
		// Remove all remaining tags and comments and return.
		$text =  strip_tags($text);
	
		return getUrls(nl2br($text));
	}
}


if(!function_exists('is_valid_password_pattern'))
{
	function is_valid_password_pattern($password)
	{
		
		$uppercase 		= preg_match('@[A-Z]@', $password);
		$lowercase 		= preg_match('@[a-z]@', $password);
		$number    		= preg_match('@[0-9]@', $password);
		$special_cha 	= preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password);
		
		$min_len	=	6;
		$max_len	=   30; 
		
		if(!$uppercase || !$lowercase || !$number || !$special_cha || strlen($password) < $min_len || strlen($password) > $max_len) {
		 
		 	return FALSE;
		}
		else
		{
			return TRUE;
		}
		
		
	}
	
}