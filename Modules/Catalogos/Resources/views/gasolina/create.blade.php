@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   @isset($gasolina)Editar @else Nuevo @endisset Gasolina
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
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Tipo: </label>
              <select class="form-control" id="cve_tipo_gasolina">
                @isset($gasolina)
                <option value="{{ $gasolina->cve_tipo_gasolina }}">{{ $gasolina->obteneGasolina->nombre }}</option>
                @else
                <option value="">seleccionar</option>
                @endisset
                @foreach($tipos_gasolina as $tipo)
                <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Por Favor Seleccione tipo de gasolina
              </div>
          </div>
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Año: </label>
              <input type="text" class="form-control" id="anio" value="@isset($gasolina){{ $gasolina->anio }} @endisset" placeholder="Año" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Año
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Mes: </label>
              <input type="text" class="form-control" id="mes" value="@isset($gasolina){{ $gasolina->mes }} @endisset" placeholder="Mes" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Mes
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Precio por litro: </label>
              <input type="text" class="form-control" id="precio_litro" value="@isset($gasolina){{ $gasolina->precio_litro }} @endisset" placeholder="Precio por litro" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Precio por litro
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Vigencia: </label>
              @isset($gasolina)
              <?php

              list($dia,$mes,$anio) = explode('-',$gasolina->vigencia);
              $fecha = $anio.'/'.$mes.'/'.$dia;


               ?>
               @endisset

              <input type="text" class="form-control" name="vigencia" id="kt_datepicker" value="@isset($gasolina){{ $fecha }} @endisset" placeholder="Vigencia" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Vigencia
              </div>
          </div>
        </div>




</div>
<div class="card-footer">

  <a href="/catalogos/gasolina" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="guardar()">Guardar</a>
</div>
</form>
</div>

<script type="text/javascript">
$(function () {

    $("#kt_datepicker").datepicker({
        language: 'es',
        format: 'dd/mm/yyyy',
    });

    $("#kt_datepicker2").datepicker({
        language: 'es',
        // startDate: dateTime,
        format: 'dd/mm/yyyy',
    });
});


function guardar(){
  var cve_tipo_gasolina = $('#cve_tipo_gasolina').val();
  var anio = $('#anio').val();
  var mes = $('#mes').val();
  var precio_litro = $('#precio_litro').val();
  var vigencia = $('input[name=vigencia]').val();

    var formData = new FormData();
     //formData.append('photo', $avatarInput[0].files[0]);

    @isset($gasolina)
    formData.append('id',{{ $gasolina->id }});
    @endisset
    formData.append('cve_tipo_gasolina', cve_tipo_gasolina);
    formData.append('anio', anio);
    formData.append('mes', mes);
    formData.append('precio_litro', precio_litro);
    formData.append('vigencia', vigencia);

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

                   url:"{{ ( isset($gasolina) ) ? '/catalogos/gasolina/update' : '/catalogos/gasolina/create' }}", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
                   },
                   data: formData,
                   processData: false,
                   contentType: false,
                   cache:false,
                    success:function(data){
                      if (data.success == 'Registro agregado satisfactoriamente') {
                        Swal.fire("", data.success, "success").then(function(){
                          location.href ="/catalogos/gasolina";
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
                                location.href ="/catalogos/gasolina"; //esta es la ruta del modulo
                              }
                          })

                      }else if(data.success == 'Ha sido editado con éxito'){

                        Swal.fire("", data.success, "success").then(function(){
                          location.href ="/catalogos/gasolina";
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
                                location.href ="/catalogos/gasolina";
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
