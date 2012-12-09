# [WEBPIPE.PHP](http://www.github.com/matthewhudson/webpipe.php/)

#### Use WebPipes in your PHP applications.

## Introduction

WebPipes are handy HTTP utility programs. They accept input and return output. If you're missing a Standard Library or some other basic and/or extended functionality, there may be a WebPipe available.

[Learn more about WebPipes &rarr;](http://www.webpipes.org/)

## Setup

Add `webpipe.class.php` to your project folder and don't forget to `require()`.

```php
require('webpipe.class.php');
```

## Usage

```php
// Init 
$webpipe = new WebPipe();

// Make our WebPipe request
$response = $webpipe->execute("parse-markdown", array(
	"markdown" => "*Hello World!*"
));

// Print the WebPipe response
if ($response) {
	print "<pre>" . $response . "</pre>";
} else {
	print "<pre>Error</pre>";
}
```

# Resources

* [WebPipes.org](http://www.webpipes.org/)