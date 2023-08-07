<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_header_id',
        'item',
    ];

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function subHeader()
    {
        return $this->belongsTo(SubHeader::class);
    }

    public function purchaseItem(){
        return $this->hasMany(PurchaseItem::class);
    }
}
