<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'eid',
        'qid',
        'line',
        'uid',
        'cost_code',
        'description',
        'unit',
        'qty',
        'rate',
        'amount',
        'margin',
        'subtotal',
        'gst',
        'amount_inc_gst',
        'variation_total',
        'work_cost',
        'inc_as_margin',
        'total_float',
        'total_margin',
        'quote_complete',
        'quote_type',
        'job_label',
        'write_orders',
        'eid_code',
        'vo',
        'total_extras',
        'cost_code_label',
        'amount_ordered',
        'capture_savings',
    ];

    public function getCostCodeAttribute($attribute)
    {
        return $this->costCodeOptions()[$attribute] ?? 0;
    }

    public function costCodeOptions()
    {
        return [
            3 => 'Furniture',
            2 => 'Window',
            1 => 'Ceilling',
            0 => 'Painter',
        ];
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
