<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Ramsey\Uuid\v1;

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
            6 => 'Cancelled',
            5 => 'Lost',
            4 => 'Won',
            3 => 'Submitted',
            2 => 'Draft',
            1 => 'In Progress',
            0 => 'Pending',
        ];
    }

    public function getPriorityAttribute($attribute)
    {
        return $this->priorityOptions()[$attribute] ?? 0;
    }

    public function priorityOptions()
    {
        return [
            3 => 'Urgent',
            2 => 'High',
            1 => 'Medium',
            0 => 'Low',
        ];
    }

    public function getQuoteTypeAttribute($attribute)
    {
        return $this->quoteTypeOptions()[$attribute] ?? 0;
    }

    public function quoteTypeOptions()
    {
        return [
            1 => 'Charge',
            0 => 'Fixed Do',
        ];
    }

    public function getTypeAttribute($attribute)
    {
        return $this->typeOptions()[$attribute] ?? 0;
    }

    public function typeOptions()
    {
        return [
            2 => 'type 2',
            1 => 'type 1',
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
