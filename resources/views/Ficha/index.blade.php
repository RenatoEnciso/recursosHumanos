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
            <input type="text" placeholder="Buscar por Tipo Ficha" class="form-control" value="{{$buscarpor}}" name="buscarpor" >
        </div>
    </form>

</div>
@endsection


@section('contenido')
        <div class="card">
            <div class="card-header">
                <h3 id="titulo" class="card-title">LISTADO DE FICHAS REGISTRADAS</h3>
            </div>
            <div class="card-body">
            <a href="{{route('Ficha.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> NUEVA FICHA</a>
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
                        <th scope="col">Fecha de Registro</th>
                        {{-- <th scope="col">Certificado</th> --}}
                        <th scope="col">Estado</th>
                        <th scope="col">Tipo de Ficha</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($fichas)<=0)
                        <tr>
                            <td colspan="3"><b>No hay registros</b></td>
                        </tr>
                    @else
                        @foreach ($fichas as $item)
                            <tr>
                                <td>{{$item->idficha}}</td>
                                <td>{{$item->fecha_registro}}</td>
                               {{-- // <td>{{$item->tipo->nombre}}</td> --}}
                                <td>{{$item->estado}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>
                                    <a href="{{ route('Ficha.edit',$item->idficha) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                                    <button   class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$item->idficha}}">
                                        <i class="fas fa-trash"></i>Eliminar
                                      </button>
                                      <!-- Modal -->
                                      <div class="modal fade " id="staticBackdrop{{$item->idficha}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <span>
                                                    <b>Codigo:</b> {{$item->idficha}} 
                                                    <br> <b>¿Seguro que desea eliminar? </b> Esto puede eliminar los datos de una acta relacionada a esta ficha
                                                </span>
                                              
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                             
                                              <form method="POST" action="{{route('Ficha.destroy',$item->idficha)}}">
                                                @method('delete')
                                                @csrf
                                                    <button class="btn btn-danger"><i class="fas fa-check-square"></i> SI</button>
                                                </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                {{$fichas->links()}}
            </div>

        </div>

</div>

@endsection


