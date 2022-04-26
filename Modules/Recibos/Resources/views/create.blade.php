@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   <!-- @isset($usuarios)editar @else nuevo @endisset --> NUEVO VIATICO
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
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha y Hora de Salida: </label>
              <input type="text" class="form-control" id="apellido_paterno"  placeholder="Fecha y Hora de Salida" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha y Hora de Recibido: </label>
              <input type="text" class="form-control" id="apellido_paterno"  placeholder="Fecha y Hora de Recibido" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-2">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Departamentos: </label>
              <input type="text" class="form-control" id="nombre"  placeholder="Departamentos" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Lugar de Adscripción: </label>
              <input type="text" class="form-control" id="apellido_paterno"  placeholder="Lugar de Adscripción" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">N° de dias: </label>
              <input type="text" class="form-control" id="apellido_paterno"  placeholder="N° de dias" required>

              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">N° de dias inhabiles: </label>
              <input type="text" class="form-control" id="apellido_paterno"  placeholder="N° de dias inhabiles" required>

              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <label for="inputPassword4" style="font-size:12px;" class="form-label">Descripcion de la Comisión: </label>
            <input type="text" class="form-control" id="apellido_paterno"  placeholder="Descripcion de la Comisión" required>
          </div>
       </div>


        <div role="separator" class="dropdown-divider"></div>

        <div class="row">
          <div class="col-md-12">

            <label class="checkbox">
                <input type="checkbox" name="Checkboxes1" >
                <span></span>
                Recibo Complementario
            </label>
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
                        <select class="form-control" name="">
                          <option value=""></option>
                        </select>
                        <div class="invalid-feedback">
                          Por Favor Ingrese Apellido Paterno
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Destino: </label>
                        <select class="form-control" name="">
                          <option value=""></option>
                        </select>
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
                                  <th scope="col">Origen</th>
                                  <th scope="col">Destino</th>
                                  <th scope="col">Dias</th>
                                  <th scope="col">Zona</th>
                                  <th scope="col">Kilometros</th>
                                  <th scope="col">Combustible</th>
                                  <th scope="col">Hospedaje</th>
                                  <th scope="col">Alimentación</th>
                                  <th scope="col">acciones</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>Victoria</td>
                                  <td>Tampico</td>
                                  <td><input type="text" class="form-control" value="2"> </td>
                                  <td>F</td>
                                  <td><input type="text" class="form-control" value="457"></td>
                                  <td>
                                    <label class="checkbox">
                                        <input type="checkbox" name="Checkboxes1" checked>
                                        <span></span>
                                    </label>
                                  </td>
                                  <td>
                                    <label class="checkbox">
                                        <input type="checkbox" name="Checkboxes1" checked>
                                        <span></span>
                                    </label>
                                  </td>
                                  <td>
                                    <div class="checkbox-inline">
                                        <label class="checkbox">
                                            <input type="checkbox" name="Checkboxes2">
                                            <span></span>

                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="Checkboxes2" checked>
                                            <span></span>

                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="Checkboxes2" checked>
                                            <span></span>

                                        </label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class='btn-group dropleft'>
                                      <button type='button' class='btn btn-light dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fas fa-align-justify'></i><span class='caret'></span> </button>
                                      <div class='dropdown-menu '  >
                                        <a class='dropdown-item' href="/recibos/show">
                                        Ver
                                        </a>
                                        <a class='dropdown-item' onclick="finiquitarP()">
                                        Eliminar
                                        </a>
                                      </div>
                                     </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Victoria</td>
                                  <td>Tampico</td>
                                  <td><input type="text" class="form-control" value="2"> </td>
                                  <td>F</td>
                                  <td><input type="text" class="form-control" value="457"></td>
                                  <td>
                                    <label class="checkbox">
                                        <input type="checkbox" name="Checkboxes1" checked>
                                        <span></span>
                                    </label>
                                  </td>
                                  <td>
                                    <label class="checkbox">
                                        <input type="checkbox" name="Checkboxes1" checked>
                                        <span></span>
                                    </label>
                                  </td>
                                  <td>
                                    <div class="checkbox-inline">
                                        <label class="checkbox">
                                            <input type="checkbox" name="Checkboxes2">
                                            <span></span>

                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="Checkboxes2" checked>
                                            <span></span>

                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="Checkboxes2" checked>
                                            <span></span>

                                        </label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class='btn-group dropleft'>
                                      <button type='button' class='btn btn-light dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fas fa-align-justify'></i><span class='caret'></span> </button>
                                      <div class='dropdown-menu '  >
                                        <a class='dropdown-item' href="/recibos/show">
                                        Ver
                                        </a>
                                        <a class='dropdown-item' onclick="finiquitarP()">
                                        Eliminar
                                        </a>
                                      </div>
                                     </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Victoria</td>
                                  <td>Tampico</td>
                                  <td><input type="text" class="form-control" value="2"> </td>
                                  <td>F</td>
                                  <td><input type="text" class="form-control" value="457"></td>
                                  <td>
                                    <label class="checkbox">
                                        <input type="checkbox" name="Checkboxes1" checked>
                                        <span></span>
                                    </label>
                                  </td>
                                  <td>
                                    <label class="checkbox">
                                        <input type="checkbox" name="Checkboxes1" checked>
                                        <span></span>
                                    </label>
                                  </td>
                                  <td>
                                    <div class="checkbox-inline">
                                        <label class="checkbox">
                                            <input type="checkbox" name="Checkboxes2">
                                            <span></span>

                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="Checkboxes2" checked>
                                            <span></span>

                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="Checkboxes2" checked>
                                            <span></span>

                                        </label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class='btn-group dropleft'>
                                      <button type='button' class='btn btn-light dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fas fa-align-justify'></i><span class='caret'></span> </button>
                                      <div class='dropdown-menu '  >
                                        <a class='dropdown-item' href="/recibos/show">
                                        Ver
                                        </a>
                                        <a class='dropdown-item' onclick="finiquitarP()">
                                        Eliminar
                                        </a>
                                      </div>
                                     </div>
                                  </td>
                              </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td>Total</td>
                              <td></td>
                              <td>3</td>
                              <td></td>
                              <td>$500</td>
                              <td>$1000</td>
                              <td>$850</td>
                              <td>$700</td>
                              <td></td>
                            </tr>
                          </tfoot>
                        </table>
                    </div>


                      <div class="col-md-8">
                          <label for="inputPassword4" style="font-size:12px;" class="form-label">Programa: </label>
                          <select class="form-control" name="">
                            <option value=""></option>
                          </select>
                          <div class="invalid-feedback">
                            Por Favor Ingrese Apellido Paterno
                          </div>
                      </div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Calcular viático</button>
                      </div>
                      <div class="col-md-2">
                        <label for="">Total Recibido</label>
                        <input type="text" class="form-control" value="$2550">
                      </div>



                  </div>

                </div>

                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                  <div class="row">
                    <div class="col-md-2">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Kilometro recorrido interno: </label>
                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Anexo" value="50">
                        <div class="invalid-feedback">
                          Por Favor Ingrese Apellido Paterno
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Especificar el recorrido: </label>
                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Especificar el recorrido" required>
                        <div class="invalid-feedback">
                          Por Favor Ingrese Apellido Paterno
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Total de Km recorridos: </label>
                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Anexo" value="250">
                        <div class="invalid-feedback">
                          Por Favor Ingrese Apellido Paterno
                        </div>
                    </div>

                  </div>

                  <div role="separator" class="dropdown-divider"></div>


                  <div class="row">
                      <div class="col-4">
                          <ul class="nav flex-column nav-pills">
                              <li class="nav-item mb-2">
                                  <a class="nav-link active" id="home-tab-5" data-toggle="tab" href="#home-5"  onclick="oficial()" >

                                      <span class="nav-text">Vehiculo Oficial</span>
                                  </a>
                              </li>
                              <li class="nav-item mb-2">
                                  <a class="nav-link" id="este-tab-5" data-toggle="tab" href="#este-5"  aria-controls="profile" onclick="particular()" >

                                      <span class="nav-text">Vehiculo Particular</span>
                                  </a>
                              </li>
                              <li class="nav-item dropdown mb-2">
                                <a class="nav-link" id="profile-tab-5" data-toggle="tab" href="#profile-5"  aria-controls="profile" onclick="autobus()">

                                    <span class="nav-text">Autobus</span>
                                </a>
                               </li>
                              <li class="nav-item">
                                  <a class="nav-link" id="contact-tab-5" data-toggle="tab" href="#contact-5"  aria-controls="contact"  onclick="peaje()">

                                      <span class="nav-text">Peaje</span>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" id="taxi-tab-5" data-toggle="tab" href="#taxi-5"  aria-controls="contact" onclick="taxi()">

                                      <span class="nav-text">Taxi</span>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" id="avion-tab-5" data-toggle="tab" href="#avion-5"  aria-controls="contact" onclick="avion()">

                                      <span class="nav-text">Avion</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                      <div class="col-8">
                          <div class="tab-content" id="myTabContent5">
                              <div class="tab-pane fade show active" id="home-5" role="tabpanel" aria-labelledby="home-tab-5">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <label for="">Viaje</label>
                                      <div class="radio-inline">
                                          <label class="radio">
                                              <input type="radio" name="radios2">
                                              <span></span>
                                              Redondo
                                          </label>
                                          <label class="radio">
                                              <input type="radio" name="radios2">
                                              <span></span>
                                              Solo Ida
                                          </label>
                                          <label class="radio">
                                              <input type="radio" name="radios2">
                                              <span></span>
                                              Solo regreso
                                          </label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-8">
                                        <label for="inputPassword4"  style="font-size:12px;"class="form-label">Buscar: </label>
                                        <input type="text" class="form-control" id="nombre"  placeholder="Buscar Vehiculo por N° Oficial" required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Nombre
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-2">
                                        <label for="inputPassword4"  style="font-size:12px;"class="form-label">N° Oficial: </label>
                                        <input type="text" class="form-control" id="nombre"  placeholder="N° Oficial" required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Nombre
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Marca: </label>
                                        <input type="text" class="form-control" id="apellido_paterno"  placeholder="Marca" required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Paterno
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Modelo: </label>
                                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Modelo" required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Tipo: </label>
                                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Tipo" required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Placas: </label>
                                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Placas" required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>

                                  </div>

                                  <div class="row">
                                    <div class="col-md-4">
                                        <label for="inputPassword4"  style="font-size:12px;"class="form-label">Cilindraje: </label>
                                        <input type="text" class="form-control" id="nombre"  placeholder="Cilindraje" required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Nombre
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Cuota: </label>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" name="radios2">
                                                <span></span>
                                                A
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="radios2">
                                                <span></span>
                                                B
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="radios2">
                                                <span></span>
                                                C
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="radios2">
                                                <span></span>
                                                D
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="radios2">
                                                <span></span>
                                                E
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Gasolina: </label>
                                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Gasolina" required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>


                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Mes $ Gasolina: </label>
                                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Mes precio Gasolina" required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">$ Gasolina vh. Oficial: </label>
                                        <input type="text" class="form-control" id="apellido_materno"  placeholder="$ Gasolina vh. Oficial" required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>

                                  </div>




                              </div>
                              <div class="tab-pane fade" id="este-5" role="tabpanel" aria-labelledby="este-tab-5">

                                <div class="row">
                                  <div class="col-md-12">
                                    <label for="">Viaje</label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="radios2">
                                            <span></span>
                                            Redondo
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2">
                                            <span></span>
                                            Solo Ida
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2">
                                            <span></span>
                                            Solo regreso
                                        </label>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">

                                  <div class="col-md-3">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Marca: </label>
                                      <input type="text" class="form-control" id="apellido_paterno"  placeholder="Marca" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Paterno
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Modelo: </label>
                                      <input type="text" class="form-control" id="apellido_materno"  placeholder="Modelo" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Tipo: </label>
                                      <input type="text" class="form-control" id="apellido_materno"  placeholder="Tipo" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Placas: </label>
                                      <input type="text" class="form-control" id="apellido_materno"  placeholder="Placas" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>

                                </div>

                                <div class="row">
                                  <div class="col-md-4">
                                      <label for="inputPassword4"  style="font-size:12px;"class="form-label">Cilindraje: </label>
                                      <input type="text" class="form-control" id="nombre"  placeholder="Cilindraje" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Nombre
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Cuota: </label>
                                      <div class="radio-inline">
                                          <label class="radio">
                                              <input type="radio" name="radios2">
                                              <span></span>
                                              A
                                          </label>
                                          <label class="radio">
                                              <input type="radio" name="radios2">
                                              <span></span>
                                              B
                                          </label>
                                          <label class="radio">
                                              <input type="radio" name="radios2">
                                              <span></span>
                                              C
                                          </label>
                                          <label class="radio">
                                              <input type="radio" name="radios2">
                                              <span></span>
                                              D
                                          </label>
                                          <label class="radio">
                                              <input type="radio" name="radios2">
                                              <span></span>
                                              E
                                          </label>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Gasolina: </label>
                                      <input type="text" class="form-control" id="apellido_materno"  placeholder="Gasolina" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>


                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Mes $ Gasolina: </label>
                                      <input type="text" class="form-control" id="apellido_materno"  placeholder="Mes precio Gasolina" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">$ Gasolina vh. Oficial: </label>
                                      <input type="text" class="form-control" id="apellido_materno"  placeholder="$ Gasolina vh. Oficial" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>

                                </div>


                              </div>
                              <div class="tab-pane fade" id="profile-5" role="tabpanel" aria-labelledby="profile-tab-5">

                                <div class="row">
                                  <div class="col-md-12">
                                    <label for="">Viaje</label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="radios2">
                                            <span></span>
                                            Redondo
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2">
                                            <span></span>
                                            Solo Ida
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2">
                                            <span></span>
                                            Solo regreso
                                        </label>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">


                                  <div class="col-md-6">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Costo Total Transporte de Autobus: </label>
                                      <input type="text" class="form-control" id="apellido_materno"  placeholder="Costo Total Transporte de Autobus" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>

                                </div>

                              </div>
                              <div class="tab-pane fade" id="contact-5" role="tabpanel" aria-labelledby="contact-tab-5">
                                <div class="row">
                                  <div class="col-md-10">
                                    <label for="">Peaje</label>
                                    <select class="form-control" name="">
                                      <option value=""></option>
                                    </select>
                                  </div>
                                  <div class="col-md-2">
                                    <label for="" style="visibility:hidden;">dfdfdf</label><br>
                                    <button type="button" class="btn btn-primary">Agregar</button>
                                  </div>
                                  <div class="col-md-12">
                                      <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Costo</th>
                                                <th scope="col">acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Auto</td>
                                                <td>2500</td>
                                                <td>
                                                  <span class="label label-inline label-light-danger font-weight-bold">
                                                      <i class="far fa-trash-alt"></i>
                                                  </span>
                                                </td>
                                            </tr>

                                        </tbody>
                                        <tfoot>
                                          <td>total peaje</td>
                                          <td>$1000</td>
                                          <td></td>
                                        </tfoot>
                                      </table>
                                  </div>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="taxi-5" role="tabpanel" aria-labelledby="taxi-tab-5">
                                <span for="">Selecciona la clasificación del Recorrido</span>
                                <div class="row">

                                  <div class="col-md-4">

                                    <select class="form-control" name="">
                                      <option value="">DIF. y otros estados</option>
                                      <option value="">Tamaulipas</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4">
                                    <select class="form-control" name="">
                                      <option value="">Aeropuerto-Comisión-Aeropuerto</option>
                                      <option value="">Central de Autobuses - Comisión - Central de Autobuses</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4">
                                    <select class="form-control" name="">
                                      <option value="">Aeropuerto-Lugar de Comisión-Aeropuerto</option>
                                      <option value="">Central de Autobuses - Lugar de Comisión - Central de Autobuses</option>
                                    </select>
                                  </div>

                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                    <label for="">Dia Adicional</label>
                                    <input type="text" class="form-control" value="">
                                  </div>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="avion-5" role="tabpanel" aria-labelledby="avion-tab-5">

                                <div class="row">
                                  <div class="col-md-12">
                                    <label for="">Viaje</label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="radios2">
                                            <span></span>
                                            Redondo
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2">
                                            <span></span>
                                            Solo Ida
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2">
                                            <span></span>
                                            Solo regreso
                                        </label>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">


                                  <div class="col-md-6">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Costo Boleto del Avion: </label>
                                      <input type="text" class="form-control" id="apellido_materno"  placeholder="Costo Total Transporte de Autobus" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>

                                </div>


                              </div>
                          </div>
                      </div>
                  </div>


                  <div role="separator" class="dropdown-divider"></div>
                  <div id="tabla1">
                    <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Agregar</button>
                      </div>
                      <div class="col-md-12">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tipo Transporet</th>
                                    <th scope="col">Tipo de viaje</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Modelo</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Placas</th>
                                    <th scope="col">Cilindraje</th>
                                    <th scope="col">Cuota</th>
                                    <th scope="col">Gasolina</th>
                                    <th scope="col">total</th>
                                    <th scope="col">acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Auto</td>
                                    <td>SORPRESA</td>
                                    <td>FORD</td>
                                    <td>567YT</td>
                                    <td>TRED-789</td>
                                    <td>250</td>
                                    <td>250</td>
                                    <td>250</td>
                                    <td>250</td>
                                    <td>2500</td>
                                    <td>
                                      <span class="label label-inline label-light-danger font-weight-bold">
                                          <i class="far fa-trash-alt"></i>
                                      </span>
                                    </td>
                                </tr>

                            </tbody>
                          </table>
                      </div>

                      <div class="col-md-4">
                          <label for="inputPassword4" style="font-size:12px;" class="form-label">Programa: </label>
                          <select class="form-control" name="">
                            <option value=""></option>
                          </select>
                          <div class="invalid-feedback">
                            Por Favor Ingrese Apellido Paterno
                          </div>
                      </div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Calcular viático</button>
                      </div>
                      <div class="col-md-4">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <label class="checkbox">
                            <input type="checkbox" name="Checkboxes2">
                            <span></span>
                            Se proporcionan vales de combustible
                        </label>
                      </div>
                      <div class="col-md-2">
                        <label for="">Total Transporte</label>
                        <input type="text" class="form-control" value="$2550">
                      </div>

                    </div>
                  </div>
                  <div id="tabla2">
                    <div class="row">
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <label class="radio">
                            <input type="radio" name="radios3">
                            <span></span>
                            Vale de gasolina
                        </label>
                      </div>
                      <div class="col-md-8"></div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Agregar</button>
                      </div>
                      <div class="col-md-12">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tipo Transporet</th>
                                    <th scope="col">Tipo de viaje</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Modelo</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Placas</th>
                                    <th scope="col">Cilindraje</th>
                                    <th scope="col">Cuota</th>
                                    <th scope="col">Gasolina</th>
                                    <th scope="col">total</th>
                                    <th scope="col">acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Auto</td>
                                    <td>SORPRESA</td>
                                    <td>FORD</td>
                                    <td>567YT</td>
                                    <td>TRED-789</td>
                                    <td>250</td>
                                    <td>250</td>
                                    <td>250</td>
                                    <td>250</td>
                                    <td>2500</td>
                                    <td>
                                      <span class="label label-inline label-light-danger font-weight-bold">
                                          <i class="far fa-trash-alt"></i>
                                      </span>
                                    </td>
                                </tr>

                            </tbody>
                          </table>
                      </div>


                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Calcular viático</button>
                      </div>
                      <div class="col-md-4">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <label class="checkbox">
                            <input type="checkbox" name="Checkboxes2">
                            <span></span>
                            Se proporcionan vales de combustible
                        </label>
                      </div>
                      <div class="col-md-2">
                        <label for="">Total Transporte</label>
                        <input type="text" class="form-control" value="$2550">
                      </div>

                    </div>
                  </div>

                  <div id="tabla3">
                    <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Agregar</button>
                      </div>
                      <div class="col-md-12">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tipo Transporet</th>
                                    <th scope="col">Tipo de viaje</th>

                                    <th scope="col">total</th>
                                    <th scope="col">acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Auto</td>
                                    <td>Redondo</td>
                                    <td>2500</td>
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

                      </div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Calcular viático</button>
                      </div>

                      <div class="col-md-2">
                        <label for="">Total Transporte</label>
                        <input type="text" class="form-control" value="$2550">
                      </div>

                    </div>
                  </div>

                  <div id="tabla4">
                    <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Agregar</button>
                      </div>
                      <div class="col-md-12">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tipo Transporet</th>
                                    <th scope="col">Tipo de viaje</th>

                                    <th scope="col">total</th>
                                    <th scope="col">acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Auto</td>
                                    <td>Redondo</td>
                                    <td>2500</td>
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

                      </div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Calcular viático</button>
                      </div>

                      <div class="col-md-2">
                        <label for="">Total Transporte</label>
                        <input type="text" class="form-control" value="$2550">
                      </div>

                    </div>
                  </div>

                  <div id="tabla5">
                    <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Agregar</button>
                      </div>
                      <div class="col-md-12">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tipo Transporet</th>
                                    <th scope="col">Tipo de viaje</th>

                                    <th scope="col">total</th>
                                    <th scope="col">acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Auto</td>
                                    <td>Redondo</td>
                                    <td>2500</td>
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

                      </div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Calcular viático</button>
                      </div>

                      <div class="col-md-2">
                        <label for="">Total Transporte</label>
                        <input type="text" class="form-control" value="$2550">
                      </div>

                    </div>
                  </div>

                  <div id="tabla6">
                    <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Agregar</button>
                      </div>
                      <div class="col-md-12">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tipo Transporet</th>
                                    <th scope="col">Tipo de viaje</th>

                                    <th scope="col">total</th>
                                    <th scope="col">acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Auto</td>
                                    <td>Redondo</td>
                                    <td>2500</td>
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

                      </div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Calcular viático</button>
                      </div>

                      <div class="col-md-2">
                        <label for="">Total Transporte</label>
                        <input type="text" class="form-control" value="$2550">
                      </div>

                    </div>
                  </div>
                  <!-- <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col">Tipo Transporet</th>
                                  <th scope="col">Tipo de viaje</th>
                                  <th scope="col">Marca</th>
                                  <th scope="col">Modelo</th>
                                  <th scope="col">Tipo</th>
                                  <th scope="col">Placas</th>
                                  <th scope="col">Cilindraje</th>
                                  <th scope="col">Cuota</th>
                                  <th scope="col">Gasolina</th>
                                  <th scope="col">total</th>
                                  <th scope="col">acciones</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>Auto</td>
                                  <td>SORPRESA</td>
                                  <td>FORD</td>
                                  <td>567YT</td>
                                  <td>TRED-789</td>
                                  <td>250</td>
                                  <td>250</td>
                                  <td>250</td>
                                  <td>250</td>
                                  <td>2500</td>
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

                    </div>
                    <div class="col-md-2">
                      <label for="" style="visibility:hidden;">dfdfdf</label><br>
                      <button type="button" class="btn btn-primary">Calcular viático</button>
                    </div>
                    <div class="col-md-2">
                      <label for="">Total Recibido</label>
                      <input type="text" class="form-control" value="$2550">
                    </div>

                  </div> -->



                </div>
                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="">RECIBÍ DE LA SECRETARIA DE</label>
                      <p>Comisión Estatal del Agua</p>
                    </div>
                    <div class="col-md-6">
                      <label for="">CHEQUE N°</label>
                      <input type="text" class="form-control" value="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <label for="">DE FECHA</label>
                      <input type="text" class="form-control" value="">
                    </div>
                    <div class="col-md-6">
                      <label for="">POR LA CANTIDAD DE</label>
                      <input type="text" class="form-control" value="">
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-12">
                      <label for="">LETRA</label>
                      <p>DOS MIL DOCIENTOS VIENTE</p>
                    </div>
                    <div class="col-md-12">
                      <label for="">A MI FAVOR Y CARGO DEL BANCO</label>
                      <p></p>
                    </div>
                  </div>

                </div>
                <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                  <div class="row">
                    <div class="col-md-6">
                      <select class="form-control" name="">
                        <option value=""></option>
                      </select>
                        <p style="text-align:center;">DIRECTOR DEL ÁREA <br> NOMBRE Y FIRMA </p>
                    </div>
                    <div class="col-md-6">
                      <select class="form-control" name="">
                        <option value=""></option>
                      </select>
                        <p style="text-align:center;">ORGANO DE CONTROL<br> NOMBRE Y FIRMA </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <select class="form-control" name="">
                        <option value=""></option>
                      </select>
                        <p style="text-align:center;">DIRECTOR ADMINISTRATIVO <br> NOMBRE Y FIRMA </p>
                    </div>
                    <div class="col-md-6">

                      <input type="text" class="form-control" value="">
                      <p style="text-align:center;">RECIBÍ CHEQUE</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <select class="form-control" name="">
                        <option value=""></option>
                      </select>
                        <p style="text-align:center;">SUPERIOR INMEDIATO <br> NOMBRE Y FIRMA </p>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_5">
                  <div class="col-md-12">
                    <p>12-02-2022 14:00:00 PM (Alex Mondragon) Registro Bien</p>
                    <p>12-02-2022 14:00:00 PM (Alex Mondragon) Registro Bien</p>
                    <p>12-02-2022 14:00:00 PM (Alex Mondragon) Registro Bien</p>
                    <p>12-02-2022 14:00:00 PM (Alex Mondragon) Registro Bien</p>
                    <p>12-02-2022 14:00:00 PM (Alex Mondragon) Registro Bien</p>
                    <p>12-02-2022 14:00:00 PM (Alex Mondragon) Registro Bien</p>
                  </div>
                </div>
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

<script type="text/javascript">
$('#tabla1').show();
$('#tabla2').hide();
$('#tabla3').hide();
$('#tabla4').hide();
$('#tabla5').hide();
$('#tabla6').hide();
  function oficial(){
    $('#tabla1').show();
    $('#tabla2').hide();
    $('#tabla3').hide();
    $('#tabla4').hide();
    $('#tabla5').hide();
    $('#tabla6').hide();
  }

  function particular(){
    $('#tabla1').hide();
    $('#tabla2').show();
    $('#tabla3').hide();
    $('#tabla4').hide();
    $('#tabla5').hide();
    $('#tabla6').hide();

  }

  function autobus(){
    $('#tabla2').hide();
    $('#tabla3').show();
    $('#tabla1').hide();
    $('#tabla4').hide();
    $('#tabla5').hide();
    $('#tabla6').hide();

  }

  function peaje(){
    $('#tabla1').hide();
    $('#tabla2').hide();
    $('#tabla3').hide();
    $('#tabla4').show();
    $('#tabla5').hide();
    $('#tabla6').hide();
  }

  function taxi(){
    $('#tabla1').hide();
    $('#tabla2').hide();
    $('#tabla3').hide();
    $('#tabla4').hide();
    $('#tabla5').show();
    $('#tabla6').hide();
  }

  function avion(){
    $('#tabla1').hide();
    $('#tabla2').hide();
    $('#tabla3').hide();
    $('#tabla4').hide();
    $('#tabla5').hide();
    $('#tabla6').show();
  }
</script>
@endsection
