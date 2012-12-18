<?php

/**
 * WebPipe client interface.
 *
 * @package  WebPipe
 * @author   Matthew Hudson <matt@matthewghudson.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 * @link     http://github.com/matthewhudson/webpipe.php/
 */
class WebPipe {
  
  // HTTP UserAgent.
  private $_userAgent = 'WebPipe-PHP/0.2.0';
  
  /**
   * Returns a WebPipe's Block Definition. 
   * It's handy while debugging and/or learning about new webpipes.
   *
   * @param string $block URL of the WebPipe to call.
   * @return string 
   */
  public function options($block) {
    return $this->_request('options', $block);
  }

  /**
   * Make a request to a WebPipe Block.
   *
   * @param string $block URL of the Block to call.
   * @param array $input Any Input to send to the Block.
   * @return string
   */
  public function execute($block, $input = array()) {
    return $this->_request('post', $block, $input);
  }

  /**
   * Make a HTTP request.
   *
   * @param string $method Expecting POST|GET.
   * @param string $url The URL to request.
   * @param array $data Any data to send along.
   * @return string|bool False on fail, or response body string on success.
   */  
  private function _request($method, $url, $data = array()) {
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
    if (strtolower($method) === 'post') {
      curl_setopt($curl, CURLOPT_HEADER, 'application/json');
      
      // Convert data to Input Record
      if (sizeof($data)) {
        foreach ($data as $key => $val) {
          if (substr($val, 0, 1) === '@') {
            $data[$key] = file_get_contents(substr($val, 1, strlen($val)));
          }
          
        }
        $data = json_encode(array(
          'inputs' => array($data)
        ));
        // The full data to post in a HTTP 'POST' operation.
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      }
    } else {
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'options');
    }
  
    // Execute the HTTP request.
    $response = curl_exec($curl);
    
    // Get response status code.
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
    
    // Close cURL resource, and free up system resources
    curl_close($curl);
    
    // Ensure HTTP Status Code is '2xx Success'
    if (!($status >= 200) || !($status < 300)) {
      return false;
    }
    
    return $response;
  }
}
?>