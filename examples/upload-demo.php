<?php
require('../webpipe.class.php');

// Init 
$webpipe = new Webpipe();

// Make our webpipe request
// Since it's a file, add '@' in front of the file path.
$response = $webpipe->request("markdown-to-html", array(
	"markdown" => "@../README.markdown"
));

// Print the webpipe response
print "<pre>" . $response . "</pre>";

?>