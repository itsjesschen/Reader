<?php

class Adder {

	protected static $RSSrules = array(
		'feedTitle' => 'required',
		'feedLocation' => 'required|validxml|unique:addedfeeds,URL'
	);

	public static function validateRSS($input){

			if($input["feedTitle"] === "RSS Title"){
				$input["feedTitle"] = "";
			}

			if($input["feedLocation"] === "RSS URL"){

				$input["feedLocation"] = "";
			}
			Validator::register('validxml', function($attribute, $value, $parameters){
			    $URL = $value;
				if((filter_var($URL, FILTER_VALIDATE_URL) === FALSE)){//if it's not a legit URL format
					return false;
				}
				function get_http_response_code($url) {
				    $headers = get_headers($url);
				    return substr($headers[0], 9, 3);
				}
				if(get_http_response_code($URL) > "400"){//if it's not an active link
					return false;
				}

				 $sValidator = 'http://feedvalidator.org/check.cgi?url=';
				 if( $sValidationResponse = @file_get_contents($sValidator . urlencode($URL)) )
			    {
			        if( stristr( $sValidationResponse , 'This is a valid RSS feed' ) !== false )
			        {
			            return true;
			        }
			        else
			        {
			            return false;
			        }
			    }
			    else
			    {
			        return false;
			    }
				//
				// dd($sValidator);
				// $content = file_get_contents($URL);
				// $xml = new XMLReader(); 
				// try{
				// 	$temp = $xml->open($content);
				// 	dd($temp);
				// }catch(Exception $e){
				// 	return false;
				// }

				// $xml->setParserProperty(XMLReader::VALIDATE, true);// validates for legit xml
				// dd($xml->isValid());
				// return $xml->isValid();
			});
		$validation = new Validator($input, static::$RSSrules);//validates inputs
		return $validation;
	}

}