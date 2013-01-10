<?php

require 'remoteconnector.php';
class RSS extends RemoteConnector{

	//gets most current articles from inputted RSS URL 
	public static function getArticles($url, $num){

		$content = file_get_contents($url);
		$xelement = new SimpleXmlElement($content);
		return $xelement->asXML();
		// $html = "<ul class = ArticleList>";
		// foreach($RSSFeed as $homepage) {
		// 	$channel = $homepage->channel; 
		// 	$length = sizeof($channel->item);
		// 	if($length<$num){
		// 		$num = $length;
		// 	}
		// 	//$html = $html."<h2>".$channel->title."'s Recent Articles</h2>";
		// 	if($num === '3'){
		// 		$html = $html."<li><a href = '#' id='$url' name='Clickable' class='additional'>Show +".($length-3)."</a></li>";
		// 	}else{
		// 		$html = $html."<li><a href = '#' id='$url' name='Clickable' class='additional'>Show Less</a></li>";
		// 	}
		// 	for($i=0; $i < $num; $i++){
		// 		$article = $channel->item[$i]; 
		// 		$html = $html."<hr>";
		// 		$html = $html."<li class = detail name='hover'>";
		// 		$date = substr($article->pubDate, 4,12) ;
		// 		$html = $html."<p class=date>".$date."</p>";
		// 		$html = $html."<a href ='#' name = '$article->link' title='$article->title'>".$article->title."</a>";
		// 		if(strpos($article->description, 'youtube') ){
		// 			$html = $html."<div class = hidden>Cannot Retrieve Article Description(Video Embedded)</div>";
		// 		}else{
		// 			$html = $html."<div class = hidden>".$article->description;
		// 		}
		// 			$html = $html."<a href ='$article->link' class='htmlpage' title='$article->title'> (Full Article)</a>";
		// 		$html = $html."</div></li>";
		// 	}
		// }
		// $html = $html.'</ul>';
		// return $html;
	}
	public static function getPage($url){
		$contents = file_get_contents($url);

		dd($contents);
	}
}

