<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Gasolinerias México</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>  
  <!-- Custom styles for this template -->
  <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">

  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

  <link href="{{asset('css/gmaps.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>    
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <a class="nav-link px-3" href="#">Sign out</a>
        </div>
      </div>
    </header>

    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky pt-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('welcome')}}">
                  <span data-feather="home"></span>
                  Gasolinerias
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('gasolinerias.create')}}">
                  <span data-feather="layers"></span>
                  Alta Gasolinería
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <h3>My Google Maps Demo</h3>
        <!--The div element for the map -->
        <div id="map"></div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating">
                <select class="form-select" id="sltEstado" name="sltEstado" aria-label="Selecciona un Estado">
                  <option value="todos" selected>Todos</option>
                  @foreach($gasolineras as $gas)
                    @isset($gas->estado)
                      <option value="{{$gas->estado}}">{{$gas->estado}}</option>
                    @endisset
                  @endforeach
                </select>
                <label for="sltEstado">Selecciona un Estado</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating">
                <select class="form-select" id="municipioSlt" name="municipioSlt" aria-label="Selecciona un Municipio">
                  <option value="todos" selected>Todos</option>
                  @foreach($gasolineras as $gas)
                    @isset($gas->municipio)
                      <option value="{{$gas->municipio}}">{{$gas->municipio}}</option>
                    @endisset
                  @endforeach
                </select>
                <label for="municipioSlt">Selecciona un Municipio</label>
              </div>
            </div>
            <div class="col">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioDesendente" value="DESC">
                <label class="form-check-label" for="radioDesendente">
                  Desendente
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioAsendente" value="ASC" checked>
                <label class="form-check-label" for="radioAsendente">
                  Asendente
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col text-center my-2">
              <button type="button" onclick="filtro('{{route('gasFiltro')}}')" class="btn btn-primary">Buscar y Ordenar</button>
            </div>
          </div>

          <h2>Gasolinerias</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Regular</th>
                  <th scope="col">Premiun</th>
                  <th scope="col">Dieasel</th>
                  <th scope="col">Calle</th>
                  <th scope="col">Colonia</th>
                  <th scope="col">Municipio</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Codigo Postal</th>
                  <th scope="col">RFC</th>
                  <th scope="col">Razonsocial</th>
                  <th scope="col">Date Insert</th>
                  <th scope="col">Numero Permiso</th>
                  <th scope="col">Fecha Aplicacion</th>
                  <th scope="col">Permisoid</th>
                  <th scope="col">Longitude</th>
                  <th scope="col">Latitude</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="Gasolinerias-tbl">
                @include('gasolineras-tbl')
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <!-- 
    The `defer` attribute causes the callback to execute after the full HTML
    document has been parsed. For non-blocking uses, avoiding race conditions,
    and consistent behavior across browsers, consider loading using Promises
    with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0WvNe-Efxd1How-cJngQcWtYJ8sDFJNU&callback=initMap"
      defer>  //AIzaSyB0WvNe-Efxd1How-cJngQcWtYJ8sDFJNU   AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('js/dashboard.js')}}"></script>
    <script src="{{asset('js/gmaps.js')}}"></script>
  </body>
</html>
