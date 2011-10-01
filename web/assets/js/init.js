$(document).ready( function() {
	
	/*
	* Apply content height to 
	* content right gradient border (div).
	*/
	//Get height
	var contentHeight = $('#content').height();
	
	//Apply css rule
	$('#content #right-border').css('height', contentHeight);
	
	/*
	* Apply city field position to
	* live search box.
	*/
	//Get field
	var cityFieldGuest = $('form #guest_city');
	
	if(cityFieldGuest.length != 0){
		
		//Get position
		var cityFieldGuestPos = cityFieldGuest.position();
		
		//Positioning
		$('form #city-search').css('top', cityFieldGuestPos.top + 22);
		$('form #city-search').css('left', cityFieldGuestPos.left);
		
	}
	
	//Set class
	$('form div input[id=user_email]').parent().addClass('emailField');
});
	
	/**
	 * 
	 * @param city
	 * @returns
	 */
	var searchCities = function(city) {
    	
		//Get search box
		var searchBox = $('form ul[id=city-search]');
		
		//Display search box
		searchBox.css('display', 'block');
		
		//Ajax call to get cities begining by the characters typed
		$.ajax({
		 	url: Routing.generate('autocomplete_search_cities'),
			type: "GET",
			data: { city: city },
			success: function( data ) {
				if(data.count > 0)
				{	
					/*
					* Build html
					*/
					//Initialise html var
					var html = '';
				
					//Loop result
					for(var i in data){
						if(i !== 'count'){
							
							//Add 'selected' class to the first row
							if(i == 0)
								var selectedClass = 'selected';
							else
								var selectedClass = '';
								
							//Add row
							html += '<li class="row ' + selectedClass + '">' + data[i]['name'] + '</li>';
						}
							
					}
					
					//Add show more result link
					html += '<li class="show-more"><a href="#">Plus de Résultats</a></li>';
					
					//Replace searchBox content
					searchBox.html(html);
					
				}
				else
				{
					//Clear box
					searchBox.html();
					
					//Hide search box
					searchBox.css('display', 'none');
				}

			},
			error: function(xhr) {
				//$('body').html(xhr.responseText);
			}
		});
		
  	}//End searchCities

	/**
	 * Function that closes search cities
	 * 
	 * @param cityField
	 * @returns
	 */
	var searchCitiesClose = function(cityField) {
		
		//Get search box
		var searchBox = $('form ul[id=city-search]');
		
		//Loop check if mouse over
		searchBox.mouseenter(function(){
		    clearTimeout($(this).data('timeoutId'));
			
			//Only fade in if search box is focus
			if(cityField.is(":focus"))
				searchBox.fadeIn('fast');
			else
				searchBox.fadeOut('fast');
				
		}).mouseleave(function(){
			
			//Only fade out if search box isnt focus
			if( ! cityField.is(":focus")){
		    	var timeoutId = setTimeout(function(){ searchBox.fadeOut("fast");}, 650);
		    	searchBox.data('timeoutId', timeoutId);
			}
		});
		
		//Only fade out if search box isnt focus
		if( ! cityField.is(":focus")){
	    	searchBox.fadeOut("fast");
		}
		
	}//End searchCitiesClose
	
	/**
	 * Function that closes search cities (Force closing)
	 * 
	 * @returns
	 */
	var searchCitiesCloseForce = function() {
		
		//Get search box
		var searchBox = $('form ul[id=city-search]');
		
		//Fade out
		searchBox.css('display', 'none');
		
	}//End searchCitiesCloseForce
	
	/**
	* Show more function (opens popup with all results)
	*/
	var searchCitiesShowMore = function() {
		
		
		
	}
	
	/**
	 * Populate city field from postal code 
	 * 
	 * @param cityField
	 * @param postalCodeField
	 * @returns
	 */
	var autocompleteFromPC = function(cityField, postalCodeField){
	
		//Init city var
		var city = '';
	
		//Init code postal var
		var postalCode = '';

			var url = Routing.generate('autocomplete_postal_code');

		//Get postal code value
		postalCode = postalCodeField.val();
	
		$.ajax({
		 	url: url,
			type: "GET",
			data: { postalCode: postalCode },
			success: function( data ) {
			
				if(data.success == true){
					//Update fields
					cityField.val(data.city);
					postalCodeField.val('0' + data.postalCode);
				
					//Update url
					var newUrl = Routing.generate('search', { keyword: data.keyword, city: data.slug });
					window.history.pushState("object or string", "Title", newUrl);
				
					//Remove error class
					postalCodeField.removeClass('error-field');
					cityField.removeClass('error-field');
				}
				else
				{
					postalCodeField.addClass('error-field');
				}
			},
			error: function(xhr) {
				//$('body').html(xhr.responseText);
				//alert('An unexcepted error occured ! Please contact the administration if the error persists: contact@commeaupotager.fr');
			}
		});
		
	}//End autocompleteFromPC
	
	/**
	 * Populate postal code field from city
	 * 
	 * @param cityField
	 * @param postalCodeField
	 * @returns
	 */
	var autocompleteFromCity = function(cityField, postalCodeField){
	
		var url = Routing.generate('autocomplete_city');

		//Get postal code value
		city = cityField.val();
		
		//Initialise search cities function
		searchCities(city);
		
		$.ajax({
		 	url: url,
			type: "GET",
			data: { city: city },
			success: function( data ) {
				if(data.success == true){
					//Update Fields
					postalCodeField.val('0' + data.postalCode);
					cityField.val(data.city);
					
					//Update url
					var newUrl = Routing.generate('search', { keyword: 'panier-bio', city: data.slug });
					window.history.pushState("object or string", "Title", newUrl);
					
					//Remove error class
					cityField.removeClass('error-field');
					postalCodeField.removeClass('error-field');
				}
				else
				{
					cityField.addClass('error-field');
				}
			},
			error: function(xhr) {
				//$('body').html(xhr.responseText);
				//alert('An unexcepted error occured ! Please contact the administration if the error persists: contact@commeaupotager.fr');
			}
		});
		
	}//End entityFromCity