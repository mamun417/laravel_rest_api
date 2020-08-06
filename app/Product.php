<?php

namespace App;

use App\Http\Controllers\HelperController;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static latest()
 */
class Product extends Model
{
    protected $fillable = ['status', 'name', 'description', 'price', 'image'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        $image_path = config('custom.image_path').HelperController::currentController();
        if ($this->image) {
            return preg_replace('/\s+/', '-', url("/$image_path/$this->image"));
        }
    }
}
