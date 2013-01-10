<?php
class ShowFeed_Controller extends Base_Controller {

	public function action_showRSS(){
		$url= $_GET['URL'];
		$num= $_GET['NUM'];
		$feedlist = RSS::getArticles($url, $num);	
		return $feedlist;
	}
	public function action_index(){
	}

	public function action_showTweets(){
		$searchID = $_GET['USERID'];
		$num = $_GET['NUM'];
		$Twitter = new Twitter($searchID);
		$Tweets = $Twitter->SearchForUser($searchID, $num);
		return $Tweets;
	}

	public function action_showPage(){
		$url = $_GET['URL'];
		$pageHTML = RSS::getPage($url);
		return $pageHTML;
	}
}