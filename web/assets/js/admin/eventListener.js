/**
 * Internal or external state change
 */
var internal = false;

/**
 * 
 * @param bool
 * @returns
 */
var setStateChangeInternal = function(bool){
	internal = bool;
};

/**
 * 
 * @returns
 */
var clearStateChangeInternal = function(){
	internal = false;
};

$(document).ready( function() {
	
	//onClick
	$('a').live('click', function(){
		
		// set internal state change to true
		setStateChangeInternal(true);
		
		// set href attr value
		var href = $(this).attr('href');
		
		History.pushState(null, 'CMS: Comme Au Potager', href);
		
		// call redirect function
		ajaxRedirect(href, this);
		
		return false;
	});
	
	/**
	 * EventListener
	 *  
	 * Enable state change (browser prev/next nav)
	 * 
	 *  @param event
	 */
	$(window).bind('statechange', function(event) {
		
		//Redirect only if not an internal request
		if( ! internal){
			
			//Get state
		    var state = History.getState();
	   	
			//Call redirect function
			ajaxRedirect(state.url);

		    event.preventDefault();
		    return false;
		}
		
		//Clear internal
		clearStateChangeInternal();
	});
	
	/**
	 * 
	 */
	$('form #phrase_content').keyup(function(e){
		// call show selectable tags
		addTagObj.initialize();
		
	});
	
	$('form #random-words textarea').live('keyup', function(e){
		// check associated tags and is submit
		addTagObj.checkAssocTags();
		addTagObj.checkStatus();
		addTagObj.isSubmit();
	});
	
});//End ready()