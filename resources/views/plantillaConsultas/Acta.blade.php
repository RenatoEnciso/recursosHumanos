<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>  @yield('titulo')</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </head>
<body>
    <nav class="navbar bg-dark " data-bs-theme="dark">
        <div class="container-fluid d-inline">
          
            <a class="navbar-brand">
              
              <img src="{{asset('images/Logo-Login.png')}}" alt="Logo" width="150" height="60" class="d-inline-block align-text-top">
             
                @yield('subtitulo') 
              
              
            </a>

          
        </div>
      </nav>

    <div class="container border mx-auto my-4" style="width:700px;">
        @yield('cuerpo')
            
      
    </div>
    

    <footer class="text-center text-white fixed-bottom" style="background-color: #21081a;">
        <!-- Grid container -->
        <div class="container"></div>
        <!-- Grid container -->
      
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          © 2023 Copyright: RENIEC -GTI - SGIS
         
        </div>
       
      </footer>

</body>
</html>