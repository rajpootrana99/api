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
        'estimate_id',
        'description',
        'unit',
        'qty',
        'rate',
        'account',
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
        'order_unit_price',
        'order_total_amount',
        'eid_code',
        'vo',
        'total_extras',
        'cost_code_label',
        'amount_ordered',
        'capture_savings',
        'movement',
    ];

    public function getAccountAttribute($attribute)
    {
        return $this->accountOptions()[$attribute] ?? 0;
    }

    public function accountOptions()
    {
        return [
            2 => 'Management Income',
            1 => 'Construction Income',
            0 => 'Maintenance Income',
        ];
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function estimate(){
        return $this->belongsTo(Estimate::class);
    }

    public function invoices(){
        return $this->belongsToMany(Invoice::class)->withPivot('description', 'qty', 'rate', 'amount', 'tax', 'total');
    }

    public function purchaseOrders(){
        return $this->belongsToMany(PurchaseOrder::class)->withPivot('description', 'qty', 'rate', 'amount', 'tax', 'total');
    }
}
