@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-body">
  <div class="row">
      <div class="col-xl-3">
          <!--begin::Stats Widget 25-->
          <div class="card card-custom bg-primary card-stretch gutter-b">
              <!--begin::Body-->
              <div class="card-body">

                  <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$capturados}}</span>
                  <span class="font-weight-bold text-white  font-size-sm">Capturados</span>
              </div>
              <!--end::Body-->
          </div>
          <!--end::Stats Widget 25-->
      </div>
      <div class="col-xl-3">
                <!--begin::Stats Widget 26-->
        <div class="card card-custom bg-primary card-stretch gutter-b">
            <!--begin::ody-->
            <div class="card-body">

                <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$proceso}}</span>
                <span class="font-weight-bold text-white font-size-sm">En Proceso</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 26-->
      </div>
      <div class="col-xl-3">
                  <!--begin::Stats Widget 27-->
          <div class="card card-custom bg-primary card-stretch gutter-b">
              <!--begin::Body-->
              <div class="card-body">

                  <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$finiquitado}}</span>
                  <span class="font-weight-bold text-white  font-size-sm">Finiquitados</span>
              </div>
              <!--end::Body-->
          </div>
          <!--end::Stats Widget 27-->
      </div>
      <div class="col-xl-3">
                <!--begin::Stats Widget 28-->
        <div class="card card-custom bg-primary card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">

                <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$pendiente}}</span>
                <span class="font-weight-bold text-white font-size-sm">Pendientes</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stat: Widget 28-->
      </div>
  </div>
  <div role="separator" class="dropdown-divider"></div>
  <div class="row">
    <div class="col-md-12">
        <div id="graficaLineal" style="width: 100%; height: 500px; margin: 0 auto"></div>
    </div>
  </div>
  <div role="separator" class="dropdown-divider"></div>
  <div class="row">
    <div class="col-md-12">
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
          </tr>
          </thead>
         <tbody>

         </tbody>
      </table>
    </div>

  </div>







  </div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
var tabla;
$(function() {
tabla = $('#kt_datatable').DataTable({
  processing: true,
  serverSide: true,
  order: [[0, 'desc']],
  ajax: {
    url: "/tabla",
  },
  columns: [
    { data: 'folio', name : 'folio'},
    { data: 'dependencia', name : 'dependencia'},
    { data: 'nombre', name : 'nombre'},
    { data: 'num_empleado', name : 'num_empleado'},
    { data: 'fecha_hora_salida', name : 'fecha_hora_salida'},
    { data: 'fecha_hora_recibio', name : 'fecha_hora_recibio'},
    { data: 'num_dias', name : 'num_dias'},
    { data: 'cve_estatus', name : 'cve_estatus'},
  ],
  createdRow: function ( row, data, index ) {
    $(row).find('.ui.dropdown.acciones').dropdown();
  },
  language: { url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
});
});
////////////////////// CHART /////////////////////////////////////////////////
  initCurso();

  async function initCurso(){
    var array_IdCursos = [];
    var array_cursos = [];
    var array_alumnos = [];
    var cursos_id =   {!!  json_encode($id_cursos) !!};

  for (var i = 0; i < cursos_id.length; i++) {
      array_IdCursos.push(cursos_id[i].id_dependencia);
      //console.log(array_IdCursos);

    }
  ///////////////////////////////////////////////////////////////
    for (var i = 0; i < array_IdCursos.length; i++) {
      var  _temp = await mandarCurso(array_IdCursos[i]);
      array_cursos.push(_temp);
      //console.log(array_cursos);
    }


    /////////////////////////////////////////////////////////////
      async function mandarCurso(id){
        //console.log(id)
        var _objeto = $.ajax({
           type:"POST",
           //async:false,
           url:"/TraerDatosCursos",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
             id_curso:id,
           }
        }).then(data=>{
            var _temp = {'id':'','data':[]};
            _temp.id = id;
          //  console.log(data)
            for (var j = 0; j < data.length; j++) {
              array_alumnos.push(parseInt(data[j].total_incritos));
              //_temp.data.push(data[j].total_incritos);
              //console.log(array_alumnos)
            }
            //return _temp;


        });


          return _objeto;
      }

      var chart;
      var alumnos = await array_alumnos;
      var alumnosInt = [];

      for (var i = 0; i < alumnos.length; i++) {

        alumnosInt.push(parseInt(alumnos[i]));
      }
      //console.log(alumnosInt);
      //console.log(parseInt(alumnos))

      $(document).ready(function() {

        chart = new Highcharts.Chart({
          chart: {
            renderTo: 'graficaLineal', 	// Le doy el nombre a la gráfica
            defaultSeriesType: 'column'	// Pongo que tipo de gráfica es
          },
          title: {
            text: 'Total Viaticos por Dependencia'	// Titulo (Opcional)
          },
          subtitle: {
            text: ''		// Subtitulo (Opcional)
          },
          // Pongo los datos en el eje de las 'X'
          xAxis: {
            categories: ['<?php echo join("','",$data1); ?>'],
            // Pongo el título para el eje de las 'X'
            title: {
              text: 'Dependencias'
            }
          },
          yAxis: {
            // Pongo el título para el eje de las 'Y'
            title: {
              text: 'Total Viaticos'
            }
          },
          // Doy formato al la "cajita" que sale al pasar el ratón por encima de la gráfica
          tooltip: {
            enabled: true,
            formatter: function() {
              return '<b>'+ this.series.name +'</b><br/>'+
                this.x +': '+ this.y +' '+this.series.name;
            }
          },
          // Doy opciones a la gráfica
          plotOptions: {
            line: {
              dataLabels: {
                enabled: true
              },
              enableMouseTracking: true
            }
          },
          // Doy los datos de la gráfica para dibujarlas
          series: [{
                        name: 'Dependencia',
                        data: alumnosInt
                    }],
        });
      });

  }
  /////////////////////////////////////////////////////////////////////////////

</script>
@endsection
