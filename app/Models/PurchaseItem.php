<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'estimate_id',
        'description',
        'qty',
        'unit_price',
        'amount',
        'tax',
    ];

    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function estimate(){
        return $this->belongsTo(Estimate::class);
    }
}
