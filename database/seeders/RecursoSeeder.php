<?php

namespace Database\Seeders;

use App\Models\RecursoModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recursos = [
            ['Recurso para passagens ', '10000.00'],
            ['Recurso para hospedagens', '10000.00']
        ];

        foreach ($recursos as $recurso) {
            $new_clube = RecursoModel::firstOrCreate([
                'recurso' => $recurso[0],
                'saldo_disponivel' => $recurso[1]
            ]);
            $new_clube->save();
        }
    }
}
