<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'site_id',
        'description',
        'priority',
        'eid',
        'item',
        'uid',
        'status',
        'completed_date',
        'days_in_progress',
        'quoted_price_ex_gst',
        'est_cost_price',
        'profit',
        'type',
        'proj_no',
        'requested_by',
        'requested_date',
        'requested_completion',
        'forecast_start_on_site',
        'project_duration',
        'forecast_completion',
        'forecast_value',
        'forecast_margin',
        'forecast_profit',
        'month',
        'quote_type',
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

    public function getPriorityAttribute($attribute)
    {
        return $this->priorityOptions()[$attribute] ?? 0;
    }

    public function priorityOptions()
    {
        return [
            2 => 'High',
            1 => 'Low',
            0 => 'None',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
