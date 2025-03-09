<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkOrder extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'work_order_number',
        'product_name',
        'quantity',
        'deadline',
        'step',
        'operator_id'
    ];


    protected static function booted()
    {
        static::creating(function ($workOrder) {
            $date = now()->format('Ymd');
            $count = self::withTrashed()
                ->whereDate('created_at', now()->toDateString())->count() + 1;
            $workOrder->work_order_number = 'WO-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
            $workOrder->status = 1;
        });
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function progress()
    {
        return $this->hasMany(WorkOrderProgress::class);
    }
    public function lastprogress()
    {
        return $this->belongsTo(WorkOrderProgressMaster::class, 'status', 'step');
    }
}
