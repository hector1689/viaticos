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
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Dependencia: </label>
                  <!-- <input type="text" class="form-control" id="dependencia" placeholder="Dependencia"  value="@isset($folios) {{ $folios->dependencia }} @endisset"required> -->
                  <select class="form-control" id="dependencia" onchange="encargado()" required>
                    @isset($folios)
                    <option value="{{ $folios->dependencia }}">{{ $folios->obtenerArea->nombre }}</option>
                    @else
                    <option value="">Seleccionar</option>
                    @endisset
                    @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Dependencia
                  </div>
              </div>
              <!-- <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Dirección de área: </label>
                  <input type="text" class="form-control" id="direccion_area" placeholder="Dirección de área" value="@isset($folios) {{ $folios->direccion_area }} @endisset" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Dirección de área
                  </div>
              </div> -->

            </div>
            <div class="row">
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Director Administrativo: </label>
                  <input type="text" class="form-control" id="director_administrativo" placeholder="DIrector Administrativo" value="@isset($folios) {{ $folios->director_administrativo }} @endisset" disabled required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Director Administrativo
                  </div>
              </div>
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Comisario: </label>
                  <input type="text" class="form-control" id="comisario" placeholder="Comisario" value="@isset($folios) {{ $folios->comisario }} @endisset" required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Comisario
                  </div>
              </div>
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Superior Inmediato: </label>
                  <input type="text" class="form-control" id="superior_inmediato" placeholder="Superios Inmediato" value="@isset($folios) {{ $folios->superior_inmediato }} @endisset" disabled required>
                  <div class="invalid-feedback">
                    Por Favor Ingrese Superior Inmediato
                  </div>
              </div>

            </div>
          </div>
          <div class="col-md-6">
            <!-- <div class="row">
              <div class="col-md-6">
                <label class="checkbox">
                    <input type="checkbox" name="page" >
                    <span></span>
                     Generar Folio Automaticamente
                </label>
              </div>
              <div class="col-md-6">

              </div>
            </div> -->
            <label for=""><strong style="color:red">*</strong> diagonales se ponen automaticamente</label>
            <div role="separator" class="dropdown-divider"></div>
            <div class="row">
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Tipo de Folio: </label>
                  <select class="form-control" name="tipo_folio">
                    <option >Seleccionar</option>
                    <option value="1">Recibo</option>
                    <option value="2">Oficio de Comisión</option>
                  </select>
              </div>
              <div class="col-md-6">

              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Siglas Dependencia: </label>
                  <input type="text" class="form-control" id="siglas_dependencia" onchange="siglas1()" placeholder="Siglas Dependencia" data-nivel="1">
              </div>
              <div class="col-md-6">
                <label for="inputPassword4" style="font-size:12px;" class="form-label">Posición 1: </label>
                <select class="form-control" name="posicion_1" onchange="posicion1()" disabled>
                  <option >Seleccionar</option>
                  <option value="1">Siglas de Dependencia</option>
                  <option value="2">Siglas tipo de folio</option>
                  <option value="3">Año</option>
                  <!-- <option value="4">Consecutivo</option> -->
                </select>

              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Siglas tipo de folio: </label>
                  <input type="text" class="form-control" id="siglas_folio" onchange="siglas2()" placeholder="Siglas tipo de folio" data-nivel="2">
              </div>
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Posición 2: </label>
                  <select class="form-control" name="posicion_2" onchange="posicion2()" disabled>
                    <option >Seleccionar</option>
                    <option value="1">Siglas de Dependencia</option>
                    <option value="2">Siglas tipo de folio</option>
                    <option value="3">Año</option>
                    <!-- <option value="4">Consecutivo</option> -->
                  </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Año: </label>
                  <input type="text" class="form-control" id="anio" onchange="siglas3()" onkeypress='return validaNumericos(event)' placeholder="Año" data-nivel="3">
              </div>
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Posición 3: </label>
                  <select class="form-control" name="posicion_3" onchange="posicion3()" disabled>
                    <option >Seleccionar</option>
                    <option value="1">Siglas de Dependencia</option>
                    <option value="2">Siglas tipo de folio</option>
                    <option value="3">Año</option>
                    <!-- <option value="4">Consecutivo</option> -->
                  </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Consecutivo: </label>
                  <input type="text" class="form-control" id="consecutivo" onchange="siglas4()" onkeypress='return validaNumericos(event)' placeholder="Consecutivo" data-nivel="4">
              </div>
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Posición 4: </label>
                  <select class="form-control" name="posicion_4" onchange="posicion4()" disabled>
                    <option >Seleccionar</option>
                    <!-- <option value="1">Siglas de Dependencia</option>
                    <option value="2">Siglas tipo de folio</option>
                    <option value="3">Año</option> -->
                    <option value="4">Consecutivo</option>
                  </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">

              </div>
              <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;visibility:hidden;" class="form-label">Siglas Dependencia: </label><br>
                  <button type="button" class="btn btn-primary" onclick="Agregar()">Agregar</button>

              </div>

            </div>
            <div role="separator" class="dropdown-divider"></div>
            <div class="col-md-12">
                <table class="table" id="tabla">
                  <thead>
                      <tr>
                          <th scope="col">Tipo de folio</th>
                          <th scope="col">Foliador</th>
                          <!-- <th scope="col">Folio actual</th> -->
                          <th scope="col">Acciones</th>
                      </tr>
                  </thead>
                  <tbody>
                    @isset($tabla_folios)
                        @foreach($tabla_folios as $key => $folio)
                          <tr id="orden_{{$key}}">
                            <td>
                              <?php

                                if ($folio->tipo_folio == 1) {
                                  echo 'Recibo';
                                }else{
                                  echo 'Oficio de Comisión';
                                }

                               ?>
                            </td>
                            <td>{{ $folio->foliador }}</td>
                            <td style=" text-align: center;"><div class="btn btn-danger " onclick="borrarFolios({{ $folio->id }},{{$key}})" ><i  class="fas fa-trash"></i></div></td>
                          </tr>
                        @endforeach
                    @endisset
                  </tbody>
                </table>
            </div>
            <div role="separator" class="dropdown-divider"></div>
            <div class="col-md-8">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Usuarios que usaran esta configuración: </label>
              <select class="form-control" name="usuario" id="usuarios" @isset($folios) @else required @endisset>
                @isset($folios)
                <option value="{{ $folios->cve_usuario_inmediato }}">{{$folios->obteneUsuario->nombre}} {{$folios->obteneUsuario->apellido_paterno}} {{$folios->obteneUsuario->apellido_materno}}</option>
                @else
                <option value="">Seleccionar</option>
                @endisset
                @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->nombre }} {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }} - {{ $usuario->name }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Por Favor Seleccionar Usuario
              </div>
            </div>

          </div>
        </div>





</div>
<div class="card-footer">

  <a href="/catalogos/folios" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="guardar()">Guardar</a>
</div>
</form>
</div>
<script type="text/javascript">
var arrayPosicion = [];
var array_tabla = [];
var array_table = [];
var objPosicion = {};
var arrayNivel = [];
var objTabla = {};


        function validaNumericos(event) {
            if(event.charCode >= 48 && event.charCode <= 57){
              return true;
             }
             return false;
        }

        @isset($folios)
        $.ajax({

               type:"POST", //si existe esta variable usuarios se va mandar put sino se manda post

               url:"/catalogos/folios/TraerFirmantes", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
               },
               data:{
                   area_encargada: {{ $folios->dependencia}},
                 },
                success:function(data){
                  //console.log(data)
                  for (var i = 0; i < data.length; i++) {
                      var nombre = data[i].nombre+' '+data[i].apellido_paterno+' '+data[i].apellido_materno;
                    if (data[i].cve_cargo == 1) {
                      $('#director_administrativo').val(nombre);
                    }

                  }

                }
          });
        @endisset

        function encargado(){
            var dependencia = $('#dependencia').val();
            $.ajax({

                   type:"POST", //si existe esta variable usuarios se va mandar put sino se manda post

                   url:"/catalogos/folios/TraerEncargado", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
                   },
                   data:{
                       dependencia:dependencia,
                     },
                    success:function(data){
                      //console.log(data)

                      $('#superior_inmediato').val(data.nombre_empleado+' '+data.apellido_p_empleado+' '+data.apellido_m_empleado);

                      $.ajax({

                             type:"POST", //si existe esta variable usuarios se va mandar put sino se manda post

                             url:"/catalogos/folios/TraerFirmantes", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
                             headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
                             },
                             data:{
                                 area_encargada:data.id,
                                 cve_cat_deptos_siti:data.cve_cat_deptos_siti
                               },
                              success:function(data){
                                //console.log(data)
                                for (var i = 0; i < data.length; i++) {
                                    var nombre = data[i].nombre+' '+data[i].apellido_paterno+' '+data[i].apellido_materno;
                                  if (data[i].cve_cargo == 1) {
                                    $('#director_administrativo').val(nombre);
                                  }

                                }

                              }
                        });


                    }
              });

        }


        $('#dependencia').select2({
          width: '100%',
        });

        function siglas1(){
          var siglas_dependencia = $('#siglas_dependencia').val();
          $('select[name=posicion_1]').prop('disabled',false);
        }

        function siglas2(){
          var siglas_folio = $('#siglas_folio').val();
          $('select[name=posicion_2]').prop('disabled',false);

        }

        function siglas3(){
          var anio = $('#anio').val();
          $('select[name=posicion_3]').prop('disabled',false);

        }

        function siglas4(){
          var consecutivo = $('#consecutivo').val();
          $('select[name=posicion_4]').prop('disabled',false);
        }



        function posicion1(){
          var posicion_1 = $('select[name=posicion_1]').val();


          nivel_siglas = parseInt($('#siglas_dependencia').attr('data-nivel'));
          nivel_siglas_folio = parseInt($('#siglas_folio').attr('data-nivel'));
          nivel_siglas_anio = parseInt($('#anio').attr('data-nivel'));
          nivel_siglas_consecutivo = parseInt($('#consecutivo').attr('data-nivel'));


          if (posicion_1 == nivel_siglas) {
            var valor = $('#siglas_dependencia').val();
          }else if(posicion_1 == nivel_siglas_folio){
            var valor = $('#siglas_folio').val();
          }else if(posicion_1 == nivel_siglas_anio){
            var valor = $('#anio').val();
          }else if(posicion_1 == nivel_siglas_consecutivo){
            var valor = $('#consecutivo').val();
          }

          arrayPosicion.push({
            posicion:posicion_1,
            valor:valor,
          });
        }

        function posicion2(){
          var posicion_2 = $('select[name=posicion_2]').val();
          nivel_siglas = parseInt($('#siglas_dependencia').attr('data-nivel'));
          nivel_siglas_folio = parseInt($('#siglas_folio').attr('data-nivel'));
          nivel_siglas_anio = parseInt($('#anio').attr('data-nivel'));
          nivel_siglas_consecutivo = parseInt($('#consecutivo').attr('data-nivel'));


          if (posicion_2 == nivel_siglas) {
            var valor = $('#siglas_dependencia').val();
          }else if(posicion_2 == nivel_siglas_folio){
            var valor = $('#siglas_folio').val();
          }else if(posicion_2 == nivel_siglas_anio){
            var valor = $('#anio').val();
          }else if(posicion_2 == nivel_siglas_consecutivo){
            var valor = $('#consecutivo').val();
          }
            arrayPosicion.push({
              posicion:posicion_2,
              valor:valor,
            });
        }

        function posicion3(){
          var posicion_3 = $('select[name=posicion_3]').val();
          nivel_siglas = parseInt($('#siglas_dependencia').attr('data-nivel'));
          nivel_siglas_folio = parseInt($('#siglas_folio').attr('data-nivel'));
          nivel_siglas_anio = parseInt($('#anio').attr('data-nivel'));
          nivel_siglas_consecutivo = parseInt($('#consecutivo').attr('data-nivel'));


          if (posicion_3 == nivel_siglas) {
            var valor = $('#siglas_dependencia').val();
          }else if(posicion_3 == nivel_siglas_folio){
            var valor = $('#siglas_folio').val();
          }else if(posicion_3 == nivel_siglas_anio){
            var valor = $('#anio').val();
          }else if(posicion_3 == nivel_siglas_consecutivo){
            var valor = $('#consecutivo').val();
          }
          arrayPosicion.push({
            posicion:posicion_3,
            valor:valor,
          });
        }

        function posicion4(){
          var posicion_4 = $('select[name=posicion_4]').val();
          nivel_siglas = parseInt($('#siglas_dependencia').attr('data-nivel'));
          nivel_siglas_folio = parseInt($('#siglas_folio').attr('data-nivel'));
          nivel_siglas_anio = parseInt($('#anio').attr('data-nivel'));
          nivel_siglas_consecutivo = parseInt($('#consecutivo').attr('data-nivel'));


          if (posicion_4 == nivel_siglas) {
            var valor = $('#siglas_dependencia').val();
          }else if(posicion_4 == nivel_siglas_folio){
            var valor = $('#siglas_folio').val();
          }else if(posicion_4 == nivel_siglas_anio){
            var valor = $('#anio').val();
          }else if(posicion_4 == nivel_siglas_consecutivo){
            var valor = $('#consecutivo').val();
          }
          arrayPosicion.push({
            posicion:posicion_4,
            valor:valor,
          });
        }

        function Agregar(){
          var tipo = $('select[name=tipo_folio]').val();

          var folio = arrayPosicion[0]['valor']+'/'+arrayPosicion[1]['valor']+'/'+arrayPosicion[2]['valor']+'/'+arrayPosicion[3]['valor'];
          // console.log(folio)

          objTabla = {
           tipo : tipo,
           folio : folio,
        };

        array_table.push({
         tipo : tipo,
         folio : folio,
         posicion1:arrayPosicion[0]['valor'],
         posicion2:arrayPosicion[1]['valor'],
         posicion3:arrayPosicion[2]['valor'],
         posicion4:arrayPosicion[3]['valor']
        });

        indexH = array_tabla.push(objTabla);
        objTabla.id = indexH;
        //console.log(array_table[0]);
        var nombre = '';
        if (objTabla.tipo == 1) {
          nombre = 'Recibo';
        }else{
          nombre = 'Oficio de Comisión'
        }

        var tr = '<tr id="filas'+objTabla.id+'">'+
        + objTabla.tipo +
        //'<td><input type="hidden" id="figura_nueva" value="'+objTabla.id+'"/>'+
        '<td><input type="hidden" id="figura_nueva" value="'+objTabla.id+'"/>'+nombre+'</td>'+
        '<td>'+ objTabla.folio +'</td>'+
        '<td style=" text-align: center; "><div class="btn btn-danger borrar_figura" onclick="eliminarFolioOficial('+objTabla.id+')" ><i  class="fas fa-trash"></i></div></td>'
        '</tr>';

        $("#tabla").append(tr);

        $('select[name=posicion_1]').prop('selectedIndex',0)

        $('select[name=posicion_2]').prop('selectedIndex',0)

        $('select[name=posicion_3]').prop('selectedIndex',0)

        $('select[name=posicion_4]').prop('selectedIndex',0)

        $('select[name=tipo_folio]').prop('selectedIndex',0)



        $('select[name=posicion_1]').prop('disabled',true)

        $('select[name=posicion_2]').prop('disabled',true)

        $('select[name=posicion_3]').prop('disabled',true)

        $('select[name=posicion_4]').prop('disabled',true)

        $('#siglas_dependencia').val('');

        $('#siglas_folio').val('');

        $('#anio').val('');

        $('#consecutivo').val('');

        arrayPosicion.length=0;

        }

        function eliminarFolioOficial(id){

          arrayPosicion.splice(id,1);
          $('#filas'+id).remove();

        }

        function borrarFolios(id,id_key){

          ///////////////////////////////////////////////////////7
          $.ajax({

                 type:"POST", //si existe esta variable usuarios se va mandar put sino se manda post

                 url:"/catalogos/folios/borrarFolio", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
                 },
                 data:{
                     id:id,
                   }
            });

            $('#orden_'+id_key).remove();


        }
        function guardar(){

          var dependencia = $('#dependencia').val();
          var direccion_area = $('#direccion_area').val();
          var director_administrativo = $('#director_administrativo').val();
          var comisario = $('#comisario').val();
          var superior_inmediato = $('#superior_inmediato').val();
          var usuarios = $('select[name=usuario]').val();
          @isset($folios)
          var id  = {{ $folios->id }};
          @else
          var id = 0;
          @endisset

            // var formData = new FormData();
            //  //formData.append('photo', $avatarInput[0].files[0]);
            //
            // @isset($folios)
            // formData.append('id',{{ $folios->id }});
            // @endisset
            // formData.append('dependencia', dependencia);
            // formData.append('direccion_area', direccion_area);
            // formData.append('director_administrativo', director_administrativo);
            // formData.append('comisario', comisario);
            // formData.append('superior_inmediato', superior_inmediato);
            // formData.append('usuarios', usuarios);
            //
            //
            // formData.append('tabla', array_table[0]);


            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var form = document.querySelectorAll('.needs-validation')
            //console.log(form)
            // Loop over them and prevent submission
            Array.prototype.slice.call(form)
              .forEach(function (form) {
                form.addEventListener('click', function (event) {
                  if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                  }else{
                    ///////////////////////////////////////////////////////7
                    $.ajax({

                           type:"POST", //si existe esta variable usuarios se va mandar put sino se manda post

                           url:"{{ ( isset($folios) ) ? '/catalogos/folios/update' : '/catalogos/folios/create' }}", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
                           headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
                           },
                           data:{
                               array_table : array_table,
                               dependencia:dependencia,
                               direccion_area:direccion_area,
                               director_administrativo:director_administrativo,
                               comisario:comisario,
                               superior_inmediato:superior_inmediato,
                               usuarios:usuarios,
                               id:id,
                             },
                           //data: formData,
                           //processData: false,
                           //contentType: false,
                           //cache:false,
                            success:function(data){
                              if (data.success == 'Registro agregado satisfactoriamente') {
                                Swal.fire("", data.success, "success").then(function(){
                                  location.href ="/catalogos/folios";
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
                                        location.href ="/catalogos/folios"; //esta es la ruta del modulo
                                      }
                                  })

                              }else if(data.success == 'Ha sido editado con éxito'){

                                Swal.fire("", data.success, "success").then(function(){
                                  location.href ="/catalogos/folios";
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
                                        location.href ="/catalogos/folios";
                                      }
                                  })
                              }


                            }
                      });

                    /////////////////////////////////////////////////////////
                  }

                  form.classList.add('was-validated')
                }, false)
              });


        }
</script>
@endsection
