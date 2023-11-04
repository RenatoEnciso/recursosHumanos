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
            <input type="text" placeholder="Buscar por descripcion" class="form-control" value="{{$busqueda}}" name="busqueda" >
        </div>
    </form>

</div>
@endsection

@section('contenido')

        <div class="card">
            <div class="card-header">
                <h3 id="titulo"  class="card-title">CARGOS</h3>
            </div>
            <div class="card-body">
            <a href="{{route('Cargo.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>div
            <div id="mensaje">
                @if (session('datos'))
                <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31) ">
                    {{session('datos')}}
                </div>
                @endif
            </div>
                <table class="table" style="text-align: center">
                    <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($Cargos)<=0)
                        <tr>
                        <td colspan="3"><b>No hay registros</b></td>
                        </tr>
                        @else

                    @foreach ($Cargos as $item)
                        <tr>
                        
                        <td>{{$item->idCargo}}</td>
                        <td>{{$item->descripcion}}</td>
                        <td>
                         
                            <a href="{{ route('Cargo.edit',$item->idCargo) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                            {{-- <a href="{{ route('ActaDefunsion.archivo',$item->idActaPersona)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Ver</a> --}}
                           
                            {{-- <a href="{{ route('Cargo.edit',$item->idCargo) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                            <a href="{{ route('Cargo.confirmar',$item->idCargo) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a> --}}
                            {{-- <a href="" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a> --}}
                            {{-- <a href="{{ route('Cargo.confirmar',$item->idCargo) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a> --}}
                            <button   class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$item->idCargo}}">
                                <i class="fas fa-trash"></i>Eliminar
                              </button>
                      
                            
                            
                              <!-- Modal -->
                              <div class="modal fade " id="staticBackdrop{{$item->idCargo}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar Oferta</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <span>
                                            Codigo : {{$item->idCargo}}
                                      <br> Cargo: {{$item->descripcion}}
                                    
                                        </span>
                                      
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                     
                                      <form method="POST" action="{{route('Oferta.destroy',$item->idCargo)}}">
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
                {{$Cargos->links()}}
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>


@endsection
