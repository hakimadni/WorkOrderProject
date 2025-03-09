<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkOrderProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_order_id',
        'step',
        'note',
        'started_at',
        'ended_at'
    ];

    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    public function progressMaster()
    {
        return $this->belongsTo(WorkOrderProgressMaster::class, 'step', 'step');
    }
}
