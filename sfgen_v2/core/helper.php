<?php

function safe($str)
{
    return strip_tags(trim($str));
}

function readJSON($path)
{
    $string = file_get_contents($path);
    $obj = json_decode($string);
    return $obj;
}

function createFile($string, $path)
{
    // doc: https://www.w3schools.com/php/func_filesystem_fopen.asp
    $create = fopen($path, "w"); //or die("Ubah permission folder and gen folder ke 777. Ref: $path <br>$string");
    fwrite($create, $string);
    fclose($create);
    chmod($file, 0777);//ketika file tercreate otomatis jadi 777 (generate all tables btuh ini)
    
    return $path;
}

function label($str)
{
    $label = str_replace('_', ' ', $str);
    $label = ucwords($label);
    return $label;
}

?>