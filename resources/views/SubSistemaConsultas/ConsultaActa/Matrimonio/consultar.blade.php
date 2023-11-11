@extends('plantillaConsultas.Acta')
@section('titulo', 'Acta Matrimonio')
@section('subtitulo', 'Consulta Acta Matrimonio')
@section('cuerpo')
    <form action="{{ route('SearchMatrimonio') }}" method="post" class="px-5 py-2">
        @csrf
        <div>
            <img src="{{ asset('images/matrimonio.png') }}" alt="matrimonio" width="100px" class="img-fluid d-block mx-auto">
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <label class="form-label" for="">Año Matrimonio</label>
                <input type="number" class="form-control @error('ano') is-invalid @enderror " name="ano"
                    placeholder="Año(4 digitos)" value="{{old('ano')}}">
                @error('ano')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="col-sm-12 col-md-6">
                <label class="form-label" for="">Mes del matrimonio</label>
                <select class="form-select @error('mes')is-invalid @enderror" name="mes" id="">
                    <option selected disabled>Seleccione el mes de matrimonio</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
                @error('mes')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <label class="form-label" for="">Primer Apellido</label>
                <input type="text" class="form-control @error('primer_apellido') is-invalid @enderror"
                    name="primer_apellido" placeholder="Primer Apellido" value="{{old('primer_apellido')}}">
                @error('primer_apellido')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="col-sm-12 col-md-6">
                <label class="form-label" for="">Segundo Apellido</label>
                <input type="text" class="form-control @error('segundo_apellido') is-invalid @enderror"
                    name="segundo_apellido" placeholder="Segundo Apellido" value="{{old('segundo_apellido')}}">
                @error('segundo_apellido')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="" class="form-label">Prenombres</label>
            <input type="text" class="form-control @error('prenombres') is-invalid @enderror" name="prenombres"
                placeholder="Prenombres" value="{{old('prenombres')}}">
            @error('prenombres')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="row mx-5">
            <div class="col-6">
                <a type="button" href="{{route('regresar')}}" class="btn btn-danger px-5">Salir</a>
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-success px-3">Consultar</button>
            </div>
        </div>


    </form>
@endsection
