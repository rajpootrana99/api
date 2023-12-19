<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'image',
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
