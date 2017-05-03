<?php
	session_start();
     header ("Content-type: image/png");
	 
	 // $text = rand(10000,99999); 
	 $text = substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz0123456789", 5)), 0, 5);
	 $_SESSION["capt_original"] = $text;
	 $font  = 'captcha_font.ttf';
	
     $im = ImageCreate(100,30);
     $grey = ImageColorAllocate($im, 230, 230, 230);
     $black = ImageColorAllocate($im, 0, 0, 0);
   
     ImageTTFText($im, 20, 0, 10, 25, $black, $font,$text);
     ImagePng($im);
     ImageDestroy($im); 
?>