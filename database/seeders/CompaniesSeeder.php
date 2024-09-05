<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('companies')->insert([
           
            [
     
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'company_name' => 'コカコーラ',
            'street_address' => null,
            'representative_name' => null,

    
            ],

            [
     
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'company_name' => 'サントリー',
                'street_address' => null,
                'representative_name' => null,
    
        
                ],
        
                [
     
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null,
                    'company_name' => 'アサヒ飲料',
                    'street_address' => null,
                    'representative_name' => null,
        
            
                    ],
                ]);         
    
    }
}
