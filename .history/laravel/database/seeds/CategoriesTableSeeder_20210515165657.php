<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name' => '息子'],
            ['category_name' => '娘'],
            ['category_name' => '犬'],
            ['category_name' => '猫'],
            ['category_name' => '犬']
        ]);
    }
}
