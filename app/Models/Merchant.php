<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Merchant extends Model
{
    use HasFactory, SoftDeletes, QueryCacheable;

    //public $incrementing = false;
    protected $primaryKey = 'id';
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [
        'name',
        'merchant_code',
        'industry_id',
        'description',
        'is_publish'
    ];

    protected $casts = [
        'is_publish' => 'boolean',
    ];

    public function getPublishedAttribute($value)
    {
        return $this->attributes['is_publish'] ? '<span class="badge badge-success">Published</span>' : '<span class="badge badge-warning">Unpublished</span>';
    }

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id');
    }

    public function outlets()
    {
        return $this->hasMany('App\Models\Outlet');
    }

    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }
}
