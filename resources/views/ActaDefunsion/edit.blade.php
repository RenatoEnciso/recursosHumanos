@extends('dashboard')

@section('titulo', 'Editar acta de defunsion')

@section('contenido')
    <div class="container">
        <h1 id="titulo" class="acta_title">Editar Acta de Defuncion</h1>
        <form method="POST" action="{{ route('ActaDefunsion.update', $actaDefunsion->idActaPersona) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="control-label">CODIGO</label>
                <input type="text" class="form-control" style="color: blue" value="{{ $actaDefunsion->idActaPersona }}" disabled>
            </div>
            <div class="row">
                <div class="col-8">
                    <div style="display: flex">
                        <div class="col col-6">
                            <label class="control-label">Numero de libro</label>
                            <select name="nroLibro" id="idLibro" 
                                class="form-control @error('libro') is-invalid @enderror">
                                @foreach($libros as $item)
                                <option value="{{$item['idLibro'] }}" {{$item->idLibro==$acta->idLibro?'selected':''}}> Libro
                                    {{$item['nroLibro'] }}</option>
                                 @endforeach
                            </select>
                            @error('libro')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col col-6">
                            <label class="control-label">Numero de Folio</label>
                            <select name="nroFolio" id="idFolio" 
                                class="form-control @error('folio') is-invalid @enderror">
                                @foreach($folios as $item)
                                    <option value="{{$item['idFolio'] }}" {{$item->idFolio==$acta->idFolio?'selected':''}}  > Folio 
                                    {{$item['nroFolio'] }}</option>
                                @endforeach
                            </select>
                            @error('folio')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label class="control-label">Detalle de la Muerte</label>
                        <input type="text" class="form-control @error('observacion') is-invalid @enderror"
                            value="{{ $acta->observacion }}" id="observacion" name="observacion">
                        @error('observacion')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label class="control-label">Fecha </label>
                        <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha"
                            name="fecha" value="{{ $acta->fecha_Acta }}">
                        @error('fecha')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 form-group">
                        <label class="control-label">Lugar de Extraccion</label>
                        <input type="text" class="form-control @error('lugar') is-invalid @enderror"
                            value="{{ $acta->lugar_Acta }}" id="lugar" name="lugar">
                        @error('lugar')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 form-group">
                        <label class="control-label">Persona</label>
                        <select name="dniPersona" id="DNI"
                            class="form-control @error('persona') is-invalid @enderror">
                            @foreach($personas as $item)
                                <option value="{{$item['DNI'] }}" {{$item->DNI==$actaDefunsion->DNI?'selected':''}}>
                                    {{$item['Nombres'] }}</option>
                                 @endforeach

                        </select>
                        @error('persona')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-4">
                    <div class="col-12">
                        <label class="control-label">Archivo de Defunsion</label>
                        <input type="file" class="form-control @error('archivo_defunsion') is-invalid @enderror"
                            placeholder="Ingrese Archivo" id="archivo_defunsion" name="archivo_defunsion"
                            value="{{ old('archivo_defunsion') }}" x-data="showImage()" @change="showPreview(event)">
                        <iframe src="{{ $acta->archivo }}" id="preview" class="object-cover h-32 mt-2 w-60"
                            height="100%"> </iframe>
                        @error('archivo_defunsion')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </div><br>
            <div class="boton_div">
                <div>
                    <button class="btn btn-primary boton"><i class="fas fa-save"></i> GRABAR</button>
                </div>
                <div>
                    <a href="{{ route('ActaDefunsion.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
                </div>
            </div>
        </form>
    </div>
    <script>
        function showImage() {
            return {
                showPreview(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("preview");
                        preview.src = src;
                        preview.style.display = "block";
                    }
                }
            }
        }
    </script>
    <script>
        function mensaje() {
        $('#DNI').select2();
        $('#idLibro').select2();
        $('#idFolio').select2();
        }
        setTimeout(mensaje,500);
    </script>
@endsection
