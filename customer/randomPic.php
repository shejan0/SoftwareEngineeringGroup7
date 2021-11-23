<?php
function randomHotel($dir = '../assets/img/hotel')
{
  $files = glob($dir . '/*.*');
  $file = array_rand($files);
  return $files[$file];
}

function randomPic($dir = '../assets/img/hotel-detail')
{
  $pictures = glob($dir . '/*.*');
  $file = array_rand($pictures);
  return $pictures[$file];
}
?>