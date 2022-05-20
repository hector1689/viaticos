
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/img/esc-tam.png">
    <title>Comisión</title>
    <style media="screen">
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
        font-size: 9pt;
      }
      table{
        font-size: 6pt;
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
<!--     <div class="height:50px;"></div> -->
    <header>
      <br>
      <br><br>
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

              <span>Especificación de la Comisión</span><br>
              <!-- <span>Contraloría Gubernamental</span><br>
              <span>Declaración de Situación Patrimonial y de Intereses</span> -->
            </td>
          </tr>
        </tbody>
      </table>
    </header>
    <footer>
      Página
    </footer>
    <br><br>
    <div class="content">
      <table style="width: 100%;">
        <tbody>
          <tr style="border: 4px solid orange;">
            <td style="width: 100%;">
              <div style="text-align: right;font-size: 8pt;hyphens: auto;word-wrap: break-word;word-break: break-word;">
                Ciudad Victoria, Tamaulipas, <?php echo date('d');?> DE <?php

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


                ?> DE <?php echo date('Y');?>.
              </div>
              <div style="height:50px;"></div>

            </td>
          </tr>
        </tbody>
      </table>
      <!--///////////////////// FIN -->
      <span class="negras"></span><br>
      <label for="">Comisionado(s)</label>
      <table>
        @foreach($Personal as $per)
        <tr>
          <td>C.{{ $per->Personal_obt->nombre }} {{ $per->Personal_obt->apellido_paterno }} {{ $per->Personal_obt->apellido_materno }}</td>
        </tr>
        @endforeach
      </table>
      <br><br>
      <label for="">Especificar comisión</label>
      <table>
        <tr>
          <td>{{ $comision->especificar_comision}}</td>
        </tr>
      </table>
      <br>
      <br>
      <label for="">Recorrido Interno</label>
      <table>
        <tr>
          <td>{{ $comision->recorrido_interno}}</td>
        </tr>
      </table>
      <br>
      <br>
      <label for="">lugar de comisión</label>
      <table>
        <tr>
          <td>{{ $comision->Lugar_obt->obteneLocalidad->localidad }} - {{ $comision->Lugar_obt->obteneLocalidad->obteneMunicipio->nombre }} - {{ $comision->Lugar_obt->obteneLocalidad->obteneEstado->nombre }} - {{ $comision->Lugar_obt->obteneLocalidad->obtenePais->nombre }}</td>
        </tr>
      </table>
      <br>
      <br>
      <label for="">dirección</label>
      <table>
        <tr>
          <td>{{ $comision->direccion}}</td>
        </tr>
      </table>
      <br>
      <br>
      <label for="">teléfono(s) para su ubicación</label>
      <table>
        @foreach($telefonos as $tel)
        <tr>
          <td>Tel: {{ $tel->telefono }}</td>
        </tr>
        @endforeach
      </table>
      <br>
      <br>
      <label for="">Personas ante se acredita</label>
      <table>
        @foreach($acreditados as $acre)
        <tr>
          <td>{{ $acre->acreditado }}</td>
        </tr>
        @endforeach
      </table>
    </div>
  </body>
</html>
