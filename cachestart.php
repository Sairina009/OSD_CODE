<?php
$cachefile = 'cache/' . basename($_SERVER['PHP_SELF']) . '.cache'; 
$cachetime = 3; 

if (file_exists($cachefile) && time() - $cachetime <= filemtime($cachefile)) {
  $c = @file_get_contents($cachefile);
  echo $c;
  exit;
} else {
  //unlink($cachefile);
}

ob_start();
?>