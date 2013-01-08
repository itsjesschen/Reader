<?php 

class RemoteConnector {

	protected function get($url) {
		$session = curl_init($url);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		$string = curl_exec($session);
		curl_close($session);

		return $string;
	}


	protected function post($url) {
		// code here
	}

}