<nav class="navbar navbar-expand-sm navbar-default">

    <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="./"><img src="images/logo.png" height="150" alt="Logo"></a>

    </div>

    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li @click="menu=0" class="active">
                <a href="#"> <i class="menu-icon fa fa-dashboard"></i>Escritorio </a>
            </li>
            <h3 class="menu-title">Cocina</h3><!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-wrench"></i>Herramientas de cocina</a>
                <ul class="sub-menu children dropdown-menu">
                    <li @click="menu=1"><i class="fa fa-fa-wrench"></i><a href="#">Ver Herramientas</a></li>
                </ul>

            </li>
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Equipo de Cocina</a>
                <ul class="sub-menu children dropdown-menu">
                    <li @click="menu=2"><i class="fa fa-puzzle-piece"></i><a href="#">Ver Equipo</a></li>

                </ul>
            </li>


            <h3 class="menu-title">Cristaleria y Mueble</h3><!-- /.menu-title -->

            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Cristaleria</a>
                <ul class="sub-menu children dropdown-menu">
                    <li @click="menu=3"><i class="menu-icon fa fa-glass"></i><a href="#">Ver Cristaleria</a></li>

                </ul>

            </li>
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-archive"></i>Mueble</a>
                <ul class="sub-menu children dropdown-menu">
                    <li @click="menu=4"><i class="fa fa-archive"></i><a href="#">Ver Mueble</a></li>
                </ul>
            </li>


            <h3 class="menu-title">Cuberteria y Limpieza</h3><!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cutlery"></i>Cubiertos</a>
                <ul class="sub-menu children dropdown-menu">
                    <li @click="menu=5" ><i class="fa fa-cutlery"></i><a href="#">Ver Cubiertos</a></li>

                </ul>
            </li>
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tint"></i>Limpieza</a>
                <ul class="sub-menu children dropdown-menu">

                    <li @click="menu=6"><i class="fa fa-tint"></i><a href="#">Ver Herramienta de Limpieza</a></li>
                </ul>
            </li>
            <h3 class="menu-title">Piezas dañadas</h3><!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-times-circle"></i>Piezas dañadas</a>
                <ul class="sub-menu children dropdown-menu">
                    <li @click="menu=7"><i class="fa fa-times-circle"></i><a href="#">Ver piezas</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
