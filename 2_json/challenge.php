<?php

// Add new Task  
$uri = $_SERVER['REQUEST_URI'];

echo parse_url($uri, PHP_URL_PATH); 
echo "<br";
echo $uri;

readfile('page.html');

?>