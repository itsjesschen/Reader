<?php
class ShowFeed_Controller extends Base_Controller {

	public function action_showrss(){
		$url= $_GET['URL'];
		$num= $_GET['NUM'];
		$feedlist = RSS::getArticles($url, $num);
		return $feedlist;
	}
	public function action_index(){
		return ('hello Show Feed!');
	}

	public function action_showtweets(){
		$searchID = $_GET['USERID'];
		$num = $_GET['NUM'];
		$Twitter = new Twitter($searchID);
		$Tweets = $Twitter->SearchForUser($searchID, $num);
		return $Tweets;
	}

	public function action_showpage(){
		$url = $_GET['URL'];
		$pageHTML = RSS::getPage($url);
		return $pageHTML;
	}
}