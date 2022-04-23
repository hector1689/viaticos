<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>COMPROBANTE DE INSCRIPCIÓN AL REGISTRO PECUARIO <?php echo date('Y'); ?></title>
  <link rel="shortcut icon" href="/img/EscTam.png" type="image/x-icon" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <link rel="stylesheet" href="/css/semantic/semantic.min.css"> --}}
  <link rel="stylesheet" href="/css/drive.min.css">
  <link href="/modules/fierros/css/print.css" type="text/css" rel="stylesheet" media="print"/>
  <script src="/js/jquery-3.4.1.min.js" charset="utf-8"></script>
  <script src="/css/semantic/semantic.min.js" charset="utf-8"></script>

  <style>
      .container {
        width: 300px;
     margin: auto;
      }
      .row {
      display: flex;
      width: 100%;
      }
      .col1 {

        width: 100px;
      float: left;
      height: 300px;


      }
      .col2 {
        width: 200px;
            float: left;
            height: 300px;
      }

      body{
        background-color: #f8f9fa;
        font-family: 'Open Sans', sans-serif;
      }
      .visor{
        background-color: rgb(255, 255, 255);
          width: 720px;
          height: 1260px;
          margin: 0 auto;
          padding: 96px;
      }
      .visor table{
        font-size: 14px;
        text-align: justify;
      }

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
  top: 0px;
  left: 450px;
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
/* footer:after { content: counter(page, decimal); } */

  </style>
</head>
<body>
  <ul class="toolbarx">
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
  <div class="visor" id="pdf">

    <header>

  </header>
  <footer>
    Página
  </footer>
  <div class="content">
    <table class="header">
      <tbody>
        <tr>
          <td>
            <img src="/admin/assets/media/bg/logo-educacionV2.png" style=" height: 55px;">
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
    <table style="width: 100%;">
      <tbody>
        <tr style="border: 4px solid orange;">
          <td style="width:100%;">
            <div class="nombre">
              <small style="right: 200px;">16-011 reparto de agua en comunidades rurales 2022</small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Folio: ceat-17-0002344
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
          <td style="width: 50%">oficio, comision: ceat-17-0002344</td>
          <td style="width: 50%">dirección: dirección general</td>
        </tr>
        <tr>
          <td style="width: 50%">departamento: electromecanico</td>
          <td style="width: 50%">calve departamental: 327100076543</td>
        </tr>
        <tr>
          <td colspan="2">lugar de adscripción: victoria</td>
        </tr>

      </tbody>
    </table>
        <br>
    <table style="width: 100%;" class="borderTop">
      <tbody>

        <tr>
          <td style="width: 50%">recibí de la secretaria: comisión estatal del agua de tamaulipas</td>
          <td style="width: 50%">n° de cheque: </td>
        </tr>
        <tr>
          <td style="width: 50%">de fecha: electromecanico</td>
          <td style="width: 50%">por la cantidad de: $3455.00</td>
        </tr>
        <tr>
          <td colspan="2">letra: (tres mil cutrocientos cicuenta y cinco pesos)</td>

        </tr>
        <tr>
          <td colspan="2">a mi favor y a cargo del banco:</td>
        </tr>

      </tbody>
    </table>
    <br>
    <table style="width: 100%;" class="borderTop">
      <tbody>

        <tr>
          <td style="width: 50%">Nombre: javier gonzales sanchez</td>
          <td style="width: 50%">n° de empleado: 76888</td>
        </tr>
        <tr>
          <td style="width: 50%">rfc: electromecanico</td>
          <td style="width: 50%">nivel de servidor público: 90</td>
        </tr>
        <tr>
          <td style="width: 50%">fecha y hora de salida: 22/04/22 7:00</td>
          <td style="width: 50%">fecha y hora de retorno: 23/04/22 19:00</td>
        </tr>
        <tr>
          <td colspan="2">lugar de comisión: victoria a reten militar la coma mpo. de cruillas, de reten militar la coma mpo. de cruillas a ejido benito juarez mpio. de jimenez, de ejido benito juarez mpio. de jimenez a reten la coma mpio. de cruillas
           a ejido benito juarez mpio. de jimenez,de ejido benito juarez mpio. de jimenez a reten la coma mpio. de cruillas, de reten militar la coma mpo. de cruillas a ejido benito juarez mpio. de jimenez</td>
        </tr>
        <tr>
          <td colspan="2">especificación de comisión: suministro de agua</td>
        </tr>


      </tbody>
    </table>
    <br>
    <table style="width: 100%;" class="borderTop">
      <thead>
        <tr>
          <td>viáticos</td>
          <td>hspedaje</td>
          <td>importe</td>
          <td>alimentación</td>
          <td>importe</td>
          <td>dias</td>
          <td>totales</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width: 50%">sencillo</td>
          <td style="width: 50%">cuota(I) $</td>
          <td style="width: 50%">0</td>
          <td style="width: 50%">cuota(I) $</td>
          <td style="width: 50%">0</td>
          <td style="width: 50%"> 2</td>
          <td style="width: 50%">0</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td style="width: 50%"></td>
          <td style="width: 50%">Subtotal</td>
          <td style="width: 50%">0</td>
          <td style="width: 50%">Subtotal</td>
          <td style="width: 50%">0</td>
          <td style="width: 50%">TOtal</td>
          <td style="width: 50%">0</td>
        </tr>
      </tfoot>
    </table>
    <table style="width: 100%;" class="borderTop">
      <thead>
        <tr>
          <td>transportación</td>
          <td>terrestre(x)</td>
          <td>con recorrido()</td>
          <td>area()</td>
        </tr>
        <tr>
          <td colspan="2">especifique recorrido interno: movimientos locales</td>
        </tr>
      </thead>
    </table>
    <br>
    <br>
    <table style="width: 100%;" class="borderTop">
      <tbody>

        <tr>
          <td >n° vh.ofc.: 2345</td>
          <td >atobus: &nbsp;</td>
          <td >particular: &nbsp;</td>
          <td >marca: sterling</td>
          <td >modelo: 2008</td>
        </tr>
        <tr>
          <td style="width: 30%">Tipo: pipa</td>
          <td style="width: 30%">placas: ret90v76yy</td>
          <td style="width: 40%" colspan="2">cilindraje: s</td>

        </tr>
        <tr>
          <td style="width: 30%">kms recorridos: 144</td>
          <td style="width: 30%">cuota: a() b() c(x) d()</td>
          <td style="width: 40%" colspan="3">total recorrido: 1281</td>

        </tr>
        <tr>
          <td style="width: 30%">kms recorridos interno: 50</td>
          <td style="width: 30%">precio combustible: 16.81</td>
          <td style="width: 40%" colspan="3">peaje/texi/autobus: 0.00</td>

        </tr>

        <tr>
          <td style="width: 30%">kms: 194</td>
          <td style="width: 30%">(x)p/u: 16.81</td>
          <td style="width: 40%" >(/)cil: 2.5</td>
          <td style="width: 40%" colspan="2">total de transportación: 1281</td>

        </tr>
        <tr>
          <td style="width: 40%" colspan="4">el combustible se proporciona en vales: 1281</td>

        </tr>
        <tr>
          <td style="width: 50%" colspan="2">manuel sanches martinez</td>
          <td style="width: 50%" colspan="1">21 de abril de 2022</td>
        </tr>
        <tr>
          <td style="width: 50%" colspan="2">comisionado</td>
          <td style="width: 50%" colspan="1"></td>
        </tr>


      </tbody>
    </table>
    <br>
    <br>
    <div style="width:800px;">
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
    </div>



    <!--///////////////////// FIN -->


  </div>


  </div>
