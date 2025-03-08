<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::create([
            'name' => 'Mombasa',
            'areaCode' => '001',
        ]);

        Location::create([
            'name' => 'Nairobi',
            'areaCode' => '047',
        ]);

        Location::create([
            'name' => 'Nakuru',
            'areaCode' => '032',
        ]);

        Location::create([
            'name' => 'Kilifi',
            'areaCode' => '002',
        ]);
    }
}
