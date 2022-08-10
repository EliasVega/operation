<?php

namespace Database\Seeders;

use App\Models\Operation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'ALMILLA PEGAR';
        $operation->price = 150;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'ALMILLA PEGAR Y PIZAR';
        $operation->price = 392;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 4;
        $operation->name = 'BATA COMPLETA CON CIERRE';
        $operation->price = 1650;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 2;
        $operation->name = 'BLUSA COMPLETA COSTURAS ABIERTAS';
        $operation->price = 5500;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 3;
        $operation->name = 'BLUSA QUIRURGICA';
        $operation->price = 5500;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 2;
        $operation->name = 'BLUSA COMPLETA';
        $operation->price = 3850;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 2;
        $operation->name = 'BLUSA SEMICOMPLETA';
        $operation->price = 4500;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 2;
        $operation->name = 'BLUSA SEMICOMPLETA (NO CUELLO, PUÑOS)';
        $operation->price = 3871;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'BOLSILLO PEGAR';
        $operation->price = 220;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'BOTAS HACER';
        $operation->price = 150;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'BOTON PEGAR';
        $operation->price = 18;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 7;
        $operation->name = 'BRAGA COMPLETA';
        $operation->price = 6000;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 7;
        $operation->name = 'BRAGA SEMICOMPLETA';
        $operation->price = 3850;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 5;
        $operation->name = 'BUSOS COMPLETOS';
        $operation->price = 5500;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'CAMISA COMPLETA';
        $operation->price = 4000;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 5;
        $operation->name = 'CAMISETA POLO COMPLETA';
        $operation->price = 4500;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'CERRADORA HOMBROS';
        $operation->price = 100;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'CERRADORA COSTADOS';
        $operation->price = 440;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'CERRADORA BRAGA';
        $operation->price = 5500;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'CERRADORA ESPALDA';
        $operation->price = 33333;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'CERRADORA PANTALONES';
        $operation->price = 420;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 8;
        $operation->name = 'CHALECO';
        $operation->price = 8000;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 9;
        $operation->name = 'CHAQUETA';
        $operation->price = 4950;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 9;
        $operation->name = 'CHAQUETA VIFENALCO CON VIVOS Y RIBETES';
        $operation->price = 7000;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'CHAPETA PAR PEGAR';
        $operation->price = 250;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'COCOTERA PEGAR';
        $operation->price = 220;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 3;
        $operation->name = 'COFIAS';
        $operation->price = 440;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();
        $operation = new Operation();

        $operation->category_id = 3;
        $operation->name = 'CONJUNTO DE CIRUGIA';
        $operation->price = 5500;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 10;
        $operation->name = 'CORBATAS';
        $operation->price = 385;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'CUELLO BOLIVAR HACER';
        $operation->price = 400;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 7;
        $operation->name = 'CUELLO BRAGA';
        $operation->price = 400;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'CUELLO CLASICO';
        $operation->price = 615;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'CUELLO CLASICO COMBINADO';
        $operation->price = 715;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'CUELLO PEGAR';
        $operation->price = 330;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 11;
        $operation->name = 'DIA LABORAL';
        $operation->price = 33333;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();



        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'DOBLADILLO CAMISA';
        $operation->price = 170;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'EMBONAR Y PIZAR HOMBRO';
        $operation->price = 165;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'ENCAUCHAR  BRAGA';
        $operation->price = 350;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'ESPALDA HACER';
        $operation->price = 392;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'ESPELUZAR';
        $operation->price = 200;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'ESPELUZAR PANTALO JEAN';
        $operation->price = 220;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 2;
        $operation->name = 'FILETEAR BLUSA';
        $operation->price = 385;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 7;
        $operation->name = 'FILETEAR BRAGA';
        $operation->price = 660;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'FILETEAR CAMISA';
        $operation->price = 440;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'FILETEAR PANTALON QUIRURGICO';
        $operation->price = 650;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();



        $operation = new Operation();

        $operation->category_id = 11;
        $operation->name = 'HORA LABORAL';
        $operation->price = 4167;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'JEAN DAMA COMPLETO';
        $operation->price = 4180;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'MARQUILLA PEGAR';
        $operation->price = 100;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'OJAL HACER';
        $operation->price = 22;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'PANTALON CON PRETINA ANATOMICA';
        $operation->price = 7000;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'PANTALON CON RIBETE Y PRETINA ANATOMICA';
        $operation->price = 8500;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'PANTALON DAMA';
        $operation->price = 5500;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'PANTALON JEAN DAMA CON PRETINA ANATOMICA';
        $operation->price = 6500;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'PANTALON JEAN HOMBRE';
        $operation->price = 4500;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'PANTALON MATERNO';
        $operation->price = 2750;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PARCHE';
        $operation->price = 200;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PARCHE PEGAR';
        $operation->price = 165;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 2;
        $operation->name = 'PANTAS';
        $operation->price = 80;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();


        $operation = new Operation();

        $operation->category_id = 2;
        $operation->name = 'PATAS PAR HACER';
        $operation->price = 154;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PECHERA DERECHA';
        $operation->price = 132;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PECHERA IZQUIERDA';
        $operation->price = 279;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PECHERA SOBREPUESTA';
        $operation->price = 330;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PUÑO PEGAR';
        $operation->price = 279;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'REFLECTIVO PEGAR';
        $operation->price = 132;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'REFLECTIVO ESPALDA PEGAR';
        $operation->price = 500;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'REFLECTIVO DELANTERO PEGAR';
        $operation->price = 400;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();



        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PERILLAS';
        $operation->price = 420;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PERILLA SESGADA';
        $operation->price = 450;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 2;
        $operation->name = 'PINZAS BLUSA';
        $operation->price = 84;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PIZAR ALMILLA';
        $operation->price = 132;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 7;
        $operation->name = 'PIZAR DELANTEROS';
        $operation->price = 77;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PIZAR ESPALDA';
        $operation->price = 77;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PIZAR MANGAS CAMISA';
        $operation->price = 220;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 7;
        $operation->name = 'PIZAR TRASERO BRAGA';
        $operation->price = 88;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PLANCHADA CAMISA';
        $operation->price = 250;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'PLANCHADA PANTALON';
        $operation->price = 250;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 6;
        $operation->name = 'PLANCHADA PANTALON COOPETRAN';
        $operation->price = 495;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 12;
        $operation->name = 'PLANCHADA PIJAMAS';
        $operation->price = 220;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'PUÑOS';
        $operation->price = 350;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'RECORTAR DOBLADILLO';
        $operation->price = 66;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'TAPAS PAR HACER';
        $operation->price = 250;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'TAPAS PAR PEGAR';
        $operation->price = 124;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 11;
        $operation->name = 'VARIOS';
        $operation->price = 105;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();

        $operation = new Operation();

        $operation->category_id = 1;
        $operation->name = 'VELCRO PAR PEGAR';
        $operation->price = 105;
        $operation->stock = 0;
        $operation->status = 'ACTIVA';

        $operation->save();
    }
}
