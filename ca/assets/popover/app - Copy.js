
$(document).on('focus', '.notifiction-popover', function (e) {
		
		var url = $(this).attr('href');
		
		$(this).webuiPopover('destroy'); // the trick
		
		$(this).webuiPopover({
				
				width:340,
				
				padding:false,
				
				animation:'pop',
				
				trigger:'click',
				
				type:'async',//content type, values:'html','iframe','async'
				
				url: url
				
		}); 
			
});


		
		
	
$(document).on('focus', '.who-likes-popover', function () {
		
		var url = $(this).attr('href');
		
		//$(this).webuiPopover('destroy'); // the trick
		
		$('.webui-popover').remove();
		
		$('a .who-likes-popover').webuiPopover('destroy');
		
			$(this).webuiPopover({
				
				width:340,
				
				cache:false,

				padding:false,
				
				animation:'pop',
				
				trigger:'click',
				
				type:'async',//content type, values:'html','iframe','async'
				
				url: url
				
		}); 
			
});
	
	

