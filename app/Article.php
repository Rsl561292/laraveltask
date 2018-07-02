<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    //
    use SoftDeletes;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    protected $fillable = [
        'category_id',
        'title',
        'content',
        'published_at',
        'status'
    ];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }

    public function getStatusName()
    {
        return Arr::get(self::getStatusList(), $this->status, 'Undefined');
    }

}
