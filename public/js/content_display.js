
window.onload = populateInitialFeeds;

function populateInitialFeeds(){
	// populateInitialTweets();
	populateInitialRSS();
	initDescription();
}

function deleteLinks(){

}

function initDescription(){ // so that only 1 click handler is assigned
	var $min = $("ul.article-list");
	$min.on('click','div', function(){
    			$this = $(this);
    			var $description = $this.find("p");
    			if( $description.hasClass("expand")){
    				$description.removeClass("expand");
    				$this.removeClass("expand");
    				// $description.slideUp();
    			}else{
    				$description.addClass("expand");
    				$this.animate($this.addClass("expand"), 1000, null);
    				// $description.slideDown();
    			}
    });
    $( "#RSSModule" ).sortable();
    $( "#RSSModule" ).disableSelection();
}
function getRSS(Feed){
	var URL = "../showfeed/showRSS?URL=" + Feed.id;
	var $min = $("ul.article-list");

	var xhr = new XMLHttpRequest();
	xhr.open('GET', URL, true);
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			var xml = xhr.responseText;
			// console.log(xml);
			var $xmlitems = $(xml).find("item");

    		$xmlitems.each(function() {
	         var $this = $(this),
	            item = {
	                title: $this.find("title").text(),
	                link: $this.find("link").text(),
	                description: $this.find("description").text(),
	                pubDate: $this.find("pubDate").text(),
	                author: $this.find("author").text()
	        	}
	        	console.log(this);
	        	if(item.link === ""){
	        		item.link = "#";
	        	}
	        	$min.append(" <li>\
	        						<div>\
	        							<a href= '"+item.link+"' class ='art-title' >"+item.title+"</a>\
	        							<span class = 'art-date'>"+item.pubDate+"</span>\
	        							<span>"+item.author+"</span>\
	        							<p class = 'art-desc'>"+item.description+"</p>\
	        						</div>\
	        					</li>");
	        	$min.find('div').addClass("article");
	    	});

			$('#ArticleModule').find("img").hide();
    		// $min.find("p").hide();//hide description
			$min.slideDown();
		}else if (xhr.status >= 400){
			console.log('There was an error!');
		}

	}
	xhr.send(null);
}
function populateInitialRSS(){
	var RSSFeeders = document.getElementById('RSSModule').getElementsByTagName('a');
	var Feed = RSSFeeders[0];

	//add selection highlight
	$(Feed).addClass('selected');

	//adds swirly vortex of waiting
	var $title = $("#ArticleModule");
	$title.append("<img src=../img/loader-bar.gif class=center>");
	$title.find("img").show();

	getRSS(Feed);
}

function getRSSWrapper(feed){
	//adds selection highlight
	$('.feed-title').removeClass('selected');//removes selection from all other titles
	$(feed).addClass('selected'); //adds selection to current title

	//adds swirly vortex of waiting
	$('#ArticleModule').find("img").show();

	var $min = $("ul.article-list");
	$min.html("");//clear all html already in
	$min.slideUp();
	getRSS(feed);
}