<?php

namespace App;

use App\Http\Controllers\HelperController;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static latest()
 * @method where(string $string, string $string1, string $string2)
 */
class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        $image_path = config('custom.image_path').'/'.HelperController::currentController();
        return url("/$image_path/$this->image");
    }
}
