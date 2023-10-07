@extends('plantillaConsultas.Acta')
@section('titulo','Acta Defuncion')
@section('subtitulo','Consulta Acta Defuncion')
@section('cuerpo')
    <form action="" method="post" class="px-5 py-2">
        <div>
            <img src="{{asset('images/defuncion.png')}}" alt="defuncion" width="100px" class="img-fluid d-block mx-auto">
        </div>
        
          <label class="form-label" for="">Año Defuncion</label> 
           <input type="number" class="form-control" name="ano" placeholder="Año(4 digitos)">
         <div class="row"> 
        <div class="col-auto">
          <label class="form-label" for="">Primer Apellido</label> 
          <input type="text" class="form-control" name="primer_apellido" placeholder="Primer Apellido">
        </div>
        <div class="col-auto">
          <label  class="form-label" for="">Segundo Apellido</label>
           <input type="text" class="form-control" name="segundo_apellido" placeholder="Segundo Apellido">
        </div>
        </div>
        <div class="mb-3">
           <label class="form-label" for="" class="form-label">Prenombres</label> 
           <input type="text" class="form-control" name="prenombres" placeholder="Prenombres">
        </div>
        <div class="row mx-5">
            <div class="col-6">
           <button type="button" class="btn btn-danger px-5" >Salir</button> 
        </div>
        <div class="col-6">
           <button type="button" class="btn btn-success px-3">Consultar</button>
        </div>
        </div>


    </form>
@endsection