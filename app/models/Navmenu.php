<?php
class Navmenu {
	/**
	 * Builds an array for the navmenu
	 */
	public static function getMenu() {
		$navmenu = array();
		
		$feeds = Feed::orderBy('section_id')->orderBy('feeds.name')->get();
		foreach($feeds as $feed) {
			if(!isset($navmenu[$feed->section_id])) {
				$section = null;
				if(!empty($feed->section_id)) {
					$section = Section::find($feed->section_id);
				}
				$navmenu[$feed->section_id] = array('section' => $section, 'feeds' => array());
			}
			
			// Add item to its navmenu
			$navmenu[$feed->section_id] ['feeds'][] = $feed;
			
			/*if(empty($feed->section_id)) {
				array_push($navmenu, $feed);
			} else {
				// Section doesn't exist?
				if(!in_array($feed->section, $navmenu)) {
					array_push($navmenu, $feed->section);
				}
				array_push($navmenu, $feed);
			}*/
		}
		return $navmenu;
	}
}