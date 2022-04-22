@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   Nuevo Localidad
</h3>
<div class="card-toolbar">
<div class="example-tools justify-content-center">

</div>
</div>
</div>
<form class=" needs-validation" novalidate>
<div class="card-body">


        <div class="row">
          <div class="col-md-3">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Pais: </label>
              <select class="form-control" name="">
                <option value="">México</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-3">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Municipio: </label>
              <select class="form-control" name="">
                <option value="">Tampico</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>

          <div class="col-md-3">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Estado: </label>
              <select class="form-control" name="">
                <option value="">Tamaulipas</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>

          <div class="col-md-3">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Localidad: </label>
              <input type="text" class="form-control" value="">
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
        </div>



</div>
<div class="card-footer">

  <a href="/catalogos/localidades" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="guardar()">Guardar</a>
</div>
</form>
</div>

@endsection
