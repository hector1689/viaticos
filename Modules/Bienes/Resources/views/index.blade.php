@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
  Bienes Controlables y Activos
</h3>
<div class="card-toolbar">
            <div class="dropdown dropdown-inline" data-toggle="" title="" data-placement="left" data-original-title="Quick actions">
                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ki ki-bold-more-ver"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="">
                    <!--begin::Navigation-->
                    <ul class="navi navi-hover py-5">

                      <li class="navi-item">
                          <a href="/bienes/create" class="navi-link">
                              <span class="navi-icon"><i class="fas fa-plus"></i></span>
                              <span class="navi-text">NUEVO BIEN</span>
                          </a>
                      </li>

                    </ul>
                    <!--end::Navigation-->
                </div>
            </div>
        </div>
</div>
<div class="card-body">
<table class="table table-bordered table-checkable" id="kt_datatable">
  <thead>
    <tr>
      <th>N° DE INVENTARIO</th>
      <th>DESCRIPCIÓN DEL BIEN</th>
      <th>DESCRIPCIÓN A DETALLE</th>
      <th>MARCA</th>
      <th>MODELO</th>
      <th>SERIE</th>
      <th>ESTATUS</th>
      <th>ACCIONES</th>
    </tr>
    </thead>
   <tbody>
     <tr>
       <td>54002-11-0047-07760</td>
       <td>Modulo Secretarial</td>
       <td>Incluye 3 cajones</td>
       <td>xxxxxx</td>
       <td>15465s454</td>
       <td>545a7s67d886</td>
       <td>Registrado</td>
       <td>
        <div class='btn-group '>
          <button type='button' class='btn btn-light dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fas fa-align-justify'></i><span class='caret'></span> </button>
          <div class='dropdown-menu '  >
            <a class='dropdown-item' href="/bienes/show">
            Ver Detalle
            </a>
            <a class='dropdown-item' href="/bienes/resguardante">
            Asignar Resguardante Oficial
            </a>
            <a class='dropdown-item' href="/bienes/resguardante">
            Asignar Resguardante Interno
            </a>
            <a class='dropdown-item' onclick="baja()">
            Baja
            </a>
            <a class='dropdown-item'>
            Vale de Salida
            </a>
            <a class='dropdown-item'>
            Asignar N° de Inventario
            </a>
            <a class='dropdown-item' onclick="reubicar()">
            Reubicar Bien
            </a>
          </div>
         </div>
       </td>
     </tr>
   </tbody>
</table>
</div>
</div>

<!--MODAL BAJA-->

<div class="modal fade" id="baja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Baja de Bien Controlable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                    <span>MODULO SECRETARIAL</span><br>
                    <p>N° DE INVENTARIO 54002-11-0047-07760</p>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha de Baja: </label>
                    <input type="email" class="form-control" id="email"  placeholder="Fecha de Baja" required>
                    <div class="invalid-feedback">
                      Por Favor Ingrese Fecha de Baja
                    </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Motivo Baja: </label>
                  <div class="radio-list">
                    <label class="radio">
                        <input type="radio" name="radios1">
                        <span></span>
                        Inutilidad por uso normal
                    </label>
                    <label class="radio">
                        <input type="radio" name="radios1">
                        <span></span>
                        Inaplicación en el servicio
                    </label>
                    <label class="radio">
                        <input type="radio" name="radios1">
                        <span></span>
                        Siniestro
                    </label>
                </div>
                </div>
                <div class="col-md-6">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Dictamen Técnico: </label>
                  <div class="radio-list">
                    <label class="radio">
                        <input type="radio" name="radios2">
                        <span></span>
                        Bueno(B)
                    </label>
                    <label class="radio">
                        <input type="radio" name="radios2">
                        <span></span>
                        Regular(R)
                    </label>
                    <label class="radio">
                        <input type="radio" name="radios2">
                        <span></span>
                        Malo(M)
                    </label>
                </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary font-weight-bold">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!--MODAL BAJA-->


<!--MODAL REUBICAR BIEN -->

<div class="modal fade" id="reubicar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nombre del Resguardante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                    <label for="inputPassword4" style="font-size:12px;" class="form-label">Resguardante: </label>
                    <select class="form-control" name="">
                      <option value="">Javier Hernandez Sanchez</option>
                    </select>
                    <div class="invalid-feedback">
                      Por Favor Ingrese Correo Eléctronico
                    </div>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary font-weight-bold">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!--MODAL REUBICAR BIEN -->

<script type="text/javascript">
$('#reubicar').modal('hide');
$('#baja').modal('hide');

function baja(){
  $('#baja').modal('show');
}
function reubicar(){
  $('#reubicar').modal('show');
}
//     var tabla;
//     $(function() {
//     tabla = $('#kt_datatable').DataTable({
//       processing: true,
//       serverSide: true,
//       order: [[0, 'desc']],
//       ajax: {
//         url: "/usuarios/tablausuarios",
//       },
//       columns: [
//         { data: 'nombre', name : 'nombre'},
//         { data: 'apellido_paterno', name : 'apellido_paterno'},
//         { data: 'apellido_materno', name : 'apellido_materno'},
//         { data: 'tipo_usuario', name : 'tipo_usuario'},
//
//         { data: 'name', name: 'name' },
//
//         { data: 'email', name: 'email' },
//         { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
//       ],
//       createdRow: function ( row, data, index ) {
//         $(row).find('.ui.dropdown.acciones').dropdown();
//       },
//       language: { url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
//     });
//     });
//
//     function eliminar(id){
// //console.log(id);
//     var id_user = id;
//     Swal.fire({
//           title: "¿Estas seguro?",
//           text: "No podrás revertir esto!",
//           icon: "warning",
//           showCancelButton: true,
//           confirmButtonText: "Si, bórralo!"
//       }).then(function(result) {
//           if (result.value) {
//
//             $.ajax({
//
//                type:"Delete",
//
//                url:"/usuarios/borrar",
//                headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                },
//                data:{
//               id_user:id_user,
//                },
//
//                 success:function(data){
//                   Swal.fire("Excelente!", data.success, "success").then(function(){ tabla.ajax.reload(); });
//
//                 }
//
//
//             });
//
//
//           }
//       })
//     }


</script>
@endsection
