<?php
namespace Core;

class Router
{
	private static $routes;
	public static $url;

	public static function connect($url, $route)
	{
		self::$routes[$url] = $route;
	}

	public static function get($url, $param = null)
	{

		if (isset(self::$routes)) {
			return self::$routes;
		} else {
			return ['controller' => 'error', 'action' => 'error'];
		}
	}
}
?>