<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'abn',
        'entity',
        'primary_phone',
        'fax',
        'director',
        'trade',
        'inc',
        'abbrev',
        'pl_expirey',
        'wc_expirey',
        'item_type',
        'path',
        'payment_terms',
        'contract_signed',
        'active',
    ];

    public function getActiveAttribute($attribute)
    {
        return $this->activeOptions()[$attribute] ?? 0;
    }

    public function activeOptions()
    {
        return [
            1 => 'y',
            0 => 'n',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
