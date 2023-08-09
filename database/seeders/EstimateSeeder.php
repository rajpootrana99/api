<?php

namespace Database\Seeders;

use App\Models\Estimate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstimateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estimates = [
            [
                'sub_header_id' => 1,
                'item' => 'Inspection'
            ],
            [
                'sub_header_id' => 1,
                'item' => 'Building Services Levy Fee'
            ],
            [
                'sub_header_id' => 1,
                'item' => 'Certificate of classification Fee'
            ],
            [
                'sub_header_id' => 1,
                'item' => 'Council Fees'
            ],
            [
                'sub_header_id' => 1,
                'item' => 'CTF Levy'
            ],
            [
                'sub_header_id' => 2,
                'item' => 'Application-'
            ],
            [
                'sub_header_id' => 2,
                'item' => 'Stormwater-'
            ],
            [
                'sub_header_id' => 2,
                'item' => 'Headworks-Water-'
            ],
            [
                'sub_header_id' => 2,
                'item' => '-Sewer-'
            ],
            [
                'sub_header_id' => 2,
                'item' => 'Water Service (40mm) -'
            ],
            [
                'sub_header_id' => 2,
                'item' => 'Fire Service (150) -'
            ],
            [
                'sub_header_id' => 2,
                'item' => 'Inspection-'
            ],
            [
                'sub_header_id' => 3,
                'item' => 'Builders Indemnity Insurance'
            ],
            [
                'sub_header_id' => 3,
                'item' => 'Home Indemnity Insurance'
            ],
            [
                'sub_header_id' => 3,
                'item' => 'Workers Compensation'
            ],
            [
                'sub_header_id' => 3,
                'item' => 'Client Supplied Goods'
            ],
            [
                'sub_header_id' => 4,
                'item' => 'Tender Costs'
            ],
            [
                'sub_header_id' => 4,
                'item' => 'Consultant Contracts'
            ],
            [
                'sub_header_id' => 4,
                'item' => 'Client Contracts'
            ],
            [
                'sub_header_id' => 5,
                'item' => 'Handover Manual'
            ],
            [
                'sub_header_id' => 5,
                'item' => 'CAD Drawings'
            ],
            [
                'sub_header_id' => 6,
                'item' => 'Dilapidation Survey'
            ],
            [
                'sub_header_id' => 6,
                'item' => 'Boundary Pegging'
            ],
            [
                'sub_header_id' => 6,
                'item' => 'Retaining Setout'
            ],
            [
                'sub_header_id' => 6,
                'item' => 'Slab Setout'
            ],
            [
                'sub_header_id' => 6,
                'item' => 'Bolt Setout'
            ],
            [
                'sub_header_id' => 6,
                'item' => 'Ascon Survey'
            ],
            [
                'sub_header_id' => 7,
                'item' => 'Power Connection Fee'
            ],
            [
                'sub_header_id' => 7,
                'item' => 'Power Retic'
            ],
            [
                'sub_header_id' => 7,
                'item' => 'Power Consumption'
            ],
            [
                'sub_header_id' => 7,
                'item' => 'Water Connection'
            ],
            [
                'sub_header_id' => 7,
                'item' => 'Water Use'
            ],
            [
                'sub_header_id' => 8,
                'item' => 'Promo Banners'
            ],
            [
                'sub_header_id' => 10,
                'item' => 'Chem WC-'
            ],
            [
                'sub_header_id' => 10,
                'item' => 'Sewered WC-'
            ],
            [
                'sub_header_id' => 10,
                'item' => 'Office/Lunch-'
            ],
            [
                'sub_header_id' => 10,
                'item' => 'Sea Container-'
            ],
            [
                'sub_header_id' => 10,
                'item' => 'Delivery-Large-'
            ],
            [
                'sub_header_id' => 10,
                'item' => 'Small-'
            ],
            [
                'sub_header_id' => 10,
                'item' => 'Pump Outs'
            ],
            [
                'sub_header_id' => 13,
                'item' => 'Generator 15kv'
            ],
            [
                'sub_header_id' => 13,
                'item' => 'Generator 10kv'
            ],
            [
                'sub_header_id' => 13,
                'item' => 'Generator xxx'
            ],
            [
                'sub_header_id' => 13,
                'item' => 'High Pressure Cleaner'
            ],
            [
                'sub_header_id' => 13,
                'item' => 'Water Tank & Pump'
            ],
            [
                'sub_header_id' => 13,
                'item' => 'Hoist'
            ],
            [
                'sub_header_id' => 13,
                'item' => 'Boom'
            ],
            [
                'sub_header_id' => 13,
                'item' => 'Cranage'
            ],
            [
                'sub_header_id' => 13,
                'item' => 'Bobcat'
            ],
            [
                'sub_header_id' => 13,
                'item' => 'Temporary Fencing'
            ],
            [
                'sub_header_id' => 13,
                'item' => 'Lighting - Lift Shaft'
            ],
            
            [
                'sub_header_id' => 14,
                'item' => 'Supervisor'
            ],
            [
                'sub_header_id' => 14,
                'item' => 'Labourer'
            ],
            [
                'sub_header_id' => 14,
                'item' => 'Leading Hand'
            ],
            [
                'sub_header_id' => 14,
                'item' => 'Project Manager'
            ],
            [
                'sub_header_id' => 14,
                'item' => 'Design Manager'
            ],
            [
                'sub_header_id' => 15,
                'item' => 'Inspections'
            ],
            [
                'sub_header_id' => 15,
                'item' => 'Roof Safety Anchors-'
            ],
            [
                'sub_header_id' => 15,
                'item' => 'Ladder Bracket-'
            ],
            [
                'sub_header_id' => 18,
                'item' => 'Roof Tower Access'
            ],
            [
                'sub_header_id' => 18,
                'item' => 'Brickies Kits'
            ],
            [
                'sub_header_id' => 18,
                'item' => 'Stair Temp Hand Rail'
            ],
            [
                'sub_header_id' => 18,
                'item' => 'Slab Edge Protection'
            ],
            [
                'sub_header_id' => 18,
                'item' => 'Void Scaffold'
            ],
            [
                'sub_header_id' => 18,
                'item' => 'Roof Edge Protection'
            ],
            [
                'sub_header_id' => 18,
                'item' => 'Stair Scaffold'
            ],
            [
                'sub_header_id' => 18,
                'item' => 'Lift Gates'
            ],
            [
                'sub_header_id' => 18,
                'item' => 'Lift Scaffold'
            ],
            [
                'sub_header_id' => 19,
                'item' => 'Tender Costs'
            ],
            [
                'sub_header_id' => 19,
                'item' => 'Design Management'
            ],
            [
                'sub_header_id' => 19,
                'item' => 'Project Management'
            ],
            [
                'sub_header_id' => 19,
                'item' => 'Deliveries'
            ],
            [
                'sub_header_id' => 21,
                'item' => 'Cleaner'
            ],
            [
                'sub_header_id' => 21,
                'item' => 'Pressure Cleaning'
            ],
            [
                'sub_header_id' => 21,
                'item' => 'Road Sweeper'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Building Surveyor - CDC'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Building  Surveyor - CCC'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Architect - Design'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Architect - Inspections'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Architect - Lead Consultant'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Structural Engineer - Design'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Structural Engineer - Inspection'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Civil  Engineer - Design'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Civil  Engineer - Inspection'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Geotech  Engineer - Design'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Geotech - Inspection'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Hydraulic - Design'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Hydraulic - Inspection'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Electrical - Design'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Electrical - Inspections'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Fuel - Design'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Fuel - Inspections'
            ],
            [
                'sub_header_id' => 22,
                'item' => 'Fuel - DGL'
            ],
            [
                'sub_header_id' => 23,
                'item' => 'Internal Demolition'
            ],
            [
                'sub_header_id' => 23,
                'item' => 'External Demolition'
            ],
            [
                'sub_header_id' => 23,
                'item' => 'Strip out all internal walls'
            ],
        ];
        foreach ($estimates as $estimate) {
            Estimate::updateOrCreate([
                'sub_header_id' => $estimate['sub_header_id'],
                'item' => $estimate['item']
            ], $estimate);
        }
    }
}
