<?php

class AddFeed_Controller extends Base_Controller {

		public function action_index(){
			// $view = Redirect::to('addfeed');
			// $view->foundation->headers->headers = "addfeed";
			// dd($view);
			return View::make('rss_reader');
		}

		public function action_addTwitter(){

			$validation = Adder::validateTwitter(Input::all());

			if ($validation->fails()){
				return Redirect::to('addfeed')
				->with_input()
				->with_errors($validation);
			}else{				
				//inserts Twitter user on database
				$username = Input::get('tUserName');
				$realname = Input::get('tRealName');
				$Twitter = new Twitter();
				$isValidUser = $Twitter->isUser($username, $realname);

				//if the user exists
				if ( $isValidUser !== '' ){
					Database::addTwitterUser($username, $realname);
					return Redirect::to('addfeed')
					->with('success','You have successfully added '.$realname.' ('.$username.')\'s twitter feed.' );
				}

				//user does not exist
				return Redirect::to('addfeed')
				->with_input()
				->with('invalidUser', 'User '.$username.' does not exist');
			}
		}

		public function action_addRSS(){
			$validation = Adder::validateRSS(Input::all());
			if($validation->fails()){
				return Redirect::to('addfeed')
				->with_input()
				->with_errors($validation);
			}else{
				$Title = Input::get('rFeedTitle');
				$URL = Input::get('rFeedLocation');
				$content = file_get_contents($URL);
				$xelement = new SimpleXmlElement($content);
				Database::addRSSFeed($Title, $URL, $xelement->channel->link);
				//RSS::addFeed($Title,$URL);
				// return Redirect::to('home.RSS_Reader')
				return Redirect::to('addfeed')
				->with('success', 'You have successfully added '.$Title.'\'s RSS Feed');
			}
		}
		public function action_listUsers(){
				$feedArray = array();
				//populates tweeters onto page
				$tdata = Database::getTwitterUsers('1');
				$rdata = Database::getTwitterUsers('0');
				$returndata = array(
					'Tweeters' => $tdata,
					'RSS' => $rdata
				);
				return View::make('homepage', $returndata);
		}
}