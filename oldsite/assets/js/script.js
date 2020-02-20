/*!
 * 
 * Sylor HTML5 Template v.1.0.0
 * 
 */


jQuery(function($){
	"use strict";


	$('.navbar-toggle').on('click', this, function(){
		$(this).toggleClass('open');
	});
	$('.navbar-toggle-dt').on('click', this, function(){
		
		$('#navbar').toggleClass('open');

	});

	$('.navbar-nav li').has('ul')
		.prepend('<span class="drop-btn"><i class="fa fa-angle-down"></i></span>');

	$('.drop-btn').on('click', this, function(){
		$(this).siblings('ul').toggleClass('open');
	});

	$('.site-search-link').on('click', this, function(){
		$('body').toggleClass('search-opened');
	});

	$('.search-close').on('click', this, function(){
		$('body').removeClass('search-opened');
	});

	/*** scroll handle to scroll to specific section ***/
	$('.scroller-button').on('click', this, function() {
			var target = $('#contents-area');
			$('html, body').animate({
					scrollTop: $(target).offset().top
			}, 1000);
	});


	/*** image block ***/
	$('.block-image, .image-tall, .image-db, .image-tall-min').each(function(){
		var image = $(this).find('img').attr('src');
		$(this).css({'background-image':'url(' + image + ')'});
	});

	/*** Carousel Single ***/
	if ( $('.carousel-single').length) {
		
		$(".carousel-single").each(function() {

			var cSingle = $(this),
				trans = cSingle.data('trans'),
				autoplay = cSingle.data('autoplay'),
				caroPagin = cSingle.data('paginate'),
				autoHeight = cSingle.data('auto-height'),
				caroNext = '.' + cSingle.data('btn-next'),
				caroPrev = '.' + cSingle.data('btn-prev');
			cSingle.owlCarousel({
				autoPlay: autoplay,
				singleItem: true,
				pagination: caroPagin,
				autoHeight : autoHeight,
				transitionStyle: trans,
				addClassActive: true
			});
			$(caroNext).on('click', this, function(e){
				cSingle.trigger('owl.next');
				e.preventDefault();
			});
			$(caroPrev).on('click', this, function(e){
				cSingle.trigger('owl.prev');
				e.preventDefault();
			});
		});
	}

	/*** Carousel Multi ***/
	if ( $('.carousel-multiple').length) {

		$(".carousel-multiple").each(function() {

			var cMulti = $(this),
				mAutoplay = cMulti.data('autoplay'),
				mCaroNext = '.' + cMulti.data('btn-next'),
				mCaroPrev = '.' + cMulti.data('btn-prev');

			cMulti.owlCarousel({
				autoPlay: mAutoplay,
				pagination: false,
				items : 5,
				itemsDesktop : [1200,4],
				itemsDesktopSmall : [992,3],
				itemsTablet: [768,2],
				itemsMobile : [480,1]
			});

			$(mCaroNext).on('click', this, function(){
				cMulti.trigger('owl.next');
			});
			$(mCaroPrev).on('click', this, function(){
				cMulti.trigger('owl.prev');
			});
		
		});
	
	}


	$('.form-group-auto .form-control').on('focus', this, function(){
		$(this).closest('.form-group-auto').addClass('focused');
	});
	$('.form-group-auto .form-control').on('blur', this, function(){
			if ( $(this).val() === '') {
				$(this).closest('.form-group-auto').removeClass('focused');
			}
	});

	$('.action-menu').on('click', this, function(){
		$(this).closest('.action-box').toggleClass('open');
	});

	/**** Magnific Popup
	----------------------------------------------------------------------------- ****/
	
	if ( $('.image-popup').length ) {
		$('.image-popup').magnificPopup({ 
				type: 'image',
				gallery: {
					enabled: true
			    	},
				removalDelay: 500,
				callbacks: {
				beforeOpen: function() {
				   this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				   this.st.mainClass = this.st.el.attr('data-effect');
					}
				},
				closeOnContentClick: true,
				midClick: true

		});	
		$(document).keydown(function(e) {
				if (e.keyCode == 27) {
							$.magnificPopup.close();
				}
		});
	}

});
