<!-- Banda de Presentacion  -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/Desarrollo_SSPED/index.php"> Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/Desarrollo_SSPED/Futbol/futbol.php">Futbol<span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perfil <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/Desarrollo_SSPED/Futbol/perfilcouch.php">Ver Perfil</a></li>
            <li><a href="/Desarrollo_SSPED/Futbol/cambiopass.php">Cambiar Password</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="" class="modal1" data-toggle="modal" data-target="#modalcierresesion">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>

<!-- MODAL DE CONFIRMACION DEL CIERRE DE SESION -->
<div class="modal fade" id="modalcierresesion" tabindex="-1" role="dialog" aria-labelledby="modalcierresesion">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cierre de Sesion</h4>
      </div>
          
      <div class="modal-body">
        <form class="form-horizontal" method="post" action='' name="login_form">
          <div class="form-group">
            <label class="control-label col-xs-offset-1 col-xs-10">Seguro de cerrar su sesion?</label>
          </div>

          <div class="form-group">
            <div class="col-xs-offset-2 col-xs-7">
              <a href="/Desarrollo_SSPED/index.php">
                <button id="cierre_sesion" type="button" class="btn btn-success btn-sm">Aceptar</button>
              </a>
            </div>
          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


    