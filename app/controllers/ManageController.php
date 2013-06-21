<?php

class ManageController extends BaseController {

	
	public function index()
	{
		$feeds = Feed::with('section')->get();
		$sections = Section::all();
		
		$this->asset('js', 'larss_manage');
		return $this->render('manage', array('feeds' => $feeds, 'sections' => $sections));
	}

}