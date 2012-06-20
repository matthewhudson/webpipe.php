<?php
require('../webpipe.class.php');

// Init 
$webpipe = new Webpipe();

// Request the 'proxy' webpipe manual (webpipe.json)
$response = $webpipe->manual('proxy');

// Print the webpipe response
print "<pre>" . $response . "</pre>";

?>