<?php

/**
 * Webpipe client interface.
 *
 * @package  Webpipe
 * @author   Dozier Hudson <me@dozierhudson.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 * @link     http://www.dozierhudson.com/projects/webpipe.php/
 */
class Webpipe {
	
	// Webpipe.org offers a registry and dispatch service.
	private $_hostname = "webpipes.org";
	
	// HTTP UserAgent.
	private $_userAgent = "Webpipe-PHP/0.1.0";
	
	/**
	 * Returns the manual (webpipe.json) by the webpipe's name.
	 *
	 * @param string $name Name of the webpipe to call.
	 * @return string 
	 */
	public function manual($name) {
		
		$registryURL = "http://registry.webpipes.org/webpipes/$name";

		$response = $this->_curl("get", $registryURL);
		
		return $response;
	}

	/**
	 * Make a request to the webpipe via the webpipes.org dispatch service.
	 *
	 * @param string $name Name of the webpipe to call.
	 * @param array $data Any data to send along.
	 * @return string
	 */
	public function request($name, $data = array()) {
		
		$dispatchURL = "http://dispatch.{$this->_hostname}/$name";
		
		$response = $this->_curl("post", $dispatchURL, $data);
		
		return $response;
	}

	/**
	 * Make a curl request. Defaults to a GET.
	 *
	 * @param string $method Expecting POST|GET.
	 * @param string $url The URL to request.
	 * @param array $data Any data to send along.
	 * @return string|bool False on fail, or response body string on success.
	 */	
	private function _curl($method, $url, $data = array()) {
		
		// Create a new cURL resource
		$curl = curl_init();
		
		// Set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $url);
		
		// Don't include the header in the output.
		curl_setopt($curl, CURLOPT_HEADER, false);

		// Set the UserAgent Header
		curl_setopt($curl, CURLOPT_USERAGENT, $this->_userAgent);

		// Return the response instead of outputting.
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		// Force the connection to close when it has finished processing
		curl_setopt($curl, CURLOPT_FORBID_REUSE, true);

		// Force the use of a new connection instead of a cached one.
		curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);

		// Follow redirects
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		
		// Set Method: If POST request, set it up + add data.
		if (strtolower($method) === "post") {
		
			// Regular HTTP POST: application/x-www-form-urlencoded
			curl_setopt($curl, CURLOPT_POST, true);
		
			// The full data to post in a HTTP "POST" operation.
			if (sizeof($data)) {
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			}
		}
	
		// Execute the HTTP request.
		$response = curl_exec($curl);
		
		// Get response status code.
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
		
		// Close cURL resource, and free up system resources
		curl_close($curl);
		
		// Ensure HTTP Status Code is'2xx Success'
		if (!($status >= 200) || !($status < 300)) {
			return false;
		}
		
		return $response;
	}
}
?>