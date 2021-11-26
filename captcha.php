<?php
session_start();
 
$string = '';
 
for ($i = 0; $i < 5; $i++) {
    // this numbers refer to numbers of the ascii table (lower case)
    $string .= chr(rand(97, 122));
}
 
$_SESSION['rand_code'] = $string;

// Set the content-type
header('Content-type: image/png');

// Create the image
$im = imagecreatetruecolor(100, 30);

// Create some colors

$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 399, 29, $white);

// The text to draw
$text =$string;
// Replace path by your own font path
$font = 'E:\xampp\htdocs\theme\font\arial.ttf';
$font = mb_convert_encoding($font, 'big5', 'utf-8');

// Add some shadow to the text
imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);

// Add the text
imagettftext($im, 20, 0, 10, 20, $black, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
?>