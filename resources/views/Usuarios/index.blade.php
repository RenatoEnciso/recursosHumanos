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
            <input type="text" placeholder="Buscar por correo" class="form-control" value="{{$busqueda}}" name="buscarpor" >
        </div>
    </form>

</div>
@endsection
@section('contenido')

            <div class="card">
                <div class="card-header">
                    <h3 id="titulo"  class="card-title">LISTADO DE USUARIOS</h3>
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
                            <th scope="col">Codigo</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Correo electronico</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($usuarios)==0)
                            <tr>
                            <td colspan="3"><b>No hay registros</b></td>
                            </tr>
                            @else

                        @foreach ($usuarios as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->rol->nombreRol}}</td>
                                <td>
                                    <br>
                        {{-- <a href="{{route('ActaNacimiento.revisar',$acta->idActa)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Validar</a> --}}
                        
                        <a href="{{route('administrador.edit',$item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                        <a  href="{{route('administrador.show',$item->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                {{$usuarios->links()}}
                </div>

            </div>

    </div>
@endsection
