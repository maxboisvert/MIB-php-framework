<?php

$cache = new Cache("app/cache/contact.cache");

if ( $cache->isCached() == false) {
	$cache->startBuffer();
	
	for ($i = 1; $i <= 1000000; $i++) {
		$x = 1 + 1;
	}

	echo "Contact";
	
	$cache->stopBuffer();
}

echo $cache->getCached();

?>
