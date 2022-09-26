<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_category = [
            'id' => 1,
            'title' => 'LIVRE',
            'color' => '#0041FE'
        ];

        $category = Category::find(1);

        if(is_null($category)) {
            Category::create($default_category);
        } else {
            $category->update($default_category);
        }
    }
}
