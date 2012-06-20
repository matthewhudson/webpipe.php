# WEBPIPES FOR PHP

#### Use Webpipes in your PHP applications.

## Introduction

Webpipes are handy HTTP utility programs. They accept input and return output. If you're missing a Standard Library or some other basic and/or extended functionality, there may be a Webpipe available.

[Learn more about Webpipes &rarr;](http://www.webpipes.org/)

## Setup

Add `webpipe.class.php` to your project folder and don't forget to `require()`.

``` php
require('webpipe.class.php);
```

## Usage

``` php
// Init 
$webpipe = new Webpipe();

// Make our webpipe request
$response = $webpipe->request("proxy", array(
	"method" => "GET",
	"url" => "http://www.google.com/"
));

// Print the webpipe response
if ($response) {
	print "<pre>" . $response . "</pre>";
} else {
	print "<pre>Error</pre>";
}
```

# Resources

* [Webpipes.org](http://www.webpipes.org/)
* [Webpipe.js](http://www.dozierhudson.com/projects/webpipe.js/)
* [Webpipe.php](http://www.dozierhudson.com/projects/webpipe.php/)