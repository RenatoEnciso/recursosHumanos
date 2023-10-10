@extends('plantillaConsultas.Acta')
@section('titulo','Acta Defuncion')
@section('subtitulo','Consulta Acta Defuncion')
@section('cuerpo')
    <form action="{{route('SearchDefuncion')}}" method="POST" class="px-5 py-2">
      @csrf
        <div>
            <img src="{{asset('images/defuncion.png')}}" alt="defuncion" width="100px" class="img-fluid d-block mx-auto">
        </div>
       
        
        
          <label class="form-label" for="">Año Defuncion</label> 
           <input type="number" class="form-control  @error('ano') is-invalid @enderror" name="ano" placeholder="Año(4 digitos)">
          @error('ano')
            <div class="invalid-feedback">
              Ingresar el año de defuncion
            </div>
        
          @enderror
         <div class="row"> 
        <div class="col-sm-12 col-md-6 ">
          <label class="form-label" for="">Primer Apellido</label> 
          <input type="text" class="form-control @error('primer_apellido') is-invalid @enderror" name="primer_apellido" placeholder="Primer Apellido">
          @error('primer_apellido')
            <div class="invalid-feedback">
            Ingresar el primer apellido 
            </div>
        
          @enderror
        </div>
        <div class="col-sm-12 col-md-6">
          <label  class="form-label" for="">Segundo Apellido</label>
           <input type="text" class="form-control @error('segundo_apellido') is-invalid @enderror" name="segundo_apellido" placeholder="Segundo Apellido">
           @error('segundo_apellido')
           <div class="invalid-feedback">
            Ingresar el segundo apellido
           </div>
       
         @enderror
          </div>
        </div>
        <div class="mb-3">
           <label class="form-label" for="" class="form-label">Prenombres</label> 
           <input type="text" class="form-control @error('prenombres') is-invalid @enderror" name="prenombres" placeholder="Prenombres">
           @error('prenombres')
           <div class="invalid-feedback">
            Ingresar los nombres del difunto
           </div>
       
         @enderror
          </div>
        <div class="row mx-5">
            <div class="col-6">
           <button type="button" class="btn btn-danger px-5" >Salir</button> 
        </div>
        <div class="col-6">
           <button type="submit"   class="btn btn-success px-3">Consultar</button>
        </div>
        </div>


    </form>
@endsection