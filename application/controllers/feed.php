<?php

class Feed_Controller extends Base_Controller {

		public function action_index(){
			$feedArray = array();

			//populates Feed onto page
			$rdata = Database::getTwitterUsers('0');
			$returndata = array(
				'RSS' => $rdata
			);
			return View::make('feeds', $returndata);
		}

		public function action_addRSS(){
			$validation = Adder::validateRSS(Input::all());//validates for input boxes
			if($validation->fails()){
				return Redirect::to('feed')
				->with_input()
				->with_errors($validation);
			}else{
					$Title = Input::get('feedTitle');
					$URL = Input::get('feedLocation');
					$content = file_get_contents($URL);
					$xelement = new SimpleXmlElement($content);

					Database::addRSSFeed($Title, $URL, $xelement->channel->link);
					return Redirect::to('feed')
					->with('success', 'You have successfully added '.$Title.'\'s RSS Feed');
			}
		}
}