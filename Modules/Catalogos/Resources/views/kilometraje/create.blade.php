@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   @isset($kilometraje) Editar  @else Nuevo @endisset Kilometraje
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
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Localidad Origen: </label>
              <select class="form-control" name="origen">
                @isset($kilometraje)
                <option value="{{ $kilometraje->cve_localidad_origen }}">{{ $kilometraje->obteneLocalidad->localidad }} - {{ $kilometraje->obteneLocalidad->obteneMunicipio->nombre }} - {{ $kilometraje->obteneLocalidad->obteneEstado->nombre }} - {{ $kilometraje->obteneLocalidad->obtenePais->nombre }}</option>
                @else
                <option value="">seleccionar</option>
                @endisset
                @foreach($localidades as $loc1)
                <option value="{{ $loc1->id }}">{{ $loc1->localidad }}-{{ $loc1->obteneMunicipio->nombre }}-{{ $loc1->obteneEstado->nombre }}-{{ $loc1->obtenePais->nombre }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Localidad Destino: </label>
              <select class="form-control" name="destino">
                @isset($kilometraje)
                <option value="{{ $kilometraje->cve_localidad_destino }}">{{ $kilometraje->obteneLocalidad2->localidad }} - {{ $kilometraje->obteneLocalidad2->obteneMunicipio->nombre }} - {{ $kilometraje->obteneLocalidad2->obteneEstado->nombre }} - {{ $kilometraje->obteneLocalidad2->obtenePais->nombre }}</option>
                @else
                <option value="">seleccionar</option>
                @endisset
                @foreach($localidades as $loc1)
                <option value="{{ $loc1->id }}">{{ $loc1->localidad }}-{{ $loc1->obteneMunicipio->nombre }}-{{ $loc1->obteneEstado->nombre }}-{{ $loc1->obtenePais->nombre }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>


        </div>

        <div class="row">
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Distancia en Kilometros: </label>
              <input type="text" class="form-control" id="distancia" placeholder="Distancia en Kilometros" value="@isset($kilometraje){{ $kilometraje->distancia_kilometros }}@endisset" onkeypress="return validaNumericos(event)" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>

          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Zona: </label>
              <select class="form-control" name="zona">
                @isset($kilometraje)
                  @if($kilometraje->id_zona == '')
                    <option value="">seleccionar</option>

                  @else
                    <option value="{{ $kilometraje->id_zona }}">{{ $kilometraje->obtenerZona->nombre }}</option>
                  @endif

                @else
                <option value="">seleccionar</option>
                @endisset
                <option value="1">Centro de Tamaulipas</option>
                <option value="2">Extranjero y mas de 50 millas de la frontera con México en USA</option>
                <option value="3">Méx.,Mty., Nvo. Ldo.,+ de 800 kms.</option>
              </select>
              <div class="invalid-feedback">
                Por Favor Seleccione Zona
              </div>
          </div>
        </div>

        @isset($area)
        <div class="row">
          <div class="col-md-6">
            <label for="">Dependencia</label>
            <select class="form-control" id="area" >
              @isset($kilometraje)
              <option value="{{$kilometraje->id_dependencia}}">{{$kilometraje->obtenerDependencia->nombre}}</option>
              @else
              <option value="0">Seleccionar</option>
              @endisset

              @foreach($area as $ar)
              <option value="{{ $ar->id }}">{{ $ar->nombre }}</option>
              @endforeach
            </select>
          </div>
        </div>
        @else

        @endisset



</div>
<div class="card-footer">

  <a href="/catalogos/kilometraje" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="guardar()">Guardar</a>
</div>
</form>
</div>

<script type="text/javascript">
function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;
}

function guardar(){

  var origen = $('select[name=origen]').val();
  var destino = $('select[name=destino]').val();
  var zona = $('select[name=zona]').val();
  var distancia = $('#distancia').val();

    var formData = new FormData();
     //formData.append('photo', $avatarInput[0].files[0]);
     @isset($area)
     var area = $('#area').val();
     formData.append('area',area);
     @endisset
    @isset($kilometraje)
    formData.append('id',{{ $kilometraje->id }});
    @endisset
    formData.append('origen', origen);
    formData.append('destino', destino);
    formData.append('distancia', distancia);
    formData.append('zona', zona);

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

                   url:"{{ ( isset($kilometraje) ) ? '/catalogos/kilometraje/update' : '/catalogos/kilometraje/create' }}", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
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
                          location.href ="/catalogos/kilometraje";
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
                                location.href ="/catalogos/kilometraje"; //esta es la ruta del modulo
                              }
                          })

                      }else if(data.success == 'Ha sido editado con éxito'){

                        Swal.fire("", data.success, "success").then(function(){
                          location.href ="/catalogos/kilometraje";
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
                                location.href ="/catalogos/kilometraje";
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
