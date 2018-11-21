<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeploySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deploy')->insert([
            [
                'somefield' => 'laptops description laptops description laptops description laptops description laptops description laptops description laptops description laptops description',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'somefield' => 'gamer-laptops description gamer-laptops description gamer-laptops description gamer-laptops description gamer-laptops description gamer-laptops description ',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'somefield' => 'work-laptops description work-laptops description work-laptops description work-laptops description work-laptops description work-laptops description',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}
