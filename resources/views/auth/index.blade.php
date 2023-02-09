@extends('dashboard')

@section('titulo','INICIO')
@section('buscar')
<div class="collapse" id="search-nav">
    <form class="navbar-left navbar-form nav-search mr-md-3" method="GET" role="search">
        <div class="input-group">
            <div class="input-group-prepend">
                <button type="submit" class="btn btn-search pr-1">
                    <i class="fa fa-search search-icon"></i>
                </button>
            </div>
            <input type="text" placeholder="Buscar por nombre" class="form-control" value="{{$busqueda}}" name="buscarpor" >
        </div>
    </form>

</div>
@endsection
@section('contenido')
    <div class="card">
        <div class="card-header">
            <h3 id="titulo"  class="card-title">Lista de Empleados</h3>
        </div>
        <div class="card-body">

            <div id="mensaje">
                @if (session('datos'))
                <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31)" >
                    {{session('datos')}}
                </div>
                @endif
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Rol Empleado</th>
                    <th scope="col">Opciones</th>
                </tr>
                </thead>
                <tbody>
                @if (count($Usuarios)<=0)
                    <tr>
                    <td colspan="4"><b>No hay registros</b></td>
                    </tr>
                    @else

                @foreach ($Usuarios as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->rol}}</td>
                        <td>
                            <a href="{{ route('editU',$item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                            <a href="{{ route('confirU',$item->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
           {{$Usuarios->links()}}
        </div>

    </div>
@endsection
