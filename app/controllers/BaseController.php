<?php

class BaseController extends Controller {
	private static $assets = array('js' => array(), 'css' => array());
	
	

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	
	protected function render($controller_template, $controller_data, $attribs=array()) {
		// Datas shared to each view
		$data = array();
		$data['unread_items'] = Entry::allUnread();
		$data['navmenu'] = Navmenu::getMenu();
		$data['show_mark'] = false;
		
		$data['js'] = self::$assets['js'];
		$data['css'] = self::$assets['css'];
		
		$data = array_merge($data, $attribs);
		
		$data = array_merge($data, $controller_data);
		
		
		return View::make($controller_template, $data);
	}
	
	protected function asset($asset_type, $url) {
		self::$assets[$asset_type][] =  $url;
	}

}