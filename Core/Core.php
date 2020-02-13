<?php
namespace Core;

class Core
{
	public function run() 
	{
		$url = trim($_SERVER['REQUEST_URI'], DIRECTORY_SEPARATOR);
		$uri = $_SERVER['REQUEST_URI'];

		include 'src/routes.php';

		$rep = str_replace("/index.php","", $uri);
		
		
		if (Router::get($url)) {
			$routes[$url] = Router::get($url);
			$_controller = $routes[$url][$uri]['controller'];
			$_action = $routes[$url][$uri]['action'];
			$controller_name = "\Controller\\" . ucfirst($_controller) . 'Controller';
			$action_name = $_action . 'Action';
			
			

			if (class_exists($controller_name)) {

				$controller = new $controller_name();

				if (method_exists($controller, $action_name)) {
					$controller->{ $action_name }();
				} else {
					echo "Method " . $action_name . " not found in " . $controller_name . ".\n";
				}
			} else {
				echo "Controller = *" . $controller_name . "*_\\_action_name = *" . $action_name ."* not found.\n";
			}
		}
	}
}