@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   Editar Alimentación
</h3>
<div class="card-toolbar">
<div class="example-tools justify-content-center">

</div>
</div>
</div>
<form class=" needs-validation" novalidate>
<div class="card-body">

        <span>Rango de nivel del Servidor Público</span>
        <div class="row">
          <div class="col-md-6">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Inicial: </label>
              <input type="text" class="form-control" id="nombre" placeholder="Inicial" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Final: </label>
              <input type="text" class="form-control" id="apellido_paterno" placeholder="Final" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
        </div>
        <span>Importes de alimentación</span>
        <div class="row">
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Desayuno: </label>
              <input type="text" class="form-control" id="apellido_materno" placeholder="Desayuno" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Comida: </label>
              <input type="text" class="form-control" id="apellido_materno" placeholder="Comida" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Cena: </label>
              <input type="text" class="form-control" id="apellido_materno" placeholder="Cena" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>
        <span>Vigencia</span>
        <div class="row">

          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha Inicia: </label>
              <input type="text" class="form-control" id="apellido_materno" placeholder="Fecha Inicia" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>

          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha Fin: </label>
              <input type="text" class="form-control" id="apellido_materno" placeholder="Fecha Fin" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>



</div>
<div class="card-footer">

  <a href="/catalogos/alimentacion" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="guardar()">Guardar</a>
</div>
</form>
</div>

@endsection
