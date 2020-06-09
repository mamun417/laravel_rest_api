<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class HelperController extends Controller
{
    public static function formattedResponse($success, $code, $message, $data = '')
    {
        $response = [];

        $response['success'] = $success;

        if ($data){
            $response['data'] = $data;
        }else{
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }

    public static function currentController()
    {
        return strtolower(str_replace(
            'Controller', '', class_basename(Route::current()->controller))
        );
    }

    public static function imageUpload($field_name)
    {
        request()->validate([
            $field_name => 'mimes:jpg,jpeg,bmp,png|max:1024',
        ],[
            $field_name.'.mimes' => 'Invalid file try to upload!'
        ]);

        $real_image = request()->file($field_name);
        $image_name = time().'-'.$real_image->getClientOriginalName();
        $imagePath = config('custom.image_path').'/'.self::currentController().'/'.$image_name;

        Image::make($real_image)->save($imagePath);

        return $image_name;
    }

    public static function imageDelete($image_name)
    {
        $imagePath = config('custom.image_path').'/'.self::currentController().'/'.$image_name;

        if(file_exists($imagePath)){
            unlink($imagePath);
        }
    }
}
