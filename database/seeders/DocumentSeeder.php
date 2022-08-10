<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $document = new Document();

        $document->code = 12;
        $document->name = 'Tarjeta de Identidad';
        $document->initials = 'T.I.';

        $document->save();

        $document = new Document();

        $document->code = 13;
        $document->name = 'Cedula de Ciudadania';
        $document->initials = 'C.C.';

        $document->save();

        $document = new Document();

        $document->code = 21;
        $document->name = 'Tarjeta de extrangeria';
        $document->initials = 'T.E.';

        $document->save();

        $document = new Document();

        $document->code = 22;
        $document->name = 'Cedula de extranjeria';
        $document->initials = 'C.E.';

        $document->save();

        $document = new Document();

        $document->code = 31;
        $document->name = 'NIT';
        $document->initials = 'NIT';

        $document->save();

        $document = new Document();

        $document->code = 41;
        $document->name = 'Pasaporte';
        $document->initials = 'PAS';

        $document->save();

        $document = new Document();

        $document->code = 42;
        $document->name = 'Documento de identificacion extranjero';
        $document->initials = 'D.I.E.';

        $document->save();
    }

}
