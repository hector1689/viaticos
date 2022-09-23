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
              <input type="text" class="form-control" id="apellido_paterno" value="@isset($recibos){{ $recibos->oficio_comision }}@endisset" placeholder="Oficio de Comisión" disabled required>
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
              <label for="inputPassword4"  style="font-size:12px;"class="form-label"><strong style="color:red">*</strong>N° de Empleado: </label>
              <input type="text" class="form-control" id="n_empleado" onchange="Empleado()" value="@isset($recibos) {{$recibos->num_empleado}} @endisset" placeholder="N° de Empleado" onkeypress='return validaNumericos(event)' required>
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
              <input type="text" class="form-control" id="rfc" name='prov_rfc'  placeholder="RFC" value="@isset($recibos) {{$recibos->rfc}} @endisset" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Nivel: </label>
              <input type="text" class="form-control" id="nivel"  placeholder="Nivel" value="@isset($recibos) {{$recibos->nivel}} @endisset" disabled required>
              <input type="hidden" id="area_id" value=" @isset($recibos) {{ $recibos->id_dependencia }} @endisset">
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label"><strong style="color:red">*</strong>Clave Departamental: </label>
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
          <label for="inputPassword4" style="font-size:12px;" class="form-label"><strong style="color:red">*</strong>Fecha y Hora de Salida: </label>
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
          <label for="inputPassword4" style="font-size:12px;" class="form-label"><strong style="color:red">*</strong>Fecha y Hora de Recibido: </label>
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
              <label for="inputPassword4" style="font-size:12px;" class="form-label"><strong style="color:red">*</strong>Lugar de Adscripción: </label>
              <input type="text" class="form-control" id="lugar_adscripcion"  placeholder="Lugar de Adscripción" value="@isset($recibos) {{$recibos->lugar_adscripcion}} @endisset"  required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-2">
              <label for="inputPassword4" style="font-size:12px;" class="form-label"><strong style="color:red">*</strong>N° de dias: </label>
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
            <label for="inputPassword4" style="font-size:12px;" class="form-label"><strong style="color:red">*</strong>Descripcion de la Comisión: </label>
            <input type="text" class="form-control" id="descripcion" onchange="abrirLugar()"  placeholder="Descripcion de la Comisión" value="@isset($recibos) {{$recibos->descripcion_comision}} @endisset" required>
          </div>
       </div>


        <div role="separator" class="dropdown-divider"></div>

        <div class="row">
          <div class="col-md-12">

            <label class="checkbox">
                <input type="checkbox" name="recibo_complementario" value="1" @isset($recibos) @if($recibos->recibo_complentario == 1) checked @else @endif @endisset>
                <span></span>
                Recibo Complementario
            </label>
            <ul class="nav nav-tabs nav-tabs-line">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_2">Transporte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#kt_tab_pane_1">Lugares</a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Datos de Pago</a>
                </li> -->

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
                <div class="tab-pane fade " id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                  <div class="row">
                    <div class="col-md-3">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label"><strong style="color:red">*</strong>Zona : </label>
                        <select class="form-control" id="zona_trayectoria" data-nivel="1" @isset($recibos) @else disabled @endisset>
                          <option value="0">seleccionar</option>
                          <option value="C">Centro de Tamaulipas</option>
                          <option value="E">Extranjero y mas de 50 millas de la frontera con México en USA</option>
                          <option value="M">Méx.,Mty., Nvo. Ldo.,+ de 800 kms.</option>
                        </select>
                    </div>


                    <div class="col-md-3">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label"><strong style="color:red">*</strong>Origen: </label>
                        <select class="form-control" id="origen_lugar" data-nivel="2" @isset($recibos) @else disabled @endisset >
                          <option value="0">seleccionar</option>
                          <!-- @foreach($lacalidad1 as $loc1)
                          <option value="{{ $loc1->id }}">{{ $loc1->obteneLocalidad->localidad }}-{{ $loc1->obteneLocalidad->obteneMunicipio->nombre }}-{{ $loc1->obteneLocalidad->obteneEstado->nombre }}-{{ $loc1->obteneLocalidad->obtenePais->nombre }}</option>
                          @endforeach -->
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label"><strong style="color:red">*</strong>Destino: </label>
                        <select class="form-control" id="destino_lugar"  data-nivel="3" >
                          <option value="0">seleccionar</option>
                          <!-- @foreach($lacalidad2 as $loc2)
                          <option value="{{ $loc2->id }}">{{ $loc2->obteneLocalidad2->localidad }}-{{ $loc2->obteneLocalidad2->obteneMunicipio->nombre }}-{{ $loc2->obteneLocalidad2->obteneEstado->nombre }}-{{ $loc2->obteneLocalidad2->obtenePais->nombre }}</option>
                          @endforeach -->
                        </select>
                    </div>
                    <div class="form-group col-md-3" >
                      <label for="card-holder" style="visibility:hidden;">Fecha</label><br>
                      <button type="button" class="btn btn-primary" onclick="agregarLugar()">Agregar</button>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="tablaLugares">
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
                            @isset($lugares)
                              @foreach($lugares as $key => $lugar)
                              <tr id="orden_luagres{{$key}}">

                                <!-- {{ $lugar->obteneLocalidad2->obteneLocalidad->obteneMunicipio->nombre }}-{{ $lugar->obteneLocalidad->obteneLocalidad->obteneEstado->nombre }}-{{ $lugar->obteneLocalidad->obteneLocalidad->obtenePais->nombre }} -->
                                <!-- {{ $lugar->obteneLocalidad2 }} -->
                                <td>{{ $lugar->obteneLocalidades->obteneLocalidad->localidad }}-{{ $lugar->obteneLocalidades->obteneLocalidad->obteneMunicipio->nombre }}-{{ $lugar->obteneLocalidades->obteneLocalidad->obteneEstado->nombre }}-{{ $lugar->obteneLocalidades->obteneLocalidad->obtenePais->nombre }}</td>
                                <td>{{ $lugar->obteneLocalidades2->obteneLocalidad2->localidad }}-{{ $lugar->obteneLocalidades2->obteneLocalidad2->obteneMunicipio->nombre }}-{{ $lugar->obteneLocalidades2->obteneLocalidad2->obteneEstado->nombre }}-{{ $lugar->obteneLocalidades2->obteneLocalidad2->obtenePais->nombre }}</td>
                                <td><input type="text" class="form-control" id="dias2_{{$key}}" onkeypress="return validaNumericos(event)" onchange="diasLugares2({{$key}},{{$lugar->id}})" value="{{ $lugar->dias }}" ></td>
                                <td>{{ $lugar->cve_zona }}</td>
                                <td><input type="text" class="form-control" id="kilometraje2_{{$key}}" onkeypress="return validaNumericos(event)" onchange="KilometrajeLugares2({{$key}},{{$lugar->id}})" value="{{ $lugar->kilometros }}" disabled ></td>
                                <td>
                                  <div class="form-group">
                                      <div class="checkbox-list">
                                          <label class="checkbox">
                                              <input type="checkbox" name="gasolina2_{{$key}}" value="{{ $lugar->combustible }}" onclick="gasolinaLugar2({{$lugar->id}},{{$key}})"  @if($lugar->combustible != 0) checked @endif   >
                                              <span></span>
                                          </label>
                                      </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                      <div class="checkbox-list">
                                          <label class="checkbox">
                                              <input type="checkbox" name="hospedaje2_{{$key}}"  value="{{ $lugar->hospedaje }}" onclick="hospedajeLugar2({{$lugar->id}},{{$key}})" @if($lugar->hospedaje != 0) checked @endif >
                                              <span></span>
                                          </label>
                                      </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="checkbox-inline">
                                       <label class="checkbox">
                                           <input type="checkbox" name="desayuno2_{{$key}}"  value="{{ $lugar->desayuno }}"  onclick="desayunoLugar2({{$lugar->id}},{{$key}})" @if($lugar->desayuno != 0) checked @endif >
                                           <span></span>
                                       </label>
                                       <label class="checkbox">
                                           <input type="checkbox" name="comida2_{{$key}}" value="{{ $lugar->comida }}" onclick="comidaLugar2({{$lugar->id}},{{$key}})"  @if($lugar->comida != 0) checked @endif >
                                           <span></span>
                                       </label>
                                       <label class="checkbox">
                                           <input type="checkbox" name="cena2_{{$key}}" value="{{ $lugar->cena }}" onclick="cenaLugar2({{$lugar->id}},{{$key}})"  @if($lugar->cena != 0) checked @endif >
                                           <span></span>
                                       </label>
                                   </div>
                                </td>
                                <td style=" text-align: center; "><div class="btn btn-danger borrar_figura" onclick="bajaLugar({{$lugar->id}},{{$key}})"  ><i  class="fas fa-trash"></i></div></td>
                                </tr>
                              @endforeach
                            @endisset
                          </tbody>
                          <tfoot id="footLugar" >
                            <tr style="text-align:center;">
                              <td>Total</td>
                              <td></td>
                              <td id="total_dias"></td>
                              <td></td>
                              <td id="total_kilometros"></td>
                              <td id="total_gasolina"></td>
                              <td id="total_hospedaje"></td>
                              <td id="total_comidas"></td>
                              <td></td>
                            </tr>
                          </tfoot>
                        </table>
                    </div>


                      <div class="col-md-8">
                          <label for="inputPassword4" style="font-size:12px;" class="form-label"><strong style="color:red">*</strong>Programa: </label>
                          <select class="form-control" id="programalugar" @isset($lugares) @else disabled @endisset onchange="verBtn()">

                             @isset($lugares2)

                               @if($lugares2->cve_programa == 0)
                               <option value="0">Selecciona</option>
                               @else
                               <option value="{{ $lugares2->cve_programa }}">{{ $lugares2->obtenePrograma->nombre }}</option>
                               @endif
                             @else
                             <option value="0">Selecciona</option>
                             @endisset
                            @foreach($programa as $pro)
                            <option value="{{ $pro->id }}">{{ $pro->nombre }}</option>
                            @endforeach
                          </select>
                          <div class="invalid-feedback">
                            Por Favor Ingrese Apellido Paterno
                          </div>
                      </div>



                      <div class="col-md-2 calculobtn" >
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary" onclick="calcularViaticoLugar()">Calcular viático</button>
                      </div>

                      <div class="col-md-2 calculobtn" >
                        <label for="">Total Recibo</label>
                        <div id="total_recibido_lugar"></div>
                      </div>



                  </div>

                </div>

                <div class="tab-pane fade show active" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                  <div class="row">
                    <div class="col-md-2">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Recorrido interno: </label>
                        <input type="text" class="form-control" id="kilometrorecorrido" value="@isset($transporte) {{ $transporte->kilometro_interno }} @else 0 @endisset" onchange="sumarKM()"  placeholder="Kilometro recorrido interno" onkeypress='return validaNumericos(event)'>
                        <div class="invalid-feedback">
                          Por Favor Ingrese Apellido Paterno
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label"><strong style="color:red">*</strong>Especificar el recorrido: </label>
                        <input type="text" class="form-control" id="especificarcomision"  value="@isset($transporte) {{ $transporte->especificar_recorrido }} @endisset" placeholder="Especificar el recorrido" required>
                        <div class="invalid-feedback">
                          Por Favor Ingrese Apellido Paterno
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Total de Km recorridos: </label>
                        <input type="text" class="form-control" id="totalkm"  value="@isset($transporte) {{ $transporte->total_km_recorrido }} @endisset" disabled placeholder="Total de Km recorridos" onkeypress='return validaNumericos(event)'>
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
                                              <input type="radio" name="vhof" value='1' onclick="redondo_vhof()" >
                                              <span></span>
                                              Redondo
                                          </label>
                                          <label class="radio">
                                              <input type="radio" name="vhof" value='2' onclick="redondo_vhof()" >
                                              <span></span>
                                              Solo Ida
                                          </label>
                                          <label class="radio">
                                              <input type="radio" name="vhof" value='3' onclick="redondo_vhof()" >
                                              <span></span>
                                              Solo regreso
                                          </label>
                                      </div>
                                    </div>
                                  </div>
                                  <input type="hidden" id="tipotransporte1" value="1">
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
                                        <input type="text" class="form-control" id="num_oficial"   placeholder="N° Oficial" disabled required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Nombre
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Marca: <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="marca"   placeholder="Marca" disabled required>
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
                                        <input type="text" class="form-control" id="tipo"   placeholder="Tipo" disabled required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Placas: <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="placas" placeholder="Placas" disabled required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>

                                  </div>

                                  <div class="row">
                                    <div class="col-md-4">
                                        <label for="inputPassword4"  style="font-size:12px;"class="form-label">Cilindraje: <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="cilindraje"   placeholder="Cilindraje" disabled required>
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
                                        <input type="text" class="form-control" id="mes_gasolina"   placeholder="Mes precio Gasolina" disabled required>
                                        <div class="invalid-feedback">
                                          Por Favor Ingrese Apellido Materno
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword4" style="font-size:12px;" class="form-label">$ Gasolina vh. Oficial: </label>
                                        <input type="text" class="form-control" id="gasolina_vehiculo"   placeholder="$ Gasolina vh. Oficial" disabled required>
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
                                            <input type="radio" name="vh2" value='1' onclick="redondo_vh2()" >
                                            <span></span>
                                            Redondo
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="vh2" value='2' onclick="redondo_vh2()" >
                                            <span></span>
                                            Solo Ida
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="vh2" value='3' onclick="redondo_vh2()" >
                                            <span></span>
                                            Solo regreso
                                        </label>
                                    </div>
                                  </div>
                                </div>
                                <input type="hidden" id="tipotransporte2" value="2">
                                <div class="row">

                                  <div class="col-md-3">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Marca: </label>
                                      <input type="text" class="form-control" id="marca2"   placeholder="Marca" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Paterno
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Modelo: </label>
                                      <input type="text" class="form-control" id="modelo2"   placeholder="Modelo" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Apellido Materno
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Tipo: </label>
                                      <input type="text" class="form-control" id="tipo2"   placeholder="Tipo" required>
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
                                      <input type="text" class="form-control" id="cilindraje2"   placeholder="Cilindraje" required>
                                      <div class="invalid-feedback">
                                        Por Favor Ingrese Nombre
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Cuota: </label>
                                      <div class="radio-inline">
                                        @foreach($rendimiento as $rendi)
                                          <label class="radio">
                                              <input type="radio" name="page2" value="{{ $rendi->id }}"   >
                                              <span></span>
                                              {{ $rendi->tarifa }}
                                          </label>
                                          @endforeach
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Gasolina: </label>
                                      <select class="form-control" name="gasolina" id="gasolina2" onchange="traerGasolina2()"  required>

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
                                      <input type="text" class="form-control" id="mes_gasolina2"   placeholder="Mes precio Gasolina" disabled required>
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
                                            <input type="radio" name="tipoViajeAutobus" value="2" >
                                            <span></span>
                                            Solo Ida
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="tipoViajeAutobus" value="3" >
                                            <span></span>
                                            Solo regreso
                                        </label>
                                    </div>
                                  </div>
                                </div>
                                <input type="hidden" id="tipotransporte3" value="3">
                                <div class="row">


                                  <div class="col-md-6">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Costo Total Transporte de Autobus: </label>
                                      <input type="text" class="form-control" id="costoAutobus"   placeholder="Costo Total Transporte de Autobus"  required>
                                  </div>

                                </div>

                              </div>
                              <div class="tab-pane fade" id="contact-5" role="tabpanel" aria-labelledby="contact-tab-5">
                                <div class="row">
                                  <div class="col-md-10">
                                    <label for="">Peaje</label>
                                    <select class="form-control" id="Selecpeaje">
                                      <option value="">Seleccionar</option>
                                      @foreach($peajes as $peaje)
                                      <option value="{{ $peaje->id }}">{{ $peaje->ubicacion_peaje }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <input type="hidden" id="tipotransporte4" value="4">
                                  <div class="col-md-2">
                                    <label for="" style="visibility:hidden;">dfdfdf</label><br>
                                    <button type="button" class="btn btn-primary" onclick="agregarPeaje()">Agregar</button>
                                  </div>
                                  <div class="col-md-12">
                                      <table class="table" id='tablaPeajes'>
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Costo</th>
                                                <th scope="col">acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @isset($peaje_t_tabla)
                                          @foreach($peaje_t_tabla as $key => $peajet)
                                            <tr id="filapeaje_{{$key}}">
                                                <td>{{ $peajet->nombre }}</td>
                                                <td> {{ number_format($peajet->costo, 2, '.', ',') }}</td>
                                                <td><div class="btn btn-danger borrar_figura"  onclick="eliminarpeajeTabla({{$peajet->id}},{{$key}})"  ><i  class="fas fa-trash"></i></div></td>
                                            </tr>
                                          @endforeach
                                          @endisset
                                        </tbody>
                                        <!-- <tfoot>
                                          <td>total peaje</td>
                                          <td>$1000</td>
                                          <td></td>
                                        </tfoot> -->
                                      </table>
                                  </div>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="taxi-5" role="tabpanel" aria-labelledby="taxi-tab-5">
                                <span for="">Selecciona la clasificación del Recorrido</span>
                                <div class="row">

                                  <div class="col-md-4">
                                    <input type="hidden" id="tipotransporte5" value="5">
                                    <select class="form-control" id="regiones">
                                      <option value="0">Seleccionar</option>
                                      <option value="1">DIF. y otros estados</option>
                                      <option value="2">Tamaulipas</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4">
                                    <select class="form-control" id="recorrido1">
                                      <option value="0">Seleccionar</option>
                                      @foreach($taxi as $tx)
                                      <option value="{{ $tx->id }}">{{ $tx->descripcion }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="col-md-4">
                                    <select class="form-control" id="recorrido2">
                                      <option value="0">Seleccionar</option>
                                      @foreach($taxi as $tx)
                                      <option value="{{ $tx->id }}">{{ $tx->descripcion }}</option>
                                      @endforeach
                                    </select>
                                  </div>

                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                    <label for="">Dia Adicional</label>
                                    <input type="text" class="form-control" id="dia_adicional">
                                  </div>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="avion-5" role="tabpanel" aria-labelledby="avion-tab-5">

                                <div class="row">
                                  <div class="col-md-12">
                                    <label for="">Viaje</label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="page_avion" value="1" onclick="redondo_page_avion()">
                                            <span></span>
                                            Redondo
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="page_avion" value="2" onclick="redondo_page_avion()">
                                            <span></span>
                                            Solo Ida
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="page_avion" value="3" onclick="redondo_page_avion()">
                                            <span></span>
                                            Solo regreso
                                        </label>
                                    </div>
                                  </div>
                                </div>
                                <input type="hidden" id="tipotransporte6" value="6">
                                <div class="row">


                                  <div class="col-md-6">
                                      <label for="inputPassword4" style="font-size:12px;" class="form-label">Costo Boleto del Avion: </label>
                                      <input type="text" class="form-control" id="costoAvion"  placeholder="Costo Boleto del Avion" required>
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
                              @isset($vhoficial)

                                @foreach($vhoficialtabla as $key => $vho)
                                  <tr id="figuraVHO_{{$key}}">
                                    <td>
                                      <?php

                                        if ($vho->tipo_transporte == 1) {
                                          echo 'Vehiculo Oficial';
                                        }

                                       ?>
                                    </td>
                                    <td>
                                      <?php

                                        if ($vho->tipo_viaje == 1) {
                                          echo 'Redondo';
                                        }elseif ($vho->tipo_viaje == 2) {
                                          echo 'Ida';
                                        }else{
                                          echo 'Regreso';
                                        }

                                       ?>
                                    </td>
                                    <td>{{ $vho->marca }}</td>
                                    <td>{{ $vho->modelo }}</td>
                                    <td>{{ $vho->tipo }}</td>
                                    <td>{{ $vho->placas }}</td>
                                    <td>{{ $vho->cilindraje }}</td>
                                    <td>{{ $vho->cuota }}</td>
                                    <td>{{ $vho->gasolina_vh_oficial }}</td>
                                    <td>{{ number_format($vho->total_transporte, 2, '.', ',') }}</td>
                                    <td><div class="btn btn-danger borrar_figura"  onclick="eliminarvehiculooficialTabla({{$vho->id}},{{$key}})"  ><i  class="fas fa-trash"></i></div></td>
                                  </tr>
                                @endforeach
                              @endisset
                            </tbody>
                          </table>
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
                              @isset($Vehiculo)

                                @foreach($Vehiculotabla as $key => $vh)
                                  <tr id="figuraVH_{{$key}}">
                                    <td>
                                      <?php

                                        if ($vh->tipo_transporte == 2) {
                                          echo 'Vehiculo Particular';
                                        }

                                       ?>
                                    </td>
                                    <td>
                                      <?php

                                        if ($vh->tipo_viaje == 1) {
                                          echo 'Redondo';
                                        }elseif ($vh->tipo_viaje == 2) {
                                          echo 'Ida';
                                        }else{
                                          echo 'Regreso';
                                        }

                                       ?>
                                    </td>
                                    <td>{{ $vh->marca }}</td>
                                    <td>{{ $vh->modelo }}</td>
                                    <td>{{ $vh->tipo }}</td>
                                    <td>{{ $vh->placas }}</td>
                                    <td>{{ $vh->cilindraje }}</td>
                                    <td>{{ $vh->cuota }}</td>
                                    <td>{{ $vh->gasolina_vh_oficial }}</td>
                                    <td>{{ $vh->total_transporte }}</td>
                                    <td><div class="btn btn-danger borrar_figura"  onclick="eliminarvehiculoTabla({{$vh->id}},{{$key}})"  ><i  class="fas fa-trash"></i></div></td>
                                  </tr>
                                @endforeach
                              @endisset
                            </tbody>
                          </table>
                      </div>


                      <!-- <div class="col-md-2">
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
                      </div> -->

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
                              @isset($autobus)
                                @foreach($autobustabla as $key => $tablaautb)
                                <tr id="figuraAuto_{{$key}}">
                                    <td>
                                      <?php
                                        if ($tablaautb->tipo_transporte == 3) {
                                          echo 'Autobus';
                                        }
                                       ?>
                                    </td>
                                    <td>
                                      <?php

                                        if ($tablaautb->tipo_viaje == 1) {
                                          echo 'Redondo';
                                        }elseif ($tablaautb->tipo_viaje == 2) {
                                          echo 'Ida';
                                        }elseif ($tablaautb->tipo_viaje == 3){
                                          echo 'Regreso';
                                        }

                                       ?>
                                    </td>
                                    <td>{{ number_format($tablaautb->costo_total, 2, '.', ',') }}</td>
                                    <td><div class="btn btn-danger borrar_figura"  onclick="eliminarautoTabla({{$tablaautb->id}},{{$key}})"  ><i  class="fas fa-trash"></i></div></td>
                                </tr>
                                @endforeach
                              @endisset
                            </tbody>
                          </table>
                      </div>

                      <!-- <div class="col-md-8">

                      </div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Calcular viático</button>
                      </div>

                      <div class="col-md-2">
                        <label for="">Total Transporte</label>
                        <input type="text" class="form-control" value="$2550">
                      </div> -->

                    </div>
                  </div>

                  <div id="tabla4">
                    <!-- <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary" >Agregar</button>
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

                    </div> -->
                  </div>

                  <div id="tabla5">
                    <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary" onclick="AgregarTaxi()">Agregar</button>
                      </div>
                      <div class="col-md-12">
                          <table class="table" id="tablaTaxis">
                            <thead>
                                <tr>
                                    <th scope="col">Region</th>
                                    <th scope="col">Recorrido A</th>
                                    <th scope="col">Recorrido B</th>
                                    <th scope="col">Día Adicional</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                              @isset($taxi_t_tabla)
                                @foreach($taxi_t_tabla as $key => $tabtx)
                                <tr id="figurataxi{{$key}}">
                                  <td>{{  $tabtx->name_calsificacion }}</td>
                                  <td>{{  $tabtx->name_kilometraje_origen }}</td>
                                  <td>{{  $tabtx->name_kilometraje_destino }}</td>
                                  <td>{{  $tabtx->dia_adicional }}</td>
                                  <td><div class="btn btn-danger borrar_figura"  onclick="eliminartaxiTabla({{$tabtx->id}},{{$key}})"  ><i  class="fas fa-trash"></i></div></td>
                                </tr>
                                @endforeach
                              @endisset
                            </tbody>
                          </table>
                      </div>

                      <!-- <div class="col-md-8">

                      </div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Calcular viático</button>
                      </div>

                      <div class="col-md-2">
                        <label for="">Total Transporte</label>
                        <input type="text" class="form-control" value="$2550">
                      </div> -->

                    </div>
                  </div>

                  <div id="tabla6">
                    <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary" onclick="agregarAvion()">Agregar</button>
                      </div>
                      <div class="col-md-12">
                          <table class="table" id="tablaAviones">
                            <thead>
                                <tr>
                                    <th scope="col">Tipo Transporte</th>
                                    <th scope="col">Tipo de viaje</th>

                                    <th scope="col">total</th>
                                    <th scope="col">acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                              @isset($avion_t_tabla)
                                @foreach($avion_t_tabla as $key => $tabavion)
                                  <tr id="figuraavion{{ $key }}">
                                    <td>Avion</td>
                                    <td>
                                      <?php

                                        if ($tabavion->tipo_viaje == 1) {
                                          echo 'Redondo';
                                        }else if($tabavion->tipo_viaje == 2){
                                          echo 'Ida';

                                        }else if($tabavion->tipo_viaje == 3){
                                          echo 'Regreso';

                                        }

                                       ?>
                                    </td>
                                    <td>{{ number_format($tabavion->costo_total, 2, '.', ',') }}</td>
                                    <td><div class="btn btn-danger borrar_figura"  onclick="eliminaravionTabla({{$tabavion->id}},{{$key}})"  ><i  class="fas fa-trash"></i></div></td>

                                  </tr>
                                @endforeach
                              @endisset
                            </tbody>
                          </table>
                      </div>

                      <!-- <div class="col-md-8">

                      </div>
                      <div class="col-md-2">
                        <label for="" style="visibility:hidden;">dfdfdf</label><br>
                        <button type="button" class="btn btn-primary">Calcular viático</button>
                      </div>

                      <div class="col-md-2">
                        <label for="">Total Transporte</label>
                        <input type="text" class="form-control" value="$2550">
                      </div> -->

                    </div>
                  </div>
                  <div role="separator" class="dropdown-divider"></div>

                  <div class="row">
                    <div class="col-md-4">
                        <label for="inputPassword4" style="font-size:12px;" class="form-label">Programa: </label>
                        <select class="form-control" id="programavehiculof">
                          @isset($transporte)

                          @if($transporte->programavehiculo == 0)
                          <option value="0">Selecciona</option>
                          @else
                          <option value="{{ $transporte->programavehiculo }}">{{ $transporte->obtenePrograma->nombre}}</option>
                          @endif


                          @else
                            <option value="">Selecciona</option>
                          @endisset

                          @foreach($programa as $pro)
                          <option value="{{ $pro->id }}">{{ $pro->nombre }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                      <label for="" style="visibility:hidden;">dfdfdf</label><br>
                      <button type="button" class="btn btn-primary" onclick="calcularViaticoTransporte()">Calcular viático</button>
                    </div>
                    <div class="col-md-4">
                      <label for="" style="visibility:hidden;">dfdfdf</label><br>
                      <label class="checkbox">
                          <input type="checkbox" name="valeCombustible" value="1" @isset($transporte) @if($transporte->valeCombustible == 1) checked @else @endif @endisset>
                          <span></span>
                          Se proporcionan vales de combustible
                      </label>
                    </div>
                    <div class="col-md-2">
                      <label for="">Total Transporte</label>
                      <input type="text" class="form-control" id="total_transporte_vehiculof" disabled>
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
                      <label for=""><strong style="color:red">*</strong>CHEQUE N°</label>
                      <input type="text" class="form-control" id="cheque" placeholder="Escribir n° de cheque" value="@isset($pagos) {{ $pagos->num_cheque }} @endisset" onkeypress='return validaNumericos(event)'>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <label for=""><strong style="color:red">*</strong>DE FECHA</label>
                      @isset($pagos)
                      <?php
                      list($dia,$mes,$anio) = explode('-',$pagos->fehca_inicia);
                      $fecha = $anio.'/'.$mes.'/'.$dia;
                       ?>
                       @endisset
                      <input type="text" class="form-control" id="kt_datepicker" name='fecha_pago' value="@isset($pagos) {{ $fecha }} @endisset" placeholder="Selecciona Fecha">
                    </div>
                    <div class="col-md-6">
                      <label for=""><strong style="color:red">*</strong>POR LA CANTIDAD DE</label>
                      <input type="text" class="form-control" id="cantidad" onchange="cantidadletra()" placeholder="Escribir Cantidad" value="@isset($pagos) {{ number_format($pagos->cantidad, 2, '.', ',') }} @endisset">
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
                      <input type="text" id="banco" class="form form-control" value="@isset($pagos) {{ $pagos->favor_cargo_banco }} @endisset">

                    </div>
                  </div>

                </div>
                <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                  <div class="row">
                    <div class="col-md-6">
                       <input type="text" id="director_area_firma" name="director_area_firma" class="form-control" value="@isset($firmantes) {{ $firmantes->director_area }} @endisset" >
                        <p style="text-align:center;">DIRECTOR DEL ÁREA <br> NOMBRE Y FIRMA </p>
                    </div>
                    <div class="col-md-6">
                      <input type="text" id="organo_control_firma" name="organo_control_firma" class="form-control" value="@isset($firmantes) {{ $firmantes->organo_control }} @endisset" >
                        <p style="text-align:center;">ORGANO DE CONTROL<br> NOMBRE Y FIRMA </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="text" id="director_administrativo_firma" name="director_administrativo_firma" value="@isset($firmantes) {{ $firmantes->director_administrativo }} @endisset" class="form-control" >
                        <p style="text-align:center;">DIRECTOR ADMINISTRATIVO <br> NOMBRE Y FIRMA </p>
                    </div>
                    <div class="col-md-6">

                      <input type="text" class="form-control" id="cheque_firma" value="@isset($firmantes) {{ $firmantes->recibi_cheque }} @endisset">
                      <p style="text-align:center;"><strong style="color:red">*</strong>RECIBÍ CHEQUE</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                    <input type="text" id="jefe_firma" name="jefe_firma" class="form-control" value="@isset($firmantes) {{ $firmantes->superior_inmediato }} @endisset" >
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

  <a class="btn btn-primary " id="kt_btn_1" onclick="guardar()">Guardar</a>
</div>
</form>

</div>

<!-- <div id="cargar" class="spinner spinner-primary spinner-lg mr-15"></div> -->
<script src="/admin/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js?v=7.0.6"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
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


var selectedAvion = [];
var arrayAvion = [];
var ObjetoAvion = {};

var ObjetoPeaje = {};
var arrayPeaje = [];

var ObjetoTaxi = {};
var arrayTaxi = [];


var ObjetoRecorrido = {};
var arrayRecorrido = [];

var arrayNumeros = [];


var ObjetoLugares = {};
var arrayLugares = [];

/////////////////////////////////////////////////////////////////
$("#zona_trayectoria").change(function(){

  var zona = $("#zona_trayectoria").val();

  //console.log(estado);
  //$('#municipios').prop('selectedIndex',0);
  nivel = parseInt($(this).attr('data-nivel'));
    $.ajax({

       type:"POST",

       url:"/recibos/TresZonas",
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       data:{
         zona:zona,
       },

        success:function(data){
          if (data) {

              for(i = nivel + 1; i <= 3; i++){
                $('#origen_lugar').empty();
                //$('#destino_lugar').empty();
                $('#origen_lugar').append('<option value="0">Selecciona</option>');
              }data.forEach((x) => {
                $('#origen_lugar').append('<option value="'+x.id+'">'+x.localidad+'-'+x.municipio+'-'+x.estado+'-'+x.pais+' </option>');

              });

          }
        }
  });

});

///////////////// origen destino ///////////////////////////
$("#origen_lugar").change(function(){

  var origen = $("#origen_lugar").val();

  //console.log(estado);
  //$('#municipios').prop('selectedIndex',0);
  nivel = parseInt($(this).attr('data-nivel'));
    $.ajax({

       type:"POST",

       url:"/recibos/Destino",
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       data:{
         origen:origen,
       },

        success:function(data){
          //console.log(data)
           $('#destino_lugar').empty();
           // $('#destino_lugar').prop('selectedIndex',0);
          $('#destino_lugar').append('<option value="'+data.id+'">'+data.obtene_municipio.nombre +' '+data.obtene_estado.nombre +' '+data.obtene_pais.nombre+'</option>');

          // if (data) {
          //   for(i = nivel + 1; i <= 3; i++){
          //     $('#destino_lugar').empty();
          //
          //   }data.forEach((x) => {
          //
          //     console.log(x.obtene_estado.nombre)
          //     //$('#destino_lugar').append('<option value="'+x.id+'">'+x.c_Municipios+'</option>');
          //
          //   });
          // }
        }
  });

});

/////////////////////////////////////////////////////////////
@isset($transporte)
$('#total_transporte_vehiculof').val({{$transporte->total_transporte}} );
@endisset

@isset($lugares2)
var total = {{ $lugares2->total_recibido }};
  $('#total_recibido_lugar').html('<input type="text" class="form-control" value="'+total.toFixed(2)+'" id="total_extraer" disabled>');
  cantidadletra(total.toFixed(2))
@endisset

@isset($lugares)
var suma_dias2 = 0;
var suma_kilometraje2 = 0;

var suma_gasolina2 = 0;
var suma_hospedaje2 = 0;

var suma_kilometraje2 = 0;

var suma_desayuno2 = 0;
var suma_comida2 = 0;
var suma_cena2 = 0;

var total_alimentos2 = 0;



var arraysito ={!!  json_encode($lugares) !!};
var totalkilometraje = $('#totalkm').val();
arraysito.forEach (function(x){
  suma_dias2 += parseInt(x.dias);
  suma_kilometraje2 += parseInt(x.kilometros);

  var cuota = 0;

  if (arrayvhoficial == '[]') {

  }else{
    var arrayvhoficial ={!!  json_encode($vhoficialtabla) !!};
    arrayvhoficial.forEach (function(z){
      cuota = z.cuota;
    });
  }

    var arrayvehiculo ={!!  json_encode($Vehiculotabla) !!};

    if (arrayvehiculo == '[]') {

    }else{
      arrayvehiculo.forEach (function(z){
        cuota = z.cuota;
      });
    }
    //console.log(totalkilometraje,cuota,x.combustible);
  var totalito  = parseInt(totalkilometraje) / parseInt(cuota);
  var totalmas = totalito * parseFloat(x.combustible);
  //suma_gasolina2 += parseFloat(x.combustible);
  suma_gasolina2  = totalmas;
  suma_hospedaje2 += parseFloat(x.hospedaje);

  suma_desayuno2 += parseFloat(x.desayuno);
  suma_comida2 += parseFloat(x.comida);
  suma_cena2 += parseFloat(x.cena);

  total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

});



$('#total_dias').html('<p>'+suma_dias2+'</p>');
$('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
$('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
$('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
$('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

@endisset




function  sumarKM(){
  // var kilometraje_interno = $('#kilometrorecorrido').val();
  //
  // var suma_kilometraje = 0;
  // arrayKilometrajeLugares.forEach (function(numero_kilometraje){
  // suma_kilometraje += parseInt(numero_kilometraje.kilometraje);
  // });
  //
  // var totalito = parseInt(kilometraje_interno) + parseInt(suma_kilometraje);
  //
  //  $('#totalkm').val(totalito);



}


function eliminarvehiculooficialTabla(id,id_key){
  $.ajax({

         type:"POST", //si existe esta variable usuarios se va mandar put sino se manda post

         url:"/recibos/borrarVHf", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
         },
         data:{
             id:id,
           },success:function(data){

             $('#total_transporte_vehiculof').val(data);
           }
    });

    $('#figuraVHO_'+id_key).remove();
}

function eliminarpeajeTabla(id,id_key){
  $.ajax({

         type:"POST", //si existe esta variable usuarios se va mandar put sino se manda post

         url:"/recibos/borrarPeaje", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
         },
         data:{
             id:id,
           },success:function(data){
             //console.log(data)
             $('#total_transporte_vehiculof').val(data);

           }
    });

    $('#filapeaje_'+id_key).remove();
}

 function eliminarautoTabla(id,id_key){
  $.ajax({

         type:"POST", //si existe esta variable usuarios se va mandar put sino se manda post

         url:"/recibos/borrarAutob", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
         },
         data:{
             id:id,
           },success:function(data){
             //console.log(data)
             $('#total_transporte_vehiculof').val(data);

           }
    });

    $('#figuraAuto_'+id_key).remove();
}

function eliminaravionTabla(id,id_key){
  $.ajax({

         type:"POST", //si existe esta variable usuarios se va mandar put sino se manda post

         url:"/recibos/borrarAvion", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
         },
         data:{
             id:id,
           },success:function(data){
            // console.log(data)
             $('#total_transporte_vehiculof').val(data);

           }
    });

    $('#figuraavion'+id_key).remove();
}

function eliminartaxiTabla(id,id_key){
  $.ajax({

         type:"POST", //si existe esta variable usuarios se va mandar put sino se manda post

         url:"/recibos/borrarTaxi", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
         },
         data:{
             id:id,
           }
    });

    $('#figurataxi'+id_key).remove();
}



function eliminarvehiculoTabla(id,id_key){
  $.ajax({

         type:"POST", //si existe esta variable usuarios se va mandar put sino se manda post

         url:"/recibos/borrarVH", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
         },
         data:{
             id:id,
           },success:function(data){
            // console.log(data)
             $('#total_transporte_vehiculof').val(data);

           }
    });
  $('#figuraVH_'+id_key).remove();
}




function calcularViaticoTransporte(){

  @isset($transporte)

  ////////////////////////////////////////////////////
  if (arrayVehiculoOficial == '') {
  var sumitavof = 0;
  }else{

    var sumitaautoOf2 = 0;
    arrayVehiculoOficial.forEach (function(numeroautoOf){
    sumitaautoOf2 += numeroautoOf.total;
    });
  var sumitavof =  sumitaautoOf2;
  }
  ///////////////////////////////////////////////////
  if (arrayVehiculo == '') {
  var sumitavp = 0;
  }else{

    var sumitaautop2 = 0;
    arrayVehiculo.forEach (function(numeroautoP){
    sumitaautop2 += numeroautoP.total;
    });

   var sumitavp =  sumitaautop2;
  }
  ////////////////////////////////////////////////////
  if (arrayAvion == '') {
  var sumitaavion = 0;
  }else{
    var sumitaautobus2 = 0;
    arrayAutobus.forEach (function(numeroautobus){
    sumitaautobus2 += numeroautobus.costoAutobus;
    });

  var sumitaavion =  arrayAvion[0]['costoAvion']
  }
  ////////////////////////////////////////////////
  if (arrayAutobus == '') {
  var sumitaatobus = 0;
  }else{

    var sumitaautobus2 = 0;
    arrayAutobus.forEach (function(numeroautobus){
    sumitaautobus2 += numeroautobus.costoAutobus;
    });

    var sumitaatobus =  sumitaautobus2;
  }
  /////////////////////////////////////////////////////
  if (arrayPeaje == '') {
  var sumitapeaje = 0;
  }else{


      var sumitapeaje2 = 0;
      arrayPeaje.forEach (function(numeropeaje){
      sumitapeaje2 += numeropeaje.costo;
      });
      //console.log(sumitapeaje2);

      var sumitapeaje =  sumitapeaje2
  }
  ///////////////////////////////////////////////////
  if (arrayRecorrido == '') {
  //console.log(arrayTaxi)
  var sumitataxi = 0;
  }else{

    var sumitataxi2 = 0;

    var sumitatarifa1 = 0;
    var sumitatarifa2 = 0;

    var sumitatarifa_adicional = 0;
    var sumitatarifa_adicional2 = 0;

    var totaltarifadicional = 0;

    var totalcalculoadicional = 0;
    var totalcalculo = 0;

    arrayRecorrido.forEach (function(numerotaxi){

      sumitatarifa1 += numerotaxi.tarifa_evento;
      sumitatarifa2 += numerotaxi.tarifa_evento2;

      sumitatarifa_adicional += numerotaxi.tarifa_adicional;
      sumitatarifa_adicional2 += numerotaxi.tarifa_adicional2;

      totaltarifadicional = parseFloat(sumitatarifa_adicional) + parseFloat(sumitatarifa_adicional2);

      sumitataxi2 = parseFloat(sumitatarifa1) + parseFloat(sumitatarifa2);

      //console.log(totaltarifadicional);

      dia_adicional = numerotaxi.dia_adicional;

      //console.log(dia_adicional);


      totalcalculoadicional = totaltarifadicional * dia_adicional;



      totalcalculo = parseFloat(totalcalculoadicional) + parseFloat(sumitataxi2);
    });

    var sumitataxi = totalcalculo;

  }

  var total_yasumado =  $('#total_transporte_vehiculof').val();

  var total = parseFloat(sumitavof) + parseFloat(sumitavp) + parseFloat(sumitaavion) + parseFloat(sumitaatobus) + parseFloat(sumitapeaje) + parseFloat(sumitataxi) + parseFloat(total_yasumado);

  $('#total_transporte_vehiculof').val(total.toFixed(2));


  @else

  ////////////////////////////////////////////////////
  if (arrayVehiculoOficial == '') {
  var sumitavof = 0;
  }else{

    var sumitaautoOf2 = 0;
    arrayVehiculoOficial.forEach (function(numeroautoOf){
    sumitaautoOf2 += numeroautoOf.total;
    });
  var sumitavof =  sumitaautoOf2;
  }
  ///////////////////////////////////////////////////
  if (arrayVehiculo == '') {
  var sumitavp = 0;
  }else{

    var sumitaautop2 = 0;
    arrayVehiculo.forEach (function(numeroautoP){
    sumitaautop2 += numeroautoP.total;
    });

   var sumitavp =  sumitaautop2;
  }
  ////////////////////////////////////////////////////
  if (arrayAvion == '') {
  var sumitaavion = 0;
  }else{
    var sumitaautobus2 = 0;
    arrayAutobus.forEach (function(numeroautobus){
    sumitaautobus2 += numeroautobus.costoAutobus;
    });

  var sumitaavion =  arrayAvion[0]['costoAvion']
  }
  ////////////////////////////////////////////////
  if (arrayAutobus == '') {
  var sumitaatobus = 0;
  }else{

    var sumitaautobus2 = 0;
    arrayAutobus.forEach (function(numeroautobus){
    sumitaautobus2 += numeroautobus.costoAutobus;
    });

    var sumitaatobus =  sumitaautobus2;
  }
  /////////////////////////////////////////////////////
  if (arrayPeaje == '') {
  var sumitapeaje = 0;
  }else{


      var sumitapeaje2 = 0;
      arrayPeaje.forEach (function(numeropeaje){
      sumitapeaje2 += numeropeaje.costo;
      });
      //console.log(sumitapeaje2);

      var sumitapeaje =  sumitapeaje2
  }
  ///////////////////////////////////////////////////
  if (arrayRecorrido == '') {
  //console.log(arrayTaxi)
  var sumitataxi = 0;
  }else{

    var sumitataxi2 = 0;

    var sumitatarifa1 = 0;
    var sumitatarifa2 = 0;

    var sumitatarifa_adicional = 0;
    var sumitatarifa_adicional2 = 0;

    var totaltarifadicional = 0;

    var totalcalculoadicional = 0;
    var totalcalculo = 0;

    arrayRecorrido.forEach (function(numerotaxi){

      sumitatarifa1 += numerotaxi.tarifa_evento;
      sumitatarifa2 += numerotaxi.tarifa_evento2;

      sumitatarifa_adicional += numerotaxi.tarifa_adicional;
      sumitatarifa_adicional2 += numerotaxi.tarifa_adicional2;

      totaltarifadicional = parseFloat(sumitatarifa_adicional) + parseFloat(sumitatarifa_adicional2);

      sumitataxi2 = parseFloat(sumitatarifa1) + parseFloat(sumitatarifa2);

      //console.log(totaltarifadicional);

      dia_adicional = numerotaxi.dia_adicional;

      //console.log(dia_adicional);


      totalcalculoadicional = totaltarifadicional * dia_adicional;



      totalcalculo = parseFloat(totalcalculoadicional) + parseFloat(sumitataxi2);
    });

    var sumitataxi = totalcalculo;

  }



  var total = parseFloat(sumitavof) + parseFloat(sumitavp) + parseFloat(sumitaavion) + parseFloat(sumitaatobus) + parseFloat(sumitapeaje) + parseFloat(sumitataxi) ;

  $('#total_transporte_vehiculof').val(total.toFixed(2));

  @endisset


  //console.log(total)



}

function redondo_vhof(){

  $(":radio[name=vhof]").each(function(){
      if (this.checked) {
          /////////////////////////////////////////////////////

          if ($(this).val() == 1) {
            // $('#home-tab-5').hide();
            $('#este-tab-5').hide();
            $('#profile-tab-5').hide();
            $('#contact-tab-5').show();
            $('#taxi-tab-5').hide();
            $('#avion-tab-5').hide();
          }else if($(this).val() == 2){
            $('#este-tab-5').show();
            $('#profile-tab-5').show();
            $('#contact-tab-5').show();
            $('#taxi-tab-5').show();
            $('#avion-tab-5').show();
          }else if($(this).val() == 3){
            $('#este-tab-5').show();
            $('#profile-tab-5').show();
            $('#contact-tab-5').show();
            $('#taxi-tab-5').show();
            $('#avion-tab-5').show();
          }


      }
  });

}

function redondo_vh2(){
  $(":radio[name=vh2]").each(function(){
      if (this.checked) {
          /////////////////////////////////////////////////////

          if ($(this).val() == 1) {
            $('#home-tab-5').hide();
            //$('#este-tab-5').hide();
            $('#profile-tab-5').hide();
            $('#contact-tab-5').show();
            $('#taxi-tab-5').hide();
            $('#avion-tab-5').hide();
          }else if($(this).val() == 2){
            $('#home-tab-5').show();
            $('#profile-tab-5').show();
            $('#contact-tab-5').show();
            $('#taxi-tab-5').show();
            $('#avion-tab-5').show();
          }else if($(this).val() == 3){
            $('#home-tab-5').show();
            $('#profile-tab-5').show();
            $('#contact-tab-5').show();
            $('#taxi-tab-5').show();
            $('#avion-tab-5').show();
          }


      }
  });

}

function redondo_tipoViajeAutobus(){
  $(":radio[name=tipoViajeAutobus]").each(function(){
      if (this.checked) {
          /////////////////////////////////////////////////////

          if ($(this).val() == 1) {
            $('#home-tab-5').hide();
            $('#este-tab-5').hide();
            //$('#profile-tab-5').hide();
            $('#contact-tab-5').hide();
            $('#taxi-tab-5').hide();
            $('#avion-tab-5').hide();
          }else if($(this).val() == 2){
            $('#home-tab-5').show();
            //$('#profile-tab-5').show();
            $('#este-tab-5').show();
            $('#contact-tab-5').show();
            $('#taxi-tab-5').show();
            $('#avion-tab-5').show();
          }else if($(this).val() == 3){
            $('#home-tab-5').show();
            //$('#profile-tab-5').show();
            $('#este-tab-5').show();

            $('#contact-tab-5').show();
            $('#taxi-tab-5').show();
            $('#avion-tab-5').show();
          }


      }
  });
}

function redondo_page_avion(){
  $(":radio[name=page_avion]").each(function(){
      if (this.checked) {
          /////////////////////////////////////////////////////

          if ($(this).val() == 1) {
            $('#home-tab-5').hide();
            $('#este-tab-5').hide();
            $('#profile-tab-5').hide();
            $('#contact-tab-5').hide();
            $('#taxi-tab-5').hide();
            //$('#avion-tab-5').hide();
          }else if($(this).val() == 2){
            $('#home-tab-5').show();
            $('#profile-tab-5').show();
            $('#este-tab-5').show();
            $('#contact-tab-5').hide();
            $('#taxi-tab-5').show();
            //$('#avion-tab-5').show();
          }else if($(this).val() == 3){
            $('#home-tab-5').show();
            $('#profile-tab-5').show();
            $('#este-tab-5').show();
            $('#contact-tab-5').hide();
            $('#taxi-tab-5').show();
            //$('#avion-tab-5').show();
          }


      }
  });
}


$('#estado').select2({
    width: '100%',
});


@isset($recibos)
$('#footLugar').show();
$('.calculobtn').show();
@else
$('#footLugar').hide();
//$('.calculobtn').hide();
$('.calculobtn').show();
@endisset


// function verBtn(){
//   var programalugar = $('#programalugar').val();
//   if (programalugar == 0) {
//     $('.calculobtn').hide();
//   }else{
//     $('.calculobtn').show();
//   }
// }

function abrirLugar(){
  $('#origen_lugar').prop('disabled',false);
  $('#zona_trayectoria').prop('disabled',false);
  $('#destino_lugar').prop('disabled',true);
}


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


// $("input[name=prov_rfc]").change(function(){
//
// var length = $("input[name=prov_rfc]").val().length;
//   var curp = $("input[name=prov_rfc]").val();
//         curpValida = validarRFC(curp);
//         //console.log(length);
//         //length == 12 && curpValida == true
//         if(length == 12 && curpValida == true){
// //console.log('entro')
//         }else if(length == 13 && curpValida == true){
//
//         }else{
//           Swal.fire("Lo Sentimos", 'RFC No Valido', "warning");
//           $("input[name=prov_rfc]").val('');
//         }
//
// });


function validarRFC(campo){
  if (campo.length == 12) {
    var RegExPattern = /^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))((-)?([A-Z\d]{2}))?$/i;
  }else if(campo.length == 13){
    var RegExPattern = /^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))((-)?([A-Z\d]{3}))?$/i;
  }
  //

    //console.log(RegExPattern)
    if ((campo.match(RegExPattern)) && (campo!='')) {
      return true;
    } else {
      return false;
    }
}


var objectLugar = {};
var arrayLugar = [];


function agregarLugar(){


$('#programalugar').prop('disabled',false);
var nivel = $('#nivel').val();
var origen_lugar = $('#origen_lugar').val();
var destino_lugar = $('#destino_lugar').val();
var origen_lugar_name = $('#origen_lugar').find('option:selected').text();
var destino_lugar_name = $('#destino_lugar').find('option:selected').text();
var zona_trayectoria = $('#zona_trayectoria').val();
//console.log(origen_lugar,destino_lugar)


if (origen_lugar == 0 || destino_lugar == 0) {

}else{

  // $.ajax({
  //        type:"POST",
  //        url:"/recibos/NivelAlimentacion",
  //        headers: {
  //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //        },
  //        data:{
  //            nivel:nivel,
  //            zona_trayectoria:zona_trayectoria,
  //          },
  //         success:function(dars){
  //           console.log(dars)
  //         }
  //
  //   });


  $.ajax({
         type:"POST",
         url:"/recibos/AlimentacionTime",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
             nivel:nivel,
             zona_trayectoria:zona_trayectoria,
             origen_lugar:origen_lugar,
             destino_lugar:destino_lugar,
           },
          success:function(dars){
            //console.log(dars)
          //  console.log(dars.total_kilometraje1,dars.total_kilometraje2)

            //var total_kilometros = parseInt(dars.total_kilometraje1) + parseInt(dars.total_kilometraje2);
            var total_kilometros = parseInt(dars.total_kilometraje1);
            //console.log(zona_trayectoria,dars.alimentos[0].zona)

            objectLugar = {
              desayuno:dars.alimentos[0].importe_desayuno,
              comida:dars.alimentos[0].importe_comida,
              cena:dars.alimentos[0].importe_cena,
              zona:dars.alimentos[0].zona,
              gasolina:dars.gasolina.precio_litro,
              hospedaje:dars.hospedaje[0].importe,
              nivel_persona:nivel,
              origen:origen_lugar,
              destino:destino_lugar,
              origen_name:origen_lugar_name,
              destino_name:destino_lugar_name,
              zona_trayectoria:zona_trayectoria,
              total_kilometros:total_kilometros,
            }



            agregarLugares(objectLugar);
            arrayLugar.push(objectLugar);

            ObjetoLugares = {
              nivel_persona:nivel,
              origen:origen_lugar,
              destino:destino_lugar,
              origen_name:origen_lugar_name,
              destino_name:destino_lugar_name,
            }
            arrayLugares.push(ObjetoLugares);

          }

    });

}

}


var contador_lugares = 0;
function agregarLugares(objectLugar){

var zonita = '';
if (objectLugar.zona == 1) {
  zonita = 'Centro de Tamaulipas';
}else{
  zonita = 'Frontera y Entidades Federativas del Extranjero';
}

// gasolina_
// hospedaje_
// desayuno_
// comida_
// cena_
//console.log(objectLugar.hospedaje),diasLugares('+contador_lugares+'),KilometrajeLugares('+contador_lugares+')
  var tr = '<tr id="filas_lugar'+contador_lugares+'">'+
  '<td><input type="hidden" id="figura_nueva" value="'+contador_lugares+'"/>'+objectLugar.origen_name+'</td>'+
  '<td>'+objectLugar.destino_name+'</td>'+
  '<td><input type="text" class="form-control" id="dias_'+contador_lugares+'" onkeypress="return validaNumericos(event)" onchange="diasLugares('+contador_lugares+'),KilometrajeLugares('+contador_lugares+'),botones('+contador_lugares+')" ></td>'+
  '<td>'+objectLugar.zona_trayectoria+'</td>'+
  '<td><input type="text" class="form-control" id="kilometraje_'+contador_lugares+'" onkeypress="return validaNumericos(event)" value="'+objectLugar.total_kilometros+'" disabled ></td>'+
  '<td>'+
    '<div class="form-group">'+
        '<div class="checkbox-list">'+
            '<label class="checkbox">'+
                '<input type="checkbox" name="gasolina_'+contador_lugares+'" onclick="gasolinaLugar('+contador_lugares+')" value="'+objectLugar.gasolina+'" disabled>'+
                '<span></span>'+
            '</label>'+
        '</div>'+
    '</div>'+
  '</td>'+
  '<td>'+
    '<div class="form-group">'+
        '<div class="checkbox-list">'+
            '<label class="checkbox">'+
                '<input type="checkbox" name="hospedaje_'+contador_lugares+'" onclick="hospedajeLugar('+contador_lugares+')" value="'+objectLugar.hospedaje+'" disabled>'+
                '<span></span>'+
            '</label>'+
        '</div>'+
    '</div>'+
  '</td>'+
  '<td><div class="checkbox-inline">'+
         '<label class="checkbox">'+
             '<input type="checkbox" name="desayuno_'+contador_lugares+'" onclick="desayunoLugar('+contador_lugares+')" value="'+objectLugar.desayuno+'" disabled>'+
             '<span></span>'+
         '</label>'+
         '<label class="checkbox">'+
             '<input type="checkbox" name="comida_'+contador_lugares+'" onclick="comidaLugar('+contador_lugares+')" value="'+objectLugar.comida+'" disabled>'+
             '<span></span>'+
         '</label>'+
         '<label class="checkbox">'+
             '<input type="checkbox" name="cena_'+contador_lugares+'" onclick="cenaLugar('+contador_lugares+')" value="'+objectLugar.cena+'" disabled>'+
             '<span></span>'+
         '</label>'+
     '</div>'+
  '</td>'+
  '<td style=" text-align: center; "><div class="btn btn-danger borrar_figura"  onclick="eliminarlugar('+contador_lugares+')"  ><i  class="fas fa-trash"></i></div></td>'
  '</tr>';
  $("#tablaLugares").append(tr);

  $('#origen_lugar').prop('selectedIndex',0);
  //$('#destino_lugar').prop('selectedIndex',0);
  $('#zona_trayectoria').prop('selectedIndex',0);
   $('#destino_lugar').empty();



  arrayTablaLugares.push({
    id:contador_lugares,
    zona:objectLugar.zona,
    namezona_:zonita,
    origen_nombre:objectLugar.origen_name,
    destino_nombre:objectLugar.destino_name,
    origen:objectLugar.origen,
    destino:objectLugar.destino,
  })



  contador_lugares ++;
}

function botones(id){
  //console.log(id)
  $(":checkbox[name=gasolina_"+id+"]").prop('disabled',false);
  $(":checkbox[name=hospedaje_"+id+"]").prop('disabled',false);
  $(":checkbox[name=desayuno_"+id+"]").prop('disabled',false);
  $(":checkbox[name=comida_"+id+"]").prop('disabled',false);
  $(":checkbox[name=cena_"+id+"]").prop('disabled',false);


}




var objectDiasLugares = {};
var arrayDiasLugares = [];

var objectKilometrajeLugares = {};
var arrayKilometrajeLugares = [];


var objectGasolinaLugares = {};
var arrayGasolinaLugares = [];


var objectHospedajeLugares = {};
var arrayHospedajeLugares = [];


var objectDesayunoLugares = {};
var arrayDesayunoLugares = [];

var objectComidaLugares = {};
var arrayComidaLugares = [];


var objectCenaLugares = {};
var arrayCenaLugares = [];

var objectTablaLugares = {};
var arrayTablaLugares = [];

function diasLugares(id){


  var dias = $('#dias_'+id).val();
  //var dias = $("#n_dias").val();

  //console.log(dias)
  objectDiasLugares = {
    id:id,
    dias:dias
  }



  arrayTablaLugares.push({
    id:id,
    dias:dias
  })

  arrayDiasLugares.push(objectDiasLugares)



}


function diasLugares2(id_key,id){

  var dias = $('#dias2_'+id_key).val();
  //var dias = $("#n_dias").val();
  //console.log(dias,id)

  $.ajax({
         type:"POST",
         url:"/recibos/CambioDias",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
           dias:dias,
           id:id,
           },
          success:function(data){
            //console.log(data)
          }
    });



}


function KilometrajeLugares2(id_key,id){

  var kilometraje = $('#kilometraje2_'+id_key).val();
  //console.log(dias,id)

  $.ajax({
         type:"POST",
         url:"/recibos/CambioKilometraje",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
           kilometraje:kilometraje,
           id:id,
           },
          success:function(data){
            //console.log(data)
          }
    });



}

function KilometrajeLugares(id){
var kilometraje = $('#kilometraje_'+id).val();
//var kilometraje = $('#kilometraje_0').val();
//console.log(id,kilometraje)
  arrayTablaLugares.push({
    id:id,
    kilometraje:kilometraje
  })

  objectKilometrajeLugares = {
  id:id,
  kilometraje:kilometraje
  }
  arrayKilometrajeLugares.push(objectKilometrajeLugares)

}

function gasolinaLugar(id){
    $(":checkbox[name=gasolina_"+id+"]").each(function(){
        if (this.checked) {
            /////////////////////////////////////////////////////
            //console.log(arrayVehiculo == '',arrayVehiculo.length == 0);
            //console.log(arrayVehiculoOficial,arrayVehiculo);
            //console.log('si entro esta madre');
            var kilometraje = $('#kilometraje_'+id).val();
            //var kilometraje_interno = $('#kilometrorecorrido').val();

            //console.log($('#kilometrorecorrido').val());
            if ($('#kilometrorecorrido').val() == 0) {
              var kilometraje_interno = 0;
            }else{
              var kilometraje_interno = $('#kilometrorecorrido').val();
            }

            var kilometraje_total = parseInt(kilometraje) + parseInt(kilometraje_interno)

            //console.log(kilometraje_total,kilometraje,kilometraje_interno)
            var total = $(this).val();
            // if (arrayVehiculo.length == 0) {
            //   var cuota = arrayVehiculoOficial[0].cuota;
            //   //var viaje = arrayVehiculoOficial[0].tipo_viaje;
            //
            //   // if (viaje == 1) {
            //   //   var tipo_viajesito  = 2;
            //   // }else if(viaje == 2){
            //   //   var tipo_viajesito  = 1;
            //   // }else if(viaje == 3){
            //   //   var tipo_viajesito  = 1;
            //   // }
            //   //console.log(parseInt(kilometraje) , parseInt(tipo_viajesito) , parseInt(kilometraje_interno) ,parseFloat(cuota) , parseFloat($(this).val()))
            //   var total1 = parseInt(kilometraje);
            //   var total2 = parseInt(total1) + parseInt(kilometraje_interno);
            //   //console.log(total1,parseInt(kilometraje_interno))
            //   //var total2 = parseInt(kilometraje_interno);
            //   var total3 = total2 / parseInt(cuota);
            //   var total4 = total3 * parseFloat($(this).val());
            //   //console.log(total1,total2,total3,total4)
            //   var total =  total4;
            //   //console.log(total2)
            //   //console.log(total3)
            //   //console.log(total4)
            //   //console.log(total)
            //   //var total = parseInt(kilometraje_total) * parseInt(tipo_viajesito) / parseFloat(cuota) * parseFloat($(this).val());
            //   //console.log(parseInt(kilometraje),parseFloat(cuota),parseFloat($(this).val()))
            //
            //   // arrayTablaLugares.push({
            //   //   id:id,
            //   //   //gasolina:$(this).val(),
            //   //   gasolina:total,
            //   // })
            //   //
            //   // //console.log(arrayTablaLugares)
            //   //
            //   //
            //   //
            //   // objectGasolinaLugares = {
            //   // id:id,
            //   // //gasolina:$(this).val(),
            //   // gasolina:total,
            //   // }
            //   //
            //   // arrayGasolinaLugares.push(objectGasolinaLugares)
            // }else if (arrayVehiculoOficial.length == 0) {
            //   var cuota = arrayVehiculo[0].cuota;
            //   // var viaje = arrayVehiculoOficial[0].tipo_viaje;
            //   //
            //   // if (viaje == 1) {
            //   //   var tipo_viajesito  = 2;
            //   // }else if(viaje == 2){
            //   //   var tipo_viajesito  = 1;
            //   // }else if(viaje == 3){
            //   //   var tipo_viajesito  = 1;
            //   // }
            //
            //   //console.log(parseInt(kilometraje) , parseInt(tipo_viajesito) , parseInt(kilometraje_interno) ,parseFloat(cuota) , parseFloat($(this).val()))
            //   //var total1 = parseInt(kilometraje) * parseInt(tipo_viajesito);
            //   var total1 = parseInt(kilometraje);
            //   var total2 = total1 + parseInt(kilometraje_interno);
            //   //var total2 = parseInt(kilometraje_interno);
            //   var total3 = total2 / parseInt(cuota);
            //   var total4 = total3 * parseFloat($(this).val());
            //   //console.log(total1,total2,total3,total4)
            //   var total =  total4;
            //
            //   //var total =  parseInt(kilometraje_interno) * parseInt(tipo_viajesito) + parseInt(kilometraje)  / parseFloat(cuota) * parseFloat($(this).val());
            //   //var total = parseInt(kilometraje_total) * parseInt(tipo_viajesito) / parseFloat(cuota) * parseFloat($(this).val());
            //   //console.log(parseInt(kilometraje),parseFloat(cuota),parseFloat($(this).val()))
            //
            //   //console.log(total)
            //
            //   // arrayTablaLugares.push({
            //   //   id:id,
            //   //   //gasolina:$(this).val(),
            //   //   gasolina:total,
            //   // })
            //   //
            //   // //console.log(arrayTablaLugares)
            //   //
            //   //
            //   //
            //   // objectGasolinaLugares = {
            //   // id:id,
            //   // //gasolina:$(this).val(),
            //   // gasolina:total,
            //   // }
            //   //
            //   // arrayGasolinaLugares.push(objectGasolinaLugares)
            // }else if (arrayAutobus.length == 0) {
            //
            //   // var viaje = arrayAutobus[0].tipo_viaje;
            //   //
            //   // if (viaje == 1) {
            //   //   var tipo_viajesito  = 2;
            //   // }else if(viaje == 2){
            //   //   var tipo_viajesito  = 1;
            //   // }else if(viaje == 3){
            //   //   var tipo_viajesito  = 1;
            //   // }
            //
            //   //console.log(parseInt(kilometraje) , parseInt(tipo_viajesito) , parseInt(kilometraje_interno) ,parseFloat(cuota) , parseFloat($(this).val()))
            //   //var total1 = parseInt(kilometraje) * parseInt(tipo_viajesito);
            //   var total1 = parseInt(kilometraje);
            //   var total2 = total1 + parseInt(kilometraje_interno);
            //   //var total2 = parseInt(kilometraje_interno);
            //   var total3 = total2 / parseInt(cuota);
            //   var total4 = total3 * parseFloat($(this).val());
            //   //console.log(total1,total2,total3,total4)
            //   var total =  total4;
            //
            //   //var total =  parseInt(kilometraje_interno) * parseInt(tipo_viajesito) + parseInt(kilometraje)  / parseFloat(cuota) * parseFloat($(this).val());
            //   //var total = parseInt(kilometraje_total) * parseInt(tipo_viajesito) / parseFloat(cuota) * parseFloat($(this).val());
            //   //console.log(parseInt(kilometraje),parseFloat(cuota),parseFloat($(this).val()))
            //
            //   //console.log(total)
            //
            //
            // }else if (arrayAvion.length == 0) {
            //
            //   // var viaje = arrayAvion[0].tipo_viaje;
            //   //
            //   // if (viaje == 1) {
            //   //   var tipo_viajesito  = 2;
            //   // }else if(viaje == 2){
            //   //   var tipo_viajesito  = 1;
            //   // }else if(viaje == 3){
            //   //   var tipo_viajesito  = 1;
            //   // }
            //
            //   //console.log(parseInt(kilometraje) , parseInt(tipo_viajesito) , parseInt(kilometraje_interno) ,parseFloat(cuota) , parseFloat($(this).val()))
            //   //var total1 = parseInt(kilometraje) * parseInt(tipo_viajesito);
            //   var total1 = parseInt(kilometraje);
            //   var total2 = total1 + parseInt(kilometraje_interno);
            //   //var total2 = parseInt(kilometraje_interno);
            //   var total3 = total2 / parseInt(cuota);
            //   var total4 = total3 * parseFloat($(this).val());
            //   //console.log(total1,total2,total3,total4)
            //   var total =  total4;
            //
            //   //var total =  parseInt(kilometraje_interno) * parseInt(tipo_viajesito) + parseInt(kilometraje)  / parseFloat(cuota) * parseFloat($(this).val());
            //   //var total = parseInt(kilometraje_total) * parseInt(tipo_viajesito) / parseFloat(cuota) * parseFloat($(this).val());
            //   //console.log(parseInt(kilometraje),parseFloat(cuota),parseFloat($(this).val()))
            //
            //   //console.log(total)
            //
            //   // arrayTablaLugares.push({
            //   //   id:id,
            //   //   //gasolina:$(this).val(),
            //   //   gasolina:total,
            //   // })
            //   //
            //   // //console.log(arrayTablaLugares)
            //   //
            //   //
            //   //
            //   // objectGasolinaLugares = {
            //   // id:id,
            //   // //gasolina:$(this).val(),
            //   // gasolina:total,
            //   // }
            //   //
            //   // arrayGasolinaLugares.push(objectGasolinaLugares)
            // }



            //console.log(total)

            arrayTablaLugares.push({
              id:id,
              //gasolina:$(this).val(),
              gasolina:total,
            })

            //console.log(arrayTablaLugares)



            objectGasolinaLugares = {
            id:id,
            //gasolina:$(this).val(),
            gasolina:total,
            }

            arrayGasolinaLugares.push(objectGasolinaLugares)
            //console.log(arrayGasolinaLugares)
        }else {

          arrayGasolinaLugares.forEach(function(x, index, object) {
              if(x.id === id){
                object.splice(index, 1);
              }
          });

        }
    });

}






function gasolinaLugar2(id,id_key){

  $(":checkbox[name=gasolina2_"+id_key+"]").each(function(){
      if (this.checked) {
          /////////////////////////////////////////////////////
          var gasolina = $(this).val();
          //console.log(gasolina)

          if (gasolina == 0) {
            //console.log('entro')
            $.ajax({
                   type:"POST",
                   url:"/recibos/TraerGasolinaL",
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   data:{
                     gasolina:gasolina,
                     },
                    success:function(data){
                      $.ajax({
                             type:"POST",
                             url:"/recibos/TraerGasolinaDatosViaticoLugar",
                             headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             },
                             data:{

                               gasolina:data.precio_litro,
                               id : id
                               },
                              success:function(data){

                                var suma_dias2 = 0;
                                var suma_kilometraje2 = 0;

                                var suma_gasolina2 = 0;
                                var suma_hospedaje2 = 0;

                                var suma_kilometraje2 = 0;

                                var suma_desayuno2 = 0;
                                var suma_comida2 = 0;
                                var suma_cena2 = 0;

                                var total_alimentos2 = 0;

                                var totalkilometraje = $('#totalkm').val();
                                var cuota = 0;



                                data.forEach (function(x){
                                  suma_dias2 += parseInt(x.dias);
                                  suma_kilometraje2 += parseInt(x.kilometros);
                                  @isset($vhoficialtabla)
                                  if (arrayvhoficial == '[]') {

                                  }else{
                                    var arrayvhoficial ={!!  json_encode($vhoficialtabla) !!};
                                    arrayvhoficial.forEach (function(z){
                                      cuota = z.cuota;
                                    });
                                  }
                                  @endisset
                                  @isset($Vehiculotabla)
                                    var arrayvehiculo ={!!  json_encode($Vehiculotabla) !!};

                                    if (arrayvehiculo == '[]') {

                                    }else{
                                      arrayvehiculo.forEach (function(z){
                                        cuota = z.cuota;
                                      });
                                    }
                                  @endisset
                                  //console.log(totalkilometraje,cuota,x.combustible);
                                  var totalito  = parseInt(totalkilometraje) / parseInt(cuota);
                                  var totalmas = totalito * parseFloat(x.combustible);

                                  //suma_gasolina2 += parseFloat(x.combustible);
                                  suma_gasolina2 = totalmas;
                                  suma_hospedaje2 += parseFloat(x.hospedaje);

                                  suma_desayuno2 += parseFloat(x.desayuno);
                                  suma_comida2 += parseFloat(x.comida);
                                  suma_cena2 += parseFloat(x.cena);

                                  total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                                });



                                $('#total_dias').html('<p>'+suma_dias2+'</p>');
                                $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                                $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                                $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                                $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                              }
                            });
                    }
                  });
          }else{
            $.ajax({
                   type:"POST",
                   url:"/recibos/TraerGasolinaDatosViaticoLugar",
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   data:{

                     gasolina:gasolina,
                     id : id
                     },
                    success:function(data){

                      var suma_dias2 = 0;
                      var suma_kilometraje2 = 0;

                      var suma_gasolina2 = 0;
                      var suma_hospedaje2 = 0;

                      var suma_kilometraje2 = 0;

                      var suma_desayuno2 = 0;
                      var suma_comida2 = 0;
                      var suma_cena2 = 0;

                      var total_alimentos2 = 0;

                      var totalkilometraje = $('#totalkm').val();
                      var cuota = 0;


                      data.forEach (function(x){
                        suma_dias2 += parseInt(x.dias);
                        suma_kilometraje2 += parseInt(x.kilometros);
                        @isset($vhoficialtabla)
                        if (arrayvhoficial == '[]') {

                        }else{
                          var arrayvhoficial ={!!  json_encode($vhoficialtabla) !!};
                          arrayvhoficial.forEach (function(z){
                            cuota = z.cuota;
                          });
                        }
                        @endisset
                        @isset($Vehiculotabla)
                        var arrayvehiculo ={!!  json_encode($Vehiculotabla) !!};

                        if (arrayvehiculo == '[]') {

                        }else{
                          arrayvehiculo.forEach (function(z){
                            cuota = z.cuota;
                          });
                        }
                        @endisset



                        //console.log(totalkilometraje,cuota,x.combustible);
                        var totalito  = parseInt(totalkilometraje) / parseInt(cuota);
                        var totalmas = totalito * parseFloat(x.combustible);
                        suma_gasolina2 = totalmas;
                        //suma_gasolina2 += parseFloat(x.combustible);
                        suma_hospedaje2 += parseFloat(x.hospedaje);

                        suma_desayuno2 += parseFloat(x.desayuno);
                        suma_comida2 += parseFloat(x.comida);
                        suma_cena2 += parseFloat(x.cena);

                        total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                      });




                      $('#total_dias').html('<p>'+suma_dias2+'</p>');
                      $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                      $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                      $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                      $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                    }
                  });
          }






      }else {
        var gasolina = 0;
      //  console.log(id,id_key,gasolina)
        $.ajax({
               type:"POST",
               url:"/recibos/TraerGasolinaDatosViaticoLugar",
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data:{

                 gasolina:gasolina,
                 id : id
                 },
                success:function(data){

                  var suma_dias2 = 0;
                  var suma_kilometraje2 = 0;

                  var suma_gasolina2 = 0;
                  var suma_hospedaje2 = 0;

                  var suma_kilometraje2 = 0;

                  var suma_desayuno2 = 0;
                  var suma_comida2 = 0;
                  var suma_cena2 = 0;

                  var total_alimentos2 = 0;

                  var totalkilometraje = $('#totalkm').val();
                  var cuota = 0;


                  data.forEach (function(x){
                    suma_dias2 += parseInt(x.dias);
                    suma_kilometraje2 += parseInt(x.kilometros);
                    @isset($vhoficialtabla)
                    if (arrayvhoficial == '[]') {

                    }else{
                      var arrayvhoficial ={!!  json_encode($vhoficialtabla) !!};
                      arrayvhoficial.forEach (function(z){
                        cuota = z.cuota;
                      });
                    }
                    @endisset
                    @isset($Vehiculotabla)
                    var arrayvehiculo ={!!  json_encode($Vehiculotabla) !!};

                    if (arrayvehiculo == '[]') {

                    }else{
                      arrayvehiculo.forEach (function(z){
                        cuota = z.cuota;
                      });
                    }
                    @endisset




                      //console.log(totalkilometraje,cuota,x.combustible);
                      var totalito  = parseInt(totalkilometraje) / parseInt(cuota);
                      var totalmas = totalito * parseFloat(x.combustible);
                      suma_gasolina2 = totalmas;

                    //suma_gasolina2 += parseFloat(x.combustible);
                    suma_hospedaje2 += parseFloat(x.hospedaje);

                    suma_desayuno2 += parseFloat(x.desayuno);
                    suma_comida2 += parseFloat(x.comida);
                    suma_cena2 += parseFloat(x.cena);

                    total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                  });



                  $('#total_dias').html('<p>'+suma_dias2+'</p>');
                  $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                  $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                  $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                  $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                }
              });

      }
  });
}

function hospedajeLugar2(id,id_key){



  $(":checkbox[name=hospedaje2_"+id_key+"]").each(function(){
      if (this.checked) {
          /////////////////////////////////////////////////////
          var hospedaje = $(this).val();
          //console.log(id,id_key,hospedaje)

          if (hospedaje == 0) {
            //console.log('entro')
            $.ajax({
                   type:"POST",
                   url:"/recibos/TraerHospedajeL",
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   data:{
                     hospedaje:hospedaje,
                     },
                    success:function(data){
                        $.ajax({
                               type:"POST",
                               url:"/recibos/TraerHospedajeDatosViaticoLugar",
                               headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                               },
                               data:{

                                 hospedaje:data.importe,
                                 id : id
                                 },
                                success:function(data){

                                  var suma_dias2 = 0;
                                  var suma_kilometraje2 = 0;

                                  var suma_gasolina2 = 0;
                                  var suma_hospedaje2 = 0;

                                  var suma_kilometraje2 = 0;

                                  var suma_desayuno2 = 0;
                                  var suma_comida2 = 0;
                                  var suma_cena2 = 0;

                                  var total_alimentos2 = 0;



                                  data.forEach (function(x){
                                    suma_dias2 += parseInt(x.dias);
                                    suma_kilometraje2 += parseInt(x.kilometros);

                                    suma_gasolina2 += parseFloat(x.combustible);
                                    suma_hospedaje2 += parseFloat(x.hospedaje);

                                    suma_desayuno2 += parseFloat(x.desayuno);
                                    suma_comida2 += parseFloat(x.comida);
                                    suma_cena2 += parseFloat(x.cena);

                                    total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                                  });



                                  $('#total_dias').html('<p>'+suma_dias2+'</p>');
                                  $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                                  $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                                  $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                                  $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                                }
                              });
                    }
                  });
            }else{

              $.ajax({
                     type:"POST",
                     url:"/recibos/TraerHospedajeDatosViaticoLugar",
                     headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{

                       hospedaje:hospedaje,
                       id : id
                       },
                      success:function(data){

                        var suma_dias2 = 0;
                        var suma_kilometraje2 = 0;

                        var suma_gasolina2 = 0;
                        var suma_hospedaje2 = 0;

                        var suma_kilometraje2 = 0;

                        var suma_desayuno2 = 0;
                        var suma_comida2 = 0;
                        var suma_cena2 = 0;

                        var total_alimentos2 = 0;



                        data.forEach (function(x){
                          suma_dias2 += parseInt(x.dias);
                          suma_kilometraje2 += parseInt(x.kilometros);

                          suma_gasolina2 += parseFloat(x.combustible);
                          suma_hospedaje2 += parseFloat(x.hospedaje);

                          suma_desayuno2 += parseFloat(x.desayuno);
                          suma_comida2 += parseFloat(x.comida);
                          suma_cena2 += parseFloat(x.cena);

                          total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                        });



                        $('#total_dias').html('<p>'+suma_dias2+'</p>');
                        $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                        $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                        $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                        $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                      }
                    });
            }





      }else {
        var hospedaje = 0;
      //  console.log(id,id_key,gasolina)
        $.ajax({
               type:"POST",
               url:"/recibos/TraerHospedajeDatosViaticoLugar",
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data:{

                 hospedaje:hospedaje,
                 id : id
                 },
                success:function(data){

                  var suma_dias2 = 0;
                  var suma_kilometraje2 = 0;

                  var suma_gasolina2 = 0;
                  var suma_hospedaje2 = 0;

                  var suma_kilometraje2 = 0;

                  var suma_desayuno2 = 0;
                  var suma_comida2 = 0;
                  var suma_cena2 = 0;

                  var total_alimentos2 = 0;



                  data.forEach (function(x){
                    suma_dias2 += parseInt(x.dias);
                    suma_kilometraje2 += parseInt(x.kilometros);

                    suma_gasolina2 += parseFloat(x.combustible);
                    suma_hospedaje2 += parseFloat(x.hospedaje);

                    suma_desayuno2 += parseFloat(x.desayuno);
                    suma_comida2 += parseFloat(x.comida);
                    suma_cena2 += parseFloat(x.cena);

                    total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                  });



                  $('#total_dias').html('<p>'+suma_dias2+'</p>');
                  $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                  $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                  $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                  $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                }
              });

      }
  });
}

function desayunoLugar2(id,id_key){

  $(":checkbox[name=desayuno2_"+id_key+"]").each(function(){
      if (this.checked) {
          /////////////////////////////////////////////////////
          var desayuno = $(this).val();
          //console.log(id,id_key,gasolina)

          if (desayuno == 0) {
            //console.log('entro')
            $.ajax({
                   type:"POST",
                   url:"/recibos/TraerDesayunoL",
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   data:{
                     desayuno:desayuno,
                     },
                    success:function(data){
                      $.ajax({
                             type:"POST",
                             url:"/recibos/TraerDesayunoDatosViaticoLugar",
                             headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             },
                             data:{

                               desayuno:data.importe_desayuno,
                               id : id
                               },
                              success:function(data){

                                var suma_dias2 = 0;
                                var suma_kilometraje2 = 0;

                                var suma_gasolina2 = 0;
                                var suma_hospedaje2 = 0;

                                var suma_kilometraje2 = 0;

                                var suma_desayuno2 = 0;
                                var suma_comida2 = 0;
                                var suma_cena2 = 0;

                                var total_alimentos2 = 0;



                                data.forEach (function(x){
                                  suma_dias2 += parseInt(x.dias);
                                  suma_kilometraje2 += parseInt(x.kilometros);

                                  suma_gasolina2 += parseFloat(x.combustible);
                                  suma_hospedaje2 += parseFloat(x.hospedaje);

                                  suma_desayuno2 += parseFloat(x.desayuno);
                                  suma_comida2 += parseFloat(x.comida);
                                  suma_cena2 += parseFloat(x.cena);

                                  total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                                });



                                $('#total_dias').html('<p>'+suma_dias2+'</p>');
                                $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                                $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                                $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                                $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                              }
                            });
                    }
                  });
            }else{
              $.ajax({
                     type:"POST",
                     url:"/recibos/TraerDesayunoDatosViaticoLugar",
                     headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{

                       desayuno:desayuno,
                       id : id
                       },
                      success:function(data){

                        var suma_dias2 = 0;
                        var suma_kilometraje2 = 0;

                        var suma_gasolina2 = 0;
                        var suma_hospedaje2 = 0;

                        var suma_kilometraje2 = 0;

                        var suma_desayuno2 = 0;
                        var suma_comida2 = 0;
                        var suma_cena2 = 0;

                        var total_alimentos2 = 0;



                        data.forEach (function(x){
                          suma_dias2 += parseInt(x.dias);
                          suma_kilometraje2 += parseInt(x.kilometros);

                          suma_gasolina2 += parseFloat(x.combustible);
                          suma_hospedaje2 += parseFloat(x.hospedaje);

                          suma_desayuno2 += parseFloat(x.desayuno);
                          suma_comida2 += parseFloat(x.comida);
                          suma_cena2 += parseFloat(x.cena);

                          total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                        });



                        $('#total_dias').html('<p>'+suma_dias2+'</p>');
                        $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                        $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                        $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                        $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                      }
                    });
            }


      }else {
        var desayuno = 0;
      //  console.log(id,id_key,gasolina)
        $.ajax({
               type:"POST",
               url:"/recibos/TraerDesayunoDatosViaticoLugar",
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data:{

                 desayuno:desayuno,
                 id : id
                 },
                success:function(data){

                  var suma_dias2 = 0;
                  var suma_kilometraje2 = 0;

                  var suma_gasolina2 = 0;
                  var suma_hospedaje2 = 0;

                  var suma_kilometraje2 = 0;

                  var suma_desayuno2 = 0;
                  var suma_comida2 = 0;
                  var suma_cena2 = 0;

                  var total_alimentos2 = 0;



                  data.forEach (function(x){
                    suma_dias2 += parseInt(x.dias);
                    suma_kilometraje2 += parseInt(x.kilometros);

                    suma_gasolina2 += parseFloat(x.combustible);
                    suma_hospedaje2 += parseFloat(x.hospedaje);

                    suma_desayuno2 += parseFloat(x.desayuno);
                    suma_comida2 += parseFloat(x.comida);
                    suma_cena2 += parseFloat(x.cena);

                    total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                  });



                  $('#total_dias').html('<p>'+suma_dias2+'</p>');
                  $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                  $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                  $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                  $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                }
              });

      }
  });
}

function comidaLugar2(id,id_key){

  $(":checkbox[name=comida2_"+id_key+"]").each(function(){
      if (this.checked) {
          /////////////////////////////////////////////////////
          var comida = $(this).val();
        //console.log(comida)

          if (comida == 0) {
            //console.log('entro')
            $.ajax({
                   type:"POST",
                   url:"/recibos/TraerComidaL",
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   data:{
                     comida:comida,
                     },
                    success:function(data){

                      $.ajax({
                             type:"POST",
                             url:"/recibos/TraerComidaDatosViaticoLugar",
                             headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             },
                             data:{

                               comida:data.importe_comida,
                               id : id
                               },
                              success:function(data){

                                var suma_dias2 = 0;
                                var suma_kilometraje2 = 0;

                                var suma_gasolina2 = 0;
                                var suma_hospedaje2 = 0;

                                var suma_kilometraje2 = 0;

                                var suma_desayuno2 = 0;
                                var suma_comida2 = 0;
                                var suma_cena2 = 0;

                                var total_alimentos2 = 0;



                                data.forEach (function(x){
                                  suma_dias2 += parseInt(x.dias);
                                  suma_kilometraje2 += parseInt(x.kilometros);

                                  suma_gasolina2 += parseFloat(x.combustible);
                                  suma_hospedaje2 += parseFloat(x.hospedaje);

                                  suma_desayuno2 += parseFloat(x.desayuno);
                                  suma_comida2 += parseFloat(x.comida);
                                  suma_cena2 += parseFloat(x.cena);

                                  total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                                });



                                $('#total_dias').html('<p>'+suma_dias2+'</p>');
                                $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                                $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                                $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                                $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                              }
                            });
                    }
                  });
            }else{
              $.ajax({
                     type:"POST",
                     url:"/recibos/TraerComidaDatosViaticoLugar",
                     headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{

                       comida:comida,
                       id : id
                       },
                      success:function(data){

                        var suma_dias2 = 0;
                        var suma_kilometraje2 = 0;

                        var suma_gasolina2 = 0;
                        var suma_hospedaje2 = 0;

                        var suma_kilometraje2 = 0;

                        var suma_desayuno2 = 0;
                        var suma_comida2 = 0;
                        var suma_cena2 = 0;

                        var total_alimentos2 = 0;



                        data.forEach (function(x){
                          suma_dias2 += parseInt(x.dias);
                          suma_kilometraje2 += parseInt(x.kilometros);

                          suma_gasolina2 += parseFloat(x.combustible);
                          suma_hospedaje2 += parseFloat(x.hospedaje);

                          suma_desayuno2 += parseFloat(x.desayuno);
                          suma_comida2 += parseFloat(x.comida);
                          suma_cena2 += parseFloat(x.cena);

                          total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                        });



                        $('#total_dias').html('<p>'+suma_dias2+'</p>');
                        $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                        $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                        $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                        $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                      }
                    });
            }

      }else {
        var comida = 0;
      //  console.log(id,id_key,gasolina)


        $.ajax({
               type:"POST",
               url:"/recibos/TraerComidaDatosViaticoLugar",
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data:{

                 comida:comida,
                 id : id
                 },
                success:function(data){

                  var suma_dias2 = 0;
                  var suma_kilometraje2 = 0;

                  var suma_gasolina2 = 0;
                  var suma_hospedaje2 = 0;

                  var suma_kilometraje2 = 0;

                  var suma_desayuno2 = 0;
                  var suma_comida2 = 0;
                  var suma_cena2 = 0;

                  var total_alimentos2 = 0;



                  data.forEach (function(x){
                    suma_dias2 += parseInt(x.dias);
                    suma_kilometraje2 += parseInt(x.kilometros);

                    suma_gasolina2 += parseFloat(x.combustible);
                    suma_hospedaje2 += parseFloat(x.hospedaje);

                    suma_desayuno2 += parseFloat(x.desayuno);
                    suma_comida2 += parseFloat(x.comida);
                    suma_cena2 += parseFloat(x.cena);

                    total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                  });



                  $('#total_dias').html('<p>'+suma_dias2+'</p>');
                  $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                  $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                  $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                  $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                }
              });

      }
  });
}

function cenaLugar2(id,id_key){

  $(":checkbox[name=cena2_"+id_key+"]").each(function(){
      if (this.checked) {
          /////////////////////////////////////////////////////
          var cena = $(this).val();
          //console.log(cena)

          if (cena == 0) {
            //console.log('entro')
            $.ajax({
                   type:"POST",
                   url:"/recibos/TraerCenaL",
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   data:{
                     cena:cena,
                     },
                    success:function(data){
                      $.ajax({
                             type:"POST",
                             url:"/recibos/TraerCenaDatosViaticoLugar",
                             headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             },
                             data:{

                               cena:data.importe_cena,
                               id : id
                               },
                              success:function(data){

                                var suma_dias2 = 0;
                                var suma_kilometraje2 = 0;

                                var suma_gasolina2 = 0;
                                var suma_hospedaje2 = 0;

                                var suma_kilometraje2 = 0;

                                var suma_desayuno2 = 0;
                                var suma_comida2 = 0;
                                var suma_cena2 = 0;

                                var total_alimentos2 = 0;



                                data.forEach (function(x){
                                  suma_dias2 += parseInt(x.dias);
                                  suma_kilometraje2 += parseInt(x.kilometros);

                                  suma_gasolina2 += parseFloat(x.combustible);
                                  suma_hospedaje2 += parseFloat(x.hospedaje);

                                  suma_desayuno2 += parseFloat(x.desayuno);
                                  suma_comida2 += parseFloat(x.comida);
                                  suma_cena2 += parseFloat(x.cena);

                                  total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                                });



                                $('#total_dias').html('<p>'+suma_dias2+'</p>');
                                $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                                $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                                $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                                $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                              }
                            });
                    }
                  });
            }else{

            }

          $.ajax({
                 type:"POST",
                 url:"/recibos/TraerCenaDatosViaticoLugar",
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 data:{

                   cena:cena,
                   id : id
                   },
                  success:function(data){

                    var suma_dias2 = 0;
                    var suma_kilometraje2 = 0;

                    var suma_gasolina2 = 0;
                    var suma_hospedaje2 = 0;

                    var suma_kilometraje2 = 0;

                    var suma_desayuno2 = 0;
                    var suma_comida2 = 0;
                    var suma_cena2 = 0;

                    var total_alimentos2 = 0;



                    data.forEach (function(x){
                      suma_dias2 += parseInt(x.dias);
                      suma_kilometraje2 += parseInt(x.kilometros);

                      suma_gasolina2 += parseFloat(x.combustible);
                      suma_hospedaje2 += parseFloat(x.hospedaje);

                      suma_desayuno2 += parseFloat(x.desayuno);
                      suma_comida2 += parseFloat(x.comida);
                      suma_cena2 += parseFloat(x.cena);

                      total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                    });



                    $('#total_dias').html('<p>'+suma_dias2+'</p>');
                    $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                    $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                    $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                    $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                  }
                });




      }else {
        var cena = 0;
      //  console.log(id,id_key,gasolina)
        $.ajax({
               type:"POST",
               url:"/recibos/TraerCenaDatosViaticoLugar",
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data:{

                 cena:cena,
                 id : id
                 },
                success:function(data){

                  var suma_dias2 = 0;
                  var suma_kilometraje2 = 0;

                  var suma_gasolina2 = 0;
                  var suma_hospedaje2 = 0;

                  var suma_kilometraje2 = 0;

                  var suma_desayuno2 = 0;
                  var suma_comida2 = 0;
                  var suma_cena2 = 0;

                  var total_alimentos2 = 0;



                  data.forEach (function(x){
                    suma_dias2 += parseInt(x.dias);
                    suma_kilometraje2 += parseInt(x.kilometros);

                    suma_gasolina2 += parseFloat(x.combustible);
                    suma_hospedaje2 += parseFloat(x.hospedaje);

                    suma_desayuno2 += parseFloat(x.desayuno);
                    suma_comida2 += parseFloat(x.comida);
                    suma_cena2 += parseFloat(x.cena);

                    total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

                  });



                  $('#total_dias').html('<p>'+suma_dias2+'</p>');
                  $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
                  $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
                  $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
                  $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');

                }
              });

      }
  });
}

function hospedajeLugar(id){

    var value_ckeck = $(":checkbox[name=hospedaje_"+id+"]").val();
    var value_dias = $("#dias_"+id+"").val();
    //var value_dias = $("#n_dias").val();

    if (value_dias == 1) {
      var dias = 1 ;
    }else{
      var dias = value_dias - 1;
    }



    //console.log(value_ckeck == 'undefined')
    if (value_ckeck == 'undefined') {
      $(":checkbox[name=hospedaje_"+id+"]").prop('checked',false);
      $(":checkbox[name=hospedaje_"+id+"]").prop('disabled',true);
      Swal.fire("Lo Sentimos", 'El nivel del empleado no esta en el rango de hospedaje', "warning");
    }else{
      $(":checkbox[name=hospedaje_"+id+"]").each(function(){

          if (this.checked) {
              /////////////////////////////////////////////////////
              //console.log(value_dias,$(this).val())
              //console.log(dias, $(this).val())
              //console.log(parseInt(dias) * parseFloat($(this).val()))

                var total_hospedje = parseInt(dias) * parseFloat($(this).val());
                //console.log(total_hospedje);


              arrayTablaLugares.push({
                id:id,
                //hospedaje:$(this).val(),
                hospedaje:total_hospedje,
              })
              objectHospedajeLugares = {
                id:id,
                //hospedaje:$(this).val(),
                hospedaje:total_hospedje,
              }

              arrayHospedajeLugares.push(objectHospedajeLugares)
              //console.log(arrayHospedajeLugares);
              // ObjetoLugares = {
              //   hospedaje:$(this).val(),
              // }
              // arrayLugares.push(ObjetoLugares);

          }else {

            arrayHospedajeLugares.forEach(function(x, index, object) {
                if(x.id === id){
                  object.splice(index, 1);
                }
            });

          }
      });
    }


}

function desayunoLugar(id){
  var value_ckeck = $(":checkbox[name=desayuno_"+id+"]").val();
  var value_dias = $("#dias_"+id+"").val();
  //var value_dias = $("#n_dias").val();
  //console.log(value_ckeck,value_dias)

  if (value_ckeck == 'undefined') {
    $(":checkbox[name=desayuno_"+id+"]").prop('checked',false);
    $(":checkbox[name=desayuno_"+id+"]").prop('disabled',true);
    Swal.fire("Lo Sentimos", 'El nivel del empleado no esta en el rango de desayuno', "warning");
  }else{
    $(":checkbox[name=desayuno_"+id+"]").each(function(){
        if (this.checked) {
            /////////////////////////////////////////////////////
            var total_desayino = value_dias * $(this).val();
            arrayTablaLugares.push({
              id:id,
              //desayuno:$(this).val(),
              desayuno:total_desayino,
            })
            objectDesayunoLugares = {
              id:id,
              //desayuno:$(this).val(),
              desayuno:total_desayino,
            }

            arrayDesayunoLugares.push(objectDesayunoLugares)
        }else {

          arrayDesayunoLugares.forEach(function(x, index, object) {
              if(x.id === id){
                object.splice(index, 1);
              }
          });

        }
    });
  }

}
function comidaLugar(id){
  var value_ckeck = $(":checkbox[name=comida_"+id+"]").val();
  var value_dias = $("#dias_"+id+"").val();
  //var value_dias = $("#n_dias").val();
  //console.log(value_ckeck,value_dias)

  if (value_ckeck == 'undefined') {
    $(":checkbox[name=comida_"+id+"]").prop('checked',false);
    $(":checkbox[name=comida_"+id+"]").prop('disabled',true);
    Swal.fire("Lo Sentimos", 'El nivel del empleado no esta en el rango de comida', "warning");
  }else{
    $(":checkbox[name=comida_"+id+"]").each(function(){
        if (this.checked) {
            /////////////////////////////////////////////////////
            var total_cmindas = value_dias * $(this).val();

            arrayTablaLugares.push({
              id:id,
              //comida:$(this).val(),
              comida:total_cmindas,
            })
            objectComidaLugares = {
              id:id,
              //comida:$(this).val(),
            comida:total_cmindas,
            }

            arrayComidaLugares.push(objectComidaLugares)
        }else {

          arrayComidaLugares.forEach(function(x, index, object) {
              if(x.id === id){
                object.splice(index, 1);
              }
          });

        }
    });
  }

}
function cenaLugar(id){
  var value_ckeck = $(":checkbox[name=cena_"+id+"]").val();
  var value_dias = $("#dias_"+id+"").val();
  //var value_dias = $("#n_dias").val();
  //console.log(value_ckeck,value_dias)

  if (value_ckeck == 'undefined') {
    $(":checkbox[name=cena_"+id+"]").prop('checked',false);
    $(":checkbox[name=cena_"+id+"]").prop('disabled',true);
    Swal.fire("Lo Sentimos", 'El nivel del empleado no esta en el rango de cena', "warning");
  }else{
    $(":checkbox[name=cena_"+id+"]").each(function(){
        if (this.checked) {
            /////////////////////////////////////////////////////
            var total_cenas = value_dias * $(this).val();

            arrayTablaLugares.push({
              id:id,
              //cena:$(this).val(),
              cena:total_cenas,
            })
            objectCenaLugares = {
              id:id,
              //cena:$(this).val(),
              cena:total_cenas,
            }

            arrayCenaLugares.push(objectCenaLugares)
        }else {

          arrayCenaLugares.forEach(function(x, index, object) {
              if(x.id === id){
                object.splice(index, 1);
              }
          });

        }
    });
  }

}
 function bajaLugar(id,id_key){
   //console.log(id_key)
   $('#orden_luagres'+id_key).remove();
   @isset($recibos)
   id_recibo = {{$recibos->id}};
   @else
   id_recibo = 0;

   @endisset
   $.ajax({
          type:"POST",
          url:"/recibos/TraerBorrarDatosViaticoLugar",
          headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data:{

            id_recibo:id_recibo,
            id : id
            },
           success:function(data){

             var suma_dias2 = 0;
             var suma_kilometraje2 = 0;

             var suma_gasolina2 = 0;
             var suma_hospedaje2 = 0;

             var suma_kilometraje2 = 0;

             var suma_desayuno2 = 0;
             var suma_comida2 = 0;
             var suma_cena2 = 0;

             var total_alimentos2 = 0;



             //var totalkilometraje = $('#totalkm').val();
             var cuota = 0;

             data.forEach (function(x){
               suma_dias2 += parseInt(x.dias);
               suma_kilometraje2 += parseInt(x.kilometros);
               @isset($vhoficialtabla)
               if (arrayvhoficial == '[]') {

               }else{
                 var arrayvhoficial ={!!  json_encode($vhoficialtabla) !!};
                 arrayvhoficial.forEach (function(z){
                   cuota = z.cuota;
                 });
               }
               @endisset
               @isset($Vehiculotabla)
               var arrayvehiculo ={!!  json_encode($Vehiculotabla) !!};

               if (arrayvehiculo == '[]') {

               }else{
                 arrayvehiculo.forEach (function(z){
                   cuota = z.cuota;
                 });
               }
               @endisset





               var kilometro_interno = $('#kilometrorecorrido').val();

               var total_kilometro = parseInt(suma_kilometraje2) + parseInt(kilometro_interno);
               $('#totalkm').val(total_kilometro);
                //console.log(total_kilometro,cuota,x.combustible);
               var totalito  = parseInt(total_kilometro) / parseInt(cuota);
               var totalmas = totalito * parseFloat(x.combustible);

               //suma_gasolina2 += parseFloat(x.combustible);
               suma_gasolina2 = totalmas;
               //suma_gasolina2 += parseFloat(x.combustible);
               suma_hospedaje2 += parseFloat(x.hospedaje);

               suma_desayuno2 += parseFloat(x.desayuno);
               suma_comida2 += parseFloat(x.comida);
               suma_cena2 += parseFloat(x.cena);

               total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

             });

             var total_transportes = $('#total_transporte_vehiculof').val();
             var suma_totales_transporte_gasolina_lugar = parseFloat(total_transportes);
             //console.log(kilometro_interno,suma_kilometraje2,total_kilometro)
             var total_final_recibo = parseFloat(suma_gasolina2) + parseFloat(suma_hospedaje2) + parseFloat(total_alimentos2) + parseFloat(suma_totales_transporte_gasolina_lugar);

             $('#total_dias').html('<p>'+suma_dias2+'</p>');
             $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
             $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
             $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
             $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');
             $('#total_recibido_lugar').html('<input type="text" class="form-control" value="'+total_final_recibo.toFixed(2)+'" id="total_extraer" disabled>');
             cantidadletra(total_final_recibo.toFixed(2))
           }
         });


 }

function eliminarlugar(id){
  //console.log(id)
  arrayLugar.splice(id,1);



  arrayDiasLugares.forEach(function(x, index, object) {
      if(x.id === id){
        object.splice(index, 1);
      }
  });

  arrayKilometrajeLugares.forEach(function(x, index, object) {
      if(x.id === id){
        object.splice(index, 1);
      }
  });
  //console.log(arrayGasolinaLugares)
  arrayGasolinaLugares.forEach(function(x, index, object) {
      if(x.id === id){
        object.splice(index, 1);
      }
  });

  arrayHospedajeLugares.forEach(function(x, index, object) {
      if(x.id === id){
        object.splice(index, 1);
      }
  });

  arrayDesayunoLugares.forEach(function(x, index, object) {
      if(x.id === id){
        object.splice(index, 1);
      }
  });

  arrayComidaLugares.forEach(function(x, index, object) {
      if(x.id === id){
        object.splice(index, 1);
      }
  });

  arrayCenaLugares.forEach(function(x, index, object) {
      if(x.id === id){
        object.splice(index, 1);
      }
  });




  $('#filas_lugar'+id).remove();

  // console.log(arrayDiasLugares)
  // console.log(arrayKilometrajeLugares)
  // console.log(arrayGasolinaLugares)
  // console.log(arrayHospedajeLugares)
  // console.log(arrayDesayunoLugares)
  // console.log(arrayComidaLugares)
  // console.log(arrayCenaLugares)
  //
  //
  // console.log(arrayLugar == 0,id,arrayLugar,arrayTablaLugares)

  if (arrayLugar == 0) {
    $('#footLugar').show();
    // $('#total_recibido_lugar').show();

    @isset($lugares)


    $.ajax({
           type:"POST",
           url:"/recibos/TraerDatosViaticoLugar",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{

             id:{{$recibos->id}},
             },
            success:function(data){

              var suma_dias2 = 0;
              var suma_kilometraje2 = 0;

              var suma_gasolina2 = 0;
              var suma_hospedaje2 = 0;

              var suma_kilometraje2 = 0;

              var suma_desayuno2 = 0;
              var suma_comida2 = 0;
              var suma_cena2 = 0;

              var total_alimentos2 = 0;



              data.forEach (function(x){
                suma_dias2 += parseInt(x.dias);
                suma_kilometraje2 += parseInt(x.kilometros);

                suma_gasolina2 += parseFloat(x.combustible);
                suma_hospedaje2 += parseFloat(x.hospedaje);

                suma_desayuno2 += parseFloat(x.desayuno);
                suma_comida2 += parseFloat(x.comida);
                suma_cena2 += parseFloat(x.cena);

                total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

              });

              var kilometro_interno = $('#kilometrorecorrido').val();

              var total_kilometro = parseInt(suma_kilometraje2) + parseInt(kilometro_interno);
              //console.log(kilometro_interno,suma_kilometraje2,total_kilometro)
              $('#totalkm').val(total_kilometro);
              var total_transportes = $('#total_transporte_vehiculof').val();
              var suma_totales_transporte_gasolina_lugar = parseFloat(total_transportes);
              //console.log(kilometro_interno,suma_kilometraje2,total_kilometro)
              var total_final_recibo = parseFloat(suma_gasolina2) + parseFloat(suma_hospedaje2) + parseFloat(total_alimentos2) + parseFloat(suma_totales_transporte_gasolina_lugar);


              $('#total_dias').html('<p>'+suma_dias2+'</p>');
              $('#total_kilometros').html('<p>'+suma_kilometraje2+'</p>');
              $('#total_gasolina').html('<p>$'+suma_gasolina2.toFixed(2)+'</p>');
              $('#total_hospedaje').html('<p>$'+suma_hospedaje2.toFixed(2)+'</p>');
              $('#total_comidas').html('<p>$'+total_alimentos2.toFixed(2)+'</p>');
              $('#total_recibido_lugar').html('<input type="text" class="form-control" value="'+total_final_recibo.toFixed(2)+'" id="total_extraer" disabled>');
              cantidadletra(total_final_recibo.toFixed(2))
            }
          });






    @else

    $('#total_dias').html('<p>0</p>');
    $('#total_kilometros').html('<p>0</p>');
    $('#total_gasolina').html('<p>$0</p>');
    $('#total_hospedaje').html('<p>$0</p>');
    $('#total_comidas').html('<p>$0</p>');


    //$('#total_recibido_lugar').html('<p>$'+suma_total_totales.toFixed(2)+'</p>');
    $('#total_recibido_lugar').html('<input type="text" class="form-control" value="0" id="total_extraer" disabled>');

    @endisset




  }



}

var tablalugar = [];
let nuevoObjeto = {}
function calcularViaticoLugar(){


  @isset($lugares)

  $.ajax({
         type:"POST",
         url:"/recibos/TraerDatosViaticoLugar",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{

           id:{{$recibos->id}},
           },
          success:function(data){


            var suma_dias2 = 0;
            var suma_kilometraje2 = 0;

            var suma_gasolina2 = 0;
            var suma_hospedaje2 = 0;

            var suma_kilometraje2 = 0;

            var suma_desayuno2 = 0;
            var suma_comida2 = 0;
            var suma_cena2 = 0;

            var total_alimentos2 = 0;

            //var totalkilometraje = $('#totalkm').val();
            var cuota = 0;
            var kilometro_interno = $('#kilometrorecorrido').val();
            var combustible = 0;




            data.forEach (function(x){
              suma_dias2 += parseInt(x.dias);
              suma_kilometraje2 += parseInt(x.kilometros);

              @isset($vhoficialtabla)
              if (arrayvhoficial == '[]') {

              }else{
                var arrayvhoficial ={!!  json_encode($vhoficialtabla) !!};
                arrayvhoficial.forEach (function(z){
                  cuota = z.cuota;
                });
              }
              @endisset
              @isset($Vehiculotabla)
              var arrayvehiculo ={!!  json_encode($Vehiculotabla) !!};

              if (arrayvehiculo == '[]') {

              }else{
                arrayvehiculo.forEach (function(z){
                  cuota = z.cuota;
                });
              }
              @endisset



              var total_kilometro = parseInt(suma_kilometraje2) + parseInt(kilometro_interno);
              $('#totalkm').val(total_kilometro);
               //console.log(total_kilometro,cuota,x.combustible);
              var totalito  = parseInt(total_kilometro) / parseInt(cuota);
              var totalmas = totalito * parseFloat(x.combustible);
              combustible = x.combustible;
              //suma_gasolina2 += parseFloat(x.combustible);
              suma_gasolina2 = totalmas;
              //suma_gasolina2 += parseFloat(x.combustible);
              suma_hospedaje2 += parseFloat(x.hospedaje);

              suma_desayuno2 += parseFloat(x.desayuno);
              suma_comida2 += parseFloat(x.comida);
              suma_cena2 += parseFloat(x.cena);

              total_alimentos2 = parseFloat(suma_desayuno2) + parseFloat(suma_comida2) + parseFloat(suma_cena2);

            });

            var suma_dias = 0;
            arrayDiasLugares.forEach (function(numero){
            suma_dias += parseInt(numero.dias);
            });
            //console.log(arrayDiasLugares)

            var suma_kilometraje = 0;
            arrayKilometrajeLugares.forEach (function(numero_kilometraje){
            suma_kilometraje += parseInt(numero_kilometraje.kilometraje);
            });



            var suma_gasolina = 0;
            arrayGasolinaLugares.forEach (function(numero_gasolina){
            //   if (arrayvhoficial == '[]') {
            //
            //   }else{
            //     var arrayvhoficial ={!!  json_encode($vhoficialtabla) !!};
            //     arrayvhoficial.forEach (function(z){
            //       cuota = z.cuota;
            //     });
            //   }
            //
            //     var arrayvehiculo ={!!  json_encode($Vehiculotabla) !!};
            //
            //     if (arrayvehiculo == '[]') {
            //
            //     }else{
            //       arrayvehiculo.forEach (function(z){
            //         cuota = z.cuota;
            //       });
            //     }
            // var total_kilometro = parseInt(suma_kilometraje) + parseInt(kilometro_interno);
            // $('#totalkm').val(total_kilometro);
            // var totalito  = parseInt(total_kilometro) / parseInt(cuota);
            // var totalmas = totalito * parseFloat(numero_gasolina.combustible);
            // console.log(total_kilometro,cuota,numero_gasolina.combustible)
            //console.log(numero_gasolina.combustible)
            suma_gasolina += parseFloat(numero_gasolina.gasolina);
            //suma_gasolina = totalmas;
            });

            //console.log(suma_gasolina,suma_gasolina2)
            var suma_hospedaje = 0;
            arrayHospedajeLugares.forEach (function(numero_hospedaje){
            suma_hospedaje += parseFloat(numero_hospedaje.hospedaje);
            });


            var suma_desayuno = 0;
            arrayDesayunoLugares.forEach (function(numero_desayuno){
            suma_desayuno += parseFloat(numero_desayuno.desayuno);
            });


            var suma_comida = 0;
            arrayComidaLugares.forEach (function(numero_comida){
            suma_comida += parseFloat(numero_comida.comida);
            });


            var suma_cena = 0;
            arrayCenaLugares.forEach (function(numero_cena){
            suma_cena += parseFloat(numero_cena.cena);
            });




            var suma_total_comidas = parseFloat(suma_desayuno) + parseFloat(suma_comida) + parseFloat(suma_cena);

            var suma_total_totales = parseFloat(suma_gasolina) + parseFloat(suma_hospedaje) + parseFloat(suma_total_comidas);

            var suma_total_totales2 = parseFloat(suma_gasolina2) + parseFloat(suma_hospedaje2) + parseFloat(total_alimentos2);



            var suma_dias_total = parseInt(suma_dias) + parseInt(suma_dias2);
            var suma_kilometraje_total = parseInt(suma_kilometraje) + parseInt(suma_kilometraje2);


            var total_kilometro = parseInt(suma_kilometraje_total) + parseInt(kilometro_interno);
            $('#totalkm').val(total_kilometro);
            var totalito  = parseInt(total_kilometro) / parseInt(cuota);
            var totalmas = totalito * parseFloat(combustible);
            //console.log(suma_kilometraje_total,totalmas);
            var suma_hospedaje_total = parseFloat(suma_hospedaje2) + parseFloat(suma_hospedaje);
            //var suma_gasolina_total = parseFloat(suma_gasolina2) + parseFloat(suma_gasolina);
            var suma_gasolina_total = parseFloat(totalmas);
            var suma_alimentos_total = parseFloat(suma_total_comidas) + parseFloat(total_alimentos2);

            //var suma_total_total = parseFloat(suma_total_totales2) + parseFloat(suma_total_totales);
            var total_transportes = $('#total_transporte_vehiculof').val();
            var suma_totales_transporte_gasolina_lugar = parseFloat(total_transportes);
            var suma_total_total = parseFloat(totalmas) + parseFloat(suma_hospedaje_total) + parseFloat(suma_alimentos_total) + parseFloat(suma_totales_transporte_gasolina_lugar);

            $('#total_dias').html('<p>'+suma_dias_total+'</p>');
            $('#total_kilometros').html('<p>'+suma_kilometraje_total+'</p>');
            $('#total_gasolina').html('<p>$'+totalmas.toFixed(2)+'</p>');
            $('#total_hospedaje').html('<p>$'+suma_hospedaje_total.toFixed(2)+'</p>');
            $('#total_comidas').html('<p>$'+suma_alimentos_total.toFixed(2)+'</p>');
            $('#total_recibido_lugar').html('<input type="text" class="form-control" value="'+suma_total_total.toFixed(2)+'" id="total_extraer" disabled>');
            cantidadletra(suma_total_totales.toFixed(2))
            // console.log(arrayTablaLugares)
            arrayTablaLugares.forEach( x => {
              //Si la ciudad no existe en nuevoObjeto entonces
              //la creamos e inicializamos el arreglo de profesionales.
              if( !nuevoObjeto.hasOwnProperty(x.id)){
                nuevoObjeto[x.id] = {
                  lugar: []
                }
              }

              if (typeof x.dias == 'undefined') {

              }else{
                nuevoObjeto[x.id].lugar.push({

                  dias: x.dias,
                })
              }


             if (typeof x.origen == 'undefined') {

             }else{
               nuevoObjeto[x.id].lugar.push({
                 origen: x.origen,
               })
             }

             if (typeof x.destino == 'undefined') {

             }else{
               nuevoObjeto[x.id].lugar.push({
                 destino: x.destino,
               })
             }


             if (typeof x.origen_nombre == 'undefined') {

             }else{
               nuevoObjeto[x.id].lugar.push({
                 origen: x.origen_nombre,
               })
             }

             if (typeof x.destino_nombre == 'undefined') {

             }else{
               nuevoObjeto[x.id].lugar.push({
                 destino: x.destino_nombre,
               })
             }


             if (typeof x.zona == 'undefined') {

             }else{
               nuevoObjeto[x.id].lugar.push({
                 zona: x.zona,
               })
             }


             if (typeof x.namezona_ == 'undefined') {

             }else{
               nuevoObjeto[x.id].lugar.push({
                 zona_nombre: x.namezona_,
               })
             }




              if (typeof x.kilometraje == 'undefined') {

              }else{
                nuevoObjeto[x.id].lugar.push({

                  kilometraje: x.kilometraje,
                })
              }

              if(typeof x.gasolina == 'undefined'){

              }else{
                nuevoObjeto[x.id].lugar.push({
                  gasolina: x.gasolina,
                })
              }


              if(typeof x.hospedaje == 'undefined'){

              }else{
                nuevoObjeto[x.id].lugar.push({
                   hospedaje: x.hospedaje,
                })
              }

              if(typeof x.desayuno == 'undefined'){

              }else{
                nuevoObjeto[x.id].lugar.push({
                  desayuno: x.desayuno,
                })
              }


              if(typeof x.cena == 'undefined'){

              }else{
                nuevoObjeto[x.id].lugar.push({
                   cena: x.cena,
                })
              }


              if(typeof x.comida == 'undefined'){

              }else{
                nuevoObjeto[x.id].lugar.push({
                  comida: x.comida,
                })
              }


            })




          }
    });





  @else


  if ($('#kilometrorecorrido').val() == 0) {
    var kilometraje_interno = 0;
  }else{
    var kilometraje_interno = $('#kilometrorecorrido').val();
  }

  //var kilometraje_interno = $('#totalkm').val();

  var suma_kilometraje = 0;
  arrayKilometrajeLugares.forEach (function(numero_kilometraje){
  suma_kilometraje += parseInt(numero_kilometraje.kilometraje);
  });

  if (arrayVehiculo.length == 0) {
    var viaje = arrayVehiculoOficial[0].tipo_viaje;

    if (viaje == 1) {
      var tipo_viajesito  = 2;
    }else if(viaje == 2){
      var tipo_viajesito  = 1;
    }else if(viaje == 3){
      var tipo_viajesito  = 1;
    }
    //console.log(parseInt(kilometraje) , parseInt(tipo_viajesito) , parseInt(kilometraje_interno) ,parseFloat(cuota) , parseFloat($(this).val()))
    //var total1 = parseInt(suma_kilometraje) * parseInt(tipo_viajesito);
    var total1 = parseInt(suma_kilometraje);
    var total2 = parseInt(kilometraje_interno) + parseInt(total1);
    //console.log(total1,total2,suma_kilometraje,kilometraje_interno)
    var totalito =  total2;

    $('#totalkm').val(totalito);
/////////////////////////////////////////////////////////////////////////////
  var suma_dias = 0;
  arrayDiasLugares.forEach (function(numero){
  suma_dias += parseInt(numero.dias);
  });


  var suma_kilometraje = 0;
  arrayKilometrajeLugares.forEach (function(numero_kilometraje){
  suma_kilometraje += parseInt(numero_kilometraje.kilometraje);
  });


  var suma_gasolina = 0;
  var total_gasolina = 0;

  arrayGasolinaLugares.forEach (function(numero_gasolina){
  suma_gasolina += parseFloat(numero_gasolina.gasolina);
  total_gasolina = parseFloat(numero_gasolina.gasolina);
  });
  //////////////////////////////////////////////////////////////////////
  if (arrayVehiculo.length == 0) {
    var cuota = arrayVehiculoOficial[0].cuota;


    var total2 = $('#totalkm').val();
    //console.log(total1,parseInt(kilometraje_interno))
    //var total2 = parseInt(kilometraje_interno);
    //console.log(total2,parseInt(cuota),parseFloat(total_gasolina))
    var total3 = total2 / parseInt(cuota);
    var total4 = total3 * parseFloat(total_gasolina);
    //console.log(total1,total2,total3,total4)
    var total =  total4;

  }else if (arrayVehiculoOficial.length == 0) {
    var cuota = arrayVehiculo[0].cuota;


    var total2 = $('#totalkm').val();
    //var total2 = parseInt(kilometraje_interno);
    var total3 = total2 / parseInt(cuota);
    var total4 = total3 * parseFloat(total_gasolina);
    //console.log(total1,total2,total3,total4)
    var total =  total4;

  }else if (arrayAutobus.length == 0) {


    var total2 = $('#totalkm').val();
    //var total2 = parseInt(kilometraje_interno);
    var total3 = total2 / parseInt(cuota);
    var total4 = total3 * parseFloat(total_gasolina);
    //console.log(total1,total2,total3,total4)
    var total =  total4;

  }else if (arrayAvion.length == 0) {

    var total2 = $('#totalkm').val();
    //var total2 = parseInt(kilometraje_interno);
    var total3 = total2 / parseInt(cuota);
    var total4 = total3 * parseFloat(total_gasolina);
    //console.log(total1,total2,total3,total4)
    var total =  total4;

  }

  //console.log(total)

  var suma_hospedaje = 0;
  arrayHospedajeLugares.forEach (function(numero_hospedaje){
  suma_hospedaje += parseFloat(numero_hospedaje.hospedaje);
  });


  var suma_desayuno = 0;
  arrayDesayunoLugares.forEach (function(numero_desayuno){
  suma_desayuno += parseFloat(numero_desayuno.desayuno);
  });


  var suma_comida = 0;
  arrayComidaLugares.forEach (function(numero_comida){
  suma_comida += parseFloat(numero_comida.comida);
  });


  var suma_cena = 0;
  arrayCenaLugares.forEach (function(numero_cena){
  suma_cena += parseFloat(numero_cena.cena);
  });
  var total_transportes = $('#total_transporte_vehiculof').val();
  var suma_totales_transporte_gasolina_lugar = parseFloat(total) + parseFloat(total_transportes);
  var suma_total_comidas = parseFloat(suma_desayuno) + parseFloat(suma_comida) + parseFloat(suma_cena);
  var suma_total_totales = parseFloat(total) + parseFloat(suma_hospedaje) + parseFloat(suma_total_comidas) + parseFloat(suma_totales_transporte_gasolina_lugar);

  $('#footLugar').show();
  // $('#total_recibido_lugar').show();

  $('#total_dias').html('<p>'+suma_dias+'</p>');
  $('#total_kilometros').html('<p>'+suma_kilometraje+'</p>');
  $('#total_gasolina').html('<p>$'+total.toFixed(2)+'</p>');
  $('#total_hospedaje').html('<p>$'+suma_hospedaje.toFixed(2)+'</p>');
  $('#total_comidas').html('<p>$'+suma_total_comidas.toFixed(2)+'</p>');


  //$('#total_recibido_lugar').html('<p>$'+suma_total_totales.toFixed(2)+'</p>');
  $('#total_recibido_lugar').html('<input type="text" class="form-control" value="'+suma_total_totales.toFixed(2)+'" id="total_extraer" disabled>');
  cantidadletra(suma_total_totales.toFixed(2))




 //Recorremos el arreglo

 // console.log(arrayTablaLugares)
 arrayTablaLugares.forEach( x => {
   //Si la ciudad no existe en nuevoObjeto entonces
   //la creamos e inicializamos el arreglo de profesionales.
   if( !nuevoObjeto.hasOwnProperty(x.id)){
     nuevoObjeto[x.id] = {
       lugar: []
     }
   }

   if (typeof x.dias == 'undefined') {

   }else{
     nuevoObjeto[x.id].lugar.push({

       dias: x.dias,
     })
   }


  if (typeof x.origen == 'undefined') {

  }else{
    nuevoObjeto[x.id].lugar.push({
      origen: x.origen,
    })
  }

  if (typeof x.destino == 'undefined') {

  }else{
    nuevoObjeto[x.id].lugar.push({
      destino: x.destino,
    })
  }


  if (typeof x.origen_nombre == 'undefined') {

  }else{
    nuevoObjeto[x.id].lugar.push({
      origen: x.origen_nombre,
    })
  }

  if (typeof x.destino_nombre == 'undefined') {

  }else{
    nuevoObjeto[x.id].lugar.push({
      destino: x.destino_nombre,
    })
  }


  if (typeof x.zona == 'undefined') {

  }else{
    nuevoObjeto[x.id].lugar.push({
      zona: x.zona,
    })
  }


  if (typeof x.namezona_ == 'undefined') {

  }else{
    nuevoObjeto[x.id].lugar.push({
      zona_nombre: x.namezona_,
    })
  }




   if (typeof x.kilometraje == 'undefined') {

   }else{
     nuevoObjeto[x.id].lugar.push({

       kilometraje: x.kilometraje,
     })
   }

   if(typeof x.gasolina == 'undefined'){

   }else{
     nuevoObjeto[x.id].lugar.push({
       gasolina: x.gasolina,
     })
   }


   if(typeof x.hospedaje == 'undefined'){

   }else{
     nuevoObjeto[x.id].lugar.push({
        hospedaje: x.hospedaje,
     })
   }

   if(typeof x.desayuno == 'undefined'){

   }else{
     nuevoObjeto[x.id].lugar.push({
       desayuno: x.desayuno,
     })
   }


   if(typeof x.cena == 'undefined'){

   }else{
     nuevoObjeto[x.id].lugar.push({
        cena: x.cena,
     })
   }


   if(typeof x.comida == 'undefined'){

   }else{
     nuevoObjeto[x.id].lugar.push({
       comida: x.comida,
     })
   }


 })


 ///////////////////////////////////
 //var kilometraje_interno = $('#kilometrorecorrido').val();

 // if ($('#totalkm').val() == '') {
 //   var kilometraje_interno = 0;
 // }else{
 //   var kilometraje_interno = $('#totalkm').val();
 // }


   //var total = parseInt(kilometraje_total) * parseInt(tipo_viajesito) / parseFloat(cuota) * parseFloat($(this).val());
   //console.log(parseInt(kilometraje),parseFloat(cuota),parseFloat($(this).val()))
 }

 //var totalito = parseInt(kilometraje_interno) + parseInt(suma_kilometraje);




  @endisset




}



// function lugarEstadia(id){
//
//
//
//   console.log(dias)
//   console.log(kilometraje)
//
//   $(":checkbox[name=gasolina]").each(function(){
//       if (this.checked) {
//           /////////////////////////////////////////////////////
//           console.log($(this).val());
//       }
//   });
//
//   $(":checkbox[name=hospedaje]").each(function(){
//       if (this.checked) {
//           /////////////////////////////////////////////////////
//           console.log($(this).val());
//       }
//   });
//
//   $(":checkbox[name=comidas]").each(function(){
//       if (this.checked) {
//           /////////////////////////////////////////////////////
//           console.log($(this).val());
//       }
//   });
//
//
//
//
// }


function AgregarVehiculoOficial(){
  var tipotransporte = $('#tipotransporte1').val();
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
                var kilometraje_interno = $('#kilometrorecorrido').val();


                  var totalito = parseInt(kilometraje_interno) / parseInt(data.kilometros_litros) * parseFloat(gasolina_vehiculo);
                  ObjetoVehiculoOficial = {
                    tipotransporte:tipotransporte,
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
                    total:totalito,
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

  //var total =  parseFloat(ObjetoVehiculoOficial.cuota) * parseFloat(ObjetoVehiculoOficial.gasolina_vehiculo);

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

  '<td>$'+ObjetoVehiculoOficial.total.toFixed(2)+'</td>'+
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
  var tipotransporte = $('#tipotransporte2').val();
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

                var kilometraje_interno = $('#kilometrorecorrido').val();
                  var totalito = parseInt(kilometraje_interno) / parseInt(data.kilometros_litros) * parseFloat(gasolina_vehiculo);
                  //var totalito = data.kilometros_litros * gasolina_vehiculo;
                  ObjetoVehiculo = {
                    tipotransporte:tipotransporte,
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
                    total:totalito,
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
  //var total = parseFloat(ObjetoVehiculo.cuota) * parseFloat(ObjetoVehiculo.gasolina_vehiculo);
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

  '<td>$'+ObjetoVehiculo.total.toFixed(2)+'</td>'+
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
  var tipotransporte = $('#tipotransporte3').val();
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
      tipotransporte:tipotransporte,
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

function agregarAvion(){
  //console.log('entree we')

  var costoAvion = $('#costoAvion').val();
  var tipotransporte = $('#tipotransporte6').val();
  var page = [];

      $(":radio[name=page_avion]").each(function(){
          if (this.checked) {
              /////////////////////////////////////////////////////
              page.push($(this).val());
              selectedAvion.push($(this).val());
          }else{
             page.push(0);

          }
      });

      if (page == 0 || costoAvion == '') {
        Swal.fire("Lo Sentimos", 'Campos no seleccionados o vacios', "warning");
        page.length=0;
      }else{

        ObjetoAvion = {
          tipotransporte:tipotransporte,
          tipo_viaje:selectedAvion[0],
          costoAvion:costoAvion,
        }
        agregarAviones(ObjetoAvion);
        arrayAvion.push(ObjetoAvion);

      }

}

var contador_avion = 0;
function agregarAviones(ObjetoAvion){
  //console.log(ObjetoAvion)
  var tipo_viaje = '';
  if (ObjetoAvion.tipo_viaje == 1) {
    tipo_viaje = 'REDONDO';
  }else if(ObjetoAvion.tipo_viaje == 2){
    tipo_viaje = 'SOLO IDA';
  }else if(ObjetoAvion.tipo_viaje == 3){
    tipo_viaje = 'SOLO REGRESO';
  }

  var tr = '<tr id="filasAviones'+contador_avion+'">'+
  '<td><input type="hidden" id="figura_nueva" value="'+contador_avion+'"/>Avion</td>'+
  '<td>'+tipo_viaje+'</td>'+
  '<td>$'+ObjetoAvion.costoAvion+'</td>'+
  '<td style=" text-align: center; "><div class="btn btn-danger borrar_figura" onclick="eliminarAvion('+contador_avion+')"  ><i  class="fas fa-trash"></i></div></td>'
  '</tr>';

  $("#tablaAviones").append(tr);
  $('#costoAvion').val('');
  $(":radio[name=page_avion]").prop("checked",false);
  selectedAvion.length=0;



  contador_avion ++;
}

function eliminarAvion(id){

  arrayAvion.splice(id,1);
  $('#filasAviones'+id).remove();

}


function agregarPeaje(){
  var Selecpeaje = $('#Selecpeaje').val();
  var tipotransporte = $('#tipotransporte4').val();
  $.ajax({
         type:"POST",
         url:"/recibos/TraerPeaje",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
             id:Selecpeaje,
           },
          success:function(data){

            ObjetoPeaje = {
              tipotransporte:tipotransporte,
              peaje:data.ubicacion_peaje,
              costo:data.costo,
            }
            agregarPeajes(ObjetoPeaje);
            arrayPeaje.push(ObjetoPeaje);

          }
    });
  //console.log(Selecpeaje)
}

var contador_peaje = 0;
function agregarPeajes(ObjetoPeaje){

  var tr = '<tr id="filasPeajes'+contador_peaje+'">'+
  '<td><input type="hidden" id="figura_nueva" value="'+contador_peaje+'"/>'+ObjetoPeaje.peaje+'</td>'+
  '<td>$'+ObjetoPeaje.costo+'</td>'+
  '<td style=" text-align: center; "><div class="btn btn-danger borrar_figura" onclick="eliminarPeaje('+contador_peaje+')"  ><i  class="fas fa-trash"></i></div></td>'
  '</tr>';

  $("#tablaPeajes").append(tr);
  $('#Selecpeaje').prop("selected", false);

  contador_peaje ++;
}

function eliminarPeaje(id){

  arrayPeaje.splice(id,1);
  $('#filasPeajes'+id).remove();

}

function AgregarTaxi(){

var region = $('#regiones').val(); // Capturamos el valor del select
var region_name = $('#regiones').find('option:selected').text();
var recorrido1 = $('#recorrido1').val();
var recorrido2 = $('#recorrido2').val();
var dia_adicional = $('#dia_adicional').val();
var tipotransporte = $('#tipotransporte5').val();
// console.log(recorrido1,recorrido2)
var ids = [recorrido1,recorrido2];
$.ajax({
       type:"POST",
       url:"/recibos/TraerRecorrido",
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       data:{
           ids:ids,
         },
        success:function(data){

          ObjetoRecorrido = {
            tipotransporte:tipotransporte,
            region:region,
            region_name:region_name,
            dia_adicional:dia_adicional,
            recorrido1:data[0].id,
            recorrido2:data[1].id,
            name_recorrido:data[0].descripcion,
            name_recorrido2:data[1].descripcion,
            tarifa_evento:data[0].tarifa_evento,
            tarifa_evento2:data[1].tarifa_evento,
            tarifa_adicional:data[0].tarifa_adicional,
            tarifa_adicional2:data[1].tarifa_adicional,
          }

          agregarRecorridos(ObjetoRecorrido);
          arrayRecorrido.push(ObjetoRecorrido);
          // console.log(
          // data[0].id,
          // data[0].tarifa_evento,
          // data[0].descripcion,
          // data[0].tarifa_adicional,
          //
          // data[1].id,
          // data[1].tarifa_evento,
          // data[1].descripcion,
          // data[1].tarifa_adicional
          // )

          // for (var i = 0; i < data.length; i++) {
          //   //data[i].id
          //   // data[i].tarifa_evento
          //   // data[i].descripcion
          //   // data[i].tarifa_adicional
          // }
          // ObjetoTaxi = {
          //   peaje:data.ubicacion_peaje,
          //   costo:data.costo,
          // }
          // agregarPeajes(ObjetoTaxi);
          // arrayTaxi.push(ObjetoTaxi);

        }
  });




}
var contador_taxi = 0;
function agregarRecorridos(ObjetoRecorrido){

    var tr = '<tr id="filasTaxis'+contador_taxi+'">'+
    '<td><input type="hidden" id="figura_nueva" value="'+contador_taxi+'"/>'+ObjetoRecorrido.region_name+'</td>'+
    '<td>'+ObjetoRecorrido.name_recorrido+'</td>'+
    '<td>'+ObjetoRecorrido.name_recorrido2+'</td>'+
    '<td>'+ObjetoRecorrido.dia_adicional+'</td>'+
    '<td style=" text-align: center; "><div class="btn btn-danger borrar_figura" onclick="eliminarTaxi('+contador_taxi+')"  ><i  class="fas fa-trash"></i></div></td>'
    '</tr>';

    $("#tablaTaxis").append(tr);
    $('#regiones').prop('selectedIndex',0);
    $('#recorrido1').prop('selectedIndex',0);
    $('#recorrido2').prop('selectedIndex',0);
    $('#dia_adicional').val('');


    contador_taxi ++;
}

function eliminarTaxi(id){
  arrayRecorrido.splice(id,1);
  $('#filasTaxis'+id).remove();
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
function cantidadletra(cantidad){
  //console.log('entro')
  //var cantidad = $('#total_extraer').val();
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
                //console.log(nivel);
                var id_area = data.cve_area_departamentos;

                $('#nombre_empleado').val(nombre);
                $('#nivel').val(nivel);
                $('#area_id').val(id_area);


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


    var btn = KTUtil.getById("kt_btn_1");



    var VehiculoOficial = arrayVehiculoOficial;
    var Vehiculo = arrayVehiculo;
    var Avion = arrayAvion;
    var Autobus = arrayAutobus;
    var Peaje = arrayPeaje;
    var Recorrido = arrayRecorrido;


    @isset($recibos)
    var id = {{ $recibos->id }};
    @else
    var id = 0;
    @endisset

    @isset($firmantes)
    var id_firmante = {{ $firmantes->id }};
    @else

    var id_firmante = 0;
    @endisset
    @isset($pagos)
    var id_pagos = {{ $pagos->id }};
    @else
    var id_pagos = 0;
    @endisset

    @isset($transporte)
    var id_transporte = {{ $transporte->id }};
    @else
    var id_transporte = 0;
    @endisset

    var n_empleado = $('#n_empleado').val();
    var nombre_empleado = $('#nombre_empleado').val();
    var area_id = $('#area_id').val();


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

    var kilometrorecorrido = $('#kilometrorecorrido').val();
    var especificarcomision = $('#especificarcomision').val();
    var totalkm = $('#totalkm').val();
    var banco = $('#banco').val();

    var selected = [];
    var selected2 = [];

    $(":checkbox[name=valeCombustible]").each(function(){
        if (this.checked) {
          selected.push($(this).val());
        }
    });

    $(":checkbox[name=recibo_complementario]").each(function(){
      if (this.checked) {
        selected2.push($(this).val());
      }
    });

    var programavehiculof = $('#programavehiculof').val();
    var total_transporte_vehiculof = $('#total_transporte_vehiculof').val();
    var valeCombustible = selected;
    var recibo_complentario_ticket = selected2;



    var total_extraer = $('#total_extraer').val();
    var programalugar = $('#programalugar').val();

    //var tabla_lugares = arrayTablaLugares;
    //console.log(recibo_complentario_ticket)

    if (clave_departamental == '' || inicia == '' || final == '' || lugar_adscripcion == '' || n_dias == ''  || descripcion == '' || cheque_firma == ''
      || especificarcomision == '' ) {
      Swal.fire("Lo Sentimos", 'Llenar los campos obligatorios', "warning");

      KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Por Favor Espere");

      setTimeout(function() {
          KTUtil.btnRelease(btn);
      }, 2000);

    }else{

      $('#kt_btn_1').prop('disabled',true);
      KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Por Favor Espere");

      setTimeout(function() {
          KTUtil.btnRelease(btn);
      }, 2000);
      $.ajax({

             type:"POST",

             url:"{{ ( isset($recibos) ) ? '/recibos/update' : '/recibos/create' }}",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data:{
               id:id,
               id_firmante:id_firmante,
               id_pagos:id_pagos,
               n_empleado:n_empleado,
               nombre_empleado:nombre_empleado,
               rfc:rfc,
               nivel:nivel,
               clave_departamental:clave_departamental,
               dependencia:dependencia,
               direccion:direccion,
               inicia:inicia,
               final:final,
               departamento:departamento,
               lugar_adscripcion:lugar_adscripcion,
               n_dias:n_dias,
               n_dias_ina:n_dias_ina,
               descripcion:descripcion,
               director_area_firma:director_area_firma,
               organo_control_firma:organo_control_firma,
               director_administrativo_firma:director_administrativo_firma,
               cheque_firma:cheque_firma,
               jefe_firma:jefe_firma,
               secretaria_pago:secretaria_pago,
               cheque:cheque,
               fecha_pago:fecha_pago,
               cantidad:cantidad,
               letras_cantidad:letras_cantidad,
               kilometrorecorrido:kilometrorecorrido,
               especificarcomision:especificarcomision,
               totalkm:totalkm,
               tablalugares:nuevoObjeto,
               total_extraer:total_extraer,
               programalugar:programalugar,
               area_id:area_id,
               banco:banco,
               programavehiculof:programavehiculof,
               total_transporte_vehiculof:total_transporte_vehiculof,
               valeCombustible:valeCombustible,
               recibo_complentario_ticket:recibo_complentario_ticket,
               VehiculoOficial:VehiculoOficial,
               Vehiculo:Vehiculo,
               Avion:Avion,
               Autobus:Autobus,
               Peaje:Peaje,
               Recorrido:Recorrido,
               id_transporte:id_transporte,

             },
             // data: formData,
             // processData: false,
             // contentType: false,
             // cache:false,
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

                    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Por Favor Espere");

                    setTimeout(function() {
                        KTUtil.btnRelease(btn);
                    }, 2000);

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


                    KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Por Favor Espere");

                    setTimeout(function() {
                        KTUtil.btnRelease(btn);
                    }, 2000);
                }else{
                  $('#kt_btn_1').prop('disabled',false);

                }


              }
        });
    }


  }



</script>
@endsection
