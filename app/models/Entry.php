<?php
class Entry extends Eloquent {
	protected $table = 'entries';
	public $timestamps = false;
	
	public function markread() {
		$this->status = 1;
		$this->save();
	}
	
	public function markunread() {
		$this->status = 0;
		$this->save();
	}
	
	public function elapsed() {
		$time = strtotime($this->created);
		$elapsed = time() - $time;
		
		$days = floor($elapsed/86400);
		$hours = floor($elapsed/3600);
		$minutes = floor($elapsed/60);
		
		// Today?
		$return = null;
		if($days < 1) {
			$return = date('H:i', $time);
		} else {
			$return = date('Y-m-d H:i', $time);
		}
		
		$sub = 0;
		if($minutes && $hours < 1) {
			$sub = $minutes.' minute'.($minutes>1?'s':null).' ago';
		} elseif($days >= 1) {
			$sub = $days.' day'.($days>1?'s':null).' ago';
		} else {
			$sub = $hours.' hour'.($hours>1?'s':null).' ago';
		}
		
		return $return . '('.$sub.')';
	}
	
	public function scopeFeed($query, $feed) {
		return $query->where('feed_id', $feed);
	}
	
	public function scopeUnreadFeed($query, $feed) {
		if(is_array($feed)) {
			return $query->whereIn('feed_id', $feed)->where('status', '0');
		} else {
			return $query->where('feed_id', $feed)->where('status', '0');
		}
	}
	
	public function scopeUnreadSection($query, $section) {
		if(is_array($section)) {
			return $query->leftJoin('feeds as f', 'feed_id', 'f.id')->whereIn('f.section_id', $section)->where('status', '0');
		} else {
			return $query->leftJoin('feeds as f', 'feed_id', '=', 'f.id')->where('f.section_id', $section)->where('status', '0');
		}
	}
	
	public static function allUnread() {
		return Entry::where('status', '0')->count();
	}
	
}