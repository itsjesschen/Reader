<?php

require 'remoteconnector.php';
class RSS extends RemoteConnector{

	//gets most current articles from inputted RSS URL 
	public static function getArticles($url){
		try{
			$content = file_get_contents($url);
			$xelement = new SimpleXmlElement($content);
		}catch(Exception $e){
			return;
		}
		return $xelement->asXML();
	}
	public static function getPage($url){
		$contents = file_get_contents($url);
	}
}

