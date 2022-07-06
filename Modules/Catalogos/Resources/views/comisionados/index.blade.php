@extends('layouts.inicio')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css" integrity="sha512-pg7xGkuHzhrV2jAMJvQsTV30au1VGlnxVN4sgmG8Yv0dxGR71B21QeHGLMvYod4AaygAzz87swLEZURw7VND2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .w100 { width: 100%; }
    .requerido { color: red; font-size: 10px; }
    .masGrande { font-size: 1.2em !important; }
    .ml-20 { margin-left: 20px; margin-top: 10px; }
    .mb-10 { padding-bottom: 10px; }
    .pr-10 { padding-right: 4px; }
    .pr-20 { padding-right: 20px; }
    .notas { margin: 0 0 6px 40px; }

    .der { text-align: right; }
    .gris { color: lightgray !important; }
    .negro { color: black !important; }

    .gris { color: #808080; }
    .bgris { margin: 6px !important; padding: 6px 10px !important; background-color: #F1F4F5; }
    .pl-26 { padding-left: 26px; position: absolute; top: 20px; color: #595b5b; }

    /* .jstree-default .jstree-wholerow { min-height: 44px; }
    .jstree-node, .jstree-open { min-height: 44px !important; line-height: 44px !important; } */
    .jstree-anchor { width: 94%; }
    .arbol { width: 100%; border: 1px solid #D3D3D3; border-radius: 6px; background: none; height: 656px; overflow: auto; }
    .ajusta { padding: 0 0 0 26px !important; margin-top: -1rem !important; }
    .minheight { min-height: 740px; }

    /* .ui.category.search .results { width: 100% !important; }
    .ui.category.search>.results .category { width: 100% !important; } */
</style>
<div class="card card-custom example example-compact">
<div class="card-body">
    <form class="form" id="">

      <div class="row" >
          <div class="col-md-6">
              <h3 class="ui header" style="margin-top: 10px;">
                  Departamentos registrados
              </h3>
          </div>

          <div class="col-md-6" style="text-align: right;">
            @can('crear estructura')
            <a href="javascript: editaArea(0, 0);" class="btn btn-primary">
                <i class="fas fa-plus icon-sm"></i>
                Nueva estructura inicial
            </a>
            @else
            @endcan

          </div>

      </div>


        <!-- <div class="ten wide field">
            <label>Seleccione una opción</label>
            <div class="ui selection tipo dropdown multiple" id="cve_cat_tipo">
                <input type="hidden" name="cve_cat_tipo" id="cve_cat_tipo" >
                <i class="dropdown icon"></i>
                <div class="default text">Seleccione </div>
                <div class="menu">
                    <div class="item" data-value="0">Todos... </div>
                    <div class="item" data-value="1">Dependencia </div>
                    <div class="item" data-value="2">Entidad </div>
                    <div class="item" data-value="3">Otro </div>
                </div>
            </div>
        </div> -->
        <br>


      <div class="row">

        <div class="col-xl-5">

            <!-- Desglose areas -->
            <div class="row" style="margin-bottom: 0 !important;">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-6">
                      <a href="javascript: tree_open(1);" class="btn btn-primary btn-sm" style="font-size:7pt;">
                          <i class="fas fa-angle-down icon-sm"></i>
                          Mostrar todas
                      </a>
                    </div>
                    <div class="col-md-6">
                      <a href="javascript: tree_open(2);" class="btn btn-primary btn-sm" style="font-size:7pt;">
                          <i class="fas fa-angle-up icon-sm"></i>
                          Ocultar todas
                      </a>
                    </div>
                  </div>

                </div>
                <div class="col-md-6">

                      <input type="text" class="form-control" placeholder="Nombre del área a buscar ..." id="busca_area">
                      <i class="search icon"></i>

                </div>


            </div>

            <div role="separator" class="dropdown-divider"></div>
            <div class="col-md-12">
                <div id="raiz">
                    <div id="divTree" class="arbol" style="width: 100%; border: 1px solid #D3D3D3; border-radius: 6px; background: none; height: 656px; overflow: auto;"> </div>
                </div>
            </div>


            <!-- Fin: areas -->

        </div>
        <!-- Fin: ten columns -->
        <!--////////////////// INICIO AGREGAR ESTRUCTURA Y RESPONSABLE //////////// -->

        <div class="col-xl-7 needs-validation"  style="display: none; padding-top: 0 !important;" id="columna_crear_area">

                <div class="row">
                  <div class="col-md-6 nivel" id="div_nivel">
                      <label>Nivel <span class="requerido">requerido </span></label>
                      <select class="form-control nivel" name="nivel" id="nivel" value="1"  >
                        <option value="0">Selecciona...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                  </div>

                  <div class="col-md-6" >
                      <label>Tipo <span class="requerido">requerido </span></label>
                      <select class="form-control tipo"  name="id_tipo" id="id_tipo"  >
                        <option value="0">Selecciona...</option>
                        <option value="1">Secretaria</option>
                        <option value="2">Subsecretaria</option>
                        <option value="3">Dirección General</option>
                        <option value="4">Dirección</option>
                        <option value="5">Departamento</option>
                      </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 nombre_areas" id="areas_ts">
                      <label>Nombre del Área <span class="requerido">requerido </span></label>
                      <input type="text" name="nombre_area" class="form-control" placeholder="Nombre del Área" id="nombre_area">

                  </div>
                </div>


                <div role="separator" class="dropdown-divider"></div>
                <label>Agregar Responsable del Área</label>

                <div class="row">
                  <div class="col-md-4">
                    <label>Nombre <span class="requerido">requerido </span></label>
                    <input type="text" name="nombre_empleado" id="nombre-empleado"  class="form-control" required>
                  </div>

                  <div class="col-md-4">
                    <label>Apellido Paterno <span class="requerido">requerido </span></label>
                    <input type="text" name="apellido_p_empleado" id="apellido-p-empleado" class="form-control" required>

                  </div>


                  <div class="col-md-4">
                    <label>Apellido Materno </label>
                    <input type="text" name="apellido_m_empleado" id="apellido-m-empleado" class="form-control" required>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label>Puesto <span class="requerido">requerido </span></label>
                    <input type="text" name="puesto_empleado" id="puesto-empleado" class="form-control"  required>
                      <input type="hidden" id="id_empleado_es" name='id_empleado'>
                  </div>

                  <div class="col-md-6">
                    <label>Teléfono <span class="requerido">requerido </span></label>
                    <input type="text" name="telefono_empleado" id="telefono-empleado" class="form-control" onkeypress='return validaNumericos(event)'  required>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label>Extensión <span class="requerido">requerido </span></label>
                    <input type="text" name="extension" id="extension-empleado" class="form-control" onkeypress='return validaNumericos(event)'  required>

                  </div>

                  <div class="col-md-6">
                    <label>Correo Eléctronico <span class="requerido">requerido </span></label>
                    <input type="email" name="correo" id="correo-empleado" class="form-control"  required>
                  </div>

                </div>


                <div role="separator" class="dropdown-divider"></div>

                <br />
                <div class="col-md-6" >
                    <a class="btn btn-primary" onclick="guardarEstructura()">
                        <i class="fas fa-save"></i>
                        Guardar
                    </a>
                </div>
            </div>




        <!--////////////////// FIN AGREGAR ESTRUCTURA Y RESPONSABLE //////////// -->
        <!--/////////////// AGREGAR PERSONAL A AREAS /////////////////////////-->
        <div class="col-xl-7" style="display: none; padding-top: 0 !important;" id="crud">
            <div class="row">
              <div class="col-md-6">
                <div id="nombre_area_alta"></div>
              </div>
              <div class="col-md-6">
                <div id="nombre_jefe_alta"></div>
              </div>
              <div id="id_area_alta"></div>
            </div>

              <div role="separator" class="dropdown-divider"></div>

            <label>Alta Comisionado </label>



          <div class="row">
            <div class="col-md-4">
              <label>Nombre <span class="requerido">requerido </span></label>
              <input type="text" class="form-control" name="nombre-empleados" placeholder="Nombre de Empleado" id="nombre-empleados"  >

            </div>

            <div class="col-md-4">
              <label>Apellido Paterno <span class="requerido">requerido </span></label>
              <input type="text" class="form-control" name="apellido_p_empleados" placeholder="Apellido Paterno" id="apellido-p-empleados" >

            </div>


            <div class="col-md-4">
              <label>Apellido Materno </label>
              <input type="text" class="form-control" name="apellido_m_empleados" placeholder="Apellido Materno" id="apellido-m-empleados" >

            </div>
          </div>

            <div class="row">
              <div class="col-md-4">
                <label>Número de Empleado  <span class="requerido">requerido </span></label>
                <input type="text" class="form-control" name="numero-empleados"  placeholder="Número de Empleado" id="numero-empleados"  onkeypress='return validaNumericos(event)'>
              </div>
              <div class="col-md-4">
                <label>Puesto <span class="requerido">requerido </span></label>
                <input type="text"  class="form-control"name="puesto_empleados" placeholder="Puesto" id="puesto-empleados"  >
              </div>

              <div class="col-md-4">
                <label>Nivel <span class="requerido">requerido </span></label>
                <input type="text"  class="form-control"name="nivel_empleados" placeholder="Nivel del Empleado" id="nivel_empleados"  onkeypress='return validaNumericos(event)'>
              </div>
            </div>

            <input type="hidden" id="id_empleado_es" name='id_empleado'>

            <br />
            <div class="field der" >
                <a class="btn btn-primary" onclick="agregarPersonal()">
                    <i class="ui save white icon"></i>
                    Agregar
                </a>
            </div>

            <div role="separator" class="dropdown-divider"></div>
            <div class="row">
              <div class="col-md-12">
                <table id="tablaModuloIndex" class="table table-bordered table-checkable">

                  <thead>
                    <tr>
                      <th>N° Empleado</th>
                      <th>Nombre</th>
                      <th>Puesto</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="cuerpo"></tbody>
                </table>
              </div>
            </div>


        </div>
        <!--////////////// FIN Personal areas ///////////////////////////-->

        <!--/////////////// INICIO FIRMANTES /////////////////////////////-->
        <div class="col-xl-7" style="display: none; padding-top: 0 !important;" id="firmantes">
            <div class="row">
              <div class="col-md-6">
                <div id="nombre_area_alta_firmante"></div>
              </div>
              <div class="col-md-6">
                <div id="nombre_jefe_alta_firmante"></div>
              </div>
              <div id="id_area_alta_firmante"></div>
            </div>
              <div role="separator" class="dropdown-divider"></div>
            <label>Alta Firmantes </label>

          <div class="row">
            <div class="col-md-6">
              <label>Cargo para Firmar <span class="requerido">requerido </span></label>
              <select class="form-control" name="cargo" id="cargo">
                <option value="">Seleccionar</option>
                @foreach($cargo as $car)
                <option value="{{ $car->id }}">{{ $car->nombre }}</option>
                @endforeach
              </select>
            </div>
          </div>
            <div role="separator" class="dropdown-divider"></div>
          <div class="row">
            <div class="col-md-4">
              <label>Nombre <span class="requerido">requerido </span></label>
              <input type="text" class="form-control" name="nombre-empleados_firmante" placeholder="Nombre de Empleado" id="nombre-empleados_firmante"  >

            </div>

            <div class="col-md-4">
              <label>Apellido Paterno <span class="requerido">requerido </span></label>
              <input type="text" class="form-control" name="apellido_p_empleados_firmante" placeholder="Apellido Paterno" id="apellido-p-empleados_firmante" >

            </div>


            <div class="col-md-4">
              <label>Apellido Materno </label>
              <input type="text" class="form-control" name="apellido_m_empleados_firmante" placeholder="Apellido Materno" id="apellido-m-empleados_firmante" >

            </div>
          </div>

            <div class="row">
              <div class="col-md-4">
                <label>Número de Empleado  <span class="requerido">requerido </span></label>
                <input type="text" class="form-control" name="numero-empleados_firmante"  placeholder="Número de Empleado" id="numero-empleados_firmante"  onkeypress='return validaNumericos(event)'>
              </div>
              <div class="col-md-4">
                <label>Puesto <span class="requerido">requerido </span></label>
                <input type="text"  class="form-control"name="puesto_empleados_firmante" placeholder="Puesto" id="puesto-empleados_firmante"  >
              </div>

              <div class="col-md-4">
                <label>Correo Eléctronico <span class="requerido">requerido </span></label>
                <input type="email"  class="form-control"name="correo_empleados_firmante" placeholder="Correo Eléctronico" id="correo_empleados_firmante"  >
              </div>
            </div>





            <input type="hidden" id="id_empleado_es_firmante" name='id_empleado_firmante'>

            <br />
            <div class="field der" >
                <a class="btn btn-primary" onclick="agregarPersonalFirnamte()">
                    <i class="ui save white icon"></i>
                    Agregar
                </a>
            </div>

            <div role="separator" class="dropdown-divider"></div>
            <div class="row">
              <div class="col-md-12">
                <table id="tablaModuloIndexFrimante" class="table table-bordered table-checkable">

                  <thead>
                    <tr>
                      <th>Cargo</th>
                      <th>N° Empleado</th>
                      <th>Nombre</th>
                      <th>Puesto</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="cuerpos"></tbody>
                </table>
              </div>
            </div>


        </div>
        <!--///////////////// FIN FIRMANTES //////////////////////////////-->
      </div>

    </form>


</div>


</div>




<!--/////////////////////////////////////////////////////////////////-->


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js" integrity="sha512-TGClBy3S4qrWJtzel4qMtXsmM0Y9cap6QwRm3zo1MpVjvIURa90YYz5weeh6nvDGKZf/x3hrl1zzHW/uygftKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>




  $("#correo-empleado").change(function(){

  if ($("#correo-empleado").val() == '') {
  	Swal.fire("Lo Sentimos", "Favor de Llenar el Campo", "error");
  }else{
  	if($("#correo-empleado").val().indexOf('@', 0) == -1 || $("#correo-empleado").val().indexOf('.', 0) == -1) {

  	Swal.fire("Upss!", "El correo electrónico introducido no es correcto!", "error");
    $("#correo-empleado").val('')
  	}
  }
  });


  $("#correo_empleados_firmante").change(function(){

  if ($("#correo_empleados_firmante").val() == '') {
    Swal.fire("Lo Sentimos", "Favor de Llenar el Campo", "error");
  }else{
    if($("#correo_empleados_firmante").val().indexOf('@', 0) == -1 || $("#correo_empleados_firmante").val().indexOf('.', 0) == -1) {

    Swal.fire("Upss!", "El correo electrónico introducido no es correcto!", "error");
    $("#correo_empleados_firmante").val('')
    }
  }
  });





    //console.log(rol);
    let realiza_accion = 0;
    let id_area = 0;
    let id_padre = 0;
    let fotografia = 0;
    //let aNiveles = new Array ('Seleccionar nivel', 'Secretaría', 'Subsecretaría', 'Dirección General', 'Dirección', 'Subdirección', 'Departamento');
    let aNiveles = new Array ('Seleccionar nivel', 'Secretaría', 'Dirección General', 'Departamento');


    ///////////////////////////////////////////////////////////////////////////
    function validaNumericos(event) {
        if(event.charCode >= 48 && event.charCode <= 57){
          return true;
         }
         return false;
    }
    ///////////////////////////////////////////////////////////////////////////

    $(function() {
      //mloader(0);
      busca_areas (0);




      // $('.form-control.id_tipo').dropdown('restore defaults');
      //$('.form-control.nivel').dropdown('set selected', 1);

      $(".form-control.nivel option[value='1']").attr("selected",true);
      // $('.form-control.tipo').dropdown();
      // $('.nombre_areas').dropdown();

      var niveles     = $('#areaForm .form-control.nivel');
      niveles.dropdown({
          onChange: function(id, b, c) {
              $('#nivel').val(id);
              // $('.form-control.nivel').dropdown('set selected', id);
              $(".form-control.nivel option[value='"+ id +"']").attr("selected",true);
          }
      });

      // area


      $('#cve_cat_tipo').dropdown({
        onChange: function(_index, _value, c){
          busca_areas (0);
        }
      });

    })



    // Buscar areas
    function busca_areas (id) {
        var _cve_cat_tipo = '';
        var datos_rama       = [];

        //mloader(1);

        $('#divTree').jstree('destroy');
        $('#raiz').html('<div id="divTree" class="arbol"> </div>');

        // if($('input[name="cve_cat_tipo"]').val()!=''){
        //   _cve_cat_tipo = $('input[name="cve_cat_tipo"]').val();
        // }else{
        //   _cve_cat_tipo = '0';
        // }

        _cve_cat_tipo = '0';

        $.ajax({
            url: '/catalogos/comisionados/buscaAreas/0/1/'+_cve_cat_tipo,
            type: 'GET',
            headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')}
        })
        .always(function(r) {
            let areas = r[0];
            let tamano = Object.keys(areas).length;


            if (tamano > 0) {

                $.each( areas, function(key, value) {

                    var padre   = value.id_padre.toString();

                    padre       = (padre == '0' || tamano == 1) ? '#' : padre;
                    // cancela el elemento raiz
                    tamano = 0;
                    ///////////////////////////////////////////////////////////
                    //console.log(value)
                    ////////////////////////////////////////////////////////////

                    let t = '<div class="">';
                        t += '<div class="row " style=" padding: 0 0 0 28px !important; margin-top: -2rem !important;">';
                            t += '<div class="col-md-6">';
                            //t += '<span style="#ffffff;font-size:7pt;" >'+value.nombre +' - <strong style="font-size:4pt;">'+value.cve_t_empleado+'</strong></span>';
                                t += '<span style="#ffffff;font-size:6.5pt;" >'+value.nombre +'</span>';
                            t += '</div>';
                            t += '<div class="col-md-6" style="text-align: right !important;">';

                                @can('eliminar estructura')
                                    t += '<span class="caret" onclick="elimina_area(' +value.id +')" title ="Elimina área">';
                                      t += '<i class="fas fa-minus text-danger mr-5 icon-nm"> </i>';
                                    t += '</span>';
                                @endcan
                                @can('editar estructura')
                                t += '<span class="caret" onclick="editaArea(' +value.id +', ' +value.nivel+')" title ="Editar área">';
                                      t += '<i class="far fa-edit text-primary mr-5 icon-nm"> </i>';
                                t += '</span>';
                                @endcan
                                if (value.nivel == 5) {
                                  // t += '<span  class="caret"  title ="Agrega área">';
                                  //     t += '<i class="fas fa-plus text-primary mr-5 icon-nm" style="visibility:hidden;"> </i>';
                                  // t += '</span>';
                                }else{
                                  @can('crear nivel estrcutura')

                                  t += '<span class="caret" id="agregar_area" onclick="agrega_area(' +value.id +', ' +value.nivel +')" title ="Agrega área">';
                                    t += '<i class="fas fa-plus text-primary mr-5 icon-nm"> </i>';
                                  t += '</span>';
                                  @endcan
                                }
                                    @can('responsable estructura')
                                    t += '<span class="caret" onclick="agrega_responsable(' +value.id +', ' +value.nivel +')" title ="Agrega Responsable">';
                                        t += '<i class="far fa-user text-primary mr-5 icon-nm"> </i>';
                                    t += '</span>';
                                    @endcan
                                    @can('firmante estructura')
                                    t += '<span class="caret" onclick="agrega_firmantes(' +value.id +', ' +value.nivel +')" title ="Agrega Firmantes">';
                                        t += '<i class="fas fa-pencil-alt text-primary mr-5 icon-nm"> </i>';
                                    t += '</span>';
                                    @endcan

                            t += '</div>';
                        t += '</div>';
                        t += '</div>';

                    t += '</div>';



                    datos_rama.push({
                        'id': value.id.toString(),
                        'parent': padre,
                        'text': t,
                        'nombre': value.nombre,
                        'corto': value.corto,
                        'nivel': value.nivel,
                        'id_tipo': value.id_tipo,
                        'id_padre': value.id_padre
                    });

                });

                $('#divTree').jstree({
                    "core" : {
                        'data' : datos_rama,
                        "multiple" : false,
                        "animation" : 0
                    },
                    'data' : function (node) {
                        return { 'id' : node.id };
                    },
                    "plugins" : [
                        "contextmenu", "dnd", "search", "wholerow", "state"
                    ]
                });

                var to = false;
                $('#busca_area').keyup(function () {
                    if(to) { clearTimeout(to); }
                    to  = setTimeout(function () {
                            var v = $('#busca_area').val();
                            $('#divTree').jstree(true).search(v);
                        }, 250);
                });


                // area seleccionada
                $("#divTree").click(function (e) {
                    if (id_area == -1) {
                        $('#columna_crear_area').hide();
                        id_padre = 0;
                    }

                    limpiar();

                    var node = $("#divTree").jstree("get_selected");

                    $('#divTree').jstree("toggle_node", node);
                });
            }

            //mloader(0);
        });

        return false;
    }



    function agrega_area (id, nivel) {
        nivel_sugerido = nivel + 1;
        if (nivel_sugerido > 5)
          nivel_sugerido = 5;

          crea_menu(nivel_sugerido);

          id_padre = id;

          editaArea (0, nivel_sugerido);

    }

    function editaArea (id, nivel) {
        realiza_accion = (id == 0) ? 0 : 1;
        id_area = id;
        //console.log(rol);
        $('#columna_crear_area').hide();

        if (id == 0) {
            if(nivel>1){
              //console.log(nivel);
              // $("#clave").prop("disabled", true);
              $('#clave').val('-');
              // $("#corto").prop("disabled", true);
              $('#corto').val('-');
              //$('#oculta').hide();
              //$("#id_tipo").dropdown('set selected', 0);
              $("#id_tipo option[value='0']").attr("selected",true);
              $("#id_tipo").val(0);
              // $("#id_tipo").addClass('disabled');
            }else {
              $('#columna_crear_area').show();
              $('#crud').hide();
              $('#firmantes').hide();

            }
            $('#columna_crear_area').show();
            $('#crud').hide();
            $('#firmantes').hide();

            $('#btnGuarda').html('<i class="fas fa-save"></i> Guardar');
        }
        else {
            $.ajax({
                url: '/catalogos/comisionados/datos_area/' +id,
                type: 'GET',
                headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')}
            })
            .always(function(r) {

                id_padre = r.id_padre;
                //console.log(r);
                //$('.ui.dropdown.id_tipo').dropdown('set selected', r.id_tipo);
                // $('.form-control.nivel').dropdown('set selected', r.nivel);
                $(".form-control.nivel option[value='"+  r.nivel +"']").attr("selected",true);


                $('#nombre').val(r.nombre);
                //console.log("entro"+r.rol);

                if(id_padre<1){
                    if(r[0]==='ADMINDEPENDENCIA') {
                      $('#clave').val(r.clave);
                      // $("#clave").prop("disabled", true);

                      $('#centro_gestor').val(r.centro_gestor);
                      // $("#centro_gestor").prop("disabled", true);

                      $('#corto').val(r.corto);
                      $("#corto").prop("disabled", true);
                      //$('.form-control.tipo').dropdown('set selected', r.id_tipo);
                      $(".form-control.tipo option[value='"+  r.id_tipo +"']").attr("selected",true);
                      $('.form-control.tipo').prop('disabled', true);
                      $('.form-control.nivel').prop('disabled', true);




                      $('#nombre_area').val(r.nombre);


                      $('#nombre-empleado').val(r.nombre_us);
                      $('#apellido-p-empleado').val(r.ap_us);
                      $('#apellido-m-empleado').val(r.am_us);
                      $('#puesto-empleado').val(r.puesto);

                      $('#telefono-empleado').val(r.telefono);
                      $('#extension-empleado').val(r.extension);
                      $('#correo-empleado').val(r.correo);




                    } else {
                      $('#clave').val(r.clave);
                      $('#centro_gestor').val(r.centro_gestor);

                      $('#corto').val(r.corto);
                        // $('.form-control.tipo').dropdown('set selected', r.id_tipo);
                        $(".form-control.tipo option[value='"+  r.id_tipo +"']").attr("selected",true);

                    }
                } else {
                    $('#clave').val(r.clave);
                    $('#centro_gestor').val(r.centro_gestor);
                    //$('.form-control.tipo').dropdown('set selected', r.id_tipo);
                    $(".form-control.tipo option[value='"+  r.id_tipo +"']").attr("selected",true);

                    $('.form-control.tipo').prop('disabled', true);
                    $('.form-control.nivel').prop('disabled', true);

                    // $('.nombre_areas').dropdown('set selected', r.nombre);
                    $(".nombre_areas option[value='"+  r.nombre +"']").attr("selected",true);

                    $('.nombre_areas').addClass('disabled');
                    $('.form-control.nivel').addClass('disabled');

                    $('#nombre_area').val(r.nombre);

                    $('#nombre-empleado').val(r.nombre_us);
                    $('#apellido-p-empleado').val(r.ap_us);
                    $('#apellido-m-empleado').val(r.am_us);
                    $('#puesto-empleado').val(r.puesto);
                    $('#telefono-empleado').val(r.telefono);
                    $('#extension-empleado').val(r.extension);
                    $('#correo-empleado').val(r.correo);

                    $('#corto').val(r.corto);
                    // $("#centro_gestor").prop("disabled", true);
                    // $("#clave").prop("disabled", true);
                    //$('#clave').val('-');
                    // $("#corto").prop("disabled", true);
                    //$('#corto').val('-');
                    // $('.ui.dropdown.tipo').dropdown('set selected', 0);
                    $(".ui.dropdown.tipo option[value='0']").attr("selected",true);

                    $('.ui.dropdown.tipo').addClass('disabled');
                }





                $('#entidad').focus();

                id_area = r.id;

                $('#btnGuarda').html('<i class="save icon"></i> Actualizar');

                $('#columna_crear_area').show();
                $('#crud').hide();
                $('#firmantes').hide();

            });
        }
    }

    function mloader (opcion) {
        valor = (opcion == 1) ? 'show' : 'hide';
        $('.tiny.modal.loader')
          .modal(valor);
         return false;
    }

    function tree_open (valor) {

        if (valor == 1)
            $("#divTree").jstree("open_all");

        if (valor == 2)
            $("#divTree").jstree("close_all");

        $("#busca_area").val('');
    }

    function limpiar() {
        $("form input[type=text], form textarea").each(function() { this.value = '' });
        id_area = -1;
    }

    function regresa(opc) {
        let mensaje = (opc == 1) ? 'un apellido' : 'el nivel';
        notificacion('warning', {
            titulo: 'Error',
            mensaje: 'Favor de proporcionar ' +mensaje,
            icon: 'info'
        });
        setTimeout(function () {
            $('#paterno').focus();
        }, 2000);
    }

    function crea_menu (nivel) {
        // $('#div_nivel > .menu').empty();
        // $.each(aNiveles, function(index, ele){
        //     if (index == 0 || index >= nivel) {
        //         $('#div_nivel > .menu').append(
        //             "<div class='item' data-value='" +index +"'>" +index +"</div>"
        //         );
        //     }
        // });
        // $('.form-control.nivel').dropdown('set selected', nivel);
        //console.log(nivel);
        $(".form-control.nivel option[value='"+ nivel +"']").attr("selected",true);

        var esre = $("#id_tipo option[value='"+ nivel +"']").attr("selected",true);

      //  console.log(esre)


        $('#nivel').val(nivel);
        // $('#nivel').addClass('active');
        // $('#nivel').addClass('selected');
    }

    function elimina_area (id) {

      Swal.fire({
            title: "¿Esta seguro de eliminar el registro?",
          text: "No se podrá recuperar la información",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Aceptar",
          cancelButtonText: "Cancelar"
      }).then(function(result) {
          if (result.value) {

            $.ajax({

               type:"Delete",

               url:"/catalogos/comisionados/borrar",
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data:{
                  id:id,
               },

                success:function(data){
                  Swal.fire("", data.success, "success").then(function(){ location.href ="/catalogos/comisionados"; });

                }


            });


          }


    });

    }

    ///////////////////////// TABLA USUARIOS //////////////////////////////////
    var tabla = '';


    function agrega_responsable(id,nivel){
      //console.log(id,nivel)
        $.ajax({

           type:"POST",

           url:"/catalogos/comisionados/NivelEstructura",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
             id:id,
           },

            success:function(data){
              //console.log(data)

              for (var i = 0; i < data.length; i++) {

                 //console.log(data[i].id)
                $('#id_area_alta').html('<input type="hidden" name="id_areas" value="'+data[i].id+'">');
                $('#nombre_area_alta').html('<p style="font-size:12pt;font-weight: bold;">'+data[i].nombre+'</p>');
                $('#nombre_jefe_alta').html('<p style="font-size:12pt;font-weight: bold;">'+data[i].nombre_empleado+' '+data[i].apellido_p_empleado+' '+data[i].apellido_m_empleado+' <br> '+data[i].puesto_empleado+'</p>');


                $('#crud').show();
                $('#firmantes').hide();

                $('#columna_crear_area').hide();

                ///////////////////// tabla del personal dependiendo el departamento //////////////
                // $(function() {
                  tabla = $('#tablaModuloIndex').DataTable({
                    // processing: true,
                    // serverSide: true,
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    "bDestroy": true,
                    ajax:{
                      'type': 'GET',
                      'headers': {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                      'url' : '/catalogos/comisionados/tablaPersonal',
                      'data':{  id: data[i].id,}
                    },
                    //ajax: "/catalogos/comisionados/tablaPersonal",
                    //type: 'GET',
                    columns: [
                    //   { data: 'accion_estatus', name: 'accion_estatus' },
                      { data: 'numero_empleado', name: 'numero_empleado' },
                      { data: 'nombre', name: 'nombre' },
                      { data: 'puesto', name: 'puesto' },
                      { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
                    ],
                    createdRow: function ( row, data, index ) {
                      $(row).find('.ui.dropdown.acciones').dropdown();
                    },
                    language: { url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
                  });
                // });

              }





            }
        });

    }

    function agrega_firmantes(id,nivel){
      $.ajax({

         type:"POST",

         url:"/catalogos/comisionados/NivelEstructura",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
           id:id,
         },

          success:function(data){
            //console.log(data)

            for (var i = 0; i < data.length; i++) {

               //console.log(data[i].id)
              $('#id_area_alta_firmante').html('<input type="hidden" name="id_areas_firmante" value="'+data[i].id+'">');
              $('#nombre_area_alta_firmante').html('<p style="font-size:12pt;font-weight: bold;">'+data[i].nombre+'</p>');
              $('#nombre_jefe_alta_firmante').html('<p style="font-size:12pt;font-weight: bold;">'+data[i].nombre_empleado+' '+data[i].apellido_p_empleado+' '+data[i].apellido_m_empleado+' <br> '+data[i].puesto_empleado+'</p>');


              $('#crud').hide();
              $('#firmantes').show();

              $('#columna_crear_area').hide();

              ///////////////////// tabla del personal dependiendo el departamento //////////////
              // $(function() {
                tabla = $('#tablaModuloIndexFrimante').DataTable({
                  // processing: true,
                  // serverSide: true,
                  processing: true,
                  serverSide: true,
                  stateSave: true,
                  "bDestroy": true,
                  ajax:{
                    'type': 'GET',
                    'headers': {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                    'url' : '/catalogos/comisionados/tablaPersonalFirmantes',
                    'data':{  id: data[i].id,}
                  },
                  //ajax: "/catalogos/comisionados/tablaPersonal",
                  //type: 'GET',
                  columns: [
                    { data: 'cve_cargo', name: 'cve_cargo' },
                    { data: 'numero_empleado', name: 'numero_empleado' },
                    { data: 'nombre', name: 'nombre' },
                    { data: 'puesto', name: 'puesto' },
                    { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
                  ],
                  createdRow: function ( row, data, index ) {
                    $(row).find('.ui.dropdown.acciones').dropdown();
                  },
                  language: { url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
                });
              // });

            }





          }
      });
    }

    /////////////////////////////////////////////////////////////////////////
    function agregarPersonal(){
      var id_area_alta = $('input[name=id_areas]').val();
      var numero_empleados = $('input[name=numero-empleados]').val();
      var puesto_empleados = $('input[name=puesto_empleados]').val();
      var nombre_empleados = $('input[name=nombre-empleados]').val();
      var apellido_p_empleados = $('input[name=apellido_p_empleados]').val();
      var apellido_m_empleados = $('input[name=apellido_m_empleados]').val();
      var nivel_empleados = $('input[name=nivel_empleados]').val();



      if (numero_empleados == '' || puesto_empleados == '' || nombre_empleados == '' || apellido_p_empleados == '' || nivel_empleados == '') {

         Swal.fire("Los campos estan vacios", 'Debe llenar Campos Obligatorios', "warning");
      }else{

        $.ajax({

           type:"POST",

           url:"/catalogos/comisionados/ExistePersonal",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
             nombre_empleados:nombre_empleados,
             apellido_p_empleados:apellido_p_empleados,
             apellido_m_empleados:apellido_m_empleados,
           },
        }).always(function(r) {


            if (r == '') {
              $.ajax({

                 type:"POST",

                 url:"/catalogos/comisionados/AltaPersonal",
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 data:{
                   id_area_alta:$('input[name=id_areas]').val(),
                   numero_empleados:numero_empleados,
                   puesto_empleados:puesto_empleados,
                   nombre_empleados:nombre_empleados,
                   apellido_p_empleados:apellido_p_empleados,
                   apellido_m_empleados:apellido_m_empleados,
                   nivel_empleados:nivel_empleados,

                 },
              }).always(function(r) {

                  Swal.fire("Felicidades", r.success, "success").then(function(){ tabla.ajax.reload(); });

                $('input[name=numero-empleados]').val('');
                $('input[name=puesto_empleados]').val('');
                $('input[name=nombre-empleados]').val('');
                $('input[name=apellido_p_empleados]').val('');
                $('input[name=apellido_m_empleados]').val('');
                $('input[name=nivel_empleados]').val('');




              });
            }else{

               Swal.fire("Lo Sentimos", 'Esta Persona Ya existe en otro departamento', "warning");

               $('input[name=numero-empleados]').val('');
               $('input[name=puesto_empleados]').val('');
               $('input[name=nombre-empleados]').val('');
               $('input[name=apellido_p_empleados]').val('');
               $('input[name=apellido_m_empleados]').val('');
               $('input[name=nivel_empleados]').val('');

            }

        });




      }

    }



    function agregarPersonalFirnamte(){
      var id_areas_firmante = $('input[name=id_areas_firmante]').val();
      var numero_empleados_firmante = $('input[name=numero-empleados_firmante]').val();
      var puesto_empleados_firmante = $('input[name=puesto_empleados_firmante]').val();
      var nombre_empleados_firmante = $('input[name=nombre-empleados_firmante]').val();
      var apellido_p_empleados_firmante = $('input[name=apellido_p_empleados_firmante]').val();
      var apellido_m_empleados_firmante = $('input[name=apellido_m_empleados_firmante]').val();
      var correo_empleados_firmante = $('input[name=correo_empleados_firmante]').val();
      var cargo = $('select[name=cargo]').val();

      if (numero_empleados_firmante == '' || puesto_empleados_firmante == '' || nombre_empleados_firmante == '' || apellido_p_empleados_firmante == '' || correo_empleados_firmante == '' || cargo == '') {

         Swal.fire("Los campos estan vacios", 'Debe llenar Campos Obligatorios', "warning");
      }else{
        $.ajax({

           type:"POST",

           url:"/catalogos/comisionados/ExistePersonalFirmante",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
             nombre_empleados_firmante:nombre_empleados_firmante,
             apellido_p_empleados_firmante:apellido_p_empleados_firmante,
             apellido_m_empleados_firmante:apellido_m_empleados_firmante,
           },
        }).always(function(r) {


            if (r == '') {
              $.ajax({

                 type:"POST",

                 url:"/catalogos/comisionados/AltaPersonalFirmante",
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 data:{
                   id_areas_firmante:id_areas_firmante,
                   numero_empleados_firmante:numero_empleados_firmante,
                   puesto_empleados_firmante:puesto_empleados_firmante,
                   nombre_empleados_firmante:nombre_empleados_firmante,
                   apellido_p_empleados_firmante:apellido_p_empleados_firmante,
                   apellido_m_empleados_firmante:apellido_m_empleados_firmante,
                   correo_empleados_firmante:correo_empleados_firmante,
                   cargo:cargo,

                 },
              }).always(function(r) {

                  Swal.fire("Felicidades", r.success, "success").then(function(){ tabla.ajax.reload(); });

                  $('input[name=numero-empleados_firmante]').val('');
                  $('input[name=puesto_empleados_firmante]').val('');
                  $('input[name=nombre-empleados_firmante]').val('');
                  $('input[name=apellido_p_empleados_firmante]').val('');
                  $('input[name=apellido_m_empleados_firmante]').val('');
                  $('input[name=correo_empleados_firmante]').val('');
                  $('select[name=cargo]').prop('selectedIndex',0)




              });
            }else{

               Swal.fire("Lo Sentimos", 'Esta Persona Ya existe en otro departamento', "warning");

               $('input[name=numero-empleados_firmante]').val('');
               $('input[name=puesto_empleados_firmante]').val('');
               $('input[name=nombre-empleados_firmante]').val('');
               $('input[name=apellido_p_empleados_firmante]').val('');
               $('input[name=apellido_m_empleados_firmante]').val('');
               $('input[name=correo_empleados_firmante]').val('');
               $('select[name=cargo]').prop('selectedIndex',0)

            }

        });
      }


  //       console.log(id_areas_firmante,
  // numero_empleados_firmante,
  // puesto_empleados_firmante,
  // nombre_empleados_firmante,
  // apellido_p_empleados_firmante,
  // apellido_m_empleados_firmante,
  // correo_empleados_firmante,cargo)






    }


    function eliminar(id) {


      Swal.fire({
            title: "¿Esta seguro de eliminar el registro?",
            text: "No se podrá recuperar la información",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar"
        }).then(function(result) {
            if (result.value) {

              $.ajax({

                 type:"Delete",

                 url:"/catalogos/comisionados/destroy",
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 data:{
                    id:id,
                 },

                  success:function(data){
                    Swal.fire("", data.success, "success").then(function(){ tabla.ajax.reload(); });

                  }


              });


            }
        })


    }

    function eliminarfirmante(id){
      Swal.fire({
            title: "¿Esta seguro de eliminar el registro?",
            text: "No se podrá recuperar la información",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar"
        }).then(function(result) {
            if (result.value) {

              $.ajax({

                 type:"Delete",

                 url:"/catalogos/comisionados/destroyFirmante",
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 data:{
                    id:id,
                 },

                  success:function(data){
                    Swal.fire("", data.success, "success").then(function(){ tabla.ajax.reload(); });

                  }


              });


            }
        })
    }

    function enviarResponsable(){
      var id_area_seleccionada = $('input[name=este]').val();
      var puesto_empleado = $('input[name=puesto_empleado]').val();
      var correo_empleado = $('input[name=correo_empleado]').val();
      var id_empleado = $('#id_empleado_es').val();
      var telefono = $('input[name=telefono]').val();

      var cve_cat_tipo_resp = $('input[name=cve_cat_tipo_resp]').val();
      var cve_cat_tipo_aut = $('input[name=cve_cat_tipo_aut]').val();
      var cve_cat_personal_compras = $('input[name=cve_cat_personal_compras]').val();


      //console.log(cve_cat_personal_compras);


      if (cve_cat_personal_compras > 0) {
        $.ajax({

           type:"POST",

           url:"/catalogos/comisionados/EditarResponsableArea",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
             id_area_seleccionada:id_area_seleccionada,
             puesto_empleado:puesto_empleado,
             correo_empleado:correo_empleado,
             id_empleado:id_empleado,
             telefono:telefono,
             cve_cat_tipo_resp:cve_cat_tipo_resp,
             cve_cat_tipo_aut:cve_cat_tipo_aut,
             cve_cat_personal_compras:cve_cat_personal_compras,
           },
        }).always(function(r) {
            notificacion(r.style, {
                titulo: r.titulo,
                mensaje: r.mensaje,
                icon: r.icon
            });

            $('#cve_cat_tipo_resp').dropdown('restore defaults');
            $('#cve_cat_tipo_aut').dropdown('restore defaults');

            $('#anexar_bitacora').modal('hide');


        });
      }else{
        $.ajax({

           type:"POST",

           url:"/catalogos/comisionados/AgregarResponsableArea",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
             id_area_seleccionada:id_area_seleccionada,
             puesto_empleado:puesto_empleado,
             correo_empleado:correo_empleado,
             id_empleado:id_empleado,
             telefono:telefono,
             cve_cat_tipo_resp:cve_cat_tipo_resp,
             cve_cat_tipo_aut:cve_cat_tipo_aut,
           },
        }).always(function(r) {
            notificacion(r.style, {
                titulo: r.titulo,
                mensaje: r.mensaje,
                icon: r.icon
            });

            $('#cve_cat_tipo_resp').dropdown('restore defaults');
            $('#cve_cat_tipo_aut').dropdown('restore defaults');

            $('#anexar_bitacora').modal('hide');


        });
      }






    }


    ////////////////////////////////////////////////////////////////////////////

    $('.ui.dropdown.dependencias').dropdown();
    $('.ui.dropdown.responsabilidad').dropdown();
    $('.ui.dropdown.autorizacion').dropdown();
    ///////////////////////////////////////////////////////////////////////////
    //////////// BUSCAR ///////////////////////////////////
    function searchCorral(){

      return {
        url: "/catalogos/comisionados/buscarPersonas/{query}",
        onResponse: function(res){
          let data = [];
          $.each(res.datos, function(index, val) {
            //console.log(val.correos+' '+val.apellidos);
            data.push({

              title : val.nombres+' '+val.apellidos.toUpperCase(),

                  description : val.secretaria,
                  datos: val
            });
          });

          return {results: data}
        }
      }


    }

    function limpiarCamposCorral(){
      $('#nombre-empleado').val('');
      $('#apaterno').val('');
      $('#amaterno').val('');
      $('#curp').val('');
      $('#num_empleado').val('');
      $('#puesto-empleado').val('');
      $('#correo-empleado').val('');
      $('#dependencia').val('');
      $('#area').val('');
      $('#search-upp').val('');
    }






    function modalBaja(){
      $('#baja').modal('show');
      let meses = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ];
      //////////////////////////////// FECHA //////////////////////////////////////
      $('#fechaFinal_4').calendar({

        type: 'date',
        ampm: false,
        formatter: {
          date: function (date, settings) {
            if (!date) return '';
            var day = date.getDate() + '';
            if (day.length < 2) {
              day = '0' + day;
            }
            var month = meses[date.getMonth()];
            var year = date.getFullYear();
            $('input[name=fechaFinal_4]').val(formatearFecha(date));
            return day + '/' + month + '/' + year;
          }
        }
      });
    }


    function botonBaja(){
      var fechaFinal_4 = $('input[name=fechaFinal_4]').val();
      var motivo_baja = $('textarea[name=motivo_baja]').val();
      var cve_cat_personal_compras = $('input[name=cve_cat_personal_compras]').val();

      $.ajax({

         type:"POST",

         url:"/catalogos/comisionados/BajaResponsableArea",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
           fechaFinal_4:fechaFinal_4,
           motivo_baja:motivo_baja,
           cve_cat_personal_compras:cve_cat_personal_compras,

         },
      }).always(function(r) {
          notificacion(r.style, {
              titulo: r.titulo,
              mensaje: r.mensaje,
              icon: r.icon
          });

          $('#baja').modal('hide');


      });

    }

    function guardarEstructura(){



                      if ($('#nivel').val() == 0) {
                          let opc = ($('#nivel').val() == 0) ? 0 : 1;
                          regresa(opc);
                          return false;
                      }else {
                          //$('#areaForm').addClass('loading');

                          // var form            = document.getElementById("needs-validation");

                          ////////////////////////////////////
                          // var nombre_empleado = $('#nombre-empleado').val();
                          // var apellido_p_empleado = $('#apellido-p-empleado').val();
                          // var apellido_m_empleado = $('#apellido-m-empleado').val();
                          var puesto_empleado = $('#puesto-empleado').val();

                          var nombre_empleado = $('#nombre-empleado').val();
                          var apellido_p_empleado = $('#apellido-p-empleado').val();
                          var apellido_m_empleado = $('#apellido-m-empleado').val();
                          var cve_usuario_empleado = $('#cve_usuario_empleado').val();

                          var telefono_empleado = $('input[name=telefono_empleado]').val();
                          var extension = $('input[name=extension]').val();
                          var correo = $('input[name=correo]').val();







                          var nivel = $('select[name=nivel]').val();
                          var id_tipo = $('select[name=id_tipo]').val();
                          //var nombre = $('select[name=nombre]').val();
                          var nombre = $('input[name=nombre_area]').val();



                          var formData        = new FormData ();

                          formData.append('id_padre', id_padre);
                          formData.append('nombre_empleado', nombre_empleado);
                          formData.append('apellido_p_empleado', apellido_p_empleado);
                          formData.append('apellido_m_empleado', apellido_m_empleado);
                          formData.append('puesto_empleado', puesto_empleado);

                          formData.append('telefono_empleado', telefono_empleado);
                          formData.append('extension', extension);
                          formData.append('correo', correo);


                          formData.append('nivel', nivel);
                          formData.append('id_tipo', id_tipo);
                          formData.append('nombre', nombre);




                          liga    = '/catalogos/comisionados/';
                          metodo  = 'POST';
                          liga   += (realiza_accion == 0) ? 'create_area' : 'update_area/' +id_area;

                          $.ajax({
                              url: liga,
                              type: metodo,
                              headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                              data: formData,
                              contentType: false,
                              cache: false,
                              processData: false
                          })
                          .always(function(r) {

                            Swal.fire({
                                  title: "",
                                  text: r.success,
                                  icon: "success",
                                  timer: 1500,
                                  showConfirmButton: false,
                              }).then(function(result) {


                              });


                              setTimeout(function () {
                                  $('#columna_crear_area').hide();
                                  $('#crud').hide();
                                  $('#firmantes').hide();

                                  limpiar ();
                                  busca_areas (0);
                                  tree_open(1);
                              }, 1000);
                              // recarga lista

                          });     // ajax
                      }

      // var form = document.querySelectorAll('.needs-validation')
      // //console.log(form)
      // // Loop over them and prevent submission
      // Array.prototype.slice.call(form)
      //   .forEach(function (form) {
      //     form.addEventListener('click', function (event) {
      //       if (!form.checkValidity()) {
      //         event.preventDefault()
      //         event.stopPropagation()
      //       }else{
      //         ///////////////////////////////////////////////////////
      //
      //
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
