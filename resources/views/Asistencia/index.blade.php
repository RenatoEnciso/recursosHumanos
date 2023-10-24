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
  <video id="video" width="600" height="450" autoplay>
    <input type="text" value="5" name="id" id="id" readonly>
    @foreach ($usarios as $item)
      <input type="text" value="{{$item->id}}" name="archivos"  readonly>
    @endforeach
</body>
</html>