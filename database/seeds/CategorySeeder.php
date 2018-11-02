<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                'name' => 'Ноутбуки',
                'slug' => 'laptops',
                'description' => 'laptops description laptops description laptops description laptops description laptops description laptops description laptops description laptops description',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => null,
                'name' => 'Игровые Ноутбуки',
                'slug' => 'gamer-laptops',
                'description' => 'gamer-laptops description gamer-laptops description gamer-laptops description gamer-laptops description gamer-laptops description gamer-laptops description ',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => null,
                'name' => 'Ноутбуки для Офиса',
                'slug' => 'work-laptops',
                'description' => 'work-laptops description work-laptops description work-laptops description work-laptops description work-laptops description work-laptops description',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => null,
                'name' => 'Мониторы',
                'slug' => 'monitors',
                'description' => 'monitors description monitors description monitors description monitors description monitors description monitors description monitors description monitors description',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => null,
                'name' => 'Планшеты',
                'slug' => 'tablets',
                'description' => 'tablets description tablets description tablets description tablets description tablets description tablets description tablets description tablets description',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => null,
                'name' => 'Электронные Книги',
                'slug' => 'ebook-readers',
                'description' => 'ebook-readers description ebook-readers description ebook-readers description ebook-readers description ebook-readers description ebook-readers description ',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}
