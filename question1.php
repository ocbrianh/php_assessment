<?php
// Given the following example data structure. Write a single function to 
// print out all its nested key value pairs at any level for easy display to the user.
require('data.php');

function recursive($array){
  foreach($array as $key => $value){
      if(is_array($value)){
          recursive($value);
      } else{
          echo $key . ": " .$value, "\n";
      }
  }
}

recursive($data);