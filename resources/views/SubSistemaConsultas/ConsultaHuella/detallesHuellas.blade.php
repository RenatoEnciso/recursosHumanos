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
<div>
    @error('success')
    
        <div class="alert alert-success">
         <h1> {{$message}}</h1>  
        </div>
     
    @enderror
    
</div>

    <form id="demo-form" action="{{ route('SearchHuella') }}" method="POST" class="px-5 py-2">
        @csrf
        <div>
            <img src="{{ asset('images/huella.png') }}" alt="huella" width="100px" class="img-fluid d-block mx-auto">
        </div>



        <label class="form-label" for="">DNI</label>
        <input type="number" class="form-control  @error('dni') is-invalid @enderror" name="dni"
            placeholder="DNI" value="{{ old('dni') }}">
        @error('dni')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
       
        
        <div class="row mx-5 my-2">
            <div class="col-6">
                <a type="button" href="{{route('regresar')}}" class="btn btn-danger px-5">Salir</a>
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-success px-3 g-recaptcha"  data-sitekey="6Lfn6lIpAAAAACOYumGdAsOB6pdFSH7sbbmsamv6" 
                data-callback='onSubmit'  data-action='submit'>Consultar</button>
            </div>
        </div>


    </form>
@endsection
