@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   <!-- @isset($usuarios)editar @else nuevo @endisset --> Especificación de Comisión
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
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Comisionados: </label>
              <select class="form-control" name="comisionado">
                <option value="">Seleccionar</option>
                @foreach($personal_comisionado as $comisionado)
                <option value="{{ $comisionado->id }}">{{ $comisionado->nombre }} {{ $comisionado->apellido_paterno }} {{ $comisionado->apellido_materno }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Adjuntar: </label><br>
            <button type="button" class="btn btn-primary" name="button" onclick="agregarComisionado()">Agregar</button>
          </div>
        </div>
        <div role="separator" class="dropdown-divider"></div>
        <div class="row">
          <div class="col-md-12">
            <table class="table" id="tablaComisionado">
              <thead>
                  <tr>
                      <th scope="col">Comisionado</th>
                      <th scope="col">Acciones</th>
                  </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div role="separator" class="dropdown-divider"></div>
        <div class="row">

          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Especificar comision: </label>
              <input type="text" class="form-control" id="especificar" placeholder="Escribir Especificar comision">
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Recorrido interno: </label>
              <input type="text" class="form-control" id="recorrido_interno" onkeypress='return validaNumericos(event)' placeholder="Escribir Recorrido interno">
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Municipio: </label>
              <select class="form-control" id="municipio">
                <option value="">Seleccionar</option>
                @foreach($localidades as $loc)
                <option value="{{ $loc->id }}">{{ $loc->obteneLocalidad->localidad }} - {{ $loc->obteneLocalidad->obteneMunicipio->nombre }} - {{ $loc->obteneLocalidad->obteneEstado->nombre }} - {{ $loc->obteneLocalidad->obtenePais->nombre }}</option>

                @endforeach
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Dirección: </label>
              <input type="text" class="form-control" id="direccion" placeholder="Escribir Dirección">
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>

        <div class="row">


          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Teléfono de ubicación: </label>
              <input type="text" class="form-control" id="telefono" onkeypress='return validaNumericos(event)' placeholder="Escribir Teléfono de ubicación">
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Adjuntar: </label><br>
            <button type="button" class="btn btn-primary" name="button" onclick="agregarTelefono()">Agregar</button>
          </div>

        </div>
        <div role="separator" class="dropdown-divider"></div>
        <div class="row">
          <div class="col-md-12">
            <table class="table" id="tablaTelefono">
              <thead>
                  <tr>
                      <th scope="col">Teléfono Ubicación</th>
                      <th scope="col">Acciones</th>
                  </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div role="separator" class="dropdown-divider"></div>

        <div class="row">
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Persona ante se acredita: </label>
              <input type="text" class="form-control" id="persona" placeholder="Escribir Persona ante se acredita">
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4"  style="font-size:12px;visibility:hidden;"class="form-label">Adjuntar: </label><br>
            <button type="button" class="btn btn-primary" name="button" onclick="agregarAcredita()">Agregar</button>
          </div>
        </div>

        <div role="separator" class="dropdown-divider"></div>
        <div class="row">
          <div class="col-md-12">
            <table class="table" id="tablaAcredita">
              <thead>
                  <tr>
                      <th scope="col">Persona Acreditada</th>
                      <th scope="col">Acciones</th>
                  </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div role="separator" class="dropdown-divider"></div>



</div>
<div class="card-footer">

  <a href="/recibos" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="imprimir({{$id}})">imprimir</a>
</div>
</form>
</div>
<script type="text/javascript">
var objTabla = {};
var array_table = [];
var array_tabla = [];
function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;
}
function agregarComisionado(){
  var comisionado = $('select[name=comisionado]').val();
  var comisionado_nombre = $('select[name=comisionado] option:selected').text();


  objTabla = {
     comisionado : comisionado,
     comisionado_nombre: comisionado_nombre,
  };

  array_table.push(comisionado);

  indexH = array_tabla.push(objTabla);
  objTabla.id = indexH;
  //console.log(array_table[0]);

  var tr = '<tr id="id-figura-'+objTabla.id+'">'+
  '<td><input type="hidden" id="figura_nueva" value="'+objTabla.id+'"/>'+objTabla.comisionado_nombre+'</td>'+
  '<td style=" text-align: center; "><div class="btn btn-danger borrar_figura" figura_nueva_id="'+objTabla.id+'" ><i  class="fas fa-trash"></i></div></td>'
  '</tr>';

  $("#tablaComisionado").append(tr);
  $('select[name=comisionado]').prop('selectedIndex',0);
}
var objTablaTelefono = {};
var array_tableTelefono = [];
var array_tablaTelefono2 = [];
function agregarTelefono(){
  var telefono = $('#telefono').val();


  objTablaTelefono = {
     telefono : telefono,
  };

  array_tableTelefono.push(telefono);

  indexH = array_tablaTelefono2.push(objTabla);
  objTablaTelefono.id = indexH;
  //console.log(array_table[0]);

  var tr = '<tr id="id-figura-'+objTablaTelefono.id+'">'+
  '<td><input type="hidden" id="figura_nueva" value="'+objTablaTelefono.id+'"/>'+objTablaTelefono.telefono+'</td>'+
  '<td style=" text-align: center; "><div class="btn btn-danger borrar_figura" figura_nueva_id="'+objTablaTelefono.id+'" ><i  class="fas fa-trash"></i></div></td>'
  '</tr>';

  $("#tablaTelefono").append(tr);
  $('#telefono').val('');
}

var objTablaAcredita = {};
var array_tableAcredita = [];
var array_tablaAcredita2 = [];
function agregarAcredita(){
  var persona = $('#persona').val();


  objTablaAcredita = {
     persona : persona,
  };

  array_tableAcredita.push(persona);
  array_tablaAcredita2.push(objTabla);
  agregarfiguras(objTablaAcredita);

  // indexH = array_tablaAcredita2.push(objTabla);
  // console.log(array_tableAcredita)
  // objTablaAcredita.id = indexH;

  //console.log(array_table[0]);

  //console.log(array_tableAcredita);
}

var contador_telefono = 0;
function agregarfiguras(objTablaAcredita){

  var tr = '<tr id="filas'+contador_telefono+'">'+
  '<td><input type="hidden" id="figura_nueva" value="'+contador_telefono+'"/>'+objTablaAcredita.persona+'</td>'+
  '<td style=" text-align: center; "><div class="btn btn-danger borrar_figura" onclick="eliminaracreditado('+contador_telefono+')"  ><i  class="fas fa-trash"></i></div></td>'
  '</tr>';

  $("#tablaAcredita").append(tr);
  $('#persona').val('');
  contador_telefono ++;
}

function eliminaracreditado(id){
  var este = $('#figura_nueva').val();
  console.log(id,este)
  // var numero = id - 1;
  array_tableAcredita.splice(id,1);
  array_tablaAcredita2.splice(id,1);
  $('#filas'+id).remove();
  // $('#filas'+numero).load(location.href + '#filas'+numero);

  console.log(array_tableAcredita,array_tablaAcredita2);
}

// $(document).on("click",".borrar_figura",function(e){
//       // var id_figura_nueva = $(this).attr('figura_nueva_id');
// 	      e.preventDefault();
// 	    //   var id = $('#figura_nueva').val();
// 	    //   array_tableAcredita.splice(id, 1);
// 	    //   $('#id-figura-'+id_figura_nueva).remove();
//       //   console.log(array_tableAcredita);
//
//       array_tableAcredita.splice(id,1);
//
//       $('#filas'+id).remove();
// 	});

function imprimir(id){
  var especificar = $('#especificar').val();
  var recorrido_interno = $('#recorrido_interno').val();
  var municipio = $('#municipio').val();
  var direccion = $('#direccion').val();

 location.href="/recibos/especificaciones/"+id+"/"+array_tableAcredita+"/"+array_table+"/"+array_tableTelefono+"/"+especificar+"/"+recorrido_interno+"/"+municipio+"/"+direccion+" ";

  $('#especificar').val('');
  $('#recorrido_interno').val('');
  $('#municipio').val('');
  $('#direccion').val('');
  array_table.length=0;
  $('#tablaComisionado').load(location.href + " #tablaComisionado");
  // $('#tablaComisionado').empty();
  array_tableTelefono.length=0;
  $('#tablaTelefono').load(location.href + " #tablaTelefono");

  // $('#tablaTelefono').empty();
  array_tableAcredita.length=0;
  $('#tablaAcredita').load(location.href + " #tablaAcredita");

  // $('#tablaAcredita').empty();
}
</script>
@endsection
