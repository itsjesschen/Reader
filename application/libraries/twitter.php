<?php
require 'remoteconnector.php';
class Twitter extends RemoteConnector{
	public function __construct(){

	}
	//adds user to database
	public function isUser($username, $realname){
		$userID = urlencode($username);
		$url = "http://api.twitter.com/1/statuses/user_timeline.json?screen_name=$userID";	
		
		//VALIDATE FOR VALID USER??
		$session = curl_init($url);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		$curlOutput = curl_exec($session);
		curl_close($session);
		//dd($curlOutput === true);
		if(strpos($curlOutput, 'error') === false ){
			return $url;
		}
		//return $curlOutput;
		return '';
	}
	
	public static function SearchForUser($userID, $num){
		$userID = urlencode($userID);
		$num = urlencode($num);
		$url = "http://api.twitter.com/1/statuses/user_timeline.xml?screen_name=$userID";
		// if( $num !== '0' ){
		// 	$url = $url."&count=$num";
		// }
		$jsonString = file_get_contents($url);
		//$arrayOfTweets = json_decode($jsonString);
		$arrayOfTweets = new SimpleXmlElement($jsonString);
		$data = array(
			'tweets' => $arrayOfTweets
		);
		//$html = "HTML::style('css/styles.css')";
		$html = "";
		$i=0;
		foreach ( $data as $tweet ){
			$html = $html."<li><h3><img src=".$tweet->status->user->profile_image_url." /><a href = '#' name='Clickable' id='$userID'>".$tweet->status->user->name."</a></h3></li>";//(".$tweet->status->user->screen_name.")
			$html = $html."<ul class=ArticleList>";
			$length = sizeof($tweet->status);
			if ($length < $num){
				$num = $length;
			}
			if( $num <= '3' ){//maximize button
				$html = $html."<li><a href = '#' id='$userID' name='Clickable' class='additional'>Show +".($length-$num )."</a></li>";
			}else{//minimize button
				$html = $html."<li><a href = '#' id='$userID' name='Clickable' class='additional'>Show less</a></li>";
			
			}
			//foreach($tweet->status as $tweets){
			for ($i=0; $i < $num; $i++){
				$html = $html."<hr>";
				$tweets = $tweet->status[$i];
				$html = $html."<li class = 'detail' name = 'hover'>";
				$html = $html.'<div class="date">'.$tweets->created_at.'</div>';
				$html = $html.$tweets->text;
				$html = $html.'<div style="clear:both;"></div>';
				$html = $html.'</li>';
			}

			$html = $html.'</ul>';
		}
		//dd($html);
		return $html;
	}
}