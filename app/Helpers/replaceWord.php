<?php


namespace App\Helpers;

 

class ReplaceWord{

   public static function replace($text) {
        $text = trim($text);
        $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
        $replace = array('C','c','G','g','i','I','O','o','S','s','U','u',' ');
        $new_text = str_replace($search,$replace,$text);
        return $new_text;
        } 
}