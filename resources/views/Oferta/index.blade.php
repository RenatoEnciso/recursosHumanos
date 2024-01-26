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
<!-- Button trigger modal -->

        <div class="card">
            <div class="card-header">
                <h3 id="titulo"  class="card-title">OFERTAS</h3>
            </div>
            <div class="card-body">
            <a href="{{route('Oferta.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo registro</a>
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
                        <th scope="col" style="font-weight: bold;">Codigo</th>
                        <th scope="col"style="font-weight: bold;">Descripción</th>
                        <th scope="col"style="font-weight: bold;">Inicio</th>
                        <th scope="col"style="font-weight: bold;">Fin</th>
                        <th scope="col"style="font-weight: bold;">Cargo</th>
                        <th scope="col"style="font-weight: bold;">Monto</th>
                        <th scope="col"style="font-weight: bold;">Vacantes</th>
                        <th scope="col"style="font-weight: bold;">Archivos</th>
                        <th scope="col"style="font-weight: bold;">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($Ofertas)<=0)
                        <tr>
                        <td colspan="3"><b>No hay registros</b></td>
                        </tr>
                        @else

                    @foreach ($Ofertas as $item)
                        <tr>
                        
                        <td >{{$item->idOferta}}</td>
                        <td>{{$item->descripcion}}</td>
                        <td>{{$item->fecha_inicio}}</td>
                        <td>{{$item->fecha_fin}}</td>
                        <td>{{$item->cargo->descripcion}}</td>
                        <td>S/.{{$item->monto}}</td>
                        <td>{{$item->numerovacantes}}</td>
                        <td>
                        <button   class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropr{{$item->idOferta}}">
                            <i class="fa-solid fa-file-circle-check"></i>Requisito de postulante
                        </button>
                        <button   class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropm{{$item->idOferta}}">
                            <i class="fa-solid fa-file-circle-check"></i>Manual de postulante
                        </button>
                        
                        
                        <!-- Modal -->
                        <div class="modal fade " id="staticBackdropr{{$item->idOferta}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Requisitos de {{$item->descripcion}}</h1>
                            
                                </div>
                                <div class="modal-body">
                              
                                    <iframe  src="{{$item->requisitos}}" class="object-cover  mt-2 " height="500vh" width="450vh" frameborder="0" scrolling=""> </iframe>
                                
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="modal fade " id="staticBackdropm{{$item->idOferta}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Manual de {{$item->descripcion}}</h1>
                            
                                </div>
                                <div class="modal-body">
                              
                                    <iframe  src="{{$item->manualPostulante}}" class="object-cover  mt-2 " height="500vh" width="450vh" frameborder="0" scrolling=""> </iframe>
                                
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                                </div>
                            </div>
                            </div>
                        </div>
                        </td>
                        <td >
                     
                            <a href="{{ route('Oferta.edit',$item->idOferta) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                            {{-- <a href="{{ route('ActaDefunsion.archivo',$item->idActaPersona)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Ver</a> --}}
                           
                            {{-- <a href="{{ route('Oferta.edit',$item->idOferta) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                            <a href="{{ route('Oferta.confirmar',$item->idOferta) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a> --}}
                            {{-- <a href="" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a> --}}
                            {{-- <div class="modal-dialog modal-dialog-centered">
                                HOLA
                            </div> --}}
                            {{-- <a href="{{ route('Oferta.confirmar',$item->idOferta) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a> --}}

                            <button   class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$item->idOferta}}">
                                <i class="fas fa-trash"></i>Eliminar
                              </button>
                      
                            
                            
                              <!-- Modal -->
                              <div class="modal fade " id="staticBackdrop{{$item->idOferta}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar Oferta</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <span>
                                            Codigo : {{$item->idOferta}}
                                      <br> Cargo: {{$item->Cargo->descripcion}}
                                      <br> Monto: S/.{{$item->monto}}
                                        </span>
                                      
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                     
                                      <form method="POST" action="{{route('Oferta.destroy',$item->idOferta)}}">
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
                {{$Ofertas->links()}}
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>

@endsection
