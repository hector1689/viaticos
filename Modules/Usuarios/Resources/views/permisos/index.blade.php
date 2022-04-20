@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
  Roles
</h3>
<div class="card-toolbar">
			<!--begin::Dropdown-->
<!--begin::Button-->
<a href="/usuarios/permisos/create" class="btn btn-primary font-weight-bolder">
	<span class="svg-icon svg-icon-md"><!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <circle fill="#000000" cx="9" cy="15" r="6"></circle>
        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
    </g>
</svg><!--end::Svg Icon--></span>	Nuevo
</a>
<!--end::Button-->
		</div>
</div>
<div class="card-body">
<table class="table table-bordered table-checkable" id="kt_datatable">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Modulo</th>
      <th>Acciones</th>
    </tr>
  </thead>
   <tbody></tbody>
</table>
</div>
</div>
<script>
var tabla;
$(function() {
  tabla = $('#kt_datatable').DataTable({
    processing: true,
    serverSide: true,
    order: [[0, 'desc']],
    ajax: {
      url: "/usuarios/permisos/tablapermisos",
    },
    columns: [
      { data: 'name', name: 'name' },
      { data: 'modulo', name: 'modulo' },
      { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
    ],
    createdRow: function ( row, data, index ) {
      $(row).find('.ui.dropdown.acciones').dropdown();
    },
    language: { url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
  });
});
function eliminar(id){
//console.log(id);
var id = id;
Swal.fire({
      title: "¿Esta seguro dar eliminar registro?",
      text: "No se podrá recuperar la información",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Aceptar",
      cancelButtonText: "Cancelar"
  }).then(function(result) {
      if (result.value) {

        $.ajax({

           type:"Delete",

           url:"/usuarios/permisos/borrar",
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
