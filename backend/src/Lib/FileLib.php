<?php
/**
 * Created by PhpStorm.
 * User: kasi
 * Date: 05.02.2019
 * Time: 12:38
 */

namespace App\Lib;


class FileLib {

    public static function getFilename(string $str): string {
        $str = str_replace(['ä','ö','ü','Ä','Ö','Ü','ß'],['ae','öe','ue','Ae','Oe','Ue','ss'], $str);
        $str = preg_replace('/[^A-Za-z0-9- ]/','', $str);
        $str = preg_replace('/[- ]/','-',$str);
        $str = preg_replace('/-+/','-', $str);
        return $str;
    }
}