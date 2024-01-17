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
  
    @if ($data['success']=="Consulta Exitosa")
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

  
  <label class="form-label" for="">Año Defuncion</label>
  <input type="number" class="form-control  @error('ano') is-invalid @enderror" name="ano"
      placeholder="Año(4 digitos)" value="{{ old('ano') }}">
  
  <div class="row">
      <div class="col-sm-12 col-md-6 ">
          <label class="form-label" for="">Primer Apellido</label>
          <input type="text" class="form-control @error('primer_apellido') is-invalid @enderror"
              name="primer_apellido" placeholder="Primer Apellido" value ='{{ old('primer_apellido') }}'>
          
      </div>
      <div class="col-sm-12 col-md-6">
          <label class="form-label" for="">Segundo Apellido</label>
          <input type="text" class="form-control @error('segundo_apellido') is-invalid @enderror"
              name="segundo_apellido" placeholder="Segundo Apellido" value ='{{ old('segundo_apellido') }}'>
         
      </div>
  </div>
  <div class="mb-3">
      <label class="form-label" for="" class="form-label">Prenombres</label>
      <input type="text" class="form-control @error('prenombres') is-invalid @enderror" name="prenombres"
          placeholder="Prenombres" value ='{{ old('prenombres') }}'>
      
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
