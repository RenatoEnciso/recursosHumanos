@extends('dashboard')

@section('titulo','Eliminar acta de Nacimiento')

@section('contenido')
<div class="container">
    <h1 id="titulo" class="acta_title">Archivo de Pago</h1>
    <div class="reporte_imagen">
        <img src="{{$ComprobantePago->archivo}}" alt="s">
    </div>
    
    <form method="POST" action="{{route('ComprobantePago.index')}}">
        @csrf
        <br>
        <div class="boton_div">
            <div>
                <a href="{{route('ComprobantePago.cancelar')}}" class="btn btn-primary"><i class="fa fa-undo"></i>Regresar</a>
            </div>
        </div>
    </form>
</div>
@endsection
