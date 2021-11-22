<?php
function randomPic($dir = '../assets/img/hotel')
{
  $files = glob($dir . '/*.*');
  $file = array_rand($files);
  return $files[$file];
}
?>