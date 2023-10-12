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
                <h3 id="titulo"  class="card-title">POSTULACIONES</h3>
            </div>
            <div class="card-body">
            <a href="{{route('Postulacion.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo registro</a>
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
                        <th scope="col">DNI</th>
                        <th scope="col">Oferta</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Curriculum</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($Postulacions)<=0)
                        <tr>
                        <td colspan="3"><b>No hay registros</b></td>
                        </tr>
                        @else

                    @foreach ($Postulacions as $item)
                        <tr>
                      
                            <td>{{$item->idPostulacion}}</td>
                            <td>{{$item->DNI}}</td>
                            <td>{{$item->idOferta}} {{$item->oferta->descripcion}}</td>
                            <td>{{$item->oferta->cargo->descripcion}}</td>
                            <td>{{$item->fecha}}</td>
                            <td><button   class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropp{{$item->idPostulacion}}">
                                <i class="fa-solid fa-file-circle-check"></i>
                            </button>
                    
                            
                            
                            <!-- Modal -->
                            <div class="modal fade " id="staticBackdropp{{$item->idPostulacion}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Curriculum de {{$item->DNI}}</h1>
                                
                                    </div>
                                    <div class="modal-body">
                                  
                                        <iframe  src="{{$item->curriculum}}" class="object-cover  mt-2 " height="500vh" width="450vh" frameborder="0" scrolling=""> </iframe>
                                    
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        
                                    </div>
                                </div>
                                </div>
                            </div>
                            </td>
                        
                            <td>
                                
                                {{-- <a href="{{ route('ActaDefunsion.archivo',$item->idActaPersona)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Ver</a> --}}
                            
                                <a href="{{ route('Postulacion.edit',$item->idPostulacion) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                                {{-- <a href="{{ route('Postulacion.confirmar',$item->idPostulacion) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a> --}}
                                {{-- <a href="" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                                <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a> --}}
                                <button   class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$item->idPostulacion}}">
                                    <i class="fas fa-trash"></i>Eliminar
                                  </button>
                          
                                
                                
                                  <!-- Modal -->
                                  <div class="modal fade " id="staticBackdrop{{$item->idPostulacion}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar Postulación</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <span>
                                                Codigo : {{$item->idPostulacion}}
                                          <br> Cargo: {{$item->oferta->cargo->descripcion}}
                                          <br> Oferta:  {{$item->oferta->descripcion}}
                                            </span>
                                          
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                         
                                          <form method="POST" action="{{route('Oferta.destroy',$item->idPostulacion)}}">
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
                {{$Postulacions->links()}}
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>


@endsection
