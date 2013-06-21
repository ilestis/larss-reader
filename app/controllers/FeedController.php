<?php

class FeedController extends BaseController {

	public function unread() {
		return Response::json(Feed::getUnread());
	}
	
	public function delete($feed_id) {
		$feed = Feed::find($feed_id);
		$feed->delete();
		
		return Redirect::to('manage');
	}

	public function edit($feed_id) {
		try {
			$feed = Feed::findOrFail($feed_id);
			$feed->name = Input::get('name');
			$feed->url = Input::get('url');
			$feed->section_id = Input::get('section');
			$feed->save();
		}
		catch(Exception $e) {
			
		}
		
		return Redirect::to('manage');
	}
	
	public function add() {
		$feed = new Feed;
		$feed->name = Input::get('name');
		$feed->url = Input::get('url');
		$feed->section_id = Input::get('section');
		$feed->save();

		return Redirect::to('manage');
	}
	
	public function form($feed_id) {
		$feed = null;
		if(empty($feed_id)) {
			$feed = new Feed();
		} else {
			$feed = Feed::find($feed_id);
		}
		$sections = Section::all();
		return View::make('feed/_form', array('feed' => $feed, 'sections' => $sections)); //::json($feed);
	}
}