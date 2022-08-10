<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();

        $category->code = 'CAM';
        $category->name = 'CAMISA';
        $category->description = 'Todas las prendas de vestir de tipo camisa';
        $category->status = 'ACTIVA';

        $category->save();

        $category = new Category();

        $category->code = 'BLU';
        $category->name = 'BLUSA';
        $category->description = 'Todas las prendas de vestir de tipo blusa';
        $category->status = 'ACTIVA';

        $category->save();

        $category = new Category();

        $category->code = 'CCR';
        $category->name = 'CONJUNTO CIRUGIA';
        $category->description = 'Todas las prendas de vestir de tipo Conjunto cirugia';
        $category->status = 'ACTIVA';

        $category->save();

        $category = new Category();

        $category->code = 'BAT';
        $category->name = 'BATA';
        $category->description = 'Todas las prendas de vestir de tipo bata';
        $category->status = 'ACTIVA';

        $category->save();

        $category = new Category();

        $category->code = 'CZT';
        $category->name = 'CAMISETA';
        $category->description = 'Todas las prendas de vestir de tipo Camiseta';
        $category->status = 'ACTIVA';

        $category->save();

        $category = new Category();

        $category->code = 'PAN';
        $category->name = 'PANTALON';
        $category->description = 'Todas las prendas de vestir de tipo pantalon';
        $category->status = 'ACTIVA';

        $category->save();

        $category = new Category();

        $category->code = 'OVE';
        $category->name = 'OVEROL';
        $category->description = 'Todas las prendas de vestir de tipo overol';
        $category->status = 'ACTIVA';

        $category->save();

        $category = new Category();

        $category->code = 'CHA';
        $category->name = 'CHALECO';
        $category->description = 'Todas las prendas de vestir de tipo chaleco';
        $category->status = 'ACTIVA';

        $category->save();

        $category = new Category();

        $category->code = 'CHT';
        $category->name = 'CHAQUETA';
        $category->description = 'Todas las prendas de vestir de tipo chaqueta';
        $category->status = 'ACTIVA';

        $category->save();

        $category = new Category();

        $category->code = 'COR';
        $category->name = 'CORBATA';
        $category->description = 'Todas las prendas de vestir de tipo corbatas';
        $category->status = 'ACTIVA';

        $category->save();

        $category = new Category();

        $category->code = 'OTR';
        $category->name = 'OTROS';
        $category->description = 'Relacion de procesos no comtemplados en categorias';
        $category->status = 'ACTIVA';

        $category->save();

        $category = new Category();

        $category->code = 'PIJ';
        $category->name = 'CORBATA';
        $category->description = 'Todas las prendas de vestir de tipo pijamas';
        $category->status = 'ACTIVA';

        $category->save();
    }
}
