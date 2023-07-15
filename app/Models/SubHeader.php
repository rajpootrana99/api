<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_id',
        'cost_code',
        'code',
        'sub_header'
    ];

    public function estimates()
    {
        return $this->hasMany(Estimate::class);
    }

    public function header()
    {
        return $this->belongsTo(Header::class);
    }
}
