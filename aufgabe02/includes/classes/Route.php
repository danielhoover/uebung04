<?php

/**
 * beispiel_projekt
 *
 * Copyright (c) 2017 Daniel Hoover
 *
 * @author Daniel Hoover <https://github.com/danielhoover>
 */
class Route
{
	public function __construct()
	{
		$this->runControllerByUrl();
	}

	public function runControllerByUrl()
	{
		global $route;

		$requestUri = $_SERVER['REQUEST_URI']; //get the current URL

		$parts = explode('?', $requestUri); //remove the ? i.e. login.php?anotherVariable=Value

		$requestUri = $parts[0]; //be only interested in the first part - which is the url without ?

		foreach($route as $key => $routeOption)
		{
			if($requestUri == URL_PATH.$key)
			{
				$controller = new $routeOption['controller']($routeOption['uniqueName']);
				exit;
			}
		}


		//if we are here - there was no Route found - throw 404 and show 404 view!
		$view = new View('404');
		http_response_code(404);
		$view->output();
	}
}