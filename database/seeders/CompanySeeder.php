<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = new Company();

        $company->department_id = 21;
        $company->municipality_id = 845;
        $company->name = 'Ecounts';
        $company->nit = '123456789';
        $company->dv = 3;
        $company->address = 'Carrera 21 # 99-27 Fontana';
        $company->phone = '6312957';
        $company->mobile = '3166973219';
        $company->manager = 'ELVIRA VALDIVIESO REY';
        $company->email = 'confecciones.empresariales@gmail.com';
        $company->logo = '1659792962.jpg';

        $company->save();
    }
}
