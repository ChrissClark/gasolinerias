<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Dashboard Template · Bootstrap v5.1</title>

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

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <form action="{{isset($gasolineria->id) ? route('gasolinerias.update', $gasolineria->id) : route('gasolinerias.store')}}" method="post">
                @isset($gasolineria->id)
                    @method('PATCH')
                @endisset
                <div class="form-floating my-3"">
                    <input type="text" class="form-control" id="_id" name="_id" placeholder="ID" value="{{old('_id') ?? $gasolineria->_id}}">
                    <label for="_id">id Gasolinería</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="regular" name="regular" placeholder="Precio Regular" value="{{old('name') ?? $gasolineria->regular}}">
                    <label for="regular">Precio Gasolina Regular</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="premium" name="premium" placeholder="Precio Premium" value="{{old('premium') ?? $gasolineria->premium}}">
                    <label for="premium">Precio Gasolina Premium</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="dieasel" name="dieasel" placeholder="Precio Dieasel" value="{{old('dieasel') ?? $gasolineria->dieasel}}">
                    <label for="dieasel">Precio Gasolina Dieasel</label>
                </div>
                <div class="form-floating mb-3"">
                    <input type="text" class="form-control" id="calle" name="calle" placeholder="calle" value="{{old('calle') ?? $gasolineria->calle}}">
                    <label for="calle">calle</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="colonia" name="colonia" placeholder="colonia" value="{{old('colonia') ?? $gasolineria->colonia}}">
                    <label for="colonia">Colonia</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="municipio" name="municipio" placeholder="municipio" value="{{old('municipio') ?? $gasolineria->municipio}}">
                    <label for="municipio">Municipio</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" value="{{old('estado') ?? $gasolineria->estado}}">
                    <label for="estado">Estado</label>
                </div>
                <div class="form-floating mb-3"">
                    <input type="text" class="form-control" id="codigopostal" name="codigopostal" placeholder="codigo postal" value="{{old('codigopostal') ?? $gasolineria->codigopostal}}">
                    <label for="codigopostal">codigo postal</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="rfc" value="{{old('rfc') ?? $gasolineria->rfc}}">
                    <label for="rfc">rfc</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="razonsocial" name="razonsocial" placeholder="razon social" value="{{old('razonsocial') ?? $gasolineria->razonsocial}}">
                    <label for="razonsocial">Razon Social</label>
                </div>
                <div class="form-floating mb-3"">
                    <input type="text" class="form-control" id="numeropermiso" name="numeropermiso" placeholder="Numero Permiso" value="{{old('numeropermiso') ?? $gasolineria->numeropermiso}}">
                    <label for="numeropermiso">Numero Permiso</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="permisoid" name="permisoid" placeholder="Permiso id" value="{{old('permisoid') ?? $gasolineria->permisoid}}">
                    <label for="permisoid">Permiso id</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="{{old('longitude') ?? $gasolineria->longitude}}">
                    <label for="longitude">Longitude</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="{{old('latitude') ?? $gasolineria->latitude}}">
                    <label for="latitude">Latitude</label>
                </div>

                <div class="row">
                    <div class="col text-center my-2">
                    @if(!isset($gasolineria->id))
                        <button type="submit" class="btn btn-outline-secondary">Alta</button>
                    @else
                        <button type="submit" class="btn btn-outline-secondary">Actualizar</button>
                    @endif
                    </div>
                </div>
                @csrf
            </form>
        </main>
        
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="{{asset('js/dashboard.js')}}"></script>
  </body>
</html>


