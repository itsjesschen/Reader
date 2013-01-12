
window.onload = populateInitialFeeds;

function populateInitialFeeds(){
	// populateInitialTweets();
	populateInitialRSS();
}

function deleteLinks(){

}
function getRSS(ID, NUM){
	var URL = "../showfeed/showRSS?URL=" + ID + "&NUM=" + NUM;
	var element = ID + '_min';
	var min = document.getElementById(element);
	var max = document.getElementById(ID + '_max');
	if(NUM === 3){//going to minimize feed
		//max.innerHTML = "<img src=../img/ajax-loader_pink.gif class=center>";
		min.innerHTML = "<img src=../img/ajax-loader_pink.gif class=center>";
	}else{
		min.innerHTML = "<img src=../img/ajax-loader_pink.gif class=center>";
	}
	var xhr = new XMLHttpRequest();
	xhr.open('GET', URL, true);
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			try{
				$(min).hide();
				min.innerHTML = xhr.responseText;
				$curList = $('item:not(.article-title)');
				//hides detail of feed except articles
				$('channel').find(':not(item, item title, item pubdate, :last-child)').hide();
				//hides all children 
				$curList.children().hide();
				var length = $('link').length;
					for ( var i = 0; i < length; i++){
						var node = $('link')[i];
						
						if (node && node.nextSibling)node.nextSibling.nodeValue="";
					}
				var length = $('item:not(.article-title) > link').length;
					for ( var i = 0; i < length; i++){
						var node = $('item:not(.article-title) > link')[i];
						
						if (node && node.nextSibling)node.nextSibling.nodeValue="";
					}
				$('item:not(.article-title) > title,item:not(.article-title) >pubdate').show();
				console.log($($curList.addClass('article-title')[2]).addClass('last-item'));
				$curList.slice(3, 100).hide().parent().prepend( $('<item>Show More...</item>').addClass('toggleItem article-title')).click(toggleItems);
				$(min).slideDown();
			}
			catch(err){
				min.innerHTML = "RSS Feed did not respond";
			}
		}else if (xhr.status >= 400){
			console.log('There was an error!');
		}
	}
	xhr.send(null);
}
function toggleItems(){
	$this = $(this).children(':first-child');
	if(!$this.hasClass('expand')){
	     $this.siblings('item:hidden').slideDown().end().addClass('expand').text('Show Less...');
	     $($this.siblings('item')[2]).removeClass('last-item');
	     $this.siblings('item:last').addClass('last-item');
	     console.log('expanded');
	}else{//is expanded, must now contract
		$this.siblings('item').slice(3, 100).slideUp().end();
		$this.removeClass('expand').text('Show More...'); 
		$($this.siblings('item')[2]).addClass('last-item');
		console.log('contracted');
	    }
}
function populateInitialRSS(){
	var RSSFeeders = document.getElementById('RSSModule').getElementsByTagName('a');
	var ID;
	for(var i = 0; i< RSSFeeders.length;  i++){
		ID = RSSFeeders[i].id;
		getRSS(ID, 3);
	}
}

