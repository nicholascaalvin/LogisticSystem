<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_suppliers')->insert([
            [
                'SupplierPK' => 1,
                'SupplierName' => 'Nicholas'
            ],
            [
                'SupplierPK' => 2,
                'SupplierName' => 'Calvin'
            ]
        ]);
    }
}
