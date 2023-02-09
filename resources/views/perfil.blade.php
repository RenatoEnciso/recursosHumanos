{{-- @extends('dashboard');


@section('contenido')
<form action="{{route('usuario.update',$usuario->id)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <label for="">Subir foto</label>
    <input type="file" name="file_fotoPerfil" value="{{ old('file_fotoPerfil') }}" x-data="showImage()">
    <button >Guardar</button>
</form>
 

@endsection --}}