<?php
echo "<h1>404-Error</h1>";
$url =  "{$_SERVER['REQUEST_URI']}";
$specific_tab = substr($url, strpos($url, "/") + 17);
echo "<title>$specific_tab</title>";