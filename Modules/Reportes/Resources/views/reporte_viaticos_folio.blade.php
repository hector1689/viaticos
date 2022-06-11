
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/img/esc-tam.png">
    <title>Reporte Viaticos Folio</title>
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
      .fotter {
        position: fixed;
        top: -90px;
        left: 480px;
        right: 0px;
        height: 90px;
        background-position: left;
        background-size: 2em;
        background-repeat: no-repeat;
      }
      .nombre {
        text-align: right;
        /* font-weight: bold; */
        font-size: 9pt;
      }
      .nombre2 {
        text-align: center;
        /* font-weight: bold; */
        font-size: 9pt;
      }
      table{
        font-size: 12pt;
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
        font-size: 6pt;
      }
      span.negras{
        font-size: 6pt;
      }
      td .label-default{
          float: right;
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
              <img src="https://mesadeayuda.tamaulipas.gob.mx/images/encababezado.png" style=" height: 25px;  padding-bottom: 25px;;width:548px">
            </td>
          </tr>
        </tbody>
      </table>
    </header>

    <div class="content">
      <table style="width: 100%;">
        <tbody>
          <tr style="border: 4px solid orange;">
            <td style="width: 1000%;">
              <div class="nombre">
                <strong>reporte de viaticos capturado por folio</strong>
                <br>
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
            </td>

          </tr>
        </tbody>
      </table>
      <div style="height:50px;"></div>

      <br>
      <table style="width: 100%;height: 20%;font-size:6pt;" class="borderTop">
        <thead>
            <tr>
              <th style="text-align:center;">N° RECIBO</th>
              <th style="text-align:center;">FECHA</th>
              <th style="text-align:center;">NOMBRE</th>
              <th style="text-align:center;">N° EMPLEADO</th>
              <th style="text-align:center;">IMPORTE</th>
            </tr>
        </thead>
        <tbody>
          @foreach($formulario as $form)
          <tr>
            <td style="text-align:center;">{{ $form->folio }}</td>
            <td style="text-align:center;">
              <?php
                list($fecha,$hora)=explode(' ',$form->fecha_hora_salida);
                echo $fecha;
               ?>
            </td>
            <td style="text-align:center;">{{$form->nombre}}</td>
            <td style="text-align:center;">{{$form->num_empleado}}</td>
            <td style="text-align:center;">{{$form->importe}}</td>


          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td style="text-align:center;"><strong>total de recibos de la secretaría</strong> {{ $totalp }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align:center;"><strong>total secretaría</strong> {{ $total }}</td>
          </tr>
        </tfoot>
      </table>

      <div style="width:700px;">
        <div style="width:300px; float:left;text-align:center;">
          <small ></small>
          <p>_______________________________________</p>
          <small style="text-align:center">entrego</small>

        </div>
        <div style="width:300px; float:right;text-align:center;">
          <small ></small>
          <p>_______________________________________</p>
          <small >recibio</small>
        </div>
      </div>

      <footer>
        <table class="fotter">
          <tbody>
            <tr>
              <td >
                <div ></div>
              </td>
              <td >
                <img src="https://mesadeayuda.tamaulipas.gob.mx/images/tam.png" style=" height: 50px;padding-bottom: 25px;" >
              </td>
            </tr>
          </tbody>
        </table>
        <br>

      </footer>


    </div>
  </body>
</html>
