<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'parent_id' => null,
                'name' => 'Category 1',
                'slug' => 'category-1',
                'description' => 'Category 1 Description',
            ],
            [
                'parent_id' => null,
                'name' => 'Category 2',
                'slug' => 'category-2',
                'description' => 'Category 2 Description',
            ],
            [
                'parent_id' => 1,
                'name' => 'Category 1 Child 1',
                'slug' => 'category-1-child-1',
                'description' => 'Category 1 Child 1 Description',
            ],
            [
                'parent_id' => 1,
                'name' => 'Category 1 Child 2',
                'slug' => 'category-1-child-2',
                'description' => 'Category 1 Child 2 Description',
            ]
        ]);
    }
}
