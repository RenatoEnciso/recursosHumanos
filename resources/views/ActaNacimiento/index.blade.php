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
            <input type="text" placeholder="Buscar por apellido" class="form-control" value="{{$buscarpor}}" name="buscarpor" >
        </div>
    </form>
</div>
@endsection
@section('Notificacion')
    
@if (Auth::user()->idRol==2)
<li class="nav-item dropdown hidden-caret">
    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bell"></i>
        <span class="notification">{{count($fichasP)}}</span>
    </a>
    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
        <li>
            <div class="dropdown-title">
                @if (count($fichasP)==0)
                    No tienes actas por validar
                @else
                Tienes {{count($fichasP)}} actas por validar
                @endif

               
               
            </div>
        </li>
        <li>
            <div class="notif-scroll scrollbar-outer">
                @foreach ($fichasP as $ficha )
                    <div class="notif-center">
                        <a href="{{ route('Ficha.crearActa',$ficha->idficha)}}">
                            <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                            <div class="notif-content">
                                <span class="block">
                                   Acta pendite para registrar
                                </span>
                                <span class="time">{{$ficha->fecha_registro}}</span> 
                            </div>
                        </a>
                    </div>
                @endforeach
                
            </div>
        </li>
        <li>
            <a class="see-all" href="javascript:void(0);">Ver todas las actas pendientes<i class="fa fa-angle-right"></i> </a>
        </li>
    </ul>
</li>
@endif
@endsection

@section('contenido')

        <div class="card">
            <div class="card-header">
                <h3 id="titulo" class="card-title">LISTADO DE ACTAS DE NACIMIENTO</h3>
            </div>
            <div class="card-body">
            {{-- <a href="{{route('ActaNacimiento.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a> --}}
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
                        <th scope="col">Apellidos y Nombres</th>
                        <th scope="col">Fecha_Nacimiento</th>
                        <th scope="col">Lugar de Nacimiento</th>
                       
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- @if (count($ActaNacimiento)>=0)
                         {{-- <tr>
                        <td colspan="3"><b>No hay registros</b></td>
                        </tr>  --}} 
                    @if (count($ActaNacimiento)==0)
                        <tr>
                        <td colspan="3"><b>No hay registros</b></td>
                        </tr>  
                    @else
                        @foreach ($ActaNacimiento as $acta)
                                <tr>
                                    <td>{{$acta->idActa}}</td>
                                    <td>{{$acta->nombres}}</td>
                                    <td>{{$acta->fecha_nacimiento}}</td>
                                    <td>{{$acta->lugar_ocurrencia}}</td>
                                {{-- //<td>{{$acta->DNI}}</td> --}}
                                <td>
                                    <br>
                                    {{-- <a href="{{route('ActaNacimiento.revisar',$acta->idActa)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Validar</a> --}}
                                    <a href="{{route('ActaNacimiento.generada',$acta->idActa)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Generar</a>
                                    <a href="{{route('ActaNacimiento.edit',$acta->idActa) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                                    <button   class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$acta->idActa}}">
                                        <i class="fas fa-trash"></i>Eliminar
                                      </button>
                                      <!-- Modal -->
                                      <div class="modal fade " id="staticBackdrop{{$acta->idActa}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <span>
                                                    <b>Codigo:</b> {{$acta->idActa}} 
                                                    <br> <b>Nombres:</b> {{$acta->nombres}}
                                                </span>
                                              
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                             
                                              <form method="POST" action="{{route('ActaNacimiento.destroy',$acta->idActa)}}">
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
                    {{-- @else

                    @foreach ($ActaNacimiento as $item)
                        <tr>
                        <td>{{$item->idActa}}</td>
                        <td>{{$item->Apellido_Paterno . " " . $item->Apellido_Materno." ".$item->Nombres}}</td>
                        <td>{{$item->fecha_Acta}}</td>
                        <td>{{$item->lugar_Acta}}</td>
                        <td>{{$item->DNI}}</td>
                        <td>
                            <br>
                            <a href="{{ route('ActaNacimiento.archivo',$item->idActaPersona)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Ver</a>
                            <a href="{{ route('ActaNacimiento.generada',$item->idActaPersona)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>Generar</a>
                            <a href="{{ route('ActaNacimiento.edit',$item->idActaPersona) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Editar</a>
                            <a  href="{{ route('ActaNacimiento.confirmar',$item->idActaPersona) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Eliminar</a>
                        </td>
                        </tr>
                    @endforeach
                    @endif --}}
                    </tbody>
                </table>
                {{$ActaNacimiento->links()}}
            </div>
        </div>
</div>

@endsection
