<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'image',
    ];

    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class);
    }
}
