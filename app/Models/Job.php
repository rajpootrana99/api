<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'site_id',
        'description',
        'owner',
        'status',
        'completed_date',
        'days_in_progress',
        'total_sell_price',
        'profit',
        'percentage',
        'invoiced',
        'remaining_invoice_amount',
    ];

    public function getStatusAttribute($attribute)
    {
        return $this->statusOptions()[$attribute] ?? 0;
    }

    public function statusOptions()
    {
        return [
            2 => 'Completed',
            1 => 'Review',
            0 => 'In Progress',
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function site(){
        return $this->belongsTo(Site::class);
    }
}
