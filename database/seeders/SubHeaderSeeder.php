<?php

namespace Database\Seeders;

use App\Models\SubHeader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_headers = [
            [
                'header_id' => 1,
                'cost_code' => '5-0101',
                'code' => 101,
                'sub_header' => 'Local Auth Fees'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0102',
                'code' => 102,
                'sub_header' => 'WaterCorp fees'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0103',
                'code' => 103,
                'sub_header' => 'Insurance-contract works,P/Liability'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0104',
                'code' => 104,
                'sub_header' => 'Documentation'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0105',
                'code' => 105,
                'sub_header' => 'Ascon Documentation'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0106',
                'code' => 106,
                'sub_header' => 'Surveyor'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0107',
                'code' => 107,
                'sub_header' => 'Temp Services'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0108',
                'code' => 108,
                'sub_header' => 'Advertising'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0109',
                'code' => 109,
                'sub_header' => 'Communications'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0110',
                'code' => 110,
                'sub_header' => 'Site Accomdtion'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0111',
                'code' => 111,
                'sub_header' => 'Provisions'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0112',
                'code' => 112,
                'sub_header' => 'Plant Purchases'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0113',
                'code' => 0113,
                'sub_header' => 'Plant Hire'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0114',
                'code' => 114,
                'sub_header' => 'Personel'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0115',
                'code' => 115,
                'sub_header' => 'Safety'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0116',
                'code' => 116,
                'sub_header' => 'Maintenance'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0117',
                'code' => 117,
                'sub_header' => 'Builders Contingency'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0118',
                'code' => 118,
                'sub_header' => 'Scaffold'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0119',
                'code' => 119,
                'sub_header' => 'Office Expenses'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0120',
                'code' => 120,
                'sub_header' => 'Bin Hire'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0121',
                'code' => 121,
                'sub_header' => 'Cleaning'
            ],
            [
                'header_id' => 1,
                'cost_code' => '5-0122',
                'code' => 122,
                'sub_header' => 'Consultants'
            ],
            [
                'header_id' => 2,
                'cost_code' => '5-0201',
                'code' => 201,
                'sub_header' => 'Demolition'
            ],
            [
                'header_id' => 3,
                'cost_code' => '5-0301',
                'code' => 301,
                'sub_header' => 'Shoring'
            ],
            [
                'header_id' => 3,
                'cost_code' => '5-0302',
                'code' => 302,
                'sub_header' => 'Retaining'
            ],
            [
                'header_id' => 3,
                'cost_code' => '5-0303',
                'code' => 303,
                'sub_header' => 'Earthworks'
            ],
            [
                'header_id' => 3,
                'cost_code' => '5-0304',
                'code' => 304,
                'sub_header' => 'Bitumen Pavior'
            ],
            [
                'header_id' => 3,
                'cost_code' => '5-0305',
                'code' => 305,
                'sub_header' => 'Brick Paving '
            ],
            [
                'header_id' => 3,
                'cost_code' => '5-0306',
                'code' => 306,
                'sub_header' => 'Brick Paver'
            ],
            [
                'header_id' => 3,
                'cost_code' => '5-0307',
                'code' => 307,
                'sub_header' => 'Landscaper'
            ],
            [
                'header_id' => 3,
                'cost_code' => '5-0308',
                'code' => 308,
                'sub_header' => 'Fencing'
            ],
            [
                'header_id' => 3,
                'cost_code' => '5-0309',
                'code' => 309,
                'sub_header' => 'Signs'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0401',
                'code' => 0401,
                'sub_header' => 'Concretor'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0402',
                'code' => 402,
                'sub_header' => 'Concrete supply'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0403',
                'code' => 403,
                'sub_header' => 'Reinforcement supply'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0404',
                'code' => 404,
                'sub_header' => 'Steel Fixer'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0405',
                'code' => 405,
                'sub_header' => 'Formworker'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0406',
                'code' => 406,
                'sub_header' => 'Formwork material'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0407',
                'code' => 407,
                'sub_header' => 'Concrete Testing'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0408',
                'code' => 408,
                'sub_header' => 'Concrete Cure'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0409',
                'code' => 409,
                'sub_header' => 'Concrete Cutting'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0410',
                'code' => 0410,
                'sub_header' => 'Joint Filling Concrete'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0411',
                'code' => 411,
                'sub_header' => 'Precast Panels'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0412',
                'code' => 412,
                'sub_header' => 'Concrete Pump'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0413',
                'code' => 413,
                'sub_header' => 'Place HD Bolts'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0414',
                'code' => 414,
                'sub_header' => 'Precast Brackets'
            ],
            [
                'header_id' => 4,
                'cost_code' => '5-0415',
                'code' => 415,
                'sub_header' => 'Panel Shop Drawings'
            ],
            [
                'header_id' => 5,
                'cost_code' => '5-0501',
                'code' => 501,
                'sub_header' => 'Steelworker'
            ],
            [
                'header_id' => 5,
                'cost_code' => '5-0502',
                'code' => 502,
                'sub_header' => 'Lintels- (Galv)'
            ],
        ];
        foreach ($sub_headers as $sub_header) {
            SubHeader::updateOrCreate([
                'header_id' => $sub_header['header_id'],
                'cost_code' => $sub_header['cost_code'],
                'code' => $sub_header['code'],
                'sub_header' => $sub_header['sub_header']
            ], $sub_header);
        }
    }
}
