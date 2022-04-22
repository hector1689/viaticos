@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   Nuevo Peaje
</h3>
<div class="card-toolbar">
<div class="example-tools justify-content-center">

</div>
</div>
</div>
<form class=" needs-validation" novalidate>
<div class="card-body">


        <div class="row">
          <div class="col-md-4">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Tarifa: </label>
              <input type="text" class="form-control" id="apellido_paterno" placeholder="Tarifa" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Kilometros por litro: </label>
              <input type="text" class="form-control" id="apellido_paterno" placeholder="Kilometros por litro" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>

          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Descripción: </label>
              <input type="text" class="form-control" id="apellido_paterno" placeholder="Descripción" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
        </div>



</div>
<div class="card-footer">

  <a href="/catalogos/rendimiento" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="guardar()">Guardar</a>
</div>
</form>
</div>

@endsection
