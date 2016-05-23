<?php
@session_start();
  if (isset($_SESSION['id_en']))
  {
    header('Location: /Desarrollo_SSPED/indexr.php');  
  }
  else
  {
    
  }
?>

<!DOCTYPE html>
<html>
<head> 
	<title></title>
    <link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>

    <script type="text/javascript">

    $(document).ready(function() {

      $('#formRegistrocoach').on('submit', registro_entrenador);
      $('#login_form').on('submit', inicio_sesion);
      $('#btn-limpiar-en').on('click', limpiar_datos);
      $('#carruselfut').carousel({
        interval: 3000
      });
      $('#carruseltria').carousel({
        interval: 3500
      });
      $('#cierre_sesion').on('click', function(){
        unsset($_SESSION['id_en']);
      })
    }) 
    function limpiar_datos()
    {
      $('#nombrecoach').val('');
      $('#apellidopcoach').val('');
      $('#apellidomcoach').val('');
      $('#carnet').val('');
      $('#telefono').val('');
      $('#mailcoach').val('');              
      $('#passwordcoach').val('');
      $('#password2coach').val('');
    }

     function registro_entrenador()
    {
          setTimeout("$('.ocultar').hide();", 5000);
          var datos= $('#formRegistrocoach').serialize();
          datos += "&opcion=" + encodeURIComponent('registrar_coach');
          console.log(datos);
          $.ajax({
            url: 'entrenador.php',
            type: $('#formRegistrocoach').attr('method'),
            data: datos
          })
          .done(function(data) {
            var resp = $.parseJSON(data);
            console.log(data);
            console.log(resp);
            var t= resp.resp;
            if(t==1)
            {
              $('#nombrecoach').val('');
              $('#apellidopcoach').val('');
              $('#apellidomcoach').val('');
              $('#carnet').val('');
              $('#telefono').val('');
              $('#mailcoach').val('');              
              $('#passwordcoach').val('');
              $('#password2coach').val('');
              var html='<div  class="alert alert-success ocultar" role="alert"> Entrenador agregado!</div>'; 
              setTimeout("$('#registromodal').modal('hide');", 2000);
            }
            else{
              if(t==2)
              {
                var html='<div  class="alert alert-warning ocultar" role="alert"> Los Password`s no son iguales</div>'; 
              }
              else
              {
                var html='<div  class="alert alert-danger ocultar" role="alert"> No se pudo agregar</div>'; 
              }
            }
            $('#resultado').html(html);      
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
        
      }
     

     function inicio_sesion()
    {
          setTimeout("$('.ocultar').hide();", 1000);
          var datos= $('#login_form').serialize();
          datos += "&opcion=" + encodeURIComponent('inicio_sesion');
          console.log(datos);
          $.ajax({
            url: 'entrenador.php',
            type: $('#login_form').attr('method'),
            data: datos
          })
          .done(function(data) {
            var resp = $.parseJSON(data);
            console.log(resp);
            if (resp.res == 1)
            {
              var mostrar = '<div  class="alert alert-success ocultar col-xs-offset-2 col-xs-8" role="alert"> Bienvenido!</div>'; 
              setTimeout("$('#modalingreso').modal('hide');", 2000);
            }
            else
            {
              var mostrar='<div  class="alert alert-danger ocultar" role="alert"> CI o Password Incorrectos</div>'; 
            }    
            $('#muestra').html(mostrar); 
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
    }
     
    </script>
</head>
<body>
<!--  llamada a la cabecera -->
	<?php 
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/cabecerageneral.php";
 	?>
  <?php 
    require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/barramenusr.php";
  ?>
  <!--  menu de deportes existentes -->
 	<div class="col-sm-offset-2 col-sm-8 col-xs-12">
 		<div class="jumbotron">
  		<div class="media">
  			<div class="media-left col-sm-5 col-sm-offset-0 col-xs-offset-1 col-xs-10">
    			<?php 
            require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/imgfutbol.php";
          ?>
        </div> 
  			<div class="media-body">
    			<p><h4 class="media-heading">FUTBOL:</h4></p>
    				<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati fuga saepe temporibus perspiciatis maiores iste voluptatum voluptatibus repellat repudiandae, enim exercitationem assumenda quo, natus officiis esse, vel itaque a unde.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo repellendus ipsum provident sit numquam optio quis odio autem repellat assumenda nobis, non, iste dolor esse ut tempora! Quis, voluptas, eum!<BR>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, fugit, ab. Illo, totam quaerat facere eaque sequi nam molestias. Necessitatibus blanditiis adipisci quis modi possimus explicabo itaque ab consequatur sunt?</h6><br>
            
          <a href="/Desarrollo_SSPED/Futbol/futbol.php">
            <button type="button" class="btn btn-info">
              Seleccionar
            </button>
          </a>
        </div>
			</div>
		</div>	
 	</div>

  <div class="col-sm-offset-2 col-sm-8 col-xs-12">
    <div class="jumbotron">
        <div class="media">
          <div class="media-left col-sm-5 col-sm-offset-0 col-xs-offset-1 col-xs-10">
            <?php 
              require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/imgtriatlon.php";
            ?>
         </div> 
        <div class="media-body">
          <p><h4 class="media-heading">TRIATLON:</h4></p>
            <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati fuga saepe temporibus perspiciatis maioresiste voluptatum voluptatibus repellat repudiandae, enim exercitationem assumenda quo, natus officiis esse, vel itaque a unde.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo repellendus ipsum provident sit numquam optio quis odio autem repellat assumenda nobis, non, iste dolor esse ut tempora! Quis, voluptas, eum!<BR>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, fugit, ab. Illo, totam quaerat facere eaque sequi nam molestias. Necessitatibus blanditiis adipisci quis modi possimus explicabo itaque ab consequatur sunt?</h6><br>
            
            <a href="/Desarrollo_SSPED/Futbol/triatlonindex.php">
              <button type="button" class="btn btn-info">
                Seleccionar
              </button>
            </a>
        </div>
      </div>
    </div>  
  </div>

  <div class="col-sm-offset-2 col-sm-8 col-xs-12">
    <div class="jumbotron">
        <div class="media">
          <div class="media-left col-sm-5 col-sm-offset-0 col-xs-offset-1 col-xs-10">
            <?php 
              require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/imgnatacion.php";
            ?>
         </div> 
        <div class="media-body">
          <p><h4 class="media-heading">NATACION:</h4></p>
            <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati fuga saepe temporibus perspiciatis maioresiste voluptatum voluptatibus repellat repudiandae, enim exercitationem assumenda quo, natus officiis esse, vel itaque a unde.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo repellendus ipsum provident sit numquam optio quis odio autem repellat assumenda nobis, non, iste dolor esse ut tempora! Quis, voluptas, eum!<BR>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, fugit, ab. Illo, totam quaerat facere eaque sequi nam molestias. Necessitatibus blanditiis adipisci quis modi possimus explicabo itaque ab consequatur sunt?</h6><br>
            
            <a href="/Desarrollo_SSPED/Futbol/triatlonindex.php">
              <button type="button" class="btn btn-info">
                Seleccionar
              </button>
            </a>
        </div>
      </div>
    </div>  
  </div>

  <div class="col-sm-offset-2 col-sm-8 col-xs-12">
    <div class="jumbotron">
        <div class="media">
          <div class="media-left col-sm-5 col-sm-offset-0 col-xs-offset-1 col-xs-10">
            <?php 
              require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/imgciclismo.php";
            ?>
         </div> 
        <div class="media-body">
          <p><h4 class="media-heading">CICLISMO:</h4></p>
            <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati fuga saepe temporibus perspiciatis maioresiste voluptatum voluptatibus repellat repudiandae, enim exercitationem assumenda quo, natus officiis esse, vel itaque a unde.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo repellendus ipsum provident sit numquam optio quis odio autem repellat assumenda nobis, non, iste dolor esse ut tempora! Quis, voluptas, eum!<BR>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, fugit, ab. Illo, totam quaerat facere eaque sequi nam molestias. Necessitatibus blanditiis adipisci quis modi possimus explicabo itaque ab consequatur sunt?</h6><br>
            
            <a href="/Desarrollo_SSPED/Futbol/triatlonindex.php">
              <button type="button" class="btn btn-info">
                Seleccionar
              </button>
            </a>
        </div>
      </div>
    </div>  
  </div>

  <div class="col-sm-offset-2 col-sm-8 col-xs-12">
    <div class="jumbotron">
        <div class="media">
          <div class="media-left col-sm-5 col-sm-offset-0 col-xs-offset-1 col-xs-10">
            <?php 
              require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/imgatletismo.php";
            ?>
         </div> 
        <div class="media-body">
          <p><h4 class="media-heading">ATLETISMO:</h4></p>
            <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati fuga saepe temporibus perspiciatis maioresiste voluptatum voluptatibus repellat repudiandae, enim exercitationem assumenda quo, natus officiis esse, vel itaque a unde.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo repellendus ipsum provident sit numquam optio quis odio autem repellat assumenda nobis, non, iste dolor esse ut tempora! Quis, voluptas, eum!<BR>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, fugit, ab. Illo, totam quaerat facere eaque sequi nam molestias. Necessitatibus blanditiis adipisci quis modi possimus explicabo itaque ab consequatur sunt?</h6><br>
            
            <a href="/Desarrollo_SSPED/Futbol/triatlonindex.php">
              <button type="button" class="btn btn-info">
                Seleccionar
              </button>
            </a>
        </div>
      </div>
    </div>  
  </div>
  <!--  llamada al pie de pagina -->
 	<?php 
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/pie1.php";
 	?>
</body>
</html>

