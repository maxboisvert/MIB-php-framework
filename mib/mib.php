<?php

class Mib {
	private $routeNotFound;
	private $urlToRouteMap = array();
	
	/**
	 * Load the controller of the current php request
	 */
	public function run() {
		$route = $this->routeNotFound;
		
		if ( isset($this->urlToRouteMap[$_SERVER['PATH_INFO']]) ) {
			$route = $this->urlToRouteMap[$_SERVER['PATH_INFO']];
		}
		
		$mib_title = "";
		
		// Load controller
		if (is_null($route->getLayout())) {
			include $route->getController();
		}
		else {
			ob_start();
			include $route->getController();
			$mib_content = ob_get_contents();
			ob_end_clean();
			
			include $route->getLayout();
		}
	}
	
	/**
	 * Add a link between an url and a controller
	 */
	public function add($url, $route) {
		if (is_null( $url)) {
			$this->routeNotFound = $route;
		}
		else {
			$this->urlToRouteMap[$url] = $route;
		}
	}
}

/**
 * Handle the routing url -> controller
 */
class Route {
	private $layout;
	private $controller;
	
	function __construct($controller, $layout) {
		$this->controller = $controller;
		$this->layout = $layout;
	}
	
	public function getLayout() {
		return $this->layout;
	}
	
	public function getController() {
		return $this->controller;
	}
}

/**
 * Handle generals database access
 */
class DB {
	private static $config = NULL;
	private static $db = NULL;
	
	/**
	 * Set the PDO config
	 */
	public static function setConfig($config) {
		self::$config = $config;
	}
	
	/**
	 * Open the conect if it not already done
	 */
	public static function connect() {
		if (is_null(self::$db)) {
			self::$db = new PDO(self::$config);
		}
	}
}

?>
