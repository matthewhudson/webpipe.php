<?php
require('../webpipe.class.php');

// Init 
$webpipe = new WebPipe();

// Make our WebPipe request
$blockURL = 'http://block-parse-markdown.herokuapp.com';
$response = $webpipe->execute($blockURL, array(
	"markdown" => "*Hello World!*"
));

if ($response) {
	print "<pre>" . htmlentities($response) . "</pre>";
} else {
	print "<pre>ERROR</pre>";
}

?>