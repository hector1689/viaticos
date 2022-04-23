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
          height: 960px;
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
      <span>oficio de comisión</span>
    </li>
    <li class="imprimir">
      <a class="print" href="javascript: void(0);" id="btn_edicion"></a>
    </li>
  </ul>
  <div class="visor" id="pdf">

    <header>
      <br>
      <br><br>

    </header>
    <footer>
      Página
    </footer>
    <br><br>
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

              <span>OFIcio de comisión</span><br>
              <!-- <span>Contraloría Gubernamental</span><br>
              <span>Declaración de Situación Patrimonial y de Intereses</span> -->
            </td>
          </tr>
        </tbody>
      </table>
      <table style="width: 100%;">
        <tbody>
          <tr style="border: 4px solid orange;">
            <td style="width: 100%;">
              <div style="text-align: right;font-size: 8pt;hyphens: auto;word-wrap: break-word;word-break: break-word;">
                Oficio n° ceat-17-000572 <br> a 12 de abril 2022
              </div>
              <div style="height:50px;"></div>
              <div style="font-size: 11pt;hyphens: auto;word-wrap: break-word;word-break: break-word;">
                <br>
                <strong>C.Héctor Hugo vargas Acevedo</strong>
                <br>
                Presente.
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <!--///////////////////// FIN -->
      <span class="negras"></span><br>

      <p style="font-size: 9.5pt;text-align:justify;">
        sirvase presentarse de victoria a reten militar la coma mpo. de cruillas, de reten militar la coma mpo. de cruillas a ejido benito juarez mpio. de jimenez, de ejido benito juarez mpio. de jimenez a reten la coma mpio. de cruillas
         a ejido benito juarez mpio. de jimenez,de ejido benito juarez mpio. de jimenez a reten la coma mpio. de cruillas, de reten militar la coma mpo. de cruillas a ejido benito juarez mpio. de jimenez los dias del 22 al 23 de abril
         para llevar a cabo la siguiente comisión: <strong>suministro de agua</strong> debiendo partir el dia 22/04/2022 a las 7:00 y retornar el dia  23/04/2022 a las 19:30 hrs.
      </p>
      <br><br>
      <p style="font-size: 9.5pt;text-align:justify;">
        como servidor público tendra la obligación de salvaguardar la legalidad,honradez,lealtad,imparcialidad y eficacia en el desempeño de su comisión. cuyo incumplimiento dára lugar al procedimiento y a las sanciones que correspondan,
        según la naturaleza de la infracción en que se incurra según lo establece el titulo tercero de la ley de responsabilidades de servidores públicos. al regreso de la comisión deberá presentar este oficio sellado y firmado por la
        autoridad correspondiente en el lugar donde efectuó la comisión.
      </p>
      <br>
      <br>
      <div style="width:800px;">
        <div style="width:300px; float:left;text-align:center;">
          <small >javier sanchez sanchez</small>
          <p>_______________________________________</p>
          <small style="text-align:center">Comisión</small>

        </div>
        <div style="width:300px; float:right;text-align:center;">
          <small >javier sanchez sanchez</small>
          <p>_______________________________________</p>
          <small >director de área</small>
        </div>
      </div>
      <div style="height:150px;"></div>
      <div style="width:800px;">
        <div style="width:300px; float:left;text-align:center;" >
          <small >javier sanchez sanchez</small>
          <p>_______________________________________</p>
          <small >superior inmediato</small>

        </div>
        <div style="width:300px; float:right;text-align:center;">
          <small >javier sanchez sanchez</small>
          <p>_______________________________________</p>
          <small >organo de control</small>
        </div>
      </div>


      <div style="height:180px;"></div>


    </div>

  </div>
