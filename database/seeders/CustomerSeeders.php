<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_customers')->insert([
            [
                'CustomerPK' => 1,
                'CustomerName' => 'Antonius'
            ],
            [
                'CustomerPK' => 2,
                'CustomerName' => 'Xaverius'
            ]
        ]);
    }
}
