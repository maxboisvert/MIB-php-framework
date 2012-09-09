<?php

// Load the framework
include 'mib/mib.php';

// Configure the database
include 'mib/db/db.php';

// The main application
$mib = new Mib();

// Add the routes
$mib->add("", new Route('mib/app/controllers/home.php', 'mib/app/views/layouts/main.php'));
$mib->add("/", new Route('mib/app/controllers/home.php', 'mib/app/views/layouts/main.php'));
$mib->add("/home", new Route('mib/app/controllers/home.php', 'mib/app/views/layouts/main.php'));

$mib->add("/contact", new Route('mib/app/controllers/contact.php', 'mib/app/views/layouts/main.php'));

$mib->add(null, new Route('mib/app/controllers/page404.php', null));

// Run the application
$mib->run();

?>
