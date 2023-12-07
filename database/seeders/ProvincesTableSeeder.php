<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('provinces')->truncate();
        
        \DB::table('provinces')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'បន្ទាយមានជ័យ',
                'name_en' => 'Banteay Meanchey',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'បាត់ដំបង',
                'name_en' => 'Battambang',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'កំពង់ចាម',
                'name_en' => 'Kampong Cham',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'កំពង់ឆ្នាំង',
                'name_en' => 'Kampong Chhnang',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'កំពង់ស្ពឺ',
                'name_en' => 'Kampong Speu',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'កំពង់ធំ',
                'name_en' => 'Kampong Thom',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'កំពត',
                'name_en' => 'Kampot',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'កណ្ដាល',
                'name_en' => 'Kandal',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'កោះកុង',
                'name_en' => 'Koh Kong',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'ក្រចេះ',
                'name_en' => 'Kratié',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'មណ្ឌលគិរី',
                'name_en' => 'Mondulkiri',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'ភ្នំពេញ',
                'name_en' => 'Phnom Penh',
                'active' => 1,
                'is_city' => 1,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'ព្រះវិហារ',
                'name_en' => 'Preah Vihear',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'ព្រៃវែង',
                'name_en' => 'Prey Veng',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'ពោធិ៍សាត់',
                'name_en' => 'Pursat',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'រតនគិរី',
                'name_en' => 'Ratanak Kiri',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'សៀមរាប',
                'name_en' => 'Siem Reap',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'ព្រះសីហនុ',
                'name_en' => 'Preah Sihanouk',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'ស្ទឹងត្រែង',
                'name_en' => 'Stung Treng',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'ស្វាយរៀង',
                'name_en' => 'Svay Rieng',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'តាកែវ',
                'name_en' => 'Takéo',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'ឧត្ដរមានជ័យ',
                'name_en' => 'Oddar Meanchey',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'កែប',
                'name_en' => 'Kep',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'ប៉ៃលិន',
                'name_en' => 'Pailin',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'ត្បូងឃ្មុំ',
                'name_en' => 'Tboung Khmum',
                'active' => 1,
                'is_city' => 0,
                'created_at' => '2020-11-12 13:04:59',
                'updated_at' => '2020-11-12 13:04:59',
            ),
        ));
        
        
    }
}