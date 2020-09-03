<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static firstOrCreate(array $array)
 */
class Skill extends Model
{
    protected $fillable = ['name'];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
