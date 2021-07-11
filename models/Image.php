<?php

class Image{
    const WIDTH = 269;
    const HEIGHT = 248;
    public static $width = 0;
    public static $height = 0;
    public static $allocate = 0;
    public static $shift = 0;
    public static $new_width = 0;
    public static $new_height = 0;
    
    public static function compareSize($image){
        self::$width  = imagesx($image);
        self::$height  = imagesy($image);
        if(self::$width > self::$height){
            $temp = (self::$width / self::WIDTH);
            self::$new_width = round(self::$width / $temp);
            self::$new_height = round(self::$height / $temp);
            self::$shift = round((self::HEIGHT - self::$new_height) / 2);
        } elseif(self::$width < self::$height){
            $temp = (self::$height / self::HEIGHT);
            self::$new_width = round(self::$width / $temp);
            self::$new_height = round(self::$height / $temp);
            self::$allocate = round((self::WIDTH - self::$new_width) / 2);
        } elseif(self::$width == self::$height){
            $temp = (self::$height / self::HEIGHT);
            self::$new_width = round(self::$width / $temp);
            self::$new_height = round(self::$height / $temp);
            self::$allocate = round((self::WIDTH - self::$new_width) / 2);
        }
    }
    public static function resizeImage($id, $src){
        $dest = $_SERVER['DOCUMENT_ROOT']."/images/$id.jpg";
        $from = imagecreatefromjpeg($src);
        self::compareSize($from);
        $to = imagecreatetruecolor(self::WIDTH, self::HEIGHT);
        $white = imagecolorallocate($to, 255, 255, 255);
        imagefill($to, 0, 0, $white);
        imagecopyresampled($to, $from, self::$allocate,self::$shift,0,0, self::$new_width, self::$new_height, imagesx($from), imagesy($from));
        imagejpeg($to, $dest, 100);
        imagedestroy($from);
        imagedestroy($to);
    }
    
    public static function getImage($id){
        $noImage = 'no-image.jpg';
        
        $path = '/images/';

        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            return $pathToProductImage;
        }
        return $path . $noImage;
    }
}