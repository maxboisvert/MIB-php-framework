<?php

// Load the framework
include 'app/max.php';

// Configure the database
include 'app/db/db.php';

// Add the routes and run the application
$route = new Route();
$route->add("", 'app/controllers/applicationHome.php');
$route->add("/", 'app/controllers/applicationHome.php');
$route->add("/home", 'app/controllers/applicationHome.php');
$route->add("/contact", 'app/controllers/applicationContact.php');
$route->add(null, 'app/controllers/applicationPage401.php');
$route->run();

// Close the database
DB::close();

?>
