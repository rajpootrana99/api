<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'image',
    ];

    public function items(){
        return $this->belongsTo(Item::class);
    }
}
