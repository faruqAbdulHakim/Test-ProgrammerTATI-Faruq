<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(
            file_get_contents('https://wilayah.id/api/provinces.json')
        )->data;
        foreach ($data as $d) {
            Province::create([
                'name' => $d->name,
                'lat' => $d->coordinates->lat,
                'lng' => $d->coordinates->lng,
            ]);
        }
    }
}
