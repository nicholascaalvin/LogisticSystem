<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_products')->insert([
            [
                'ProductPK' => 1,
                'ProductName' => 'Barang A'
            ],
            [
                'ProductPK' => 2,
                'ProductName' => 'Barang B'
            ],
            [
                'ProductPK' => 3,
                'ProductName' => 'Barang C'
            ],
        ]);
    }
}
