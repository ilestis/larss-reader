<?php
class Rss {
	
	public static function pull() {
		// Get all feeds and then parse them
		$feeds = Feed::all();
		foreach($feeds as $feed) {
			//echo "Loading entries for $feed->name ";
			list($updated, $cached) = $feed->loadEntries();
			//echo "- $updated/$cached<br />";
			//Rss::loadFeed($feed);
				
			// update feed time
			$feed->last_update = time();
			$feed->save();
		}
	}

	
	public static function unread() {
		$return = array('all' => array(), 'feed' => array(), 'section' => array());
		
		/** Get per feed **/
		$feeds = Feed::all();
		foreach($feeds as $feed) {
			$return['feed'][$feed->id] = $feed->unreadCount();
		}
		
		/** Get per section **/
		$sections = Section::all();
		foreach($sections as $section) {
			$return['section'][$section->id] = $section->unreadCount();
		}
		
		/** Get all **/
		$return['all'] = Entry::allUnread();
		return $return;
	}
}