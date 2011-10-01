// instanciate Class
var addTagObj = new addTag();

/**
 * On document ready
 */
$(document).ready(function(){

	// call function in case of page refreshing
	addTagObj.initialize();	
});

/**
 * @author Tobias Hourst <tobias@strawberrydigital.com.au>
 * @returns {addTag}
 */
function addTag(){
	
	/**
	 * @param  boolean  whether the compulsory city tag exists or not
	 */
	this.isCityTag = false;
	
	/**
	 * @param  boolean  whether the compulsory keyword tag exists
	 */
	this.isKeywordTag = false;
	
	/**
	 * @param  boolean  associated tags are not empty
	 */
	this.isTags = false;
	
	/**
	 * @param  Array  list of existing tags
	 */
	this.tags = new Array();
	
	/**
	 * @pram  Boolean  can be submitted or not
	 */
	this.status = false; 
	
	/**
	 * Constructor
	 */
	this.initialize = function (){
		
		this.showSelectableTags();
		
		this.checkStatus();
		
		this.isSubmit();
	};
	
	/**
	 * 
	 */
	this.isSubmit = function(){
		
		// get submit button
		var submitBtn = $('form button[type=submit]');
		
		if(this.status === true)
			submitBtn.removeAttr('disabled');	
		else
			submitBtn.attr('disabled', 'disabled');			
	};
	
	/**
	 * 
	 */
	this.checkStatus = function(){
		if(this.isCityTag === true && this.isKeywordTag === true && this.isTags){
			this.status = true;
		} else {
			this.status = false;
		}
	};
	
	/**
	 * 
	 * @returns
	 */
	this.showSelectableTags = function(){
	
		// get content 
		var content = $('form #phrase_content').val();
		
		/*
		 * Compuslory tags
		 */
		// filter comp tags
		this.filterCompTags(content);
		
		// inform on city comp tag
		if(this.isCityTag == true){
			$('form div[id=words] .list-comp .city').addClass('set');}
		else
			$('form div[id=words] .list-comp .city').removeClass('set');
		
		// inform on keyword comp tag
		if(this.isKeywordTag == true){
			$('form div[id=words] .list-comp .keyword').addClass('set');}
		else
			$('form div[id=words] .list-comp .keyword').removeClass('set');
		
		/*
		 * Normal tags 
		 */
		// filter tags
		this.filterTags(content);
		
		//init response
		var response = '';
		
		// build response
		for(i in this.tags){
			response += '<li id="id' + i + '">' + this.tags[i] + '<\li>';
		}
		
		// display tags
		$('form div[id=words] .list').html(response);
		
		/*
		 * Display textareas for tags
		 */ 
		// init response
		var response = '';
		
		// build response
		for(var i in this.tags){
			response += '<p>Mots clés associés à <span class="keyword">[' + this.tags[i] + ']</span>:</p>' +
						'<textarea name="random[' + i + ']" id="id' + i + '" class="list-assoc"></textarea>';
		}
		
		// display
		$('form div[id=random-words]').html(response);
		
		// check associated tags
		this.checkAssocTags();
		
		// prevent normal rendering
		return false;
	};
		
	/**
	 * 
	 * @param content
	 * @returns
	 */
	this.filterTags = function(content){
			
		// init regex
		var regex = /\[(.*?)\]/g;
		
		// filtering
		this.tags = content.match(regex);
		
		for(var i in this.tags){
			this.tags[i] = this.tags[i].replace(/\]/, '').replace(/\[/, '');
		}
	};
		
	/**
	* @returns response array  number of *city* and *keyword* found. 
	*/
	this.filterCompTags = function(content){		
		// init regex
		var regexCity = /\*city\*/g, regexKeyword = /\*keyword\*/g;
		
		// init tags
		var tagsCity = content.match(regexCity), tagsKeyword = content.match(regexKeyword);
		
		// init counts
		var tagsCityCount = 0,
			tagsKeywordCount = 0;
		
		if(tagsCity != null)
			tagsCityCount = tagsCity.length;
		
		if(tagsKeyword != null)
			tagsKeywordCount = tagsKeyword.length;
		
		
		if(tagsCityCount > 0 && tagsCityCount < 2)
			this.isCityTag = true;
		else
			this.isCityTag = false;
		
		if(tagsKeywordCount > 0 && tagsKeywordCount < 2)
			this.isKeywordTag = true;
		else
			this.isKeywordTag = false;
	};
	
	/**
	 * 
	 */
	this.checkAssocTags = function(){
		
		// set ttatus to true
		this.isTags = true;
		
		// loop tags
		for(var i in this.tags){
			
			// get current content
			var content = $('form #random-words textarea#id' + i).val();
			
			// check whether it is empty
			if(content != ''){
				$('form div[id=words] .list #id' + i).css('color', 'green');
			} else {
				$('form div[id=words] .list #id' + i).css('color', 'red');
				
				// set status back to false
				this.isTags = false;
			}
				
		}
		
	};
}