<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user->company_id = 1;
        $user->document_id = 2;
        $user->role_id = 1;
        $user->bank_id = 1;
        $user->payment_method_id = 3;
        $user->name = 'ELIAS VEGA DELGADO';
        $user->number = '91260182';
        $user->address = 'Carrera 21 # 99-27 Fontana';
        $user->phone = '3168886468';
        $user->email = 'discom.is@gmail.com';
        $user->password = bcrypt('matrix2012');
        $user->position = 'Administrador Sistema';
        $user->reference = '124578';
        $user->status = 'ACTIVO';

        $user->save();

        $user = new User();

        $user->company_id = 1;
        $user->document_id = 2;
        $user->role_id = 1;
        $user->bank_id = 1;
        $user->payment_method_id = 3;
        $user->name = 'JHON A. VEGA VALDIVIESO';
        $user->number = '1098713336';
        $user->address = 'Carrera 21 # 99-27 Fontana';
        $user->phone = '3168886468';
        $user->email = 'confecciones.empresariales@gmail.com';
        $user->password = bcrypt('1098713336');
        $user->position = 'Administrativo';
        $user->reference = '124578';
        $user->status = 'ACTIVO';

        $user->save();

        $user = new User();

        $user->company_id = 1;
        $user->document_id = 2;
        $user->role_id = 2;
        $user->bank_id = 2;
        $user->payment_method_id = 3;
        $user->name = 'ELVIRA VALDIVIESO';
        $user->number = '63360018';
        $user->address = 'Carrera 21 # 99-27 Bucaramanga';
        $user->phone = '3168666777';
        $user->email = 'confecciones.empresariales@hotmail.com';
        $user->password = bcrypt('63360018');
        $user->position = 'Administrativo';
        $user->reference = '3167895511';
        $user->status = 'ACTIVO';

        $user->save();

        $user = new User();

        $user->company_id = 1;
        $user->document_id = 2;
        $user->role_id = 3;
        $user->bank_id = 4;
        $user->payment_method_id = 3;
        $user->name = 'DIANA SARMIENTO';
        $user->number = '63527670';
        $user->address = 'Carrera 45 # 58-47 Bucaramanga';
        $user->phone = '3168666479';
        $user->email = 'diana@gmail.com';
        $user->password = bcrypt('63527670');
        $user->position = 'Supervisor';
        $user->reference = '3167895500';
        $user->status = 'ACTIVO';

        $user->save();

        $user = new User();

        $user->company_id = 1;
        $user->document_id = 2;
        $user->role_id = 4;
        $user->bank_id = 2;
        $user->payment_method_id = 3;
        $user->name = 'PEPITO PEREZ';
        $user->number = '44444444';
        $user->address = 'Carrera 6 # 12-27 Bucaramanga';
        $user->phone = '316458468';
        $user->email = 'pepito@gmail.com';
        $user->password = bcrypt('pepito');
        $user->position = 'Operaciones';
        $user->reference = '3167895599';
        $user->status = 'ACTIVO';

        $user->save();

        $user = new User();

        $user->company_id = 1;
        $user->document_id = 2;
        $user->role_id = 4;
        $user->bank_id = 2;
        $user->payment_method_id = 3;
        $user->name = 'PRUEBA 1';
        $user->number = '5555555';
        $user->address = 'Carrera 6 # 12-27 Bucaramanga';
        $user->phone = '316458478';
        $user->email = 'pepito1@gmail.com';
        $user->password = bcrypt('pepito1');
        $user->position = 'Operaciones';
        $user->reference = '3167895588';
        $user->status = 'ACTIVO';

        $user->save();

        $user = new User();

        $user->company_id = 1;
        $user->document_id = 2;
        $user->role_id = 4;
        $user->bank_id = 11;
        $user->payment_method_id = 3;
        $user->name = 'PRUEBA 2';
        $user->number = '454584854';
        $user->address = 'Carrera 6 # 12-27 Bucaramanga';
        $user->phone = '316458478';
        $user->email = 'pepito2@gmail.com';
        $user->password = bcrypt('pepito2');
        $user->position = 'Operaciones';
        $user->reference = '21456897542';
        $user->status = 'ACTIVO';

        $user->save();

        $user = new User();

        $user->company_id = 1;
        $user->document_id = 2;
        $user->role_id = 4;
        $user->bank_id = 11;
        $user->payment_method_id = 3;
        $user->name = 'PRUEBA 3';
        $user->number = '1616161';
        $user->address = 'Carrera 6 # 12-27 Bucaramanga';
        $user->phone = '316458478';
        $user->email = 'pepito3@gmail.com';
        $user->password = bcrypt('pepito3');
        $user->position = 'Operaciones';
        $user->reference = '2548964785';
        $user->status = 'ACTIVO';

        $user->save();

        $user = new User();

        $user->company_id = 1;
        $user->document_id = 2;
        $user->role_id = 4;
        $user->bank_id = 2;
        $user->payment_method_id = 3;
        $user->name = 'PRUEBA 4';
        $user->number = '151515';
        $user->address = 'Carrera 6 # 12-27 Bucaramanga';
        $user->phone = '316458478';
        $user->email = 'pepito4@gmail.com';
        $user->password = bcrypt('pepito4');
        $user->position = 'Operaciones';
        $user->reference = '3165556677';
        $user->status = 'ACTIVO';

        $user->save();
    }
}
