<?php

$greetings = [];

foreach(range('a', 'z') as $char){
    $path = "alphabet/kh_".$char.".php";  // get files name 
    $file_path = resource_path('../lang/kh/'.$path); 
    if(file_exists($file_path)){
        include($path);
        $arr = 'kh_'.$char;
        $arr = $$arr;
        $greetings = array_merge($greetings, $arr);
    }
}

return $greetings;