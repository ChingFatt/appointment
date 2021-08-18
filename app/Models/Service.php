<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Service extends Model
{
    use HasFactory, SoftDeletes, QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [
        'name',
        'duration',
        'merchant_id',
        'service_code'
    ];

    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant');
    }

    public function getDurationsAttribute()
    {
        return "{$this->duration} minutes";
    }

    public function getServiceDurationAttribute()
    {
        return "{$this->name}";// - {$this->service_code}
    }
}
