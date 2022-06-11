@extends('layouts.inicio')

@section('content')

<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
  Reportes Viáticos
</h3>

</div>
<div class="card-body">
  <div class="row">

    <div class="col-md-4">
        <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha Inicia: </label>
        <input type="text"  class="form-control" name="fecha1" id="kt_datepicker" value="@isset($alimentacion){{ $fecha }} @endisset" placeholder="Fecha Inicia" required>
        <div class="invalid-feedback">
          Por Favor Ingrese Fecha Inicia
        </div>
    </div>

    <div class="col-md-4">
        <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha Fin: </label>
        <input type="text" class="form-control" name="fecha2" id="kt_datepicker2" value="@isset($alimentacion){{ $fecha2 }} @endisset" placeholder="Fecha Fin" required>
        <div class="invalid-feedback">
          Por Favor Ingrese Fecha Fin
        </div>
    </div>
    @can('descargar reporte')
    <div class="col-md-4">
        <label for="inputPassword4" style="font-size:12px;visibility:hidden;" class="form-label">Fddd: </label><br>
        <button type="button" class="btn btn-primary" onclick="descargar()">Descargar</button>
    </div>
    @else

    @endcan

  </div>
</div>
</div>
<script type="text/javascript">
$(function () {
  var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes();
    var dateTime = date+' '+time;

    $("#kt_datepicker").datepicker({
        language: 'es',
        format: 'dd-mm-yyyy',
    });

    $("#kt_datepicker2").datepicker({
        language: 'es',
        // startDate: dateTime,
        format: 'dd-mm-yyyy',
    });
});
function descargar(){
var fecha1 = $('input[name=fecha1]').val();
var fecha2 = $('input[name=fecha2]').val();


if (fecha1=="" || fecha2=="") {
    Swal.fire("¡Lo sentimos!", 'Favor de llenar los campos de fecha', "warning");
  }else{
    location.href="/reportes/fechas/"+fecha1+"/"+fecha2+" ";
  }

}
</script>
@endsection
