<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Store::create([
            'store_name'=>'Jaya Tani', 
            'store_status'=>'1',
            'user_id' => 1,
       ]);
    }
}
