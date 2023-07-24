<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'quote_id',
        'description',
        'no_of_units',
        'unit_price',
        'amount',
        'tax',
    ];

    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function quote(){
        return $this->belongsTo(Quote::class);
    }
}
