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
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Descripción: </label>
              <input type="text" class="form-control" id="nombre" value="@isset($usuarios) {{ $usuarios->nombre }} @endisset" placeholder="Descripción" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Descripción a Detalle: </label>
              <input type="text" class="form-control" id="apellido_paterno" value="@isset($usuarios) {{ $usuarios->apellido_paterno }} @endisset" placeholder="Descripción a Detalle" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Número de Inventario: </label>
              <input type="text" class="form-control" id="apellido_materno"  placeholder="Número de Inventario" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-2">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Marca: </label>
              <input type="text" class="form-control" id="nombre" value="@isset($usuarios) {{ $usuarios->nombre }} @endisset" placeholder="Marca" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Modelo: </label>
              <input type="text" class="form-control" id="apellido_paterno" value="@isset($usuarios) {{ $usuarios->apellido_paterno }} @endisset" placeholder="Modelo" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Serie: </label>
              <input type="text" class="form-control" id="apellido_materno"  placeholder="Serie" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Número de Pedido: </label>
              <input type="text" class="form-control" id="apellido_materno"  placeholder="Número de Pedido" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Cantidad: </label>
              <input type="text" class="form-control" id="apellido_materno"  placeholder="Cantidad" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Unidad de Medida: </label>
              <input type="text" class="form-control" id="apellido_materno"  placeholder="Unidad de Medida" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-2">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">N° de Factura: </label>
              <input type="text" class="form-control" id="nombre" value="@isset($usuarios) {{ $usuarios->nombre }} @endisset" placeholder="N° de Factura" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha de Pedido: </label>
              <input type="text" class="form-control" id="apellido_paterno" value="@isset($usuarios) {{ $usuarios->apellido_paterno }} @endisset" placeholder="Fecha de Pedido" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-4">

          </div>
          <div class="col-md-4">
            
          </div>
        </div>

        <div role="separator" class="dropdown-divider"></div>

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

        <div role="separator" class="dropdown-divider"></div>

        <div class="row">
          <div class="col-md-12">


            <ul class="nav nav-tabs nav-tabs-line">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Resguardante Oficial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Resguardante Interno</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Historial de Resguardantes</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4" tabindex="-1" aria-disabled="true">Bitácoras de Movimiento</a>
                </li>
            </ul>
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                  <div class="row">
                    <div class="col-md-4">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Busqueda de Resguardante: </label>
                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Busqueda de Resguardante" required>
                    </div>
                    <div class="form-group col-sm-4" >
                      <label for="card-holder" style="visibility:hidden;">Fecha</label><br>
                      <button type="button" class="btn btn-primary" >Agregar</button>
                    </div>
                    <div class="col-md-12">
                      <p>Javier Hernandez Sanchez</p>
                      <p>SECRETARIA DE ADMINISTRACION</p>
                      <p>SUBSECRETARIA DE INNOVACIÓN Y TECNOLÓGIAS DE LA INFORMACIÓN</p>
                      <p>DIRECCIÓN DE MOVILIDAD, SISTEMA E INFORMACIÓN</p>
                      <p>DIRECCIÓN DE INFORMÁTICA</p>
                      <p>DEPARTAMENTO DE ANÁLISIS Y DISEÑO</p>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                  <div class="row">
                    <div class="col-md-4">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Busqueda de Resguardante: </label>
                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Busqueda de Resguardante" required>
                    </div>
                    <div class="form-group col-sm-4" >
                      <label for="card-holder" style="visibility:hidden;">Fecha</label><br>
                      <button type="button" class="btn btn-primary" >Agregar</button>
                    </div>
                    <div class="col-md-12">
                      <p>Javier Hernandez Sanchez</p>
                      <p>SECRETARIA DE ADMINISTRACION</p>
                      <p>SUBSECRETARIA DE INNOVACIÓN Y TECNOLÓGIAS DE LA INFORMACIÓN</p>
                      <p>DIRECCIÓN DE MOVILIDAD, SISTEMA E INFORMACIÓN</p>
                      <p>DIRECCIÓN DE INFORMÁTICA</p>
                      <p>DEPARTAMENTO DE ANÁLISIS Y DISEÑO</p>
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
