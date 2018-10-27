<!doctype html>
  <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
  <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
  <html class="no-js lt-ie9" lang=""> <![endif]-->
  <html class="no-js" lang="">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema Gastronomia</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.css" media="screen" title="no title" charset="utf-8">

     <link rel="apple-touch-icon" href="apple-icon.png">
     <link rel="shortcut icon" href="favicon.ico">
     <link rel="stylesheet" href="css/plantilla.css">
     <link rel="stylesheet" href="scss/style.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

    </head>
    <body>
    <div id="app">
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        @if(Auth::check())

            @if(Auth::user()->id_roles == 1)
                @include('plantilla.sidebar')
            @elseif(Auth::user()->id_roles== 2)
                @include('plantilla.sidebarAdmin')
            @endif

        @endif
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            </div>

            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <div >
                        <form method="POST" action="{{ route('logout') }}">
                            {{ csrf_field() }}
                            <div class="btn-group"  >
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Opciones
                                    <i class="fa  fa-gears"></i>
                                </button>
                                <div class="user-menu dropdown-menu">
                                    <button class="btn btn-link">
                                        <i class="fa  fa-power-off"></i>
                                        Cerrar sesión</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </header><!-- /header -->
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Sistema gastronomia</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">

            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <h2> Bienvenido  {{ auth()->user()->name }}</h2>
                        <center><img src="images/profile.png" class="rounded-circle mx-auto d-block" right="100px" height="40" width="40"></center>

                    </ol>

                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="mx-auto d-block">





        </div>
@yield('contenido')


    </div> <!-- .content -->
</div><!-- /#right-panel -->
</div>
<!-- Right Panel -->
<script src="js/vendor/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="js/app.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plantilla.js"></script>
<script src="js/sweetalert2.all.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<script src="https://unpkg.com/promise-polyfill"></script>





<script type="text/javascript">


</script>
</body>
</html>
