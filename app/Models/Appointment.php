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

    public function getAppointmentStatusAttribute($value)
    {
        if ($this->attributes['status'] == 'Pending') {
            return '<span class="badge badge-warning">Pending</span>';
        } elseif ($this->attributes['status'] == 'Scheduled') {
            return '<span class="badge badge-success">Scheduled</span>';
        } elseif ($this->attributes['status'] == 'Cancelled') {
            return '<span class="badge badge-danger">Cancelled</span>';
        }
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'action_by');
    }
}
