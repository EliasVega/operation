<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ 'css/pdfs.css' }}">
        <title>PAgo</title>

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
                <p> <h4>PAGO<br> <strong id="numfact">N°.{{ $payment->id }}</strong>  </h4>

                </p>
                <p> <h4>FECHA DE EMISION <br> <strong id="datosfact">{{ date('d-m-Y', strtotime($payment->created_at)) }}</strong>  </h4>
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
                        <span id="td">{{ $payment->number }}</span><br>
                        <span id="td">{{ $payment->address }}</span><br>
                        <span id="td">{{ $payment->email }}</span><br>
                    </div>
                </div>
                <div id="cliente">
                    <!--DATOS CLIENTE -->
                    <div id="titc">
                        <span id="tc">NOMBRE:   </span><br>
                        <span id="tc">TELEFONO: </span><br>
                    </div>
                    <div id="titd">
                        <span id="td">{{ $payment->name }}</span><br>
                        <span id="td">{{ $payment->phone }}</span><br>
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
                                <th>O.P.</th>
                                <th>Ent</th>
                                <th>Operacion</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>SubTotal ($)</th>
                            </tr>
                        </thead>
                        <tbody class="detalle">
                            @foreach ($operatingPartials as $op)
                            <tr>
                                <td>{{ $op->idR }}</td>
                                <td>{{ $op->idPar }}</td>
                                <td>{{ $op->nameO }}</td>
                                <td>{{ $op->quantity }}</td>
                                <td class="tdder">${{ number_format($op->price)}}</td>
                                <td class="tdder">${{number_format($op->subtotal)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <!--DATOS FTOTALES -->
                            <tr>
                               <th colspan="5" class="footder">TOTAL DEVENGADOS:</th>
                               <td class="footder">${{ number_format( $payment->amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="ttabla">
                    <table class="tabla">
                        <!--DETALLE DE VENTA -->
                        <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Autorizado</th>
                                <th>Fecha</th>
                                <th>Descripcion</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody class="detalle">
                            @foreach ($advances as $adv)
                            <tr>
                                <td>{{ $adv->id }}</td>
                                <td>{{ $adv->nameR }}</td>
                                <td>{{ $adv->nameO }}</td>
                                <td>{{ $adv->created_at->format('yy-m-d') }}</td>
                                <td>{{ $adv->description }}</td>
                                <td class="tdder">$ -{{ $adv->amount }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <!--DATOS FTOTALES -->
                            <tr>
                               <th colspan="5" class="footder">TOTAL DEDUCCIONES:</th>
                               <td class="footder">${{ number_format( $advan, 2) }}</td>
                            </tr>
                            <br>
                            <tr>
                                <th colspan="5" class="footder">PAGO TOTAL:</th>
                                <td class="footder"><strong>${{ number_format($payment->amount - $advan, 2) }}</strong></td>
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
                        <span>{{ $payment->nameU }}</span><br>
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



