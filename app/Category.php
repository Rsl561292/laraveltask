<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories'; //name table with work this model

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public static function getListId()
    {
        $categories = self::pluck('name', 'id')->toArray();

        return $categories;
    }

    public static function getListSlug()
    {
        $categories = self::pluck('name', 'slug')->toArray();

        return $categories;
    }
}
