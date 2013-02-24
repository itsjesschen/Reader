<?php
class ShowFeed_Controller extends Base_Controller {

	public function action_showRSS(){
		$url= $_GET['URL'];
		// $num= $_GET['NUM'];
		$feedlist = RSS::getArticles($url);	
		// dd($feedlist);
		return $feedlist;
	}
	public function action_index(){
	}

	public function action_showPage(){
		$url = $_GET['URL'];
		$pageHTML = RSS::getPage($url);
		return $pageHTML;
	}
}