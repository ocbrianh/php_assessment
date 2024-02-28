<?php
require('data.php');

function sortMyArray(array &$array, array $target_keys = []) {
  $total_search_params = count($target_keys);
  
  if ($total_search_params == 0) {
    return;
    
  } else if ($total_search_params == 1) {
    $target_key = $target_keys[0];
    
  } else {
    foreach ($target_keys as $param) {
      $target_key = $param;
      
      sortMyArray($array, array($target_key));
    }
  }
  
  $columnValues = [];
  array_walk_recursive(
      $array,
      function($v, $k, $key) use (&$columnValues) {
          if ($k === $key) {
              $columnValues[] = $v;
          }
      },
      $target_key
  );
  array_multisort($columnValues, $array);
}

sortMyArray($data, ['last_name', 'guest_id']);
print_r($data);