<?php

namespace Database\Seeders;

use App\Models\ClubeModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clubes = [
            ['Clube A', '2000.00'],
            ['Clube B', '3000.00']
        ];

        foreach ($clubes as $clube) {
            $new_clube = ClubeModel::firstOrCreate([
                'clube' => $clube[0],
                'saldo_disponivel' => $clube[1]
            ]);
            $new_clube->save();
        }
    }
}
