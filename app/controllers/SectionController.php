<?php

class SectionController extends BaseController {
	
	public function all($section_id, $start=0, $take=25) {
		if(!is_numeric($section_id) || !is_numeric($start) || !is_numeric($take)) {
			return 'error';
		}
		
		$section = null;
		try { 
			$section = Section::findOrFail($section_id);
		}
		catch(Exception $e) {
			return Redirect::to('/');
		}
		
		// List of feeds in this section
		$feed_ids = array();
		$feeds = $section->feeds;
		

		foreach($feeds as $feed) {
			array_push($feed_ids, $feed->id);
		}
		
		//Rss::pull();
	
		//$entries = Entry::all($feed_id, $start, $count);
		$entries = Entry::unreadFeed($feed_ids)->orderBy('created', 'DESC')->skip($start)->take($take)->get();
		

		$data = array(
				'entries' => $entries,
				'feed' => $section // make the template think it's a feed
		);
	
		return $this->render('list', $data);
	}
	
	public function delete($sec_id) {
		$section = Section::find($sec_id);
		$section->delete();
		return Redirect::to('manage');
	}
	
	public function edit($sec_id) {
		$section = Section::find($sec_id);
		$section->name = Input::get('name');
		$section->save();
		return Redirect::to('manage');
	}
	
	public function add() {
		$section = new Section;
		$section->name = Input::get('name');
		$section->save();
		return Redirect::to('manage');
	}
	
	public function form($sec_id) {
		$section = null;
		if(empty($sec_id)) {
			$section = new Section();
		} else {
			$section = Section::find($sec_id);
		}
		return View::make('section/_form', array('section' => $section)); //::json($feed);
	}
}