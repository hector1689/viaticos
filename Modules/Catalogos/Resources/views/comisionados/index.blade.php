@extends('layouts.inicio')

@section('content')
<link href="/admin/assets/plugins/custom/jstree/jstree.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\1F7A5";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   Comisionados
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
          </div>
          <div class="col-md-6">
            <button type="button" class="btn btn-primary" onclick="estructura()">Nueva Estructura</button>
          </div>
        </div>
          <div role="separator" class="dropdown-divider"></div>
        <div class="row">
          <div class="col-md-6">

            <ul id="myUL">
              <li><span class="caret"><i class="far fa-building  text-primary"></i> Dirección General de Movilidad, Sistemas e Informatica</span>&nbsp;&nbsp; <i class="fas fa-times text-danger" onclick="agregar()"></i> <i class="far fa-edit  text-primary" onclick="agregar()"></i>
                 <i class="far fa-plus-square text-primary" onclick="agregar()"></i> <i class="fas fa-user-plus  text-primary" onclick="agregarusuarios()"></i> <i class="far fa-check-square text-primary" onclick="configuracion()"></i>
                <ul class="nested">
                  <li><i class="fa fa-user text-primary"></i> Jesús Roberto Quintero Castañeda (Director General)</li>
                  <li><span class="caret"><i class="far fa-building  text-primary"></i> Dirección de Informatica</span>&nbsp;&nbsp;  <i class="fas fa-times text-danger" onclick="agregar()"></i> <i class="far fa-edit  text-primary" onclick="agregar()"></i>
                     <i class="far fa-plus-square text-primary" onclick="agregar()"></i> <i class="fas fa-user-plus  text-primary" onclick="agregarusuarios()"></i> <i class="far fa-check-square text-primary" onclick="configuracion()"></i>

                    <ul class="nested">
                      <li><i class="fa fa-user text-primary"></i> Alejandro Paulino Arellanes Mora (Director)</li>
                      <!-- <li>White Tea</li>
                      <li><span class="caret">Green Tea</span>
                        <ul class="nested">
                          <li>Sencha</li>
                          <li>Gyokuro</li>
                          <li>Matcha</li>
                          <li>Pi Lo Chun</li>
                        </ul>
                      </li> -->
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>


            <!-- <div id="kt_tree_2" class="tree-demo">
            	<ul>
            		<li>
            			Dirección General de Movilidad, <i class="fa fa-comment-alt" onclick="agregar()"></i> Sistemas e Informatica
            			<ul>
                    <li data-jstree='{ "icon" : "fa fa-user text-success ", "disabled" : true }'>
            					Jesús Roberto Quintero Castañeda (Director General)
            				</li>
            				<li data-jstree='{ "opened" : true }'>
            					Dirección de Informatica
            					<ul>
                        <li data-jstree='{ "icon" : "fa fa-user text-success ", "disabled" : true }'>
                					Alejandro Paulino Arellanes Mora (Director)
                				</li>
            					</ul>
            				</li>

            			</ul>
            		</li>

            	</ul>
            </div> -->



          </div>

          <div class="col-md-6">

            <div id="agregarestructura">


              <div class="card card-custom card-stretch" id="kt_page_stretched_card">
                  <div class="card-header">
                      <div class="card-title">
                          <h3 class="card-label">Alta de Jefe de Área o Resguardante Oficial</h3>
                      </div>
                  </div>
                  <div class="card-body">

                        <div class="row">
                          <div class="col-md-4">
                            <label for="inputPassword4"  style="font-size:12px;"class="form-label">De quien Depende: </label>
                            <select class="form-control" name="">
                              <option value=""></option>
                            </select>
                          </div>
                          <div class="col-md-4">
                            <label for="inputPassword4"  style="font-size:12px;"class="form-label">Nivel: </label>
                            <select class="form-control" name="">
                              <option value="">Secretaria</option>
                              <option value="">Subcretaria</option>
                            </select>
                          </div>
                          <div class="col-md-4">
                            <label for="inputPassword4"  style="font-size:12px;"class="form-label">Nombre Área: </label>
                            <input type="text" class="form-control" value="">
                          </div>
                        </div>
                        <div role="separator" class="dropdown-divider"></div>
                          <div class="row">
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">B </label>
                              <input type="text" class="form-control" value="" placeholder="Buscar por nombre o numero de empleado">
                            </div>
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Nombre Área: </label><br>
                              <button type="button" class="btn btn-primary">Agregar</button>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">N° de Empleado: </label>
                              <input type="text" class="form-control" value="">
                            </div><div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Nombre: </label>
                              <input type="text" class="form-control" value="">
                            </div><div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Apellido Paterno: </label>
                              <input type="text" class="form-control" value="">
                            </div><div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Apellido Materno: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Puesto: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Extensión: </label>
                              <input type="text" class="form-control" value="">
                          </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;" class="form-label">Celular: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Correo Electronico: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                          </div>
                          <div class="row">
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;" class="form-label">Correo Electronico: </label><br>
                            <button type="button" style="font-size:12px;visibility:hidden;" class="btn btn-primary">Guardar</button>
                          </div>
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Correo Electronico: </label><br>
                            <button type="button" class="btn btn-primary">Guardar</button>
                          </div>
                          </div>

                      </div>

              </div>



            </div>

            <div id="agregarjefe">

              <div class="card card-custom card-stretch" id="kt_page_stretched_card">
                  <div class="card-header">
                      <div class="card-title">
                          <h3 class="card-label">SubEstructura Alta de Jefe de Área o Resguardante Oficial</h3>
                      </div>
                  </div>
                  <div class="card-body">

                        <div class="row">
                          <div class="col-md-4">
                            <label for="inputPassword4"  style="font-size:12px;"class="form-label">De quien Depende: </label>
                            <select class="form-control" name="">
                              <option value=""></option>
                            </select>
                          </div>
                          <div class="col-md-4">
                            <label for="inputPassword4"  style="font-size:12px;"class="form-label">Nivel: </label>
                            <select class="form-control" name="">
                              <option value="">Secretaria</option>
                              <option value="">Subcretaria</option>
                            </select>
                          </div>
                          <div class="col-md-4">
                            <label for="inputPassword4"  style="font-size:12px;"class="form-label">Nombre Área: </label>
                            <input type="text" class="form-control" value="">
                          </div>
                        </div>
                        <div role="separator" class="dropdown-divider"></div>
                          <div class="row">
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">B </label>
                              <input type="text" class="form-control" value="" placeholder="Buscar por nombre o numero de empleado">
                            </div>
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Nombre Área: </label><br>
                              <button type="button" class="btn btn-primary">Agregar</button>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">N° de Empleado: </label>
                              <input type="text" class="form-control" value="">
                            </div><div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Nombre: </label>
                              <input type="text" class="form-control" value="">
                            </div><div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Apellido Paterno: </label>
                              <input type="text" class="form-control" value="">
                            </div><div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Apellido Materno: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Puesto: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Extensión: </label>
                              <input type="text" class="form-control" value="">
                          </div>
                          </div>
                          <div class="row">
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;"class="form-label">Celular: </label>
                            <input type="text" class="form-control" value="">
                          </div>
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;"class="form-label">Correo Electronico: </label>
                            <input type="text" class="form-control" value="">
                          </div>
                          </div>
                          <div class="row">
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;" class="form-label">Correo Electronico: </label><br>
                            <button type="button" style="font-size:12px;visibility:hidden;" class="btn btn-primary">Guardar</button>
                          </div>
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Correo Electronico: </label><br>
                            <button type="button" class="btn btn-primary">Guardar</button>
                          </div>
                          </div>
                      </div>

              </div>
            </div>




            <div id="agregarresguardante">
              <div class="card card-custom card-stretch" id="kt_page_stretched_card">
                  <div class="card-header">
                      <div class="card-title">
                          <h3 class="card-label">Alta Resguardante Interno</h3>
                      </div>
                  </div>
                  <div class="card-body">

                          <div class="row">
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">B </label>
                              <input type="text" class="form-control" value="" placeholder="Buscar por nombre o numero de empleado">
                            </div>
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Nombre Área: </label><br>
                              <button type="button" class="btn btn-primary">Agregar</button>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">N° de Empleado: </label>
                              <input type="text" class="form-control" value="">
                            </div><div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Nombre: </label>
                              <input type="text" class="form-control" value="">
                            </div><div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Apellido Paterno: </label>
                              <input type="text" class="form-control" value="">
                            </div><div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Apellido Materno: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Puesto: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Nivel: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                          </div>
                          <div class="row">
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;" class="form-label">Correo Electronico: </label><br>
                            <button type="button" style="font-size:12px;visibility:hidden;" class="btn btn-primary">Guardar</button>
                          </div>
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Correo Electronico: </label><br>
                            <button type="button" class="btn btn-primary">Agregar</button>
                          </div>
                          </div>
                          <div class="col-md-12">
                            <table class="table">
                              <thead>
                                  <tr>
                                      <th scope="col">N° de Empleado</th>
                                      <th scope="col">Nombre</th>
                                      <th scope="col">Puesto</th>

                                      <th scope="col">acciones</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>2500</td>
                                      <td>Javier sanchez</td>
                                      <td>Analista</td>
                                      <td>
                                        <span class="label label-inline label-light-danger font-weight-bold">
                                            <i class="far fa-trash-alt"></i>
                                        </span>
                                      </td>
                                  </tr>

                              </tbody>
                            </table>
                          </div>

                          <div class="row">
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;" class="form-label">Correo Electronico: </label><br>
                            <button type="button" style="font-size:12px;visibility:hidden;" class="btn btn-primary">Guardar</button>
                          </div>
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Correo Electronico: </label><br>
                            <button type="button" class="btn btn-primary">Guardar</button>
                          </div>
                          </div>
                      </div>

              </div>
            </div>

            <div id="agregarfirmantes">
              <div class="card card-custom card-stretch" id="kt_page_stretched_card">
                  <div class="card-header">
                      <div class="card-title">
                          <h3 class="card-label">Alta Firmantes</h3>
                      </div>
                  </div>
                  <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Cargo a firmar: </label><br>
                              <select class="form-control" name="">
                                <option value="">Director Administrativo</option>
                                <option value="">Organo de Control</option>
                                <option value="">Responsable de Almacen</option>
                              </select>
                            </div>
                            <div class="col-md-6">

                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">B </label>
                              <input type="text" class="form-control" value="" placeholder="Buscar por nombre o numero de empleado">
                            </div>
                            <div class="col-md-4">
                              <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Nombre Área: </label><br>
                              <button type="button" class="btn btn-primary">Agregar</button>
                            </div>
                            <div class="col-md-4">
                              <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Nombre Área: </label><br>
                              <button type="button" class="btn btn-primary">nuevo</button>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">N° de Empleado: </label>
                              <input type="text" class="form-control" value="">
                            </div><div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Nombre: </label>
                              <input type="text" class="form-control" value="">
                            </div><div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Apellido Paterno: </label>
                              <input type="text" class="form-control" value="">
                            </div><div class="col-md-3">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Apellido Materno: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Puesto: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-4">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">N° de Empleado: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-4">
                              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Correo Electronico: </label>
                              <input type="text" class="form-control" value="">
                            </div>
                          </div>
                          <div class="row">
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;" class="form-label">Correo Electronico: </label><br>
                            <button type="button" style="font-size:12px;visibility:hidden;" class="btn btn-primary">Guardar</button>
                          </div>
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Correo Electronico: </label><br>
                            <button type="button" class="btn btn-primary">Agregar</button>
                          </div>
                          </div>
                          <div class="col-md-12">
                            <table class="table">
                              <thead>
                                  <tr>
                                      <th scope="col">Cargo a firmar</th>
                                      <th scope="col">Nombre</th>
                                      <th scope="col">Puesto</th>

                                      <th scope="col">acciones</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>Director Administrativo</td>
                                      <td>Javier sanchez</td>
                                      <td>Analista</td>
                                      <td>
                                        <span class="label label-inline label-light-danger font-weight-bold">
                                            <i class="far fa-trash-alt"></i>
                                        </span>
                                      </td>
                                  </tr>

                              </tbody>
                            </table>
                          </div>

                          <div class="row">
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;" class="form-label">Correo Electronico: </label><br>
                            <button type="button" style="font-size:12px;visibility:hidden;" class="btn btn-primary">Guardar</button>
                          </div>
                          <div class="col-md-6">
                            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Correo Electronico: </label><br>
                            <button type="button" class="btn btn-primary">Guardar</button>
                          </div>
                          </div>
                      </div>

              </div>
            </div>

          </div>
        </div>





</div>
<div class="card-footer">

  <!-- <a href="/catalogos/comisionados" class="btn btn-default">Regresar</a> -->

  <!-- <a class="btn btn-primary " onclick="guardar()">Guardar</a> -->
</div>
</form>
</div>
<script src="/admin/assets/plugins/custom/jstree/jstree.bundle.js?v=7.0.6"></script>
 <script src="/admin/assets/js/pages/features/miscellaneous/treeview.js?v=7.0.6"></script>
<script type="text/javascript">

$('#agregarjefe').hide();
$('#agregarresguardante').hide();
$('#agregarfirmantes').hide();
$('#agregarestructura').hide();

function estructura(){
  $('#agregarjefe').hide();
  $('#agregarresguardante').hide();
  $('#agregarfirmantes').hide();
  $('#agregarestructura').show();
}

function agregar(){
  $('#agregarjefe').show();
  $('#agregarresguardante').hide();
  $('#agregarfirmantes').hide();
  $('#agregarestructura').hide();
}

function agregarusuarios(){
  $('#agregarjefe').hide();
  $('#agregarresguardante').show();
  $('#agregarfirmantes').hide();
  $('#agregarestructura').hide();
}

function configuracion(){
  $('#agregarjefe').hide();
  $('#agregarresguardante').hide();
  $('#agregarfirmantes').show();
  $('#agregarestructura').hide();
}

var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}


$('#kt_tree_2').jstree({
  "core": {
      "themes": {
          "responsive": false
      }
  },
  "types": {
      "default": {
          "icon": "fa fa-file text-warning"
      },
      "file": {
          "icon": "fa fa-file  text-warning"
      }
  },
  "plugins": ["types"]
});

// handle link clicks in tree nodes(support target="_blank" as well)
// $('#kt_tree_2').on('select_node.jstree', function(e, data) {
//   var link = $('#' + data.selected).find('a');
//   if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
//       if (link.attr("target") == "_blank") {
//           link.attr("href").target = "_blank";
//       }
//       document.location.href = link.attr("href");
//       return false;
//   }
// });



var KTLayoutStretchedCard=function() {
	// Private properties
	var _element;

	// Private functions
	var _init=function() {
		var scroll=KTUtil.find(_element, '.card-scroll');
		var cardBody=KTUtil.find(_element, '.card-body');
		var cardHeader=KTUtil.find(_element, '.card-header');

		var height=KTLayoutContent.getHeight();

		height=height - parseInt(KTUtil.actualHeight(cardHeader));

		height=height - parseInt(KTUtil.css(_element, 'marginTop')) - parseInt(KTUtil.css(_element, 'marginBottom'));
		height=height - parseInt(KTUtil.css(_element, 'paddingTop')) - parseInt(KTUtil.css(_element, 'paddingBottom'));

		height=height - parseInt(KTUtil.css(cardBody, 'paddingTop')) - parseInt(KTUtil.css(cardBody, 'paddingBottom'));
		height=height - parseInt(KTUtil.css(cardBody, 'marginTop')) - parseInt(KTUtil.css(cardBody, 'marginBottom'));

		height=height - 1;

		KTUtil.css(scroll, 'height', height + 'px');
	}

	// Public methods
	return {
		init: function(id) {
			_element=KTUtil.getById(id);

			if ( !_element) {
				return;
			}

			// Initialize
			_init();

			// Re-calculate on window resize
			KTUtil.addResizeHandler(function() {
					_init();
				}
			);
		},

		update: function() {
			_init();
		}
	};
}();

// Webpack support
if (typeof module !=='undefined') {
	module.exports=KTLayoutStretchedCard;
}




</script>
@endsection
