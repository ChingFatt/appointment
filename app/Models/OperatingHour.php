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
        'rest_time'
    ];

    protected $casts = [
        'operating_hours' => 'json',
    ];

    public function setOperatingHourAttribute($value)
    {
        $this->attributes['operating_hours'] = json_encode($value);
    }

    public function getOperatingHourAttribute($value)
    {
        return $this->attributes['operating_hours'] = (string) $value;
    }

    public function week()
    {
        //$week = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
        return $week = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    }

    public function outlet()
    {
        return $this->belongsTo('App\Models\Outlet', 'outlet_id');
    }
}
