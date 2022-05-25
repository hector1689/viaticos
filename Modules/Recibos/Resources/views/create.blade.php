@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   @isset($recibos)EDITAR @else NUEVO @endisset  VIATICO
</h3>
<div class="card-toolbar">
<div class="example-tools justify-content-center">

</div>
</div>
</div>
<form class=" needs-validation" novalidate>
<div class="card-body">

        @isset($recibos)
        <div class="row">
          <div class="col-md-4">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Folio: </label>
              <input type="text" class="form-control" id="nombre"  placeholder="Folio"  value="@isset($recibos) {{$recibos->folio}} @endisset" disabled >
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Oficio de Comisión: </label>
              <input type="text" class="form-control" id="apellido_paterno"  placeholder="Oficio de Comisión" disabled required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Estatus: </label>
              <select class="form-control" name="">
                <option value="{{ $recibos->cve_estatus }}">{{ $recibos->obtenerEstatus->nombre }}</option>
                <option value="">Seleccionar</option>
                @foreach($estatus as $estatu)
                <option value="{{ $estatu->id }}">{{ $estatu->nombre }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>
        @endisset
        <div class="row">
          <div class="col-md-2">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">N° de Empleado: </label>
              <input type="text" class="form-control" id="n_empleado" onchange="Empleado()" value="@isset($recibos) {{$recibos->num_empleado}} @endisset" placeholder="N° de Empleado" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Nombre: </label>
              <input type="text" class="form-control" id="nombre_empleado"  placeholder="Nombre"  value="@isset($recibos) {{$recibos->nombre}} @endisset" disabled required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">RFC: </label>
              <input type="text" class="form-control" id="rfc"  placeholder="RFC" value="@isset($recibos) {{$recibos->rfc}} @endisset" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Nivel: </label>
              <input type="text" class="form-control" id="nivel"  placeholder="Nivel" value="@isset($recibos) {{$recibos->nivel}} @endisset" disabled required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Clave Departamental: </label>
              <input type="text" class="form-control" id="clave_departamental"  placeholder="Clave Departamental" value="@isset($recibos) {{$recibos->clave_departamental}} @endisset" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-3">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Dependencia: </label>
              <input type="text" class="form-control" id="dependencia"  placeholder="Dependencia" disabled value="@isset($recibos) {{$recibos->dependencia}} @endisset" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-3">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Dirección: </label>
              <input type="text" class="form-control" id="direccion"  placeholder="Dirección" disabled value="@isset($recibos) {{$recibos->direccion}} @endisset" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-3">
          <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha y Hora de Salida: </label>
          @isset($recibos)
          <?php
          list($fecha,$hora) = explode(' ',$recibos->fecha_hora_salida);

          list($dia,$mes,$anio) = explode('-',$fecha);
          $fecha = $anio.'/'.$mes.'/'.$dia;
          $fecha1 = $fecha.' '.$hora;

           ?>
           @endisset
					<div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
						<input type="text" class="form-control datetimepicker-input" name="fecha_inicial" data-target="#kt_datetimepicker_1" value="@isset($recibos) {{$fecha1}} @endisset" placeholder="Fecha y Hora de Salida">
						<div class="input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
							<span class="input-group-text">
								<i class="ki ki-calendar"></i>
							</span>
						</div>
					</div>
          <div class="invalid-feedback">
            Por Favor Ingrese Apellido Paterno
          </div>
				</div>
        <div class="col-md-3">
          <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha y Hora de Recibido: </label>
          @isset($recibos)
          <?php
          list($fecha,$hora) = explode(' ',$recibos->fecha_hora_recibio);

          list($dia,$mes,$anio) = explode('-',$fecha);
          $fecha = $anio.'/'.$mes.'/'.$dia;
          $fecha2 = $fecha.' '.$hora;

           ?>
           @endisset
          <div class="input-group date" id="kt_datetimepicker_2" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input"  name="fecha_final" data-target="#kt_datetimepicker_2"  value="@isset($recibos) {{$fecha2}} @endisset" placeholder="Fecha y Hora de Recibido">
            <div class="input-group-append" data-target="#kt_datetimepicker_2" data-toggle="datetimepicker">
              <span class="input-group-text">
                <i class="ki ki-calendar"></i>
              </span>
            </div>
          </div>
          <div class="invalid-feedback">
            Por Favor Ingrese Apellido Paterno
          </div>
        </div>

        </div>


        <div class="row">
          <div class="col-md-4">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Departamentos: </label>
              <input type="text" class="form-control" id="departamento"  placeholder="Departamentos" value="@isset($recibos) {{$recibos->departamentos }} @endisset" disabled required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Lugar de Adscripción: </label>
              <input type="text" class="form-control" id="lugar_adscripcion"  placeholder="Lugar de Adscripción" value="@isset($recibos) {{$recibos->lugar_adscripcion}} @endisset"  required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">N° de dias: </label>
              <input type="text" class="form-control" id="n_dias"  placeholder="N° de dias" value="@isset($recibos) {{$recibos->num_dias}} @endisset" onkeypress='return validaNumericos(event)' required>

              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">N° de dias inhabiles: </label>
              <input type="text" class="form-control" id="n_dias_ina"  placeholder="N° de dias inhabiles" value="@isset($recibos) {{$recibos->num_dias_inhabiles}} @endisset" onkeypress='return validaNumericos(event)' required>

              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <label for="inputPassword4" style="font-size:12px;" class="form-label">Descripcion de la Comisión: </label>
            <input type="text" class="form-control" id="descripcion"  placeholder="Descripcion de la Comisión" value="@isset($recibos) {{$recibos->descripcion_comision}} @endisset" required>
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
                @isset($recibos)
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5" tabindex="-1" aria-disabled="true">Seguimiento</a>
                </li>
                @endisset
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
                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Anexo" >
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
                        <input type="text" class="form-control" id="apellido_materno"  placeholder="Anexo" >
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
                                      <label for="">Viaje <span style="color:red;">*</span></label>
                                      <div class="radio-inline" id="radiopage">
                                          <label class="radio">
                                              <input type="radio" name="vhof" value='1'>
                                              <span></span>
                                              Redondo
                                          </label>
                                          <label class="radio">
                                              <input type="radio" name="vhof" value='2'>
                                              <span></span>
                                              Solo Ida
                                          </label>
                                          <label class="radio">
                                              <input type="radio" name="vhof" value='3'>
                                              <span></span>
                                              Solo regreso
                                          </label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-8">
                                        <label for="inputPassword4"  style="font-size:12px;"class="form-label">Buscar: </label>
                                        <input type="text" class="form-control" id="numero_buscar"  placeholder="Buscar Vehiculo por N° Oficial" onchange="buscarNumero()" required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Nombre
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-2">
                                        <label for="inputPassword4"  style="font-size:12px;"class="form-label">N° Oficial: <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="num_oficial"  placeholder="N° Oficial" disabled required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Nombre
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Marca: <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="marca"  placeholder="Marca" disabled required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Paterno
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Modelo: <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="modelo"  placeholder="Modelo" disabled required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Tipo: <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="tipo"  placeholder="Tipo" disabled required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Placas: <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="placas"  placeholder="Placas" disabled required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>

                                  </div>

                                  <div class="row">
                                    <div class="col-md-4">
                                        <label for="inputPassword4"  style="font-size:12px;"class="form-label">Cilindraje: <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="cilindraje"  placeholder="Cilindraje" disabled required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Nombre
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Cuota: <span style="color:red;">*</span></label>
                                        <div class="radio-inline">
                                          @foreach($rendimiento as $rendi)
                                            <label class="radio">
                                                <input type="radio" name="page" value="{{ $rendi->id }}" >
                                                <span></span>
                                                {{ $rendi->tarifa }}
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Gasolina: <span style="color:red;">*</span></label>
                                        <select class="form-control" name="gasolina" id="gasolina" onchange="traerGasolina()"  required>
                                          <option value="0">Seleccionar</option>
                                          @foreach($gasolina as $gaso)
                                          <option value="{{ $gaso->id }}">{{ $gaso->obteneGasolina->nombre }}</option>
                                          @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Gasolina
                                        </div>
                                    </div>


                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Mes $ Gasolina: </label>
                                        <input type="text" class="form-control" id="mes_gasolina"  placeholder="Mes precio Gasolina" disabled required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">$ Gasolina vh. Oficial: </label>
                                        <input type="text" class="form-control" id="gasolina_vehiculo"  placeholder="$ Gasolina vh. Oficial" disabled required>
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
                                            <input type="radio" name="vh2" value='1'>
                                            <span></span>
                                            Redondo
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="vh2" value='2'>
                                            <span></span>
                                            Solo Ida
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="vh2" value='3'>
                                            <span></span>
                                            Solo regreso
                                        </label>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">

                                  <div class="col-md-3">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Marca: </label>
                                      <input type="text" class="form-control" id="marca2"  placeholder="Marca" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Paterno
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Modelo: </label>
                                      <input type="text" class="form-control" id="modelo2"  placeholder="Modelo" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Tipo: </label>
                                      <input type="text" class="form-control" id="tipo2"  placeholder="Tipo" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Placas: </label>
                                      <input type="text" class="form-control" id="placas2"  placeholder="Placas" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>

                                </div>

                                <div class="row">
                                  <div class="col-md-4">
                                      <label for="inputPassword4"  style="font-size:12px;"class="form-label">Cilindraje: </label>
                                      <input type="text" class="form-control" id="cilindraje2"  placeholder="Cilindraje" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Nombre
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Cuota: </label>
                                      <div class="radio-inline">
                                        @foreach($rendimiento as $rendi)
                                          <label class="radio">
                                              <input type="radio" name="page2" value="{{ $rendi->id }}" >
                                              <span></span>
                                              {{ $rendi->tarifa }}
                                          </label>
                                          @endforeach
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Gasolina: </label>
                                      <select class="form-control" name="gasolina" id="gasolina2" onchange="traerGasolina2()"  required>
                                        <option value="">Seleccionar</option>
                                        @foreach($gasolina as $gaso)
                                        <option value="{{ $gaso->id }}">{{ $gaso->obteneGasolina->nombre }}</option>
                                        @endforeach
                                      </select>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Gasolina
                                      </div>
                                  </div>


                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Mes $ Gasolina: </label>
                                      <input type="text" class="form-control" id="mes_gasolina2"  placeholder="Mes precio Gasolina" disabled required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">$ Gasolina vh. Oficial: </label>
                                      <input type="text" class="form-control" id="gasolina_vehiculo2"  placeholder="$ Gasolina vh. Oficial" disabled required>
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
                                            <input type="radio" name="tipoViajeAutobus" value="1">
                                            <span></span>
                                            Redondo
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="tipoViajeAutobus" value="2">
                                            <span></span>
                                            Solo Ida
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="tipoViajeAutobus" value="3">
                                            <span></span>
                                            Solo regreso
                                        </label>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">


                                  <div class="col-md-6">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Costo Total Transporte de Autobus: </label>
                                      <input type="text" class="form-control" id="costoAutobus"  placeholder="Costo Total Transporte de Autobus"  required>
                                  </div>

                                </div>

                              </div>
                              <div class="tab-pane fade" id="contact-5" role="tabpanel" aria-labelledby="contact-tab-5">
                                <div class="row">
                                  <div class="col-md-10">
                                    <label for="">Peaje</label>
                                    <select class="form-control" name="">
                                      @foreach($peajes as $peaje)
                                      <option value="{{ $peaje->id }}">{{ $peaje->ubicacion_peaje }}</option>
                                      @endforeach
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
                        <button type="button" class="btn btn-primary" onclick="AgregarVehiculoOficial()">Agregar</button>
                      </div>
                      <div class="col-md-12">
                          <table class="table" id="tablavehiculo1">
                            <thead>
                                <tr>
                                    <th scope="col">Tipo Transporte</th>
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
                            </tbody>
                          </table>
                      </div>

                      <div class="col-md-4">
                          <label for="inputPassword4" style="font-size:12px;" class="form-label">Programa: </label>
                          <select class="form-control" id="programavehiculof">
                            <option value="">Selecciona</option>
                            @foreach($programa as $pro)
                            <option value="{{ $pro->id }}">{{ $pro->nombre }}</option>
                            @endforeach
                          </select>
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
                        <input type="text" class="form-control" id="total_transporte_vehiculof">
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
                        <button type="button" class="btn btn-primary"  onclick="AgregarVehiculo()">Agregar</button>
                      </div>
                      <div class="col-md-12">
                          <table class="table" id="tablavehiculo2">
                            <thead>
                                <tr>
                                    <th scope="col">Tipo Transporte</th>
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
                        <button type="button" class="btn btn-primary" onclick="agregarAutobus()">Agregar</button>
                      </div>
                      <div class="col-md-12">
                          <table class="table" id="tablaAutobus">
                            <thead>
                                <tr>
                                    <th scope="col">Tipo Transporte</th>
                                    <th scope="col">Tipo de viaje</th>

                                    <th scope="col">total</th>
                                    <th scope="col">acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>Auto</td>
                                    <td>Redondo</td>
                                    <td>2500</td>
                                    <td>
                                      <span class="label label-inline label-light-danger font-weight-bold">
                                          <i class="far fa-trash-alt"></i>
                                      </span>
                                    </td>
                                </tr> -->

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
                                    <th scope="col">Tipo Transporte</th>
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
                                    <th scope="col">Tipo Transporte</th>
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
                                    <th scope="col">Tipo Transporte</th>
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
                                  <th scope="col">Tipo Transporte</th>
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
                      <input type="text" id="secretaria_pago" class="form-control" value="@isset($pagos) {{ $pagos->secretaria }} @endisset" disabled>
                    </div>
                    <div class="col-md-6">
                      <label for="">CHEQUE N°</label>
                      <input type="text" class="form-control" id="cheque" placeholder="Escribir n° de cheque" value="@isset($pagos) {{ $pagos->num_cheque }} @endisset">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <label for="">DE FECHA</label>
                      @isset($pagos)
                      <?php
                      list($dia,$mes,$anio) = explode('-',$pagos->fehca_inicia);
                      $fecha = $anio.'/'.$mes.'/'.$dia;
                       ?>
                       @endisset
                      <input type="text" class="form-control" id="kt_datepicker" name='fecha_pago' value="@isset($pagos) {{ $fecha }} @endisset" placeholder="Selecciona Fecha">
                    </div>
                    <div class="col-md-6">
                      <label for="">POR LA CANTIDAD DE</label>
                      <input type="text" class="form-control" id="cantidad" onchange="cantidadletra()" placeholder="Escribir Cantidad" value="@isset($pagos) {{ $pagos->cantidad }} @endisset">
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-12">
                      <label for="">LETRA</label>

                      <div id="letras"></div>
                      <input type="hidden" id="letras_cantidad" >

                    </div>
                    <div class="col-md-12">
                      <label for="">A MI FAVOR Y CARGO DEL BANCO</label>
                      <p>@isset($pagos) {{ $pagos->favor_cargo_banco }} @endisset</p>
                    </div>
                  </div>

                </div>
                <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                  <div class="row">
                    <div class="col-md-6">
                       <input type="text" id="director_area_firma" name="director_area_firma" class="form-control" value="@isset($firmantes) {{ $firmantes->director_area }} @endisset" disabled>
                        <p style="text-align:center;">DIRECTOR DEL ÁREA <br> NOMBRE Y FIRMA </p>
                    </div>
                    <div class="col-md-6">
                      <input type="text" id="organo_control_firma" name="organo_control_firma" class="form-control" value="@isset($firmantes) {{ $firmantes->organo_control }} @endisset" disabled>
                        <p style="text-align:center;">ORGANO DE CONTROL<br> NOMBRE Y FIRMA </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="text" id="director_administrativo_firma" name="director_administrativo_firma" value="@isset($firmantes) {{ $firmantes->director_administrativo }} @endisset" class="form-control" disabled>
                        <p style="text-align:center;">DIRECTOR ADMINISTRATIVO <br> NOMBRE Y FIRMA </p>
                    </div>
                    <div class="col-md-6">

                      <input type="text" class="form-control" id="cheque_firma" value="@isset($firmantes) {{ $firmantes->recibi_cheque }} @endisset">
                      <p style="text-align:center;">RECIBÍ CHEQUE</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                    <input type="text" id="jefe_firma" name="jefe_firma" class="form-control" value="@isset($firmantes) {{ $firmantes->superior_inmediato }} @endisset" disabled>
                        <p style="text-align:center;">SUPERIOR INMEDIATO <br> NOMBRE Y FIRMA </p>
                    </div>
                  </div>
                </div>
                @isset($recibos)
                <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_5">
                  <div class="col-md-12">
                    @foreach($bitacora as $bit)
                    <p>{{$bit->fecha}} ({{$bit->Usuario_obt->nombre}} {{$bit->Usuario_obt->apellido_paterno}} {{$bit->Usuario_obt->apellido_materno}}) {{$bit->tarea}}</p>
                    @endforeach
                  </div>
                </div>
                @endisset
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
<script src="/admin/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js?v=7.0.6"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
var selectedCouta1 = [];
var selectedviajetipo1 = [];
var arrayVehiculoOficial = [];
var ObjetoVehiculoOficial = [];

var selectedCouta2 = [];
var selectedviajetipo2 = [];
var arrayVehiculo= [];
var ObjetoVehiculo= [];

var selectedAutobus = [];
var arrayAutobus = [];
var ObjetoAutobus = {};

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
  function validaNumericos(event) {
      if(event.charCode >= 48 && event.charCode <= 57){
        return true;
       }
       return false;
  }

  $(function () {
    $('#kt_datetimepicker_1').datetimepicker({
      language: 'es',
      format: 'dd/mm/yyyy',
    });

    // Demo 2
    $('#kt_datetimepicker_2').datetimepicker({
      language: 'es',
      format: 'dd/mm/yyyy',
    });

    $("#kt_datepicker").datepicker({
      language: 'es',
      format: 'dd/mm/yyyy',
  });
});


function AgregarVehiculoOficial(){
  var num_oficial = $('#num_oficial').val();
  var marca = $('#marca').val();
  var modelo = $('#modelo').val();
  var tipo = $('#tipo').val();
  var placas = $('#placas').val();
  var cilindraje = $('#cilindraje').val();
  var gasolina = $('#gasolina').val();
  var mes_gasolina = $('#mes_gasolina').val();
  var gasolina_vehiculo = $('#gasolina_vehiculo').val();
  var couta=$(":radio[name=page]").val();
  var tipo_viaje=$(":radio[name=vhof]").val();
  var page = [];
  var vhof = [];
      $(":radio[name=page]").each(function(){
          if (this.checked) {
              /////////////////////////////////////////////////////
              page.push($(this).val());
              selectedCouta1.push($(this).val());
          }else{
             page.push(0);

          }
      });

      $(":radio[name=vhof]").each(function(){
          if (this.checked) {
              /////////////////////////////////////////////////////
              vhof.push($(this).val());
              selectedviajetipo1.push($(this).val());
          }else{
              vhof.push(0);
          }
      });
      //console.log(page,vhof,num_oficial,gasolina)

      if (page == 0 || vhof == 0 || num_oficial == '' || gasolina == 0) {
        Swal.fire("Lo Sentimos", 'Campos no seleccionados o vacios', "warning");
        page.length=0;
        vhof.length=0;
      }else{
        $.ajax({
               type:"POST",
               url:"/recibos/traerCuotaVehiculo",
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data:{
                   cuota:selectedCouta1[0],
                 },
                success:function(data){
                //  console.log(data.kilometros_litros)

                  ObjetoVehiculoOficial = {
                    tipo_viaje:selectedviajetipo1[0],
                    num_oficial:num_oficial,
                    marca:marca,
                    modelo:modelo,
                    tipo:tipo,
                    placas:placas,
                    cilindraje:cilindraje,
                    gasolina:gasolina,
                    mes_gasolina:mes_gasolina,
                    gasolina_vehiculo:gasolina_vehiculo,
                    cuota:data.kilometros_litros,
                  }
                  agregarVehiculo1(ObjetoVehiculoOficial);
                  arrayVehiculoOficial.push(ObjetoVehiculoOficial);

                  //console.log(arrayVehiculoOficial)
                }
          });
      }

}


var contador_vehiculo1 = 0;
function agregarVehiculo1(ObjetoVehiculoOficial){
  var tipo_viaje = '';
  if (ObjetoVehiculoOficial.tipo_viaje == 1) {
    tipo_viaje = 'REDONDO';
  }else if(ObjetoVehiculoOficial.tipo_viaje == 2){
    tipo_viaje = 'SOLO IDA';
  }else if(ObjetoVehiculoOficial.tipo_viaje == 3){
    tipo_viaje = 'SOLO REGRESO';
  }

  var tr = '<tr id="filas'+contador_vehiculo1+'">'+
  '<td><input type="hidden" id="figura_nueva" value="'+contador_vehiculo1+'"/>Vehiculo Oficial</td>'+
  '<td>'+tipo_viaje+'</td>'+

  '<td>'+ObjetoVehiculoOficial.marca+'</td>'+
  '<td>'+ObjetoVehiculoOficial.modelo+'</td>'+
  '<td>'+ObjetoVehiculoOficial.tipo+'</td>'+
  '<td>'+ObjetoVehiculoOficial.placas+'</td>'+
  '<td>'+ObjetoVehiculoOficial.cilindraje+'</td>'+
  '<td>'+ObjetoVehiculoOficial.cuota+'</td>'+
  '<td>$'+ObjetoVehiculoOficial.gasolina_vehiculo+'</td>'+

  '<td>$100</td>'+
  '<td style=" text-align: center; "><div class="btn btn-danger borrar_figura" onclick="eliminarvehiculooficial('+contador_vehiculo1+')"  ><i  class="fas fa-trash"></i></div></td>'
  '</tr>';

  $("#tablavehiculo1").append(tr);
  $('#num_oficial').val('');
  $('#marca').val('');
  $('#modelo').val('');
  $('#tipo').val('');
  $('#placas').val('');
  $('#cilindraje').val('');
  $('#gasolina').val('');
  $('#mes_gasolina').val('');
  $('#gasolina_vehiculo').val('');

  $(":radio[name=page]").prop("checked",false);
  selectedCouta1.length=0;
  $(":radio[name=vhof]").prop("checked",false);
  selectedviajetipo1.length=0;


  contador_vehiculo1 ++;
}

function eliminarvehiculooficial(id){

  arrayVehiculoOficial.splice(id,1);
  $('#filas'+id).remove();

}



function AgregarVehiculo(){
  var marca = $('#marca2').val();
  var modelo = $('#modelo2').val();
  var tipo = $('#tipo2').val();
  var placas = $('#placas2').val();
  var cilindraje = $('#cilindraje2').val();
  var gasolina = $('#gasolina2').val();
  var mes_gasolina = $('#mes_gasolina2').val();
  var gasolina_vehiculo = $('#gasolina_vehiculo2').val();

  var page = [];
  var vhof = [];
      $(":radio[name=page2]").each(function(){
          if (this.checked) {
              /////////////////////////////////////////////////////
              page.push($(this).val());
              selectedCouta2.push($(this).val());
          }else{
             page.push(0);

          }
      });

      $(":radio[name=vh2]").each(function(){
          if (this.checked) {
              /////////////////////////////////////////////////////
              vhof.push($(this).val());
              selectedviajetipo2.push($(this).val());
          }else{
              vhof.push(0);
          }
      });
      //console.log(page,vhof,num_oficial,gasolina)

      if (page == 0 || vhof == 0 ||  gasolina == 0) {
        Swal.fire("Lo Sentimos", 'Campos no seleccionados o vacios', "warning");
        page.length=0;
        vhof.length=0;
      }else{
        $.ajax({
               type:"POST",
               url:"/recibos/traerCuotaVehiculo",
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data:{
                   cuota:selectedCouta2[0],
                 },
                success:function(data){
                //  console.log(data.kilometros_litros)

                  ObjetoVehiculo = {
                    tipo_viaje:selectedviajetipo2[0],
                    marca:marca,
                    modelo:modelo,
                    tipo:tipo,
                    placas:placas,
                    cilindraje:cilindraje,
                    gasolina:gasolina,
                    mes_gasolina:mes_gasolina,
                    gasolina_vehiculo:gasolina_vehiculo,
                    cuota:data.kilometros_litros,
                  }
                  agregarVehiculo2(ObjetoVehiculo);
                  arrayVehiculo.push(ObjetoVehiculo);

                  //console.log(arrayVehiculoOficial)
                }
          });
      }

}


var contador_vehiculo2 = 0;
function agregarVehiculo2(ObjetoVehiculo){
  var tipo_viaje = '';
  if (ObjetoVehiculo.tipo_viaje == 1) {
    tipo_viaje = 'REDONDO';
  }else if(ObjetoVehiculo.tipo_viaje == 2){
    tipo_viaje = 'SOLO IDA';
  }else if(ObjetoVehiculo.tipo_viaje == 3){
    tipo_viaje = 'SOLO REGRESO';
  }

  var tr = '<tr id="filasVh'+contador_vehiculo2+'">'+
  '<td><input type="hidden" id="figura_nueva" value="'+contador_vehiculo2+'"/>Vehiculo Particular</td>'+
  '<td>'+tipo_viaje+'</td>'+
  '<td>'+ObjetoVehiculo.marca+'</td>'+
  '<td>'+ObjetoVehiculo.modelo+'</td>'+
  '<td>'+ObjetoVehiculo.tipo+'</td>'+
  '<td>'+ObjetoVehiculo.placas+'</td>'+
  '<td>'+ObjetoVehiculo.cilindraje+'</td>'+
  '<td>'+ObjetoVehiculo.cuota+'</td>'+
  '<td>$'+ObjetoVehiculo.gasolina_vehiculo+'</td>'+

  '<td>$100</td>'+
  '<td style=" text-align: center; "><div class="btn btn-danger borrar_figura" onclick="eliminarvehiculo('+contador_vehiculo2+')"  ><i  class="fas fa-trash"></i></div></td>'
  '</tr>';

  $("#tablavehiculo2").append(tr);
  $('#marca2').val('');
  $('#modelo2').val('');
  $('#tipo2').val('');
  $('#placas2').val('');
  $('#cilindraje2').val('');
  $('#gasolina2').val('');
  $('#mes_gasolina2').val('');
  $('#gasolina_vehiculo2').val('');

  $(":radio[name=page2]").prop("checked",false);
  selectedCouta2.length=0;
  $(":radio[name=vh2]").prop("checked",false);
  selectedviajetipo2.length=0;


  contador_vehiculo2 ++;
}

function eliminarvehiculo(id){

  arrayVehiculoOficial.splice(id,1);
  $('#filasVh'+id).remove();

}


function agregarAutobus(){

  var costoAutobus = $('#costoAutobus').val();
  var page = [];

      $(":radio[name=tipoViajeAutobus]").each(function(){
          if (this.checked) {
              /////////////////////////////////////////////////////
              page.push($(this).val());
              selectedAutobus.push($(this).val());
          }else{
             page.push(0);

          }
      });

  if (page == 0 || costoAutobus == '') {
    Swal.fire("Lo Sentimos", 'Campos no seleccionados o vacios', "warning");
    page.length=0;
  }else{

    ObjetoAutobus = {
      tipo_viaje:selectedAutobus[0],
      costoAutobus:costoAutobus,
    }
    agregarAutobuses(ObjetoAutobus);
    arrayAutobus.push(ObjetoAutobus);

    //console.log(ObjetoAutobus)
  }

}
var contador_autobus = 0;
function agregarAutobuses(ObjetoAutobus){
  //console.log(ObjetoAutobus)
  var tipo_viaje = '';
  if (ObjetoAutobus.tipo_viaje == 1) {
    tipo_viaje = 'REDONDO';
  }else if(ObjetoAutobus.tipo_viaje == 2){
    tipo_viaje = 'SOLO IDA';
  }else if(ObjetoAutobus.tipo_viaje == 3){
    tipo_viaje = 'SOLO REGRESO';
  }

  var tr = '<tr id="filasAutobus'+contador_autobus+'">'+
  '<td><input type="hidden" id="figura_nueva" value="'+contador_autobus+'"/>Autobus</td>'+
  '<td>'+tipo_viaje+'</td>'+
  '<td>$'+ObjetoAutobus.costoAutobus+'</td>'+
  '<td style=" text-align: center; "><div class="btn btn-danger borrar_figura" onclick="eliminarAutobus('+contador_autobus+')"  ><i  class="fas fa-trash"></i></div></td>'
  '</tr>';

  $("#tablaAutobus").append(tr);
  $('#costoAutobus').val('');
  $(":radio[name=tipoViajeAutobus]").prop("checked",false);
  selectedAutobus.length=0;



  contador_autobus ++;
}

function eliminarAutobus(id){

  arrayAutobus.splice(id,1);
  $('#filasAutobus'+id).remove();

}


function buscarNumero(){
  var numero = $('#numero_buscar').val();
  $.ajax({
         type:"POST",
         url:"/catalogos/vehiculos/ExisteVehiculo",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
             numero:numero,
           },
          success:function(data){
            //console.log(data)

            if(data == ''){

              Swal.fire("Lo Sentimos", 'No Existe N° Oficial', "warning").then(function(){
                $('#numero_buscar').val('');
              });

            }else{
              $('#numero_buscar').val('');
              $('#num_oficial').val(data.num_oficial);
              $('#marca').val(data.marca);
              $('#modelo').val(data.modelo);
              $('#tipo').val(data.tipo);
              $('#placas').val(data.placas);
              $('#cilindraje').val(data.cilindraje);
            }
          }
    });
}

function traerGasolina(){
  var id_gasolina = $('#gasolina').val();

  $.ajax({
         type:"POST",
         url:"/recibos/TraerGasolina",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
             id_gasolina:id_gasolina,
           },
          success:function(data){
            //console.log(data)
            $('#mes_gasolina').val(data.mes);
            $('#gasolina_vehiculo').val(data.precio_litro);
          }
    });



}

function traerGasolina2(){
  var id_gasolina = $('#gasolina2').val();

  $.ajax({
         type:"POST",
         url:"/recibos/TraerGasolina",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
             id_gasolina:id_gasolina,
           },
          success:function(data){
            //console.log(data)
            $('#mes_gasolina2').val(data.mes);
            $('#gasolina_vehiculo2').val(data.precio_litro);
          }
    });

}

$('#cantidad').keypress(function (tecla) {
    if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
        return false;
    }else {
             var len   = $('#cantidad').val().length;
             var index = $('#cantidad').val().indexOf('.');
             if (index > 0 && tecla.charCode == 46) {
                 return false;
             }
             if (index > 0) {
                 var CharAfterdot = (len + 1) - index;
                 if (CharAfterdot > 3) {
                     return false;
                 }
             }
    }
    return true;

});

$('#costoAutobus').keypress(function (tecla) {
    if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
        return false;
    }else {
             var len   = $('#costoAutobus').val().length;
             var index = $('#costoAutobus').val().indexOf('.');
             if (index > 0 && tecla.charCode == 46) {
                 return false;
             }
             if (index > 0) {
                 var CharAfterdot = (len + 1) - index;
                 if (CharAfterdot > 3) {
                     return false;
                 }
             }
    }
    return true;

});
@isset($pagos)
var cantidadletras = '{{ $pagos->cantidad_letra }}';

$('#letras').html('<p>'+cantidadletras+'</p>');
$('#letras_cantidad').val(cantidadletras);
@endisset
function cantidadletra(){
  //console.log('entro')
  var cantidad = $('#cantidad').val();
  $.ajax({
         type:"POST",
         url:"/recibos/ConvertirLetras",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
             cantidad:cantidad,
           },
          success:function(data){
            $('#letras').html('<p>'+data+'</p>');
            $('#letras_cantidad').val(data);
          }
    });
}


  function Empleado(){
    var n_empleado = $('#n_empleado').val();

    $.ajax({

           type:"POST",

           url:"/recibos/TraerEmpleado",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
               n_empleado:n_empleado,
             },
            success:function(data){
              //console.log(data)

              if (data == '') {
                Swal.fire("Lo Sentimos", 'No Existe N° de Empleado', "warning").then(function(){
                  $('#n_empleado').val('');
                  $('#dependencia').val('');
                  $('#direccion').val('');
                  $('#departamento').val('');
                  $('#nivel').val('');
                });
              }else{
                var nombre  = data.nombre+' '+data.apellido_paterno+' '+data.apellido_materno;
                var nivel = data.nivel;

                $('#nombre_empleado').val(nombre);
                $('#nivel').val(nivel);

                $.ajax({
                       type:"POST",
                       url:"/recibos/TraerNombreDependencia",
                       headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                       data:{
                           id:data.cve_area_departamentos,
                         },
                        success:function(datas){
                          //console.log(datas)
                          $('#dependencia').val('');
                          $('#direccion').val('');
                          $('#departamento').val('');
                          for (var i = 0; i < datas.length; i++) {
                          //console.log(datas[i].id)

                            if (datas[i].id_tipo == 1 || datas[i].id_tipo == 2) {
                              $('#dependencia').val(datas[i].nombre);
                              $('#secretaria_pago').val(datas[i].nombre);

                            }

                            if(datas[i].id_tipo == 3 || datas[i].id_tipo == 4){
                              $('#direccion').val(datas[i].nombre);
                            }

                            if (datas[i].id_tipo == 5) {
                              $('#departamento').val(datas[i].nombre);
                            }

                            if (datas[i].id_tipo == 4) {
                              $.ajax({
                                     type:"POST",
                                     url:"/recibos/TraerJefeDirector",
                                     headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                     },
                                     data:{
                                         id:datas[i].id,
                                       },
                                      success:function(datajD){
                                        //console.log(datajD);
                                        //console.log(dataj.nombre_empleado+' '+dataj.apellido_p_empleado+' '+dataj.apellido_m_empleado)
                                        var nombrejefe = datajD.nombre_empleado+' '+datajD.apellido_p_empleado+' '+datajD.apellido_m_empleado
                                        $('#director_area_firma').val(nombrejefe);
                                      }
                                });
                            }






                          }
                        }
                  });


                  $.ajax({
                         type:"POST",
                         url:"/recibos/TraerFirmaJefes",
                         headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                         data:{
                             id:data.cve_area_departamentos,
                           },
                          success:function(datass){
                            for (var i = 0; i < datass.length; i++) {
                              //console.log(datass[i].cve_cargo,datass[i].nombre,datass[i].apellido_paterno,datass[i].apellido_materno)

                              if (datass[i].cve_cargo == 1) {
                                var nombre_completo = datass[i].nombre+' '+datass[i].apellido_paterno+' '+datass[i].apellido_materno;
                                $('#director_administrativo_firma').val(nombre_completo);
                              }
                              if(datass[i].cve_cargo == 2){
                                var nombre_completo = datass[i].nombre+' '+datass[i].apellido_paterno+' '+datass[i].apellido_materno;
                                $('#organo_control_firma').val(nombre_completo);
                              }
                            }
                          }
                    });


                    $.ajax({
                           type:"POST",
                           url:"/recibos/TraerJefe",
                           headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           },
                           data:{
                               id:data.cve_area_departamentos,
                             },
                            success:function(dataj){
                              //console.log(dataj.nombre_empleado+' '+dataj.apellido_p_empleado+' '+dataj.apellido_m_empleado)
                              var nombrejefe = dataj.nombre_empleado+' '+dataj.apellido_p_empleado+' '+dataj.apellido_m_empleado
                              $('#jefe_firma').val(nombrejefe);
                            }
                      });


// director_area_firma

              }

            }
      });

    //nombre_empleado
  }

  function guardar(){

    var n_empleado = $('#n_empleado').val();
    var nombre_empleado = $('#nombre_empleado').val();
    var rfc = $('#rfc').val();
    var nivel = $('#nivel').val();
    var clave_departamental = $('#clave_departamental').val();
    var dependencia = $('#dependencia').val();
    var direccion = $('#direccion').val();
    var inicia = $('input[name=fecha_inicial]').val();
    var final = $('input[name=fecha_final]').val();
    var departamento = $('#departamento').val();
    var lugar_adscripcion = $('#lugar_adscripcion').val();
    var n_dias = $('#n_dias').val();
    var n_dias_ina = $('#n_dias_ina').val();
    var descripcion = $('#descripcion').val();

    var director_area_firma = $('#director_area_firma').val();
    var organo_control_firma = $('#organo_control_firma').val();
    var director_administrativo_firma = $('#director_administrativo_firma').val();
    var cheque_firma = $('#cheque_firma').val();
    var jefe_firma = $('#jefe_firma').val();

    var secretaria_pago = $('#secretaria_pago').val();
    var cheque = $('#cheque').val();
    var fecha_pago = $('input[name=fecha_pago]').val();
    var cantidad = $('#cantidad').val();
    var letras_cantidad = $('#letras_cantidad').val();


      var formData = new FormData();
       //formData.append('photo', $avatarInput[0].files[0]);

      @isset($recibos)
      formData.append('id',{{ $recibos->id }});
      @endisset
      @isset($firmantes)
      formData.append('id_firmante',{{ $firmantes->id }});
      @endisset
      @isset($pagos)
      formData.append('id_pagos',{{ $pagos->id }});
      @endisset
      formData.append('n_empleado', n_empleado);
      formData.append('nombre_empleado', nombre_empleado);
      formData.append('rfc', rfc);
      formData.append('nivel', nivel);
      formData.append('clave_departamental', clave_departamental);
      formData.append('dependencia', dependencia);
      formData.append('direccion', direccion);
      formData.append('inicia', inicia);
      formData.append('final', final);
      formData.append('departamento', departamento);
      formData.append('lugar_adscripcion', lugar_adscripcion);
      formData.append('n_dias', n_dias);
      formData.append('n_dias_ina', n_dias_ina);
      formData.append('descripcion', descripcion);

      /////////////// FIRMANTES ////////////////////
      formData.append('director_area_firma', director_area_firma);
      formData.append('organo_control_firma', organo_control_firma);
      formData.append('director_administrativo_firma', director_administrativo_firma);
      formData.append('cheque_firma', cheque_firma);
      formData.append('jefe_firma', jefe_firma);

      /////////////////// PAGO ////////////////////
      formData.append('secretaria_pago', secretaria_pago);
      formData.append('cheque', cheque);
      formData.append('fecha_pago', fecha_pago);
      formData.append('cantidad', cantidad);
      formData.append('letras_cantidad', letras_cantidad);




      $.ajax({

             type:"POST",

             url:"{{ ( isset($recibos) ) ? '/recibos/update' : '/recibos/create' }}",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data: formData,
             processData: false,
             contentType: false,
             cache:false,
              success:function(data){
                if (data.success == 'Registro agregado satisfactoriamente') {
                  Swal.fire("", data.success, "success").then(function(){
                    location.href ="/recibos";
                  });

                  Swal.fire({
                        title: "",
                        text: data.success,
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(function(result) {
                        if (result.value == true) {
                             $('#nombre').val('');

                        }else{
                          location.href ="/recibos"; //esta es la ruta del modulo
                        }
                    })

                }else if(data.success == 'Ha sido editado con éxito'){

                  Swal.fire("", data.success, "success").then(function(){
                    location.href ="/recibos";
                  });

                  Swal.fire({
                        title: "",
                        text: data.success,
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(function(result) {

                        if (result.value == true) {

                        }else{
                          location.href ="/recibos";
                        }
                    })
                }


              }
        });


      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      // var form = document.querySelectorAll('.needs-validation')
      // Array.prototype.slice.call(form)
      //   .forEach(function (form) {
      //     form.addEventListener('click', function (event) {
      //       if (!form.checkValidity()) {
      //         event.preventDefault()
      //         event.stopPropagation()
      //       }else{
      //         ///////////////////////////////////////////////////////7
      //
      //         /////////////////////////////////////////////////////////
      //       }
      //
      //       form.classList.add('was-validated')
      //     }, false)
      //   });


  }
</script>
@endsection
