@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
  Kilometraje
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
                          <a href="/catalogos/kilometraje/create" class="navi-link">
                              <span class="navi-icon"><i class="fas fa-plus"></i></span>
                              <span class="navi-text">Agregar</span>
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
      <th>Origen</th>
      <th>Destino</th>
      <th>Kilometraje</th>
      <th>ACCIONES</th>
    </tr>
    </thead>
   <tbody>
     <tr>
       <td>Victoria-Victoria-Tamaulipas-México</td>
       <td>Tampico-Tampico-Tamaulipas-México</td>
       <td>250</td>
       <td>
        <div class='btn-group dropleft'>
          <button type='button' class='btn btn-light dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fas fa-align-justify'></i><span class='caret'></span> </button>
          <div class='dropdown-menu '  >
            <a class='dropdown-item' href="/catalogos/kilometraje/show">
            Editar
            </a>
            <a class='dropdown-item'>
            Eliminar
            </a>
          </div>
         </div>
       </td>
     </tr>
   </tbody>
</table>
</div>
</div>


@endsection
