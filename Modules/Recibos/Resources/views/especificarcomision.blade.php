@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   <!-- @isset($usuarios)editar @else nuevo @endisset --> Especificación de Comisión
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
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Comisionados: </label>
              <select class="form-control" name="">
                <option value="">Javier sanchez sanchez</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Especificar comision: </label>
              <select class="form-control" name="">
                <option value="">Comision del agua de tamaulipas</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Recorrido interno: </label>
              <input type="text" class="form-control" value="">
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Municipio: </label>
              <select class="form-control" name="">
                <option value="">victoria-tampico</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Dirección: </label>
              <input type="text" class="form-control" value="">
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>

        <div class="row">


          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Teléfono de ubicación: </label>
              <input type="text" class="form-control" value="">
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>

          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Persona ante se acredita: </label>
              <select class="form-control" name="">
                <option value="">Tomas valdez salazar</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>



</div>
<div class="card-footer">

  <a href="/recibos" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " href="/recibos/especificacion">imprimir</a>
</div>
</form>
</div>

@endsection
