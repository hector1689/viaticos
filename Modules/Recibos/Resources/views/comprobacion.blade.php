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
                <select class="form-control" name="" disabled>
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
                <input type="text" class="form-control" id="n_empleado" onchange="Empleado()" disabled value="@isset($recibos) {{$recibos->num_empleado}} @endisset" placeholder="N° de Empleado" required>
                <div class="invalid-feedback">
                  Por Favor Ingrese Nombre
                </div>
            </div>
            <div class="col-md-4">
                <label for="inputPassword4" style="font-size:12px;" class="form-label">Nombre: </label>
                <input type="text" class="form-control" id="nombre_empleado"  placeholder="Nombre" disabled  value="@isset($recibos) {{$recibos->nombre}} @endisset" disabled required>
                <div class="invalid-feedback">
                  Por Favor Ingrese Apellido Paterno
                </div>
            </div>
            <div class="col-md-2">
                <label for="inputPassword4" style="font-size:12px;" class="form-label">RFC: </label>
                <input type="text" class="form-control" id="rfc"  placeholder="RFC" disabled value="@isset($recibos) {{$recibos->rfc}} @endisset" required>
                <div class="invalid-feedback">
                  Por Favor Ingrese Apellido Materno
                </div>
            </div>
            <div class="col-md-2">
                <label for="inputPassword4" style="font-size:12px;" class="form-label">Nivel: </label>
                <input type="text" class="form-control" id="nivel"  placeholder="Nivel" disabled value="@isset($recibos) {{$recibos->nivel}} @endisset" disabled required>
                <div class="invalid-feedback">
                  Por Favor Ingrese Apellido Materno
                </div>
            </div>
            <div class="col-md-2">
                <label for="inputPassword4" style="font-size:12px;" class="form-label">Clave Departamental: </label>
                <input type="text" class="form-control" id="clave_departamental" disabled  placeholder="Clave Departamental" value="@isset($recibos) {{$recibos->clave_departamental}} @endisset" required>
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
              <input type="text" class="form-control datetimepicker-input" name="fecha_inicial" data-target="#kt_datetimepicker_1" disabled value="@isset($recibos) {{$fecha1}} @endisset" placeholder="Fecha y Hora de Salida">
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
              <input type="text" class="form-control datetimepicker-input"  name="fecha_final" data-target="#kt_datetimepicker_2" disabled  value="@isset($recibos) {{$fecha2}} @endisset" placeholder="Fecha y Hora de Recibido">
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
                <input type="text" class="form-control" id="lugar_adscripcion"   placeholder="Lugar de Adscripción" value="@isset($recibos) {{$recibos->lugar_adscripcion}} @endisset" disabled required>
                <div class="invalid-feedback">
                  Por Favor Ingrese Apellido Paterno
                </div>
            </div>
            <!-- <div class="col-md-2">
                <label for="inputPassword4" style="font-size:12px;" class="form-label">N° de dias: </label>
                <input type="text" class="form-control" id="n_dias"  placeholder="N° de dias" value="@isset($recibos) {{$recibos->num_dias}} @endisset" required>

                <div class="invalid-feedback">
                  Por Favor Ingrese Apellido Paterno
                </div>
            </div>
            <div class="col-md-2">
                <label for="inputPassword4" style="font-size:12px;" class="form-label">N° de dias inhabiles: </label>
                <input type="text" class="form-control" id="n_dias_ina"  placeholder="N° de dias inhabiles" value="@isset($recibos) {{$recibos->num_dias_inhabiles}} @endisset" required>

                <div class="invalid-feedback">
                  Por Favor Ingrese Apellido Materno
                </div>
            </div> -->
          </div>
          <input type="hidden" id="id_recibo" value="{{ $recibos->id }}">
          <div class="row">
            <div class="col-md-12">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Descripcion de la Comisión: </label>
              <input type="text" class="form-control" id="descripcion" disabled placeholder="Descripcion de la Comisión" value="@isset($recibos) {{$recibos->descripcion_comision}} @endisset" required>
            </div>
         </div>
         <div role="separator" class="dropdown-divider"></div>
           <div class="row">
             <div class="col-md-6">
                 <label for="inputPassword4"  style="font-size:12px;"class="form-label">Adjuntar: </label>
                 <input type="file"  id="archivo" class="form-control" >
             </div>

             <div class="col-md-6">
                 <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Adjuntar: </label><br>
                 <button type="button" class="btn btn-primary" name="button" onclick="agregararchivo()">Agregar</button>
             </div>


           </div>

           <div role="separator" class="dropdown-divider"></div>
           <div class="row">
             <div class="col-md-12">
                 <table class="table" id="tabla">
                   <thead>
                       <tr>
                           <th scope="col">Archivo</th>
                           <th scope="col">Acciones</th>
                       </tr>
                   </thead>
                   <tbody>

                   </tbody>
                 </table>
             </div>
           </div>
    </div>
    <div class="card-footer">

      <a href="/recibos" class="btn btn-default">Regresar</a>

      <!-- <a class="btn btn-primary " onclick="guardar()">Guardar</a> -->
    </div>
  </form>
</div>

<script type="text/javascript">
var arrayArchivo = [];
var arrayTablaArchivo = [];
var objTabla = {};

var tabla;
$(function() {
tabla = $('#tabla').DataTable({
  // processing: true,
  // serverSide: true,
  // order: [[0, 'desc']],
  // ajax: {
  //   url: "/recibos/tablaComprobacion",
  // },
  processing: true,
  serverSide: true,
  order: [[0, 'desc']],
  "bDestroy": true,
    ajax:{
        'type': 'POST',
        'headers': {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
        'url' : '/recibos/tablaComprobacion',
        'data':{
                  id:{{ $recibos->id }},
        }
    },
  columns: [
    { data: 'archivo', name : 'archivo'},
    { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
  ],
  createdRow: function ( row, data, index ) {
    $(row).find('.ui.dropdown.acciones').dropdown();
  },
  language: { url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
});
});



  function agregararchivo(){

    var id = $('#id_recibo').val();


    var archivo = $('#archivo').val();
      if (archivo == '') {
      var archivos = 0;
      }else{
        var archivos = $('#archivo').prop('files')[0];
      //console.log(archivo_nombre)
      }


    var formData = new FormData();
     //formData.append('photo', $avatarInput[0].files[0]);


    formData.append('id', id);
    formData.append('archivos', archivos);

    $.ajax({

           type:"POST",

           url:"/recibos/comprobar",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           // data:{
           //   id:id,
           //   archivos:arrayArchivo,
           // },
           data: formData,
           processData: false,
           contentType: false,
           cache:false,
           // processData: false,

            success:function(data){
            //  console.log(data)
              if (data.success == 'Archivo Agregado Exitosamente') {

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
                        tabla.ajax.reload();
                      }
                  })

              }

            }
      });

  }

  function eliminar(id){
  //console.log(id);
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

             url:"/recibos/borrarComprobante",
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
</script>
@endsection
