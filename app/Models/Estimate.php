<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_code',
        'cost_code',
        'header',
        'sub_header',
        'item',
        'label',
    ];

    public function getHeaderAttribute($attribute)
    {
        return $this->headerOptions()[$attribute] ?? 0;
    }

    public function headerOptions()
    {
        return [
            19 => 'FURNITURE',
            18 => 'PAINTING',
            17 => 'PARTITIONING',
            16 => 'GLAZING',
            15 => 'FLOOR FINISHES',
            14 => 'CEILINGS',
            13 => 'PLASTERING',
            12 => 'MECHANICAL SERVICES',
            11 => 'ELECTRICAL SERVICES',
            10 => 'HYDRAULIC SERVICES',
            9 => 'ROOF COVER',
            8 => 'JOINERY',
            7 => 'CARPENTRY',
            6 => 'BRICKWORK',
            5 => 'METALWORK',
            4 => 'STRUCTURAL STEELWORK',
            3 => 'CONCRETE',
            2 => 'SITEWORKS',
            1 => 'DEMOLITION',
            0 => 'PRELIMINARIES',
        ];
    }

    public function quotes(){
        return $this->hasMany(Quote::class);
    }

}
