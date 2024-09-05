<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
           
        [
 
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => null,
        'company_id' => 1,
        'product_name' => 'コカコーラ',
        'price' => 180,
        'stock' => 20,
        'comment' => 'テスト1',
        'img_path' => 'aaaaaa',

        ],

        [
 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'company_id' => 2,
            'product_name' => 'オレンジジュース',
            'price' => 120,
            'stock' => 30,
            'comment' => 'テスト2',
            'img_path' => 'bbbbbb',
    
            ],

            [
 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'company_id' => 3,
                'product_name' => 'アイスコーヒー',
                'price' => 100,
                'stock' => 50,
                'comment' => 'テスト3',
                'img_path' => 'cccccc',
        
                ],
            
    
        ]);
    }
}
