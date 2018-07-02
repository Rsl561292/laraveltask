<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //List available roles
    const ROLE_SLUG_SYSTEM_ADMIN = 'admin';
    const ROLE_SLUG_SYSTEM_MANAGER = 'manager';
    const ROLE_SLUG_SYSTEM_USER = 'user';

    protected $fillable = [
        'name',
        'slug',
        'slug_system'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public static function getListId()
    {
        $list = self::pluck('name', 'id')->toArray();

        return $list;
    }

    public static function getListSlug()
    {
        $list = self::pluck('name', 'slug')->toArray();

        return $list;
    }
}
