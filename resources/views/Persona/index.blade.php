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
            <input type="text" placeholder="Buscar por apellido" class="form-control" value="{{$busqueda}}" name="buscarpor" >
        </div>
    </form>

</div>
@endsection
@section('contenido')

            <div class="card">
                <div class="card-header">
                    <h3 id="titulo"  class="card-title">LISTADO DE PERSONAS</h3>
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
                            <th scope="col">DNI</th>
                            <th scope="col">Apellidos Paternos</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Sexo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($personas)==0)
                            <tr>
                            <td colspan="3"><b>No hay registros</b></td>
                            </tr>
                            @else

                        @foreach ($personas as $item)
                            <tr>
                                <td>{{$item->DNI}}</td>
                                <td>{{$item->Apellido_Paterno}}</td>
                                <td>{{$item->Apellido_Materno}}</td>
                                <td>{{$item->Nombres}}</td>
                                <td>{{$item->sexo}}</td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                {{$personas->links()}}
                </div>

            </div>

    </div>
@endsection
