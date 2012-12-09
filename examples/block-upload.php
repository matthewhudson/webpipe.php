<?php
require('../webpipe.class.php');

// Init 
$webpipe = new WebPipe();

// Make our webpipe request
// Since it's a file, add '@' in front of the file path.
$blockURL = 'http://block-parse-markdown.herokuapp.com';
$response = $webpipe->execute($blockURL, array(
	"markdown" => "@../README.markdown"
));

// Print the webpipe response
print "<pre>" . htmlentities($response) . "</pre>";

?>