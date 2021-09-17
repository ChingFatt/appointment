<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class OperatingHour extends Model
{
    use HasFactory, SoftDeletes, QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [
        'outlet_id',
        'operating_hours',
        'interval',
        'capacity',
        'rest_time',
        'public_holidays',
        'other_holidays'
    ];

    protected $casts = [
        'operating_hours' => 'json',
        'public_holidays' => 'json',
        'other_holidays' => 'json',
    ];

    public function week()
    {
        return [
            'Sunday'    => 'Sunday',
            'Monday'    => 'Monday',
            'Tuesday'   => 'Tuesday',
            'Wednesday' => 'Wednesday',
            'Thursday'  => 'Thursday',
            'Friday'    => 'Friday',
            'Saturday'  => 'Saturday',
        ];
    }

    public function outlet()
    {
        return $this->belongsTo('App\Models\Outlet', 'outlet_id');
    }
}
