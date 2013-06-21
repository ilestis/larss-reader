<?php

class RssController extends BaseController {

	/**
	 * Sync the feeds and return unread count
	 */
	public function pull()
	{
		Rss::pull();
		return Response::json(Rss::unread());
	}
	
	/**
	 * Cron that will read new entries
	 */
	public function cron() {
		Rss::pull();
	}

	public function unread() {
		return Response::json(Rss::unread());
	}
	
	public function unreadPerFeed() {
		return Response::json(Rss::unreadPerFeed());
	}
}