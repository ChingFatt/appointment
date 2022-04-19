<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Appointment extends Model
{
    use HasFactory, SoftDeletes, QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    const STATUSES = [
        'Cancelled' => 'Cancelled',
        'Scheduled' => 'Scheduled',
        'Pending' => 'Pending',
    ];

    protected $fillable = [
        'appointment_no',
        'fullname',
        'phone',
        'email',
        'gender',
        'industry_id',
        'merchant_id',
        'service_id',
        'outlet_id',
        'employee_id',
        'date',
        'time',
        'end_time',
        'duration',
        'comments',
        'status',
        'remarks',
        'action_by'
    ];

    protected $casts = [
        'service_id' => 'json',
        'employee_id' => 'json'
    ];

    public function setServiceIdAttribute($value)
    {
        $this->attributes['service_id'] = json_encode($value);
    }

    public function getServiceIdAttribute($value)
    {
        return $this->attributes['service_id'] = (string) $value;
    }

    public function services()
    {
        return json_decode($this->attributes['service_id']);
    }

    public function setEmployeeIdAttribute($value)
    {
        $this->attributes['employee_id'] = json_encode($value);
    }

    public function getEmployeeIdAttribute($value)
    {
        return $this->attributes['employee_id'] = (string) $value;
    }
    
    public function employees()
    {
        return json_decode($this->attributes['employee_id']);
    }

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id');
    }

    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant', 'merchant_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }

    public function outlet()
    {
        return $this->belongsTo('App\Models\Outlet', 'outlet_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_id');
    }

    public function getStatusColorAttribute($value)
    {
        return [
            'Scheduled' => 'success',
            'Cancelled' => 'danger',
        ][$this->status] ?? 'warning';
    }

    public function getCalendarStatusColorAttribute($value)
    {
        return [
            'Scheduled' => '#1fae77',
            'Cancelled' => '#e56767',
        ][$this->status] ?? '#e5ae67';
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'action_by');
    }
}
