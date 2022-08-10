<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bank = new Bank();
        $bank->name = 'No Aplica';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'Nequi';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'Asopagos';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'bancolombia';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco Agrario';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco AV villas';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco BBVA';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco BCSC';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'bank Citibank';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco Coopcentral';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco Davivienda';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'bank de Bogota';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco de Occidente';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco Falabella';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'bank Finandina';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco GNB Sudameris';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco Itau';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco Mundo Mujer';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco Pichincha';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco Popular';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco Credifinanciera';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'banco Fogafin';
        $bank->save();

        $bank = new Bank();
        $bank->name = 'Otro';
        $bank->save();
    }
}
