@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   <!-- @isset($usuarios)editar @else nuevo @endisset --> Datos del Bien
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
              <input type="text" class="form-control" id="nombre" value="@isset($usuarios) {{ $usuarios->nombre }} @endisset" placeholder="Descripción" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Oficio de Comisión: </label>
              <input type="text" class="form-control" id="apellido_paterno" value="@isset($usuarios) {{ $usuarios->apellido_paterno }} @endisset" placeholder="Descripción a Detalle" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Estatus: </label>
              <select class="form-control" name="">
                <option value="">Donación</option>
                <option value="">Comodato</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-2">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">N° de Empleado: </label>
              <input type="text" class="form-control" id="nombre" value="@isset($usuarios) {{ $usuarios->nombre }} @endisset" placeholder="Marca" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Nombre: </label>
              <input type="text" class="form-control" id="apellido_paterno" value="@isset($usuarios) {{ $usuarios->apellido_paterno }} @endisset" placeholder="Modelo" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">RFC: </label>
              <input type="text" class="form-control" id="apellido_materno"  placeholder="Serie" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Nivel: </label>
              <input type="text" class="form-control" id="apellido_materno"  placeholder="Número de Pedido" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Clave Departamental: </label>
              <input type="text" class="form-control" id="apellido_materno"  placeholder="Cantidad" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-2">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Dependencia: </label>
              <input type="text" class="form-control" id="nombre" value="@isset($usuarios) {{ $usuarios->nombre }} @endisset" placeholder="N° de Factura" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Dirección: </label>
              <input type="text" class="form-control" id="apellido_paterno" value="@isset($usuarios) {{ $usuarios->apellido_paterno }} @endisset" placeholder="Fecha de Pedido" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha y Hora de Salida: </label>
              <input type="text" class="form-control" id="apellido_paterno" value="@isset($usuarios) {{ $usuarios->apellido_paterno }} @endisset" placeholder="Fecha de Pedido" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha y Hora de Recibido: </label>
              <input type="text" class="form-control" id="apellido_paterno" value="@isset($usuarios) {{ $usuarios->apellido_paterno }} @endisset" placeholder="Fecha de Pedido" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-2">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Departamentos: </label>
              <input type="text" class="form-control" id="nombre" value="@isset($usuarios) {{ $usuarios->nombre }} @endisset" placeholder="N° de Factura" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Lugar de Adscripción: </label>
              <input type="text" class="form-control" id="apellido_paterno" value="@isset($usuarios) {{ $usuarios->apellido_paterno }} @endisset" placeholder="Fecha de Pedido" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">N° de dias: </label>
              <input type="text" class="form-control" id="apellido_paterno" value="@isset($usuarios) {{ $usuarios->apellido_paterno }} @endisset" placeholder="Fecha de Pedido" required>

              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">N° de dias inhabiles: </label>
              <input type="text" class="form-control" id="apellido_paterno" value="@isset($usuarios) {{ $usuarios->apellido_paterno }} @endisset" placeholder="Fecha de Pedido" required>

              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>


        <div role="separator" class="dropdown-divider"></div>

        <div class="row">
          <div class="col-md-12">


            <ul class="nav nav-tabs nav-tabs-line">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Lugares</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Transporte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Datos de Pago</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4" tabindex="-1" aria-disabled="true">Firmas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5" tabindex="-1" aria-disabled="true">Seguimiento</a>
                </li>
            </ul>
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                  <div class="row">
                    <div class="col-md-3">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">¿Remoto?: </label>
                        <div class="checkbox-list">
                            <label class="checkbox">
                                <input type="checkbox" name="Checkboxes1">
                                <span></span>
                                SI
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Origen: </label>
                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Anexo" required>
                        <div class="invalid-feedback">
                          Por Favor Ingrese Apellido Paterno
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Destino: </label>
                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Anexo" required>
                        <div class="invalid-feedback">
                          Por Favor Ingrese Apellido Paterno
                        </div>
                    </div>
                    <div class="form-group col-md-3" >
                      <label for="card-holder" style="visibility:hidden;">Fecha</label><br>
                      <button type="button" class="btn btn-primary" >Agregar</button>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col">Nombre</th>
                                  <th scope="col">Fecha de creación</th>
                                  <th scope="col">acciones</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>Nick</td>
                                  <td>2022-04-21</td>
                                  <td>
                                    <span class="label label-inline label-light-danger font-weight-bold">
                                        <i class="far fa-trash-alt"></i>
                                    </span>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Ana</td>
                                  <td>2022-04-21</td>
                                  <td>
                                    <span class="label label-inline label-light-danger font-weight-bold">
                                        <i class="far fa-trash-alt"></i>
                                    </span>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Larry</td>
                                  <td>2022-04-21</td>
                                  <td>
                                      <span class="label label-inline label-light-danger font-weight-bold">
                                          <i class="far fa-trash-alt"></i>
                                      </span>
                                  </td>
                              </tr>
                          </tbody>
                        </table>
                    </div>

                  </div>

                </div>
                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                  <div class="row">
                    <div class="col-md-4">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Anexos: </label>
                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Anexo" required>
                        <div class="invalid-feedback">
                          Por Favor Ingrese Apellido Paterno
                        </div>
                    </div>
                    <div class="form-group col-sm-4" >
                      <label for="card-holder" style="visibility:hidden;">Fecha</label><br>
                      <button type="button" class="btn btn-primary" >Agregar</button>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col">Nombre</th>
                                  <th scope="col">Fecha de creación</th>
                                  <th scope="col">acciones</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>Nick</td>
                                  <td>2022-04-21</td>
                                  <td>
                                    <span class="label label-inline label-light-danger font-weight-bold">
                                        <i class="far fa-trash-alt"></i>
                                    </span>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Ana</td>
                                  <td>2022-04-21</td>
                                  <td>
                                    <span class="label label-inline label-light-danger font-weight-bold">
                                        <i class="far fa-trash-alt"></i>
                                    </span>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Larry</td>
                                  <td>2022-04-21</td>
                                  <td>
                                      <span class="label label-inline label-light-danger font-weight-bold">
                                          <i class="far fa-trash-alt"></i>
                                      </span>
                                  </td>
                              </tr>
                          </tbody>
                        </table>
                    </div>

                  </div>

                </div>
                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                  <div class="col-md-12">
                    <p>12-02-2022 14:00:00 PM (Alex Mondragon) Registro Bien</p>
                  </div>
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                  <div class="col-md-12">
                    <p>12-02-2022 14:00:00 PM (Alex Mondragon) Registro Bien</p>
                  </div>
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_5">
                  <div class="col-md-12">
                    <p>12-02-2022 14:00:00 PM (Alex Mondragon) Registro Bien</p>
                  </div>
                </div>
            </div>


          </div>

        </div>


</div>
<div class="card-footer">

  <a href="/bienes" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="guardar()">Guardar</a>
</div>
</form>
</div>
@endsection
