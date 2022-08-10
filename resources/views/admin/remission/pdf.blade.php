<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ 'css/pdfs.css' }}">
        <title>Remision</title>

    </head>
    <header id="header">
        <!-- LOGGO -->
        <div class="center">
            <div id="logo">
                <img src="{{ public_path('images/logos/'.$company->logo) }}" alt="{{ $company->name }}" width="150px" height="50px" class="app-logo">
            </div>
        <!--DATOS company -->
            <div class="empresa">
                <p><strong id="nombre">{{  $company->name  }}</strong></p>

                <p id="datos">Nit: {{ $company->nit }} -- {{ $company->dv }}  <br> {{ $company->department }} {{ $company->municipality }} <br> {{ $company->address }} <br> Email: {{ $company->email }} <br> Telefono: {{ $company->phone }} Celular: {{ $company->mobile }}
                    </p>
            </div>
            <!--DATOS FACTURA -->
            <div id="factura">
                <p> <h4>REMISION <br> <strong id="numfact">N°.{{ $remissions->id }}</strong>  </h4>

                </p>
                <p> <h4>FECHA DE EMISION <br> <strong id="datosfact">{{ date('d-m-Y', strtotime($remissions->created_at)) }}</strong>  </h4>
                </p>
            </div>
        </div>
    </header>
    <body>
        <!--DATOS CLIENTE -->
        <div class="content">
            <div class="center">
                <div id="tcliente">
                    <span id="titulo"><strong>DATOS DEL OPERADOR</strong></span>
                </div>
            </div>
            <div class="center">
                <!--CODIGO QR -->
                <div id="cliente">
                    <!--DATOS CLIENTE -->
                    <div id="titc">
                        <span id="tc">CC o NIT: </span><br>
                        <span id="tc">DIRECCION:</span><br>
                        <span id="tc">EMAIL:    </span><br>
                    </div>
                    <div id="titd">
                        <span id="td">{{ $remissions->number }}</span><br>
                        <span id="td">{{ $remissions->address }}</span><br>
                        <span id="td">{{ $remissions->email }}</span><br>
                    </div>
                </div>
                <div id="cliente">
                    <!--DATOS CLIENTE -->
                    <div id="titc">
                        <span id="tc">NOMBRE:   </span><br>
                        <span id="tc">TELEFONO: </span><br>
                    </div>
                    <div id="titd">
                        <span id="td">{{ $remissions->name }}</span><br>
                        <span id="td">{{ $remissions->phone }}</span><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="contenido">
            <div class="center">
                <div id="ttabla">
                    <table class="tabla">
                        <!--DETALLE DE VENTA -->
                        <thead>
                            <tr>
                                <th id="uno">Cant.</th>
                                <th id="dos">Descripcion Operacion</th>
                                <th>Valor</th>
                                <th>SubTotal ($)</th>
                            </tr>
                        </thead>
                        <tbody class="detalle">
                            @foreach ($operationRemissions as $or)
                            <tr>
                                <td id="ccent">{{ number_format($or->quantity) }}</td>
                                <td>{{ $or->name }}</td>
                                <td class="tdder">${{ number_format($or->price)}}</td>
                                <td class="tdder">${{number_format($or->quantity * $or->price)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <!--DATOS FTOTALES -->
                            <tr>
                               <th colspan="3" class="footder">TOTAL:</th>
                               <td class="footder"><strong>${{number_format($remissions->total,2)}}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
        <div class="content">
            <div class="center">
                <div id="cliente">
                    <!--DATOS CLIENTE -->
                    <div id="titc">
                        <span >ELABORADO: </span><br>
                    </div>
                    <div id="titd">
                        <span>{{ $remissions->nameR }}</span><br>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <footer>
            Impreso por Emdisoft S.A.S. derechos reservados
        </footer>
    </body>
</html>



