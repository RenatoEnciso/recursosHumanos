@extends('plantillaConsultas.Acta')
@section('titulo', 'Mejor Huella')
@section('script')
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
      document.getElementById("demo-form").submit();
    }
  </script>

@endsection
@section('subtitulo', 'Consulta Mejor Huella')
@section('cuerpo')
  
    @if ($data['success']=="Consulta Exitosa" and $data['datos']['huellaDerecha'] and $data['datos']['huellaIzquierda'])
    <div>
      <div class="container-fluid"> 
        <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                  <h3 style="color:#1da318">{{$data['success']}}</h3>
            </div>
        </div>

    </div>
    
      <img src="{{ asset('images/huella.png') }}" alt="huella" width="100px" class="img-fluid d-block mx-auto">
  </div>
<br>
<br>
  <div class="row">

    <div class="col-6 mx-auto" style="font-weight:bold">
      <label class="form-label" for="">Numero de DNI: {{$data['datos']['huellaDerecha'][0]->DNI}}</label>

    </div>
  </div>
  
  
  
  <div class="row">
    <div class="col-6 mx-auto">
      <label class="form-label" for="" style="font-weight:bold">Apellidos Paterno: {{$data['datos']['huellaDerecha'][0]->Apellido_Paterno}}</label> <br>
      <label class="form-label" for="" style="font-weight:bold">Apellido Materno:  {{$data['datos']['huellaDerecha'][0]->Apellido_Materno}}</label>
    </div>
  </div>
  <div class="row">

    <div class="col-6 mx-auto">
      <label class="form-label" for="" class="form-label" style="font-weight:bold">Tus Mejores huella son: </label> <br>
      <label class="form-label" for="" class="form-label" style="font-weight:bold">  
        {{$data['datos']['huellaDerecha'][0]->nombreHuella}}  Derecho
      </label>   <br>
      <label class="form-label" for="" class="form-label" style="font-weight:bold">  
        {{$data['datos']['huellaIzquierda'][0]->nombreHuella}}  Izquierdo
      </label>
      
  </div>
  </div>
  
  

    @else
    
    <div>
      <div class="container-fluid"> 
        <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                  <h3 style="color:#D62522">{{$data['success']}}</h3>
            </div>
        </div>

    </div>
      
      <img src="{{ asset('images/huella.png') }}" alt="huella" width="100px" class="img-fluid d-block mx-auto">
  </div>
  <div class="container-fluid"> 
    <div class="row">
            <div class="col-sm-12 d-flex justify-content-center">
              <h6 style="color:#D62522">DNI no existe o huellas no encontradas</h3>
        </div>
    </div>

</div>

<div class="container-fluid"> 
  <div class="row">
          <div class="col-sm-12 d-flex justify-content-center">
            <a type="button" href="{{route('regresar')}}" class="btn btn-danger px-5">Salir</a>
      </div>
  </div>

</div>



    @endif
 
@endsection
