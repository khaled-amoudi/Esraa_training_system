<?php

use Illuminate\Support\Optional;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

// Steps To Make Helper File
//     * create app/helpers.php
//     * add this
//     "files": [
//         "app/helpers.php"
//     ]
//     inside the "autoload": {}  in composer.json
//     * run > composer dump-autoload
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
function transformDate($value, $format = 'Y-m-d')
{
    try {
        return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
    } catch (\ErrorException $e) {
        return \Carbon\Carbon::createFromFormat($format, $value);
    }
}
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
// function productImagePath($image_name)
// {
//     return public_path('images/products/' . $image_name);
// }
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
// function model_path($model){
//     return "App\\Models\\$model";
// }
// function request_path($request){
//     return "App\\Http\\Requests\\$request";
// }
// function resource_path($resource){
//     return "App\\Http\\Resources\\$resource";
// }
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
function get_class_name($classPath) {
    $classPath = get_class($classPath);
    $pathPartials = explode('\\', $classPath);
    return end($pathPartials);
}
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
if(! function_exists('optional')) {
    function optional($value = null, callable $callback = null) {
        if(is_null($callback)){
            return new Optional($value);
        } elseif (! is_null($callback)){
            return $callback($value);
        }
    }
}
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
if(! function_exists('image_url')) {
    function image_url($img, $custom_path = null) {
        return (!empty($custom_path)) ? asset($custom_path . '/' . $img) : asset('storage/' . $img);
    }
}
