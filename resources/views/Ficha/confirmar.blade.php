@extends('dashboard')

@section('titulo','Eliminar Ficha')

@section('contenido')
<div class="container">
    <h1 id="titulo" class="acta_title">Desea eliminar Ficha?</h1>
    <br>
    <div class="info_confirmacion">
        <h2>Codigo : {{$ficha->idficha}}</h2>
    </div>
    <form method="POST" action="{{route('Ficha.destroy',$ficha->idficha)}}">
        @method('delete')
        @csrf
        <div class="boton_div_confirmar">
            <div>
                <button class="btn btn-danger boton"><i class="fas fa-check-square"></i> SI</button>
            </div>
            <div>
                <a href="{{route('Ficha.cancelar')}}" class="btn btn-primary boton"><i class="fas fa-times-circle"></i> NO</a>
            </div>
        </div>
        
    </form>
</div>
@endsection