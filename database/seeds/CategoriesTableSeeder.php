<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        /*DB::insert('INSERT INTO `tbl_categories` [`name`,`slug`, `description`] VALUES [?, ?, ?]', [
            'Politics',
            'politics',
            'Articles about politics'
        ]);*/

        //2
        DB::table('categories')->insert([
            [
                'name' => 'Politics',
                'slug' => 'politics',
                'description' => 'Articles about politics',
            ],
            //
            [
                'name' => 'Art',
                'slug' => 'art',
                'description' => 'Articles about art',
            ],
            //
            [
                'name' => 'Study',
                'slug' => 'study',
                'description' => 'Articles about study',
            ]
        ]);

        //3
        Category::create([
            'name' => 'Sport',
            'slug' => 'sport',
            'description' => 'Articles about sport',
        ]);
    }
}
