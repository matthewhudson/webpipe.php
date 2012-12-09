<?php
require('../webpipe.class.php');

// Init 
$webpipe = new WebPipe();

// Request the 'parse-markdown' WebPipe Block Definition
$blockURL = 'http://block-parse-markdown.herokuapp.com';
$response = $webpipe->options($blockURL);

// Print the WebPipe response
print "<pre>" . $response . "</pre>";

?>