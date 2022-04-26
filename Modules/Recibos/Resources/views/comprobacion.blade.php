@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   <!-- @isset($usuarios)editar @else nuevo @endisset --> Registro de Comprobantes
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
                  <label for="inputPassword4"  style="font-size:12px;"class="form-label">Folio: </label>
                  <input type="text" class="form-control" id="nombre"  placeholder="Folio" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Nombre
                  </div>
              </div>
              <div class="col-md-4">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Oficio de Comisión: </label>
                  <input type="text" class="form-control" id="apellido_paterno"  placeholder="Oficio de Comisión" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Paterno
                  </div>
              </div>
              <div class="col-md-4">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Estatus: </label>
                  <select class="form-control" name="">
                    <option value="">Capturado</option>
                    <option value="">En Proceso</option>
                    <option value="">Pagado</option>
                    <option value="">Finiquito</option>
                    <option value="">Finiquito Provicional</option>
                    <option value="">Pendiente de Comprobar</option>
                    <option value="">Cancelado</option>
                  </select>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2">
                  <label for="inputPassword4"  style="font-size:12px;"class="form-label">N° de Empleado: </label>
                  <input type="text" class="form-control" id="nombre"  placeholder="N° de Empleado" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Nombre
                  </div>
              </div>
              <div class="col-md-2">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Nombre: </label>
                  <input type="text" class="form-control" id="apellido_paterno"  placeholder="Nombre" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Paterno
                  </div>
              </div>
              <div class="col-md-2">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">RFC: </label>
                  <input type="text" class="form-control" id="apellido_materno"  placeholder="RFC" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
              <div class="col-md-2">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Nivel: </label>
                  <input type="text" class="form-control" id="apellido_materno"  placeholder="Nivel" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
              <div class="col-md-4">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Clave Departamental: </label>
                  <input type="text" class="form-control" id="apellido_materno"  placeholder="Clave Departamental" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-2">
                  <label for="inputPassword4"  style="font-size:12px;"class="form-label">Dependencia: </label>
                  <input type="text" class="form-control" id="nombre"  placeholder="Dependencia" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Nombre
                  </div>
              </div>
              <div class="col-md-2">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Dirección: </label>
                  <input type="text" class="form-control" id="apellido_paterno"  placeholder="Dirección" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Paterno
                  </div>
              </div>
              <div class="col-md-4">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha y Hora de regreso: </label>
                  <input type="text" class="form-control" id="apellido_paterno"  placeholder="Fecha y Hora de Salida" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Paterno
                  </div>
              </div>
              <div class="col-md-4">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha y Hora de salida: </label>
                  <input type="text" class="form-control" id="apellido_paterno"  placeholder="Fecha y Hora de Recibido" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                  <label for="inputPassword4"  style="font-size:12px;"class="form-label">Departamentos: </label>
                  <input type="text" class="form-control" id="nombre"  placeholder="Departamentos" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Nombre
                  </div>
              </div>
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Lugar de Adscripción: </label>
                  <input type="text" class="form-control" id="apellido_paterno"  placeholder="Lugar de Adscripción" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Paterno
                  </div>
              </div>

            </div>



            <div class="row">
              <div class="col-md-12">
                <label for="inputPassword4" style="font-size:12px;" class="form-label">Descripcion de la Comisión: </label>
                <input type="text" class="form-control" id="apellido_paterno"  placeholder="Descripcion de la Comisión" required>
              </div>
           </div>

           <div class="row">
             <div class="col-md-6">
                 <label for="inputPassword4"  style="font-size:12px;"class="form-label">Adjuntar: </label>
                 <input type="file" class="form-control" >
                 <div class="invalid-feedback">
                   Por Favor Ingrese Nombre
                 </div>
             </div>


           </div>
    </div>
    <div class="card-footer">

      <a href="/recibos" class="btn btn-default">Regresar</a>

      <a class="btn btn-primary " onclick="guardar()">Guardar</a>
    </div>
  </form>
</div>
@endsection
