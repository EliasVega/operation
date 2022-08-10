<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();

        $role->role = 'SuperAdmin';
        $role->description = 'Encargado del mantenimiento del sistema';

        $role->save();

        $role = new Role();

        $role->role = 'Administrador';
        $role->description = 'Es el responsable del mantenimiento de la empresa';

        $role->save();

        $role = new Role();

        $role->role = 'Supervisor';
        $role->description = 'Tiene las funciones tanto de supervision de la empresa';

        $role->save();

        $role = new Role();

        $role->role = 'Operativo';
        $role->description = 'Ejerce funciones de las operaciones de la empresa';

        $role->save();
    }
}
