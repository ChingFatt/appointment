<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Employee extends Model
{
    use HasFactory, SoftDeletes, QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [
        'name',
        'outlet_id',
        'employee_code',
        'service_codes'
    ];

    protected $casts = [
        'service_codes' => 'json',
    ];

    public function setServiceCodesAttribute($value)
    {
        $this->attributes['service_codes'] = json_encode($value);
    }

    public function getServiceCodesAttribute($value)
    {
        return $this->attributes['service_codes'] = (string) $value;
    }

    public function outlet()
    {
        return $this->belongsTo('App\Models\Outlet', 'outlet_id');
    }

    public function services()
    {
        return json_decode($this->attributes['service_codes']);
    }
}
