<?php

class Database {

	public static function addTwitterUser($url, $realname){

		$query = DB::table('addedfeeds')->insert_get_id(array(
			'Name' => $realname,
			'URL' => $url,
			'isTwitter'=> '1',
			));

	}
	public static function addRSSFeed($Title, $url, $pagelink){

		$query = DB::table('addedfeeds')->insert_get_id(array(
			'Name' => $Title,
			'URL' => $url,
			'isTwitter'=> '0',
			'PageLink' => $pagelink
			));
	}
	public static function getRSSURL($pagelink){
		$query = DB::table('addedfeeds')->where('PageLink', '=', $pagelink)->only('URL');
		return $query;
	}

	public static function getTwitterUsers($parameter){
		$query = DB::table('addedfeeds')->where('isTwitter','=',$parameter)->get();
		return $query;
	}

}