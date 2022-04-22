@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   @isset($usuarios)editar @else nuevo @endisset Gasolina
</h3>
<div class="card-toolbar">
<div class="example-tools justify-content-center">

</div>
</div>
</div>
<form class=" needs-validation" novalidate>
<div class="card-body">


        <div class="row">
          <div class="col-md-6">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Tipo: </label>
              <select class="form-control" name="">
                <option value="">Magna Sin</option>
                <option value="">Premium</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Año: </label>
              <input type="text" class="form-control" id="apellido_paterno" placeholder="Año" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Mes: </label>
              <input type="text" class="form-control" id="apellido_materno" placeholder="Mes" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Precio por litro: </label>
              <input type="text" class="form-control" id="apellido_materno" placeholder="Precio por litro" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Vigencia: </label>
              <input type="text" class="form-control" id="apellido_materno" placeholder="Vigencia" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>




</div>
<div class="card-footer">

  <a href="/catalogos/gasolina" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="guardar()">Guardar</a>
</div>
</form>
</div>

@endsection
