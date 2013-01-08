<?php

class Adder {

	protected static $RSSrules = array(
		'rFeedTitle' => 'required',
		'rFeedLocation'=>'active_url',
		'rFeedLocation' => 'unique:addedfeeds,URL'
	);
	protected static $Twitterrules = array(
		'tUserName' => 'required',
		'tUserName' => 'unique:addedfeeds,URL',
		'tRealName' => 'required'
	);

	protected static $urlCheck = array(
		''
	);

	public static function validateRSS($input){
		$validation = new Validator($input, static::$RSSrules);

		return $validation;
	}

	public static function validateTwitter($input){
		$validation = new Validator($input, static::$Twitterrules);
		return $validation;
	}

}