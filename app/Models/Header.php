<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_code',
        'code',
        'header',
    ];

    public function subHeaders()
    {
        return $this->hasMany(SubHeader::class);
    }
}
