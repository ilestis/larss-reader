<?php
class entryController extends BaseController {
	public function all($start=0, $take=25) {
		if(!is_numeric($start) || !is_numeric($take)) {
			return 'error params';
		}
		
		$entries = Entry::where('status', '0')->orderBy('created', 'DESC')->skip($start)->take($take)->get();
		$feed = new Feed();
		$feed->name = 'All unread entries';
		
		$data = array(
			'entries' => $entries,
			'parent' => $feed
		);
		
		return $this->render('list', $data, array('show_mark' => true));
	}
	
	public function feed($feed_id, $start=0, $take=25) {
		$entries = Entry::unreadFeed($feed_id)->orderBy('created', 'DESC')->skip($start)->take($take)->get();
		$feed = Feed::find($feed_id);
		
		$data = array(
			'entries' => $entries,
			'parent' => $feed
		);
		
		return $this->render('list', $data, array('show_mark' => true));
	}
	
	public function section($section_id, $start=0, $take=25) {
		$entries = Entry::unreadSection($section_id)->orderBy('created', 'DESC')->skip($start)->take($take)->get(array('entries.*'));		
		$section = Section::find($section_id);
		
		$data = array(
				'entries' => $entries,
				'parent' => $section
		);
		
		return $this->render('list', $data, array('show_mark' => true));
	}
	
	/**
	 * Set an entry as read
	 * @param int $entry_id
	 */
	public function read($entry_id) {
		if(!is_numeric($entry_id) || empty($entry_id)) {
			// do nothing
			return Response::json('false');
		}
		
		$entry = Entry::find($entry_id);
		$entry->status = 1;
		$entry->save();

		return Response::json($entry_id);
	}
	
	/**
	 * Set a list of entries as read
	 * @param mixed $entry_ids
	 */
	public function readall($entry_ids) {
		$ids = explode('|', $entry_ids);
		if(empty($ids)) {
			return 'invalid IDs';
		}
		
		//DB::query('UPDATE entries SET status = 1 WHERE id IN ('. implode(',', $ids).')');
		DB::table('entries')->whereIn('id', $ids)->update(array('status' => 1));
		return 'success';
	}
	
	public function get($feed_id) {
		$feed = Feed::find($feed_id);
		return Response::json($feed);
	}
}