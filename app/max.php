<?php

/**
 * Handle the routing url -> controller
 */
class Route {
	private $controllerNotFound;
	private $urlToControllersMap = array();
	
	/**
	 * Load the controller of the current php request
	 */
	public function run() {
		$controller = $this->controllerNotFound;
		
		if ( isset($this->urlToControllersMap[$_SERVER['PATH_INFO']]) ) {
			$controller = $this->urlToControllersMap[$_SERVER['PATH_INFO']];
		}
		
		// Load controller
		include $controller;
	}
	
	/**
	 * Add a link between an url and a controller
	 */
	public function add($url, $controller) {
		if (is_null( $url)) {
			$this->controllerNotFound = $controller;
		}
		else {
			$this->urlToControllersMap[$url] = $controller;
		}
	}
	
}

/**
 * Cache a buffered string in a file on disk
 */
class Cache {
	private $file;
	
	public function __construct($file) {
		$this->file = $file;
	}
	
	public function clear() {
		unlink($this->file);
	}
	
	public function isCached() {
		return file_exists($this->file);
	}
	
	public function getCached() {
		return file_get_contents($this->file);
	}
	
	public function startBuffer() {
		ob_start();
	}
	
	public function stopBuffer() {
		file_put_contents($this->file, ob_get_contents());
		ob_end_clean();
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
	
	/**
	 * Close the database if connected
	 */
	public static function close() {
		// close db, nothing else to do
		self::$db = NULL;
	}
}

?>
