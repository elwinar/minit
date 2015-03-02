<?php namespace Minit;

use Illuminate\View\Engines\PhpEngine;
use App;
 
class Engine extends PhpEngine
{
	public static $template = null;
	
	public function get($path, array $data = array())
	{
		$finder = App::make('view.finder');
		$result = parent::get($path, $data);
		
		while ( static::$template != null ) {
			$path = $finder->find(static::$template);
			static::$template = null;
			
			$result = parent::get($path, array_merge($data, [
				'_view' => $result,
			]));
		}
		
		return $result;
	}

	public function extend($template)
	{
		static::$template = $template;
	}
}
