<?php
class Section extends Eloquent {
	public $timestamps = false;
	private $unread_count = null;
	
	
	public function delete() {
		// Delete feeds (which will delete entries)
		Feed::where('section_id', $this->id)->delete();
		parent::delete();
	}
	
	public function feeds() {
		return $this->hasMany('feed', 'section_id');
	}
	
	public function unreadCount() {
		if($this->unread_count === null) {
			$this->unread_count = Entry::leftJoin('feeds as f', 'entries.feed_id', '=', 'f.id')->where('f.section_id', $this->id)->where('entries.status', '0')->count();
		}
		return $this->unread_count; 
	}
	
	public function type() {
		return 'section';
	}
	
	public function navClass() {
		$count = $this->unreadCount();
		if($count > 0) {
			return 'unread';
		}
		return null;
	}
}