$(document).ready( function() {	
	
	$('#global-container').css('left', '-275px');
	$('#side-bar').css('opacity', '0.1');
	
	setTimeout(function(){
		$('#global-container').animate({
		    left: '0',
		}, 800, function() {
		    
		});
		$('#side-bar').animate({
		    opacity: 1,
		}, 2000, function() {
		    
		});
	}, 500);
	
	$('#footer').show('drop', 1000);
	
});// end ready()

/**
 * 
 * @param href
 * @param options  optional
 * @returns
 */
var ajaxRedirect = function(href, element) {
	
	// show Loader image
	showAjaxLoader();
	
	// show effect boolean
	var showEffect = true;
	
	// check if the effect is disabled
	if($(element).length !== 0) {
		if($(element).hasClass('no-effect'))
			// disable effect
			showEffect = false;
	}
	
	// check if element has the no-effect class
	if( element) {
		if($(element).hasClass('no-effect'))
			showEffect = false;
	}
	
	// check showEffect value
	if(showEffect == true){
	
		// check if element exists
		if($('#content-inside').length !== 0){
			$('#content-inside').hide('drop', 250, function(){
				
				//Call AJAX request
				ajaxRedirectRequest(href, showEffect);
			});
		} else {

			//Call AJAX request
			ajaxRedirectRequest(href, showEffect);
		}
	}
	else
		ajaxRedirectRequest(href, showEffect);
	
	// prevent normal rendering
	return false;
	
};// end ajaxRedirect

/**
 * 
 * @param href
 * @returns
 */
var ajaxRedirectRequest = function(href, showEffect) {
	
	$.ajax({
	 	url: href,
		dataType: 'json',
		success: function(data) {
			
			// set content
			$('#content').html(data.content);

			// gide loader image
			hideAjaxLoader();
		},
		error: function( xhr ) {
			$('#content').html(xhr.responseText);
			
			// hide loader image
			hideAjaxLoader();
		},
		complete: function(){
			if(showEffect == true)
				$('#content-inside').show('drop', 200);
		}
	});
};

/**
 * 
 * @returns
 */
var showAjaxLoader = function(){
	$('.loader').css('display', 'block');
};

/**
 * 
 * @returns
 */
var hideAjaxLoader = function() {
	$('.loader').css('display', 'none');
};

