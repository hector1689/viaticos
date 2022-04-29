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
        <input type="text" name="inicia" class="form-control" id="kt_datepicker" value="@isset($alimentacion){{ $fecha }} @endisset" placeholder="Fecha Inicia" required>
        <div class="invalid-feedback">
          Por Favor Ingrese Fecha Inicia
        </div>
    </div>

    <div class="col-md-4">
        <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha Fin: </label>
        <input type="text" name="final" class="form-control" id="kt_datepicker2" value="@isset($alimentacion){{ $fecha2 }} @endisset" placeholder="Fecha Fin" required>
        <div class="invalid-feedback">
          Por Favor Ingrese Fecha Fin
        </div>
    </div>
    <div class="col-md-4">
        <label for="inputPassword4" style="font-size:12px;visibility:hidden;" class="form-label">Fddd: </label><br>
        <button type="button" class="btn btn-primary">Descargar</button>
    </div>
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
        format: 'dd/mm/yyyy',
    });

    $("#kt_datepicker2").datepicker({
        language: 'es',
        // startDate: dateTime,
        format: 'dd/mm/yyyy',
    });
});
</script>
@endsection
