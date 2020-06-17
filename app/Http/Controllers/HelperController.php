<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Image;
use Route;

class HelperController extends Controller
{
    public static function apiResponse($code, $message, $key = 'data', $data = '')
    {
        $response = [];
        $response['success'] = $code == 200 ?? false;

        if ($data){
            $response[$key] = $data;
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
        $imagePath = config('custom.image_path').self::currentController().'/'.$image_name;

        if(file_exists($imagePath)){
            unlink($imagePath);
        }
    }

    /**
     * @param array $excepts
     * @param $request
     * @return Collection
     */
    public static function filterFormRequest($excepts, $request)
    {
        return collect($excepts)->filter(function ($item) use ($request) {
            return array_key_exists($item, $request) ?? false;
        })->mapWithKeys(function ($item) use ($request){
            return [$item => $request[$item]];
        });
    }
}
