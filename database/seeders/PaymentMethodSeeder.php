<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethod = new PaymentMethod();

        $paymentMethod->code = 1;
        $paymentMethod->name = 'Efectivo';

        $paymentMethod->save();

        $paymentMethod = new PaymentMethod();

        $paymentMethod->code = 2;
        $paymentMethod->name = 'Nequi';

        $paymentMethod->save();

        $paymentMethod = new PaymentMethod();

        $paymentMethod->code = 3;
        $paymentMethod->name = 'Transferencia';

        $paymentMethod->save();

        $paymentMethod = new PaymentMethod();

        $paymentMethod->code = 4;
        $paymentMethod->name = 'TC o TD';

        $paymentMethod->save();

        $paymentMethod = new PaymentMethod();

        $paymentMethod->code = 5;
        $paymentMethod->name = 'otros';

        $paymentMethod->save();
    }
}
