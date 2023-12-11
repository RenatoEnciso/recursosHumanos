@extends('dashboard')

@section('titulo','Eliminar acta de defuncion')

@section('contenido')
<div class="container">
    <h1 id="titulo" class="acta_title">Archivo solicitado</h1>

    <div class="reporte_imagen">
        <img src="{{$ActaDefunsion->Acta->archivo}}" alt="s"> 
    </div>
    <form method="POST" action="{{route('ActaDefunsion.index')}}">
        @csrf
        <br>
        <div class="boton_div">
            <div>
                <a href="{{route('ActaDefunsion.cancelar')}}" class="btn btn-primary"><i class="fa fa-undo boton"></i>Regresar</a>
            </div>
        </div>
        
    </form>
</div>
@endsection
