@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
  Recibo de Viáticos
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
                          <a href="/recibos/create" class="navi-link">
                              <span class="navi-icon"><i class="fas fa-plus"></i></span>
                              <span class="navi-text">Nuevo Recibo</span>
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
      <th>Folio</th>
      <th>Dependencia</th>
      <th>Comisionado</th>
      <th>N° de Empleado</th>
      <th>Fecha Inicio</th>
      <th>Fecha Fin</th>
      <th>Monto Total</th>
      <th>Estatus</th>
      <th>ACCIONES</th>
    </tr>
    </thead>
   <tbody>
     <tr>
       <td>GO/2019/ITABEC/000</td>
       <td>CEAT</td>
       <td>JUAN PEREZ RAMIREZ</td>
       <td>15111</td>
       <td>19/02/2022</td>
       <td>19/02/2022</td>
       <td>$2500</td>
       <td>Capturado</td>
       <td>
        <div class='btn-group dropleft'>
          <button type='button' class='btn btn-light dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fas fa-align-justify'></i><span class='caret'></span> </button>
          <div class='dropdown-menu '  >
            <a class='dropdown-item' href="/recibos/show">
            Ver Detalle
            </a>
            <a class='dropdown-item' onclick="finiquitarP()">
            Finiquitar Provisional
            </a>
            <a class='dropdown-item' onclick="finiquitar()">
            Finiquitar
            </a>
            <!-- <a class='dropdown-item' >
            Pagado
            </a> -->
            <a class='dropdown-item' onclick="baja()">
            Cancelar
            </a>
            <a class='dropdown-item' href="/recibos/recibo">
            Recibo Complementario
            </a>
            <a class='dropdown-item' >
            Comprobaciones
            </a>
            <!-- <a class='dropdown-item' >
            Programa de recorridos
            </a>
            <a class='dropdown-item' >
            Acompañante
            </a> -->
            <!-- <a class='dropdown-item' >
            Imprimir Recibo
            </a> -->
            <div role="separator" class="dropdown-divider"></div>
            <a class='dropdown-item' >
            Oficio de Comisión
            </a>
            <a class='dropdown-item' >
            Especificación de Comisión
            </a>
            <!-- <a class='dropdown-item' >
            Turnar
            </a>
            <a class='dropdown-item' >
            Turnar y Firmar
            </a>
            <a class='dropdown-item' >
            Pagar
            </a> -->
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
                <h5 class="modal-title" id="exampleModalLabel">Cancelar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                    <label for="inputPassword4" style="font-size:12px;" class="form-label">Estatus: </label>
                    <input type="text" name="" class="form-control">
                    <div class="invalid-feedback">
                      Por Favor Ingrese Correo Eléctronico
                    </div>
                </div>
                <div class="col-md-12">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Motivo: </label>
                  <textarea name="name" rows="8" cols="80" class="form-control"></textarea>
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

<div class="modal fade" id="finiquitar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Finiquitar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                    <label for="inputPassword4" style="font-size:12px;" class="form-label">Estatus: </label>
                    <input type="text" name="" class="form-control">
                    <div class="invalid-feedback">
                      Por Favor Ingrese Correo Eléctronico
                    </div>
                </div>
                <div class="col-md-12">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Motivo: </label>

                  <textarea name="name" rows="8" cols="80" class="form-control"></textarea>
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


<!--MODAL REUBICAR BIEN -->

<div class="modal fade" id="finiquitarP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Finiquitar Provicional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                    <label for="inputPassword4" style="font-size:12px;" class="form-label">Estatus: </label>
                    <input type="text" name="" class="form-control">
                    <div class="invalid-feedback">
                      Por Favor Ingrese Correo Eléctronico
                    </div>
                </div>
                <div class="col-md-12">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Motivo: </label>

                  <textarea name="name" rows="8" cols="80" class="form-control"></textarea>
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
$('#finiquitar').modal('hide');
$('#finiquitarP').modal('hide');
$('#baja').modal('hide');

function baja(){
  $('#baja').modal('show');
}
function finiquitar(){
  $('#finiquitar').modal('show');
}
function finiquitarP(){
  $('#finiquitarP').modal('show');
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
