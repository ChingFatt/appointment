<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Outlet extends Model
{
    use HasFactory, SoftDeletes, QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [
        'name',
        'merchant_id',
        'outlet_code',
        'description',
        'phone',
        'email',
        'service_codes',
        'address',
        'address2',
        'postcode',
        'state',
        'country',
        'latitude',
        'longitude',
        'is_publish'
    ];

    protected $casts = [
        'service_codes' => 'json',
        'is_publish'    => 'boolean',
    ];

    public function setServiceCodesAttribute($value)
    {
        $this->attributes['service_codes'] = json_encode($value);
    }

    public function getServiceCodesAttribute($value)
    {
        return $this->attributes['service_codes'] = (string) $value;
    }

    public function getPublishedAttribute($value)
    {
        return $this->attributes['is_publish'] ? '<span class="bg-success-light text-success font-size-sm font-w600 px-2 py-1 rounded">Published</span>' : '<span class="bg-warning-light text-warning font-size-sm font-w600 px-2 py-1 rounded">Unpublished</span>';
    }

    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant', 'merchant_id');
    }

    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }

    public function services()
    {
        return json_decode($this->attributes['service_codes']);
    }

    public function operating_hour()
    {
        return $this->hasOne('App\Models\OperatingHour', 'outlet_id');
    }
}
