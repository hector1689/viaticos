@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   Editar Kilometraje
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
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Localidad Origen: </label>
              <select class="form-control" name="">
                <option value="">Victoria-Victoria-Tamaulipas-México</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Localidad Destino: </label>
              <select class="form-control" name="">
                <option value="">Tampico-Tampico-Tamaulipas-México</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>

          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Distancia en Kilometros: </label>
              <input type="text" class="form-control" id="apellido_paterno" placeholder="Distancia en Kilometros" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
        </div>



</div>
<div class="card-footer">

  <a href="/catalogos/kilometraje" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="guardar()">Guardar</a>
</div>
</form>
</div>

@endsection
