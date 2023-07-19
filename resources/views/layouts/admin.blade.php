<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- MAP -->
    <link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.18.0/maps/maps.css">
    <script type="text/javascript" src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.18.0/maps/maps-web.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BoolBnb @yield('title')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>

  <div class="main-wrapper @auth d-flex @endauth">

    @auth
      @include("admin.partials.aside")

      <main>
        <div class="jumbotron text-white">
          <div class="logout">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                @csrf
                <button class="btn btn-danger" type="submit" title="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
            </form>
          </div>
            <h1>@yield("jumbotron-title")</h1>
            <h4>@yield("jumbotron-subtitle")</h4>
        </div>
        @endauth
        @yield('content')
      </main>

    </div>
    @include("admin.partials.footer")
</body>

</html>

