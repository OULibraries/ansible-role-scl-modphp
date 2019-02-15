<?php

$response=array();
http_response_code(500);
$response["data"] = ["failed"]; 

/* Don't let strangers in */
if (! in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
  http_response_code(403);
  $response["data"] = ["denied"];
} else {


  if (extension_loaded('apc')) { 
    // php is using the legacy apc caching method
    $result1 = apc_clear_cache();
    $result2 = apc_clear_cache('user');
    $result3 = apc_clear_cache('opcode');
    $infos["apc status"] = apc_cache_info();
    $infos['apc_clear_cache'] = $result1;
    $infos["apc_clear_cache('user')"] = $result2;
    $infos["apc_clear_cache('opcode')"] = $result3;
 
  } else {
 
    /* Clear caches based on system setup */
    if (function_exists('opcache_reset')) { // php is using opcache
      // Clear it twice to avoid some internal issues...
      $result = opcache_reset();
      $infos["opcache status"] = opcache_get_status();
      $successMsg = $result;
      $infos['opcache_reset'] = $result;
    } 
    
    if (extension_loaded('apcu')) { 
    // php is using the "newer" apcu caching method to add user cache cleaning
      $result = apcu_clear_cache();
      $infos["apcu status"] = apcu_cache_info();
      $infos['apcu_clear_cache'] = $result;
      
    } 
     
  }
  http_response_code(200);
  $response["data"] = $infos;
}

header('Content-type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);
