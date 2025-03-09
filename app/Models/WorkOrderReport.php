<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkOrderReport extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'work_order_id',
        'operator_id',
        'completed_quantity'
    ];

    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }
}
