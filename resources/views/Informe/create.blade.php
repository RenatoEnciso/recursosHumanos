@extends('dashboard');

@section('titulo','Generar Informe')

@section('contenido')

            <div class="container">
                <h1 id="titulo" >Generar Informe</h1>
                <br>
                <form method="POST" action="{{route('GenerarInfo')}}">
                    @csrf

                    <div id="mensaje">
                            @if (session('datos'))
                            <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31)" >
                                {{session('datos')}}
                            </div>
                            @endif
                    </div>

                    <div class="col-12 form-group">
                        <label class="control-label">Dni:</label>
                        <select name="dni" id="dni"
                            class="form-control @error('dni') is-invalid @enderror" >
                            @foreach ($personas as $item)
                                <option value="{{ $item->DNI }}">DNI:{{ $item->DNI}} - {{ $item->Nombres }} {{ $item->Apellido_Paterno}} {{ $item->Apellido_Materno}}</option>
                            @endforeach
                        </select>

                        @error('dni')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <br>
                    <div >
                        <button class="btn btn-primary"> <i class="fas fa-save"></i>Generar</button>
                        <a href="{{route('dashboard')}}" class="btn btn-danger" > <i class="fas fa-ban"></i>Cancelar</a>
                    </div>
                </form>
            </div>

@endsection
