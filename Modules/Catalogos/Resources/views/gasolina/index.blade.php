@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
  Gasolina
</h3>
<div class="card-toolbar">
            <div class="dropdown dropdown-inline" data-toggle="" title="" data-placement="left" data-original-title="Quick actions">
                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ki ki-bold-more-ver"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="">
                    <!--begin::Navigation-->
                    <ul class="navi navi-hover py-5">
                      @can('crear gasolina')
                      <li class="navi-item">
                          <a href="/catalogos/gasolina/create" class="navi-link">
                              <span class="navi-icon"><i class="fas fa-plus"></i></span>
                              <span class="navi-text">Agregar</span>
                          </a>
                      </li>
                      @else

                      @endcan


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
      <th>Tipo</th>
      <th>Año</th>
      <th>Mes</th>
      <th>Precio por litro</th>
      <th>Vigencia</th>
      <th>ACCIONES</th>
    </tr>
    </thead>
   <tbody>
   </tbody>
</table>
</div>
</div>

<script type="text/javascript">
var tabla;
$(function() {
tabla = $('#kt_datatable').DataTable({
  processing: true,
  serverSide: true,
  order: [[0, 'desc']],
  ajax: {
    url: "/catalogos/gasolina/tabla",
  },
  columns: [
    { data: 'cve_tipo_gasolina', name : 'cve_tipo_gasolina'},
    { data: 'anio', name : 'anio'},
    { data: 'mes', name : 'mes'},
    { data: 'precio_litro', name : 'precio_litro'},
    { data: 'vigencia', name : 'vigencia'},
    { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
  ],
  createdRow: function ( row, data, index ) {
    $(row).find('.ui.dropdown.acciones').dropdown();
  },
  language: { url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
});
});
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

           url:"/catalogos/gasolina/borrar",
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
