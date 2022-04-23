@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   Folios
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
            <div class="row">
              <div class="col-md-4">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Dependencia: </label>
                  <input type="text" class="form-control" id="apellido_materno" placeholder="Dependencia" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
              <div class="col-md-4">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Dirección de área: </label>
                  <input type="text" class="form-control" id="apellido_materno" placeholder="Dirección de área" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
              <div class="col-md-4">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">DIrector Administrativo: </label>
                  <input type="text" class="form-control" id="apellido_materno" placeholder="DIrector Administrativo" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Comisario: </label>
                  <input type="text" class="form-control" id="apellido_materno" placeholder="Comisario" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
              <div class="col-md-4">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Superios Inmediato: </label>
                  <input type="text" class="form-control" id="apellido_materno" placeholder="Superios Inmediato" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>

            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <label class="checkbox">
                    <input type="checkbox" name="Checkboxes1" checked>
                    <span></span>
                    Generar Folio Automaticamente
                </label>
              </div>
              <div class="col-md-6">

              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Tipo de Folio: </label>
                  <select class="form-control" name="">
                    <option value="">Recibo</option>
                    <option value="">Oficio de Comisión</option>
                  </select>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Posición 1: </label>
                  <select class="form-control" name="">
                    <option value="">Siglas de Dependencia</option>
                    <option value="">Siglas tipo de folio</option>
                    <option value="">Año</option>
                    <option value="">Consecutivo</option>
                  </select>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Siglas Dependencia: </label>
                  <input type="text" class="form-control" id="apellido_materno" placeholder="Siglas Dependencia" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
              <div class="col-md-6">

              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Siglas tipo de folio: </label>
                  <input type="text" class="form-control" id="apellido_materno" placeholder="Siglas tipo de folio" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Posición 2: </label>
                  <select class="form-control" name="">
                    <option value="">Siglas de Dependencia</option>
                    <option value="">Siglas tipo de folio</option>
                    <option value="">Año</option>
                    <option value="">Consecutivo</option>
                  </select>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Año: </label>
                  <input type="text" class="form-control" id="apellido_materno" placeholder="Año" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Posición 3: </label>
                  <select class="form-control" name="">
                    <option value="">Siglas de Dependencia</option>
                    <option value="">Siglas tipo de folio</option>
                    <option value="">Año</option>
                    <option value="">Consecutivo</option>
                  </select>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Consecutivo: </label>
                  <input type="text" class="form-control" id="apellido_materno" placeholder="Consecutivo" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Posición 4: </label>
                  <select class="form-control" name="">
                    <option value="">Siglas de Dependencia</option>
                    <option value="">Siglas tipo de folio</option>
                    <option value="">Año</option>
                    <option value="">Consecutivo</option>
                  </select>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Apellido Materno
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">

              </div>
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;visibility:hidden;" class="form-label">Siglas Dependencia: </label><br>
                  <button type="button" class="btn btn-primary">Agregar</button>

              </div>

            </div>

            <div class="col-md-12">
                <table class="table">
                  <thead>
                      <tr>
                          <th scope="col">Tipo de folio</th>
                          <th scope="col">Foliador</th>
                          <th scope="col">Folio actual</th>
                          <th scope="col">Acciones</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>RECIBO</td>
                          <td>CET/REC/2019/0001</td>
                          <td>047</td>
                          <td>
                            <span class="label label-inline label-light-danger font-weight-bold">
                                <i class="far fa-trash-alt"></i>
                            </span>
                          </td>
                      </tr>

                  </tbody>
                </table>
            </div>

            <div class="col-md-8">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Usuarios que usaran esta configuración: </label>
              <select class="form-control" name="">
                <option value="">Javier Sanchez Cordero</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
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
