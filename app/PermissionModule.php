<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Str;

/**
 * Class PermissionModule
 * @mixin Eloquent
 */
class PermissionModule extends Model
{
    protected $fillable = ['name', 'slug'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        self::creating(function (PermissionModule $permissionModule) {
            $permissionModule->slug = Str::slug($permissionModule->name);
        });

        self::updating(function (PermissionModule $permissionModule) {
            $permissionModule->slug = Str::slug($permissionModule->name);
        });
    }

    public function permissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Permission::class);
    }
}
