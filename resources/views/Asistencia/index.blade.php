<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Face detection on the browser using javascript !</title>
  <script defer src="{{asset('/asistencia/face-api.min.js')}}"></script>
  <script defer src="{{asset('/asistencia/web.js')}}"></script>
  <link rel="stylesheet"  href="{{asset('/asistencia/style.css')}}">
</head>
<body>
  @if (session('datos'))
                <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31) ">
                    {{session('datos')}}
                </div>
                @endif
  <video id="video" width="600" height="450" autoplay>
    <form method="POST" action="{{ route('Contrato.store') }}" enctype="multipart/form-data">
      @csrf
      <input type="text" value="{{Auth::user()->id}}" name="id" id="id" readonly>
      @foreach ($usuarios as $item)
        <input type="text" value="{{$item->id}}" name="archivos"  readonly>
      @endforeach
      <button id="btnAsistencia">ASISTENCIA </button>
    </form>
</body>
</html>
