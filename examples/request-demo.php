<?php
require('../webpipe.class.php');

// Init 
$webpipe = new Webpipe();

// Make our webpipe request
$response = $webpipe->request("markdown-to-html", array(
	"markdown" => "https://raw.github.com/duzour/webpipe.php/master/README.markdown"
));

if ($response) {
	// Print the webpipe response
	print "<pre>" . htmlentities($response) . "</pre>";
} else {
	print "<pre>ERROR</pre>";
}

?>