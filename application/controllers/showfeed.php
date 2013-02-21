<?php
class ShowFeed_Controller extends Base_Controller {

	public function action_showRSS(){
		$url= $_GET['URL'];
		$feedlist = RSS::getArticles($url);	
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