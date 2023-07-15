<?php

namespace Database\Seeders;

use App\Models\Header;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $headers = [
            [
                'major_code' => '5-2000',
                'code' => 2000,
                'header' => 'FURNITURE'
            ],
            [
                'major_code' => '5-1900',
                'code' => 1900,
                'header' => 'PAINTING'
            ],
            [
                'major_code' => '5-1800',
                'code' => 1800,
                'header' => 'PARTITIONING'
            ],
            [
                'major_code' => '5-1700',
                'code' => 1700,
                'header' => 'GLAZING'
            ],
            [
                'major_code' => '5-1600',
                'code' => 1600,
                'header' => 'FLOOR FINISHES'
            ],
            [
                'major_code' => '5-1500',
                'code' => 1500,
                'header' => 'CEILINGS'
            ],
            [
                'major_code' => '5-1400',
                'code' => 1400,
                'header' => 'PLASTERING'
            ],
            [
                'major_code' => '5-1300',
                'code' => 1300,
                'header' => 'MECHANICAL SERVICES'
            ],
            [
                'major_code' => '5-1200',
                'code' => 1200,
                'header' => 'ELECTRICAL SERVICES'
            ],
            [
                'major_code' => '5-1100',
                'code' => 1100,
                'header' => 'HYDRAULIC SERVICES'
            ],
            [
                'major_code' => '5-1000',
                'code' => 1000,
                'header' => 'ROOF COVER'
            ],
            [
                'major_code' => '5-0900',
                'code' => 900,
                'header' => 'JOINERY'
            ],
            [
                'major_code' => '5-0800',
                'code' => 800,
                'header' => 'CARPENTRY'
            ],
            [
                'major_code' => '5-0700',
                'code' => 700,
                'header' => 'BRICKWORK'
            ],
            [
                'major_code' => '5-0600',
                'code' => 600,
                'header' => 'METALWORK'
            ],
            [
                'major_code' => '5-0500',
                'code' => 500,
                'header' => 'STRUCTURAL STEELWORK'
            ],
            [
                'major_code' => '5-0400',
                'code' => 400,
                'header' => 'CONCRETE'
            ],
            [
                'major_code' => '5-0300',
                'code' => 300,
                'header' => 'SITEWORKS'
            ],
            [
                'major_code' => '5-0200',
                'code' => 200,
                'header' => 'DEMOLITION'
            ],
            [
                'major_code' => '5-0100',
                'code' => 100,
                'header' => 'PRELIMINARIES'
            ],
        ];
        foreach ($headers as $header) {
            Header::updateOrCreate([
                'major_code' => $header['major_code'],
                'code' => $header['code'],
                'header' => $header['header']
            ], $header);
        }
    }
}
