
window.onload = populateInitialFeeds;

function populateInitialFeeds(){
	populateInitialRSS();
	initDescription();
}

function focusedText(item) {
    item.style.color = "#333";
}
            
function blurText(item) {
    item.style.color = "#888";
    if(item.value == ""){
        item.value = item.defaultValue;
    }
}
function searchFieldDisplay(item){
    if(item.value == item.defaultValue ){//} || item.value =="search for"){
        item.value = "";
    }
}

function initDescription(){ // so that only 1 click handler is assigned
	var $min = $("ul.article-list");
	$min.on('click','div.art-desc', function(){
    			$this = $(this);
    			var $description = $this.find("p");
    			if( $this.hasClass("expand")){
    				$this.parent().removeClass("expand");
    				$this.removeClass("expand");
    			}else{
    				$this.parent().addClass("expand");
    				$this.animate($this.addClass("expand"), 1000, null);
    			}
    });
    $( "#RSSModule" ).sortable();
    $( "#RSSModule" ).disableSelection();
}
function getRSS(Feed){
	var URL = "../public/showfeed/showRSS?URL=" + Feed.id;
	var $min = $("ul.article-list");

	$.ajax({
		type:"GET",
	    url: "../public/showfeed/showRSS",
	    data:{
	    	URL : ""+Feed.id
	    },
	  	dataType: "xml",
	    success: function(data){
	    	var xml;
	    	if (typeof data == "string") {
	    		xml = new ActiveXObject("Microsoft.XMLDOM");
	        	xml.async = false;
	       		xml.loadXML(data);

	     	} else {
	       		xml = data;
	     	}
	     	var $xmlitems = $(xml).find("item");
	    		$xmlitems.each(function() {
		         var $this = $(this),
		            item = {
		                title: $this.find("title").text(),
		                link:$this.find("link").text(),
		                description: $this.find("description").text(),
		                pubDate: $this.find("pubDate").text().substr(0,22),
		                author: $this.find("author").text()
		        	}
		        	if(item.link === ""){
		        		item.link = "#";
		        	}
		        	$min.append(" <li>\
		        						<div>\
		        							<a href= '"+item.link+"' class ='art-title' >"+item.title+"</a>\
		        							<span class = 'art-date'>"+item.pubDate+"</span>\
		        							<span>"+item.author+"</span>\
		        							<div class = 'art-desc'>"+item.description+"</div>\
		        						</div>\
		        					</li>");
		    	});
				$min.find('li>div').addClass("article");
		        $min.find('di').addClass("art-desc");
				$('.progress').hide();
				$min.slideDown();
	   }
	 });
}
function populateInitialRSS(){
	var RSSFeeders = document.getElementById('RSSModule').getElementsByTagName('a');
	var Feed = RSSFeeders[1];

	//add selection highlight
	$(Feed).addClass('selected');

	//adds swirly vortex of waiting
	var $title = $("#ArticleModule");
	$title.append("<p class = 'progress' >Loading Articles...</p>");
	$title.append("<img class = 'progress' src=../public/img/loader-bar.gif class=center>");
	$('.progress').show();
	getRSS(Feed);
}

function getRSSWrapper(feed){
	//adds selection highlight
	$('.feed-title').removeClass('selected');//removes selection from all other titles
	$(feed).addClass('selected'); //adds selection to current title

	//adds swirly vortex of waiting
	$('.progress').show();

	var $min = $("ul.article-list");
	$min.html("");//clear all current articles
	$min.slideUp();
	getRSS(feed);//get new feed
}
