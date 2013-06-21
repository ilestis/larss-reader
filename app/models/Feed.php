<?php
class Feed extends Eloquent {
	public $timestamps = false;
	private $unread_count = null;
	
	public function section() {
		return $this->belongsTo('Section');
	}
	
	public function loadEntries() {
		$rss = simplexml_load_file($this->url);
		$updated = $cached = 0;
		foreach ($rss->channel->item as $item) {
			$link = (string) $item->link;
			$title = (string) $item->title;
			$description = (string) $item->description;
				
				
			// Search if we already have this entry
			$duplicate = Entry::where('feed_id', '=', $this->id)->where('guidhash', '=', md5($item->guid))->count();
				
			$queries = DB::getQueryLog();
			$last_query = end($queries);
			//var_dump($last_query);
			if($duplicate > 0) {
				$cached++;
				continue;
			} else {
				$updated++;
			}
				
			$entry = new Entry;
			$entry->link = $link;
			$entry->title = $title;
			$entry->content = $description;
			$entry->created = date('Y-m-d H:i:s');
			$entry->feed_id = $this->id;
			$entry->guidhash = md5($item->guid);
			$entry->status = 0;
			$entry->save();
		}
		
		return array($updated, $cached);
	}
	
	public function unreadCount() {
		if($this->unread_count === null) {
			$this->unread_count = Entry::where('feed_id', $this->id)->where('status', 0)->count();
		}
		return $this->unread_count;
	}
	
	public function navClass() {
		$count = $this->unreadCount();
		if($count > 0) {
			return 'unread';
		}
		return null;
	}
	
	public static function getUnread() {
		// Update count
		Rss::pull();
	
		$uncount = array();
		$feeds = Feed::all();
		foreach($feeds as $feed) {
			$uncount[$feed->id] = $feed->unreadCount();
		}
		return $uncount;
	}
	
	public function delete() {
		// Delete entries
		Entry::where('feed_id', $this->id)->delete();
		
		parent::delete();
	}
	
	public function getSection() {
		if(empty($this->section_id)) {
			return '';
		}
		return $this->section->name;
	}
	
	public function type() {
		return 'feed';
	}
}