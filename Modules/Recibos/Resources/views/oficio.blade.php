
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/img/esc-tam.png">
    <link rel="stylesheet" href="/css/drive.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

      .visor{
      background-color: rgb(255, 255, 255);
        width: 720px;
        height: 1200px;
        margin: 0 auto;
        padding: 96px;
    }
    .visor table{
      font-size: 10px;
      text-align: justify;
    }

    .contenedor{
    position: relative;
    display: inline-block;
    text-align: center;
    }
    </style>
  </head>
  <body>
<!--     <div class="height:50px;"></div> -->
    <!-- <header>
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

              <span>Oficio de Comisión</span><br>

            </td>
          </tr>
        </tbody>
      </table>
    </header>
    <footer>
      Página
    </footer>
    <br><br> -->
    <ul class="toolbarx">
      <li class="regresar">
        <a href="/recibos"></a>
      </li>
      <li class="pdfIcon">
        <div></div>
      </li>
      <li class="title">
        <span>oficio de comisión</span>
      </li>
      <li class="imprimir">
        <a class="print" href="javascript: void(0);" id="btn_edicion"></a>
      </li>
    </ul>
    <div class="visor" id="pdf">
    <div class="content">
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

              <span>Oficio de Comisión</span><br>

            </td>
          </tr>
        </tbody>
      </table>
      <table style="width: 100%;">
        <tbody>
          <tr style="border: 4px solid orange;">
            <td style="width: 100%;">
              <div style="text-align: right;font-size: 8pt;hyphens: auto;word-wrap: break-word;word-break: break-word;">
                Oficio n° <strong>{{ $recibos->oficio_comision }}</strong> <br> a <?php echo date('d');?> DE <?php

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
              <div  style="text-align: left;font-size: 8pt;hyphens: auto;word-wrap: break-word;word-break: break-word;">
                C. {{ $recibos->nombre }}
                <br>
                Presente
              </div>
              <div style="height:50px;"></div>

            </td>
          </tr>
        </tbody>
      </table>
      <!--///////////////////// FIN -->
      <span class="negras"></span><br>

      <p style="font-size: 9.5pt;text-align:justify;">
        sirvase presentarse de @foreach($lugares as $lugar) {{ $lugar->obteneLocalidades->obteneLocalidad->localidad }} MPIO de {{ $lugar->obteneLocalidades->obteneLocalidad->obteneMunicipio->nombre }},{{ $lugar->obteneLocalidades->obteneLocalidad->obteneEstado->nombre }},{{ $lugar->obteneLocalidades->obteneLocalidad->obtenePais->nombre }} a {{ $lugar->obteneLocalidades2->obteneLocalidad2->localidad }} MPIO de {{ $lugar->obteneLocalidades2->obteneLocalidad2->obteneMunicipio->nombre }},{{ $lugar->obteneLocalidades2->obteneLocalidad2->obteneEstado->nombre }} / @endforeach los dias del
        <?php
        list($fecha,$hora) = explode(' ',$recibos->fecha_hora_salida);
        list($dia,$mes,$anio) = explode('-',$fecha);
        echo $anio;
         ?>
         al
         <?php
         list($fecha2,$hora2) = explode(' ',$recibos->fecha_hora_recibio);
         list($dia2,$mes2,$anio2) = explode('-',$fecha2);
         echo $anio2;
          ?>
          de
          <?php
          list($fecha2,$hora2) = explode(' ',$recibos->fecha_hora_recibio);
          list($dia2,$mes2,$anio2) = explode('-',$fecha2);
                  if ($mes2 == 1) {
                    echo 'ENERO';
                  }elseif($mes2 == 2){
                    echo 'FEBRERO';

                  }elseif($mes2 == 3){
                    echo 'MARZO';

                  }elseif($mes2 == 4){
                    echo 'ABRIL';

                  }elseif($mes2 == 5){
                    echo 'MAYO';

                  }elseif($mes2 == 6){
                    echo 'JUNIO';

                  }elseif($mes2 == 7){
                    echo 'JULIO';

                  }elseif($mes2 == 8){
                    echo 'AGOSTO';

                  }elseif($mes2 == 9){
                    echo 'SEPTIEMBRE';

                  }elseif($mes2 == 10){
                    echo 'OCTUBRE';

                  }elseif($mes2 == 11){
                    echo 'NOVIEMBRE';

                  }elseif($mes2 == 12){
                    echo 'DICIEMBRE';
                  }
           ?>

          para llevar a cabo la siguiente comisión: <strong>{{ $recibos->descripcion_comision }}</strong> debiendo partir el dia
         <?php
         list($fecha,$hora) = explode(' ',$recibos->fecha_hora_salida);

         list($dia,$mes,$anio) = explode('-',$fecha);
         $fecha = $anio.'/'.$mes.'/'.$dia;
         echo $fecha1 = $fecha.' a las '.$hora;

          ?>
          y retornar el dia
          <?php
         list($fecha,$hora) = explode(' ',$recibos->fecha_hora_recibio);

         list($dia,$mes,$anio) = explode('-',$fecha);
         $fecha = $anio.'/'.$mes.'/'.$dia;
         echo $fecha2 = $fecha.' a las '.$hora;

          ?>
<!--

         {{ $recibos->fecha_hora_salida }}  7:00 y retornar el dia  {{ $recibos->fecha_hora_recibio }} a las 19:30 hrs -->
         .
      </p>
      <br><br>
      <p style="font-size: 9.5pt;text-align:justify;">
        como servidor público tendra la obligación de salvaguardar la legalidad,honradez,lealtad,imparcialidad y eficacia en el desempeño de su comisión. cuyo incumplimiento dára lugar al procedimiento y a las sanciones que correspondan,
        según la naturaleza de la infracción en que se incurra según lo establece el titulo tercero de la ley de responsabilidades de servidores públicos. al regreso de la comisión deberá presentar este oficio sellado y firmado por la
        autoridad correspondiente en el lugar donde efectuó la comisión.
      </p>
      <br>
      <br>
      <div style="width:700px;">
        <div style="width:300px; float:left;text-align:center;">
          <small >{{ $recibos->nombre }}</small>
          <p>_______________________________________</p>
          <small style="text-align:center">Comisión</small>

        </div>
        <div style="width:300px; float:right;text-align:center;">
          <small >{{ $firmantes->director_area }}</small>
          <p>_______________________________________</p>
          <small >director de área</small>
        </div>
      </div>
      <div style="height:150px;"></div>
      <div style="width:700px;">
        <div style="width:300px; float:left;text-align:center;" >
          <small >{{ $firmantes->superior_inmediato }}</small>
          <p>_______________________________________</p>
          <small >superior inmediato</small>

        </div>
        <div style="width:300px; float:right;text-align:center;">
          <small >{{ $firmantes->organo_control }}</small>
          <p>_______________________________________</p>
          <small >organo de control</small>
        </div>
      </div>
      <div style="height:180px;"></div>
    </div>
  </div>


    <script>
      $(function() {
          $('body').delegate('.print', 'click', function(event) {
            var ventana = window.open('', 'PRINT', 'height=600,width=720');
            ventana.document.write('<html><head><title>Oficio de Comisión</title><style>*{font-family: "Lato" !important;line-height: 14px;text-transform: uppercase;}@page{margin: 100px 50px 50px 50px;}header {position: fixed;top: -90px;left: 0px;right: 0px;height: 90px;background-position: left;background-size: 2em;background-repeat: no-repeat;}.nombre {text-align: right;font-weight: bold;font-size: 11pt;}.nombres {text-align: center;font-weight: bold;font-size: 12pt;}table{font-size: 10pt;}td.negras, span.negras{font-weight: 900;}table.borderTop td, table.borderTop th {border-top: 0.5px solid lightgray;border-collapse: collapse;word-wrap: break-word;}table.borderTop td.estaNo, table.borderTop th.estaNo {border: none;}th{font-weight: 900;text-align: left;}table.header{font-size: 12pt;}span.negras{font-size: 6pt;}footer {position: fixed;bottom: 0px;left: 0px;right: 0px;height: 20px;text-align: right;font-size: 8pt;font-weight: 900;}footer:after { content: counter(page, decimal);}.visor{background-color: rgb(255, 255, 255);width: 720px;height: 1100px;margin: 0 auto;padding: 96px;}.visor table{font-size: 12px;text-align: justify;}.contenedor{position: relative;display: inline-block;text-align: center;}</style>');
            ventana.document.write('</head><body >');
            ventana.document.write( document.getElementById('pdf').innerHTML );
            ventana.document.write('</body></html>');
            ventana.document.close();
            ventana.focus();
            ventana.print();
            ventana.close();
            return true;
            // }, 100);
          });
        });


    </script>
  </body>
</html>
