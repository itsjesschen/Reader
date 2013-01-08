
window.onload = populateInitialFeeds;

function populateInitialFeeds(){
	populateInitialTweets();
	populateInitialRSS();
}
document.getElementById('RSSModule').onclick= function(e){
		var cur = e.target.name;
	if( cur && ( cur.indexOf("http") !== -1)){
		console.log('got into loadhttp function : ' + e.target.name);
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
document.getElementById('TweeterModule').onclick = function addTweets(e){
	if(e.target.name === "Clickable"){
		console.log("Clicked on this link:" + e.target.id);
		var URL ;	   
		if( e.target.innerHTML === 'Show less'){
			URL = "../showfeed/showtweets?USERID=" + e.target.id + "&NUM=3";
		}else{
	   		URL = "../showfeed/showtweets?USERID=" + e.target.id + "&NUM=25";
		}
		getTwitter(URL, e.target.id);
	}
	e.preventDefault();
};
function getRSS(ID, NUM){
	var URL = "../showfeed/showRSS?URL=" + ID + "&NUM=" + NUM;
	var min = document.getElementById(ID + '_min');
	var max = document.getElementById(ID + '_max');
	if(NUM === 3){//going to minimize feed
		console.log("here!");
		max.innerHTML = "<img src=../img/ajax-loader_pink.gif class=center>";
		min.innerHTML = "<img src=../img/ajax-loader_pink.gif class=center>";
	}else{
		min.innerHTML = "<img src=../img/ajax-loader_pink.gif class=center>";
	}
	var xhr = new XMLHttpRequest();
	xhr.open('GET', URL, true);
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			if(NUM === 3 ){//for minimize feeds
				$(max).slideUp('fast').html();
				min.innerHTML = xhr.responseText;
				max.innerHTML="";
				$(min).slideDown('slow');
				min.setAttribute('class','');
				max.setAttribute('class', 'hidden');
			}
			else{//for max amount of feeds
				$(min).slideUp('fast');
				max.innerHTML = xhr.responseText;
				min.innerHTML ="";
				$(max).slideDown('slow');
				min.setAttribute('class','hidden');
				max.setAttribute('class', 'show');
			}
		}else if (xhr.status >= 400){
			console.log('There was an error!');
		}
	}
	xhr.send(null);
}
function getTwitter(URL,ID) {
	var xhr = new XMLHttpRequest();
	xhr.open('GET', URL, true);
	div =document.getElementById(ID+'_min');
	div.innerHTML = "<img src=../img/ajax-loader_blue.gif class=center>";	

	xhr.onreadystatechange = function(){
		//console.log(xhr.responseText);
		if(xhr.readyState === 4 && xhr.status === 200){
			div =document.getElementById(ID+'_min');
			$(div).slideUp(20);
			$(div).html(xhr.responseText);
			$(div).slideDown('slow');
			//console.log(document.getElementById('Tweets'));
		}else if (xhr.status >= 400){
			console.log("there was an error!");
		}
	}
	xhr.send(null);
}
function populateInitialTweets(){
	var Tweeters = document.getElementById('TweeterModule').getElementsByTagName('a');
	for(var i = 0; i< Tweeters.length;  i++){
		var URL = "../showfeed/showtweets?USERID=" + Tweeters[i].id + "&NUM=3";
		getTwitter(URL, Tweeters[i].id);
	}

}
function populateInitialRSS(){
	console.log(document.URL);
	var RSSFeeders = document.getElementById('RSSModule').getElementsByTagName('a');
	var ID;
	for(var i = 0; i< RSSFeeders.length;  i++){
		ID = RSSFeeders[i].id;
		console.log(ID);
		getRSS(ID, 3);
	}
}

 $(".ArticleList.li").mouseenter(
 	  function(e) { console.log($(this));$(this).children(".date").show("slide"); }).mouseleave(
 	  function() { $(this).children(".date").hide("slide"); });
