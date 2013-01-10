
window.onload = populateInitialFeeds;

function populateInitialFeeds(){
	// populateInitialTweets();
	populateInitialRSS();
}
document.getElementById('RSSModule').onclick= function(e){
		var cur = e.target.name;
	if( cur && ( cur.indexOf("http") !== -1)){
		//console.log('got into loadhttp function : ' + e.target.name);
		var cur = $(e.target).next();
		// console.log($(e.target).next());
		if (cur.attr('class') === 'hidden'){
			console.log("removes class");
			cur.removeClass('hidden');
		}else{
			console.log("has class");
			cur.addClass('hidden');
		}
		e.preventDefault();
	}
	else if(e.target.name === "Clickable"){
		min = document.getElementById(e.target.id + '_min');
		max = document.getElementById(e.target.id + '_max');
		
		if(max.getAttribute('class') === 'show'){//if it is maxed right now
			var ID= e.target.id;
			console.log(ID);
			getRSS(ID, 3);
		}else{// if( min.getAttribute('class') === 'show'){
			var ID= e.target.id;
			console.log(ID);
			getRSS(ID, 30);	
		}
		e.preventDefault();
	}
};
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
			if(NUM === 3 ){//for minimize feeds
				// $(max).slideUp('fast').html();
				$(min).hide();
				min.innerHTML = xhr.responseText;
				//console.log($('channel').children('description,item, :last'));
				//for RSS 2.0
				$('channel').find(':not(description,item, item title, item pubdate, :last-child)').hide();
				//for RSS 
				//console.log($('channel').find(' item pubdate').show());
				$('item:not(.article)').children().hide();
				var length = $('link').length;
					for ( var i = 0; i < length; i++){
						var node = $('link')[i];
						
						if (node && node.nextSibling)node.nextSibling.nodeValue="";
					}
				var length = $('item:not(.article) > link').length;
					for ( var i = 0; i < length; i++){
						var node = $('item:not(.article) > link')[i];
						
						if (node && node.nextSibling)node.nextSibling.nodeValue="";
					}
				$('item:not(.article) > title, pubdate').show();
				$('item:not(.article)').addClass('article').slice(3, 100).hide();
				$(min).show('slow');
				
				// max.innerHTML="";
				// $(min).slideDown('slow');
				// min.setAttribute('class','');
				// max.setAttribute('class', 'hidden');
			}
			else{//for max amount of feeds
				// $(min).slideUp('fast');
				// max.innerHTML = xhr.responseText;
				// min.innerHTML ="";
				// $(max).slideDown('slow');
				// min.setAttribute('class','hidden');
				// max.setAttribute('class', 'show');
			}
		}else if (xhr.status >= 400){
			console.log('There was an error!');
		}
	}
	xhr.send(null);
}
function populateInitialRSS(){
	var RSSFeeders = document.getElementById('RSSModule').getElementsByTagName('a');
	var ID;
	for(var i = 0; i< RSSFeeders.length;  i++){
		ID = RSSFeeders[i].id;
		//console.log(ID);
		getRSS(ID, 3);
	}
}

 $(".ArticleList.li").mouseenter(
 	  function(e) { console.log($(this));$(this).children(".date").show("slide"); }).mouseleave(
 	  function() { $(this).children(".date").hide("slide"); });
