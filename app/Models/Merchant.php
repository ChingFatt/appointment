<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Kyslik\ColumnSortable\Sortable;

class Merchant extends Model
{
    use HasFactory, SoftDeletes, QueryCacheable, Sortable;

    //public $incrementing = false;
    protected $primaryKey = 'id';
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    public $sortable = ['name'];

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
        return $this->attributes['is_publish'] ? '<span class="bg-success-light text-success font-size-sm font-w600 px-2 py-1 rounded">Published</span>' : '<span class="bg-warning-light text-warning font-size-sm font-w600 px-2 py-1 rounded">Unpublished</span>';
    }

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
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
