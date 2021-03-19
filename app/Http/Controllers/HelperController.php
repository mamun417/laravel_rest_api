<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Image;
use Route;

class HelperController extends Controller
{
    public static function currentController()
    {
        return strtolower(str_replace(
            'Controller', '', class_basename(Route::current()->controller))
        );
    }

    public static function imageUpload($field_name)
    {
        /* base_64 image upload
        $real_image = request($field_name);
        list($type, $data) = explode(';', $real_image);
        list(, $ext) = explode('/', $type);
        $image_name = time().'.'.$ext;
        $imagePath = config('custom.image_path').self::currentController().'/'.$image_name;*/

        request()->validate([
            $field_name => 'mimes:jpg,jpeg,bmp,png|max:1024',
        ],[
            $field_name.'.mimes' => 'Invalid file try to upload!'
        ]);

        $real_image = request()->file($field_name);
        $image_name = time().'-'.preg_replace('/\s+/', '-', $real_image->getClientOriginalName());
        $imagePath = config('custom.image_path').'/'.self::currentController().'/'.$image_name;

        Image::make($real_image)->save($imagePath);

        return $image_name;
    }

    public static function imageDelete($image_name)
    {
        if ($image_name){
            $imagePath = config('custom.image_path').self::currentController().'/'.$image_name;

            if(file_exists($imagePath)){
                unlink($imagePath);
            }
        }
    }

    /**
     * @param array $excepts
     * @param $request
     * @return Collection
     * no need now
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
