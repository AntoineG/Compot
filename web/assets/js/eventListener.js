$(document).ready( function() {
	
	/*
	* Select items
	*/
	//Get search box
	//var searchBox = $('form ul[id=city-search]');
	
	//Get city field guest
	var cityFieldGuest = $('form #guest_city');

	//Get codePostal field guest
	var postalCodeFieldGuest = $('form #guest_postalCode');
	
	//Get city field
	//var cityFieldProspect = $('form #prospect_city');

	//Get codePostal field
	//var postalCodeFieldProspect = $('form #prospect_postalCode');
	
	/*
	* Values
	*/
	var cityFieldValue = cityFieldGuest.val();
	/*
	* Event Listeners
	*/
	postalCodeFieldGuest.blur(function(){
		autocompleteFromPC(cityFieldGuest, postalCodeFieldGuest);
	});
	cityFieldGuest.keyup(function(e){
		
		//Call function only if city field value has changed and if key pressed isn't 'enter'
		if(cityFieldValue != cityFieldGuest.val() && e.keyCode != 13){
			
			//Call function (live search)
			searchCities(cityFieldGuest.val());
			
			//Set new value
			cityFieldValue = cityFieldGuest.val();
		}
	});
	cityFieldGuest.blur(function(){
		autocompleteFromCity(cityFieldGuest, postalCodeFieldGuest);
		searchCitiesClose(cityFieldGuest);
	});
	
	//onClick row search cities
	$('form ul[id=city-search] .row').live('click', function() {
		
		//Get selected row's value
		var value = $(this).html();
		
		//Populate city field
		cityFieldGuest.val(value);
		
		//Autocomplete postal code from city
		autocompleteFromCity(cityFieldGuest, postalCodeFieldGuest);
		
		//Close
		searchCitiesCloseForce();
	});
	
	//Key arrow up and down on searchBox
	/*
	* (Max shown result = 10)
	*/
	//Keydown or keypress depending on browser support
	if ($.browser.mozilla) {
	    cityFieldGuest.keypress (checkKey);
	} else {
	    cityFieldGuest.keydown (checkKey);
	}
	function checkKey(e){
		
		var selectedItem = $('form ul[id=city-search] .selected');
		
		var previousItem = null;
		
		var nextItem = null;
		
		switch(e.keyCode) {
			//Key Up
			case 38:
				
				//Set previous item (currently selected)
				previousItem = selectedItem;
				
				//Set next item (the one that will be selected)
				nextItem = selectedItem.prev();
				
				//Only perform action is the item exists
				if(nextItem.length !== 0) {
					
					//Remove selected class from previous item
					previousItem.removeClass('selected');
					
					//Add it to the current one
					nextItem.addClass('selected');
				}
				
			return false;
			break;
			
			//Key Down
			case 40:
				
				//Set previous item (currently selected)
				previousItem = selectedItem;
				
				//Set next item (the one that will be selected)
				nextItem = selectedItem.next();
				
				//Only perform action is the item exists
				if(nextItem.length !== 0) {
					
					//Remove selected class from previous item
					previousItem.removeClass('selected');
					
					//Add it to the current one
					nextItem.addClass('selected');
				}
				
			return false;
			break;
			
			//Enter
			case 13:
				
				//Set value
				cityFieldGuest.val(selectedItem.html());
				
				//Autocomplete postal code from city
				autocompleteFromCity(cityFieldGuest, postalCodeFieldGuest);
				
				//Close search cities
				searchCitiesCloseForce();
				
			return false;
			break;
		}
		
	}
	
});