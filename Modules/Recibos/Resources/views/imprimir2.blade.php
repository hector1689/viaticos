<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>RECIBO DE VIATICOS</title>
  <link rel="shortcut icon" href="/img/EscTam.png" type="image/x-icon" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <link rel="stylesheet" href="/css/semantic/semantic.min.css"> --}}
  <link rel="stylesheet" href="/css/drive.min.css">
  <link href="/modules/fierros/css/print.css" type="text/css" rel="stylesheet" media="print"/>
  <script src="/js/jquery-3.4.1.min.js" charset="utf-8"></script>
  <script src="/css/semantic/semantic.min.js" charset="utf-8"></script>

  <style>
  *{
    font-family: 'Lato' !important;
    line-height: 14px;
    text-transform: uppercase;
  }
  @page {
    margin: 100px 50px 50px 50px;
  }
  header {
    position: fixed;
    top: -90px;
    left: 0px;
    right: 0px;
    height: 90px;
    background-position: left;
    background-size: 2em;
    background-repeat: no-repeat;
  }
  .nombre {
    text-align: right;
    font-weight: bold;
    font-size: 11pt;
  }
  .nombres {
    text-align: center;
    font-weight: bold;
    font-size: 12pt;
  }
  table{
    font-size: 10pt;
  }
  td.negras, span.negras{
    font-weight: 900;

  }
  table.borderTop td, table.borderTop th {
    border-top: 0.5px solid lightgray;
    border-collapse: collapse;
    word-wrap: break-word;
  }
  table.borderTop td.estaNo, table.borderTop th.estaNo {
    border: none;
  }
  th{
    font-weight: 900;
    text-align: left;
  }
  table.header{
    font-size: 12pt;

  }
  span.negras{
    font-size: 6pt;
  }
  footer {
    position: fixed;
    bottom: 0px;
    left: 0px;
    right: 0px;
    height: 20px;
    text-align: right;
    font-size: 8pt;
    font-weight: 900;
  }
  footer:after { content: counter(page, decimal); }

  </style>
</head>
<body>
  <!-- <ul class="toolbarx">
    <li class="back">
      <a href="/recibos"></a>
    </li>
    <li class="pdfIcon">
      <div></div>
    </li>
    <li class="title">
      <span>recibo de pagos de viáticos</span>
    </li>
    <li class="imprimir">
      <a class="print" href="javascript: void(0);" id="btn_edicion"></a>
    </li>
  </ul>
  <div class="visor" id="pdf"> -->

  <header>
    <table class="header">
      <tbody>
        <tr>
          <td>
            <img src="https://mesadeayuda.tamaulipas.gob.mx/images/tam.png" style=" height: 55px;">
          </td>
          <td>
            <span style="width: 25px; color: rgba(0,0,0,0);">.</span>
          </td>
          <td>
            <span>Tamaulipas</span><br>
            <span>recibo de pagos de viáticos</span><br>

          </td>
        </tr>
      </tbody>
    </table>
  </header>
  <footer>
    Página
  </footer>
  <!-- <div class="content"> -->

    <table style="width: 100%;">
      <tbody>
        <tr style="border: 4px solid orange;">
          <td style="width:100%;">
            <div class="nombre">
              <small style="right: 200px;">{{ $recibos->descripcion_comision }}</small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Folio: {{ $recibos->folio }}
              <br>
              <small ><?php echo date('d');?> DE <?php

              if (date('m') == 1) {
                echo 'ENERO';
              }elseif(date('m') == 2){
                echo 'FEBRERO';

              }elseif(date('m') == 3){
                echo 'MARZO';

              }elseif(date('m') == 4){
                echo 'ABRIL';

              }elseif(date('m') == 5){
                echo 'MAYO';

              }elseif(date('m') == 6){
                echo 'JUNIO';

              }elseif(date('m') == 7){
                echo 'JULIO';

              }elseif(date('m') == 8){
                echo 'AGOSTO';

              }elseif(date('m') == 9){
                echo 'SEPTIEMBRE';

              }elseif(date('m') == 10){
                echo 'OCTUBRE';

              }elseif(date('m') == 11){
                echo 'NOVIEMBRE';

              }elseif(date('m') == 12){
                echo 'DICIEMBRE';
              }


              ?> DE <?php echo date('Y');?>.</small>
            </div>
          </td>
          <td style="width: 30%; text-align: center;visibility:hidden;">
            <img src="https://staticstam.tamaulipas.gob.mx:9000/cdn/logotamgris.png" style=" height: 80px;">
          </td>
        </tr>
      </tbody>
    </table>
    <table style="width: 100%;" class="borderTop">
      <tbody>
        <!-- <tr>
          <td colspan="2" class="negras">1. Datos generales</td>
        </tr> -->
        <tr>
          <td style="width: 50%">oficio, comision: {{ $recibos->oficio_comision }}</td>
          <td style="width: 50%">dirección: {{ $recibos->direccion }}</td>
        </tr>
        <tr>
          <td style="width: 50%">departamento: {{ $recibos->departamentos }}</td>
          <td style="width: 50%">calve departamental: {{ $recibos->clave_departamental }}</td>
        </tr>
        <tr>
          <td colspan="2">lugar de adscripción: {{ $recibos->lugar_adscripcion }}</td>
        </tr>

      </tbody>
    </table>
        <br>
    <table style="width: 100%;" class="borderTop">
      <tbody>

        <tr>
          <td style="width: 50%">recibí de la secretaria:

            @isset($pagos->secretaria)
            {{$pagos->secretaria}}
            @else

            @endisset

            </td>
          <td style="width: 50%">n° de cheque:

            @isset($pagos->num_cheque)
            {{$pagos->num_cheque}}
            @else

            @endisset
          </td>
        </tr>
        <tr>
          <td style="width: 50%">de fecha:

            @isset($pagos->fehca_inicia)
            {{$pagos->fehca_inicia}}
            @else

            @endisset


          </td>
          <td style="width: 50%">por la cantidad de:
            @isset($pagos->cantidad)
              ${{$pagos->cantidad}}
            @else

            @endisset

        </td>
        </tr>
        <tr>
          <td colspan="2">letra:
            @isset($pagos->cantidad_letra)
              ({{$pagos->cantidad_letra}})
            @else

            @endisset

          </td>

        </tr>
        <tr>
          <td colspan="2">a mi favor y a cargo del banco:
            @isset($pagos->favor_cargo_banco)
              {{$pagos->favor_cargo_banco}}
            @else

            @endisset
          </td>
        </tr>

      </tbody>
    </table>
    <br>
    <table style="width: 100%;" class="borderTop">
      <tbody>

        <tr>
          <td style="width: 50%">Nombre: {{ $recibos->nombre }}</td>
          <td style="width: 50%">n° de empleado: {{ $recibos->num_empleado }}</td>
        </tr>
        <tr>
          <td style="width: 50%">rfc: {{ $recibos->rfc }}</td>
          <td style="width: 50%">nivel de servidor público: {{ $recibos->nivel }}</td>
        </tr>
        <tr>
          <td style="width: 50%">fecha y hora de salida: {{ $recibos->fecha_hora_salida }}</td>
          <td style="width: 50%">fecha y hora de retorno: {{ $recibos->fecha_hora_recibio }}</td>
        </tr>
        <tr>
          <td colspan="2">@foreach($lugares as $lugar) {{ $lugar->obteneLocalidades->obteneLocalidad->localidad }} MPIO de {{ $lugar->obteneLocalidades->obteneLocalidad->obteneMunicipio->nombre }},{{ $lugar->obteneLocalidades->obteneLocalidad->obteneEstado->nombre }},{{ $lugar->obteneLocalidades->obteneLocalidad->obtenePais->nombre }} a {{ $lugar->obteneLocalidades2->obteneLocalidad2->localidad  }} MPIO de {{ $lugar->obteneLocalidades2->obteneLocalidad2->obteneMunicipio->nombre }},{{ $lugar->obteneLocalidades2->obteneLocalidad2->obteneEstado->nombre }},{{ $lugar->obteneLocalidades2->obteneLocalidad2->obtenePais->nombre }}/ @endforeach</td>
        </tr>
        <tr>
          <td colspan="2">especificación de comisión: {{ $recibos->descripcion_comision }}</td>
        </tr>


      </tbody>
    </table>
    <br>
    <table style="width: 100%;" class="borderTop">
      <thead>
        <tr>
          <td>viáticos</td>
          <td>hospedaje</td>
          <td>importe</td>
          <td>alimentación</td>
          <td>importe</td>
          <td>dias</td>
          <td>totales</td>
        </tr>
      </thead>
      <tbody>
        @foreach($lugares as $lugar)
        <tr>
          <td style="width: 50%">
            @if(isset($Vehiculoficial))
            <?php

              if ($Vehiculoficial->tipo_viaje == 1) {
                echo 'REDONDO';
              }elseif($Vehiculoficial->tipo_viaje == 2){
                echo 'SOLO IDA';
              }elseif($Vehiculoficial->tipo_viaje == 3){
                echo 'SOLO VUELTA';
              }
             ?>
            @endif
             @if(isset($vehiculo))

             <?php

               if ($vehiculo->tipo_viaje == 1) {
                 echo 'REDONDO';
               }elseif($vehiculo->tipo_viaje == 2){
                 echo 'SOLO IDA';
               }elseif($vehiculo->tipo_viaje == 3){
                 echo 'SOLO VUELTA';
               }


              ?>

              @endif
             @if(isset($autobus))
             <?php

               if ($autobus->tipo_viaje == 1) {
                 echo 'REDONDO';
               }elseif($autobus->tipo_viaje == 2){
                 echo 'SOLO IDA';
               }elseif($autobus->tipo_viaje == 3){
                 echo 'SOLO VUELTA';
               }


              ?>
             @endif
             @if(isset($autobus))

             <?php

               if ($autobus->tipo_viaje == 1) {
                 echo 'REDONDO';
               }elseif($autobus->tipo_viaje == 2){
                 echo 'SOLO IDA';
               }elseif($autobus->tipo_viaje == 3){
                 echo 'SOLO VUELTA';
               }


              ?>
             @endif



          </td>
          <td style="width: 50%">cuota(I) $</td>
          <td style="width: 50%">{{ $lugar->hospedaje}}</td>
          <td style="width: 50%">cuota(I) $</td>
          <td style="width: 50%">
            <?php
              //$total_alimento = $lugar->desayuno + $lugar->comida + $lugar->cena;
              echo $lugar->desayuno;
             ?>
         </td>
          <td style="width: 50%">{{$lugar->dias}}</td>
          <td style="width: 50%">0</td>
        </tr>

        <tr>
          <td style="width: 50%"></td>
          <td style="width: 50%">cuota(II) $</td>
          <td style="width: 50%">0</td>
          <td style="width: 50%">cuota(II) $</td>
          <td style="width: 50%">
            <?php
              //$total_alimento = $lugar->desayuno + $lugar->comida + $lugar->cena;
              echo $lugar->comida;
             ?>
         </td>
          <td style="width: 50%">0</td>
          <td style="width: 50%">0</td>
        </tr>

        <tr>
          <td style="width: 50%"></td>
          <td style="width: 50%">cuota(III) $</td>
          <td style="width: 50%">0</td>
          <td style="width: 50%">cuota(III) $</td>
          <td style="width: 50%">
            <?php
              //$total_alimento = $lugar->desayuno + $lugar->comida + $lugar->cena;
              echo $lugar->cena;
             ?>
         </td>
          <td style="width: 50%">0</td>
          <td style="width: 50%">0</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>

        <tr>
          <td style="width: 50%"></td>
          <td style="width: 50%">Subtotal</td>
          <td style="width: 50%">
            <?php
            $suma = 0;
            foreach ($lugares as $key => $value) {
               $suma+=$value['hospedaje'];
            }
              echo $suma;
             ?>
          </td>
          <td style="width: 50%">Subtotal</td>
          <td style="width: 50%">
            <?php
            $sumad = 0;
            $sumac = 0;
            $sumace = 0;
            $sumatotal = 0;
            foreach ($lugares as $key => $value) {
              $sumad+=$value['desayuno'];
              $sumac+=$value['comida'];
              $sumace+=$value['cena'];

              $sumatotal = $sumad + $sumac + $sumace;
            }
              echo $sumatotal;
             ?>
          </td>
          <td style="width: 50%">TOtal</td>
          <td style="width: 50%">
            <?php
            $sumad = 0;
            $sumac = 0;
            $sumace = 0;
            $sumhotel = 0;
            $sumgasolina = 0;
            $sumatotal = 0;
            foreach ($lugares as $key => $value) {
              $sumad+=$value['desayuno'];
              $sumac+=$value['comida'];
              $sumace+=$value['cena'];
              $sumhotel+=$value['hospedaje'];
              $sumgasolina+=$value['combustible'];
              $sumatotal = $sumad + $sumac + $sumace + $sumhotel + $sumgasolina;
            }
              echo $sumatotal;
             ?>
          </td>
        </tr>

      </tfoot>
    </table>
    <!-- {{ $vehiculo }} <br> {{ $autobus }} <br> {{ $Vehiculoficial }} <br> {{ $peaje }} <br> {{ $taxi }} <br> {{ $avion }} -->
    <table style="width: 100%;" class="borderTop">
      <thead>
        <tr>
          <td>transportación</td>
          @if(isset($vehiculo)||isset($autobus)||isset($Vehiculoficial))
          <td>terrestre(x)</td>
          @else
          <td>terrestre()</td>
          @endif
          @if(isset($peaje)||isset($taxi))
          <td>con recorrido(x)</td>
          @else
          <td>con recorrido(x)</td>
          @endif
          @if(isset($avion))
          <td>aerea(x)</td>
          @else
          <td>aerea()</td>
          @endif

        </tr>
        <tr>
          <td colspan="2">especifique recorrido interno: {{ $transporte->especificar_recorrido }}</td>
        </tr>
      </thead>
    </table>
    <br>
    <br>
    <table style="width: 100%;" class="borderTop">
      <tbody>
        <tr>
          <td >n° vh.ofc.: @if(isset($Vehiculoficial)) x @endif</td>
          <td >autobus: @if(isset($autobus)) x @endif</td>
          <td >particular: @if(isset($vehiculo)) x @endif</td>
          <td >marca: @if(isset($Vehiculoficial)) {{ $Vehiculoficial->marca }} @endif @if(isset($vehiculo)) {{ $vehiculo->marca }} @endif</td>
          <td >modelo: @if(isset($Vehiculoficial)) {{ $Vehiculoficial->modelo }} @endif @if(isset($vehiculo)) {{ $vehiculo->modelo }} @endif</td>
        </tr>
        <tr>
          <td style="width: 30%">Tipo: @if(isset($Vehiculoficial)) {{ $Vehiculoficial->tipo }} @endif @if(isset($vehiculo)) {{ $vehiculo->tipo }} @endif</td>
          <td style="width: 30%">placas: @if(isset($Vehiculoficial)) {{ $Vehiculoficial->placas }} @endif @if(isset($vehiculo)) {{ $vehiculo->placas }} @endif</td>
          <td style="width: 40%" colspan="2">cilindraje: @if(isset($Vehiculoficial)) {{ $Vehiculoficial->cilindraje }} @endif  @if(isset($vehiculo)) {{ $vehiculo->cilindraje }} @endif</td>

        </tr>
        <tr>
          <td style="width: 30%">kms recorridos: {{ $transporte->kilometro_interno }}</td>
          <td style="width: 30%">
            cuota:
            @if(isset($Vehiculoficial))
                @foreach($rendimiento as $rendi)
                  @isset($Vehiculoficial)
                    @if($Vehiculoficial->cuota == $rendi->kilometros_litros)


                      <?php

                        if ($rendi->kilometros_litros == '9') {
                          echo 'a(x) b() c() d() e()';
                        }elseif($rendi->kilometros_litros == '7'){
                          echo 'a() b(x) c() d() e()';
                        }elseif($rendi->kilometros_litros == '5'){
                          echo 'a() b() c(x) d() e()';
                        }elseif($rendi->kilometros_litros == '2.5'){
                          echo 'a() b() c(x) d(x) e()';
                        }elseif($rendi->kilometros_litros == '3.3'){
                          echo 'a() b() c() d() e(x)';
                        }



                       ?>
                    @endif
                  @endisset
                @endforeach

            @endif


            @if(isset($vehiculo))
                @foreach($rendimiento as $rendi)
                  @isset($vehiculo)
                    @if($vehiculo->cuota == $rendi->kilometros_litros)


                      <?php

                        if ($rendi->kilometros_litros == '9') {
                          echo 'a(x) b() c() d() e()';
                        }elseif($rendi->kilometros_litros == '7'){
                          echo 'a() b(x) c() d() e()';
                        }elseif($rendi->kilometros_litros == '5'){
                          echo 'a() b() c(x) d() e()';
                        }elseif($rendi->kilometros_litros == '2.5'){
                          echo 'a() b() c(x) d(x) e()';
                        }elseif($rendi->kilometros_litros == '3.3'){
                          echo 'a() b() c() d() e(x)';
                        }



                       ?>
                    @endif
                  @endisset
                @endforeach
            @endif

            <!-- @if(isset($vehiculo))


                  @isset($vehiculo)
                  @foreach($rendimiento as $rendi)

                    @if($vehiculo->cuota == $rendi->kilometros_litros)
                    b(x)
                    @else
                    b()
                    @endif
                    @endforeach
                  @endisset

            @else
             a() b() c(x) d()
            @endif -->
          </td>
          <td style="width: 40%" colspan="3">total recorrido: {{ $transporte->total_km_recorrido }}</td>

        </tr>
        <tr>
          <td style="width: 30%">kms recorridos interno: {{ $transporte->total_km_recorrido }}</td>
          <td style="width: 30%">precio combustible: @if(isset($Vehiculoficial)) {{ $Vehiculoficial->gasolina_vh_oficial }} @endif  @if(isset($vehiculo)) {{ $vehiculo->gasolina_vh_oficial }} @endif</td>
          <td style="width: 40%" colspan="3">peaje/taxi/autobus:  @if(isset($peaje)) {{ $peaje->costo }} @endif / @if(isset($taxi)) {{ $taxi->tarifa_evento }} @endif / @if(isset($autobus)) {{ $autobus->costo_total }} @endif </td>

        </tr>

        <tr>
          <td style="width: 30%">kms: 0</td>
          <td style="width: 30%">()p/u: 0</td>
          <td style="width: 40%" >(/)cil: @if(isset($Vehiculoficial)) {{ $Vehiculoficial->cilindraje }} @endif @if(isset($vehiculo)) {{ $vehiculo->cilindraje }} @endif</td>
          <td style="width: 40%" colspan="2">total de transportación: {{ $transporte->total_transporte }}</td>

        </tr>
        <tr>
          <td style="width: 40%" colspan="4"> @if(isset($transporte)) @if($transporte->valeCombustible == 1) el combustible se proporciona en vales @else  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @endif @endif</td>

        </tr>
        <tr>
          <td style="width: 50%" colspan="2">{{ $recibos->nombre }}</td>
          <td style="width: 50%" colspan="1"><?php echo date('d');?> DE <?php

          if (date('m') == 1) {
            echo 'ENERO';
          }elseif(date('m') == 2){
            echo 'FEBRERO';

          }elseif(date('m') == 3){
            echo 'MARZO';

          }elseif(date('m') == 4){
            echo 'ABRIL';

          }elseif(date('m') == 5){
            echo 'MAYO';

          }elseif(date('m') == 6){
            echo 'JUNIO';

          }elseif(date('m') == 7){
            echo 'JULIO';

          }elseif(date('m') == 8){
            echo 'AGOSTO';

          }elseif(date('m') == 9){
            echo 'SEPTIEMBRE';

          }elseif(date('m') == 10){
            echo 'OCTUBRE';

          }elseif(date('m') == 11){
            echo 'NOVIEMBRE';

          }elseif(date('m') == 12){
            echo 'DICIEMBRE';
          }


          ?> DE <?php echo date('Y');?>.</td>
        </tr>
        <tr>
          <td style="width: 50%" colspan="2">comisionado</td>
          <td style="width: 50%" colspan="1"></td>
        </tr>


      </tbody>
    </table>
    <br>

    <!-- <div style="width:800px;">
      <div style="width:300px; float:left;text-align:center;">

        <p>_______________________________________</p>
        <small >javier sanchez sanchez</small>
        <small style="text-align:center">director de área <br> (nombre y firma)  </small>

      </div>
      <div style="width:300px; float:right;text-align:center;">

        <p>_______________________________________</p>
        <small >javier sanchez sanchez</small>
        <small >organo de control <br> (nombre y firma) </small>
      </div>
    </div>
    <div style="height:100px;"></div>


    <div style="width:400px;margin-left: auto;margin-right: auto;">
      <div style="width:400px; text-align:center;" >

        <p>_______________________________________</p>
        <small >javier sanchez sanchez</small>
        <small >director general <br> (nombre y firma)</small>
      </div>
    </div>


    <div style="height:100px;"></div>
    <div style="width:800px;">
      <div style="width:300px; float:left;text-align:center;" >

        <p>_______________________________________</p>
        <small >javier sanchez sanchez</small>
        <small >director administrativo <br> (nombre y firma)</small>

      </div>
      <div style="width:300px; float:right;text-align:center;">

        <p>_______________________________________</p>
        <small >javier sanchez sanchez</small>
        <small >recibi cheque <br> (nombre y firma)</small>
      </div>
    </div> -->

    <!--////////////////////////////////////////-->
    <div style="width:700px;">
      <div style="width:300px; float:left;text-align:center;font-size:7pt;">
        <small >{{ $recibos->nombre }}</small>
        <p>_______________________________________</p>
        <small style="text-align:center">Comisión</small>

      </div>
      <div style="width:300px; float:right;text-align:center;font-size:7pt;">
        <small >{{ $firmantes->director_area }}</small>
        <p>_______________________________________</p>
        <small >director de área</small>
      </div>
    </div>
    <div style="height:80px;"></div>
    <div style="width:700px;">
      <div style="width:300px; float:left;text-align:center;font-size:7pt;" >
        <small >{{ $firmantes->superior_inmediato }}</small>
        <p>_______________________________________</p>
        <small >superior inmediato</small>

      </div>
      <div style="width:300px; float:right;text-align:center;font-size:7pt;">
        <small >{{ $firmantes->organo_control }}</small>
        <p>_______________________________________</p>
        <small >organo de control</small>
      </div>
    </div>
    <div style="height:80px;"></div>
    <div style="width:700px;">
      <div style="width:300px; float:left;text-align:center;font-size:7pt;" >
        <small >{{ $firmantes->recibi_cheque }}</small>
        <p>_______________________________________</p>
        <small >recibi cheque</small>

      </div>
      <!-- <div style="width:300px; float:right;text-align:center;font-size:9pt;">
        <small >{{ $firmantes->organo_control }}</small>
        <p>_______________________________________</p>
        <small >organo de control</small>
      </div> -->
    </div>



    <!--///////////////////// FIN -->


  <!-- </div> -->

<!--
  </div> -->
