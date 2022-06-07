<?php
session_start();
include("../conf/conf.php");
// echo "variable de sesion: " . $_SESSION['idColegiado'];

if(!isset($_SESSION['idColegiado']) || $_SESSION["idColegiado"]==null ){
	print "<script>alert('Acceso invalido! - Inicia Sesion para Acceder');window.location='index.php';</script>";
	exit();
}


// if(!isset($_SESSION["idColegiado"]) || $_SESSION["idColegiado"]==null){
// 	// print "<script>alert('Acceso invalido! - Inicia Sesion para Acceder');window.location='index.php';</script>";
// 	echo "llega";
// 	exit();
// }
// include("conexion/config.php");

$datuser 		     = $_SESSION["nombre"] . ' ' . $_SESSION['apellido_paterno'];
$datnomuser      = $_SESSION["nombre"];
$datapepaterno   = $_SESSION['apellido_paterno'];
$datapematerno   = $_SESSION['apellido_materno'];
$apellidos       = $_SESSION['apellido_paterno'] . ' ' . $_SESSION['apellido_materno'];
$nombre_completo = $_SESSION['nombre'] . ' ' . 
                   $_SESSION['apellido_paterno'] . ' ' . 
                   $_SESSION['apellido_materno'];
$codigo_col      = $_SESSION['codigo_col'];


// $_SESSION['idColegiado']    		= $data->idColegiado;
// $_SESSION['nombre']         		= $data->nom_colegiado;
// $_SESSION['apellido_paterno']   = $data->ape_paterno;
// $_SESSION['apellido_materno']   = $data->ape_materno;

// $variable = $_GET["key"];
// $tem = isset($_GET["tema"]);
// $mensa = isset($_GET["var"]);

//funcion corta palabras en un largo texto
// function cortar_palabras($texto, $largor = 6, $puntos = "...") 
// { 
//    $palabras = explode(' ', $texto); 
//    if (count($palabras) > $largor) 
//    { 
//      return implode(' ', array_slice($palabras, 0, $largor)) ." ". $puntos; 
//    } else
//          {
//            return $texto; 
//          } 
// } 


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include("titulo.php"); ?>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="../dist/css/style.css?f=87">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



  <!-- script para descargar archivos en la misma pagina sin recargar -->
  <script src="js/modernizr.js"></script>
   
  <script>
		function confirmar2(){
			if(confirm('Estas seguro de eliminar este registro ? \n Si ACEPTAS se borrara de la BASE DE DATOS !'))
				return true;
			else
				return false;
		}
	</script>
      
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include("menu_superior.php"); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include("menu_lateral_izquierdo.php"); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        

         <center><img src="../dist/img/logo-ini.png"></center><br>
          <div class="row purchace-popup">
<!--             <div class="col-12">
              <h1 align="center">Dashboard de colegiado</h1>
            </div> -->
          </div>
          
          
          <div class="row">
           
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                
                 

                 <div class="panel panel-container">
                  <div class="row" style="height: 800px;" >

                  <div class="jumbotron" style="background-color: #E4FDFF; margin:0px auto; text-align: center; border: none;">
                    <h3>Bienvenido a la plataforma!</h3>
                    <hr class="my-4">
                    <div>
                  <!--     <iframe width="560" height="315" src="https://www.youtube.com/embed/y19UG2oopvg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->

                      <!-- <iframe width="80%" height="350" src="https://www.youtube.com/watch?v=9NeLQ0hdczM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->

<iframe width="60%" height="500" src="https://www.youtube.com/embed/9NeLQ0hdczM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


<!-- <iframe src="https://drive.google.com/file/d/1sREtEdtAxmLtl3YWTALG-mChnuQWAN4Z/preview" width="640" height="480" allow="autoplay"></iframe>                       -->


                    </div>
                  </div>
                  				


<!--         <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
          <div class="card card-statistics">
            <div class="card-body">
              <div class="clearfix">
                 
              </div>
            </div>
          </div>
				</div> -->

                 </div>
                  
                </div>
                
              </div>
            </div>
          </div>
          

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include("footer.php"); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>

	http://127.0.0.1/colegio_biologos/mod_usuarios/%3Cbr%20/%3E%3Cb%3EWarning%3C/b%3E:%20%20Use%20of%20undefined%20constant%20ENLACE_WEB%20-%20assumed%20'ENLACE_WEB'%20(this%20will%20throw%20an%20Error%20in%20a%20future%20version%20of%20PHP)%20in%20%3Cb%3EC:/laragon/www/colegio_biologos/mod_usuarios/view_dashboard.php%3C/b%3E%20on%20line%20%3Cb%3E186%3C/b%3E%3Cbr%20/%3EENLACE_WEBmod_usuarios/js/off-canvas.js
  
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo ENLACE_WEB;?>mod_usuarios/js/off-canvas.js"></script>
  <script src="<?php echo ENLACE_WEB;?>mod_usuarios/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo ENLACE_WEB;?>mod_usuarios/js/dashboard.js"></script>
  <!-- End custom js for this page-->

		  <?php // if($variable!=""){ ?>
					  <script> 
					/*   $(document).ready(function()
					   {
					      $("#Modal").modal("show");
					   });*/
					</script>
		 <?php // } ?>


	
	<!-- script para descargar archivos en la misma pagina sin recargar -->
<script src="<?php echo ENLACE_WEB;?>mod_usuarios/js/scripts_descarga.js"></script>
	
	<?php // mysqli_close($linkdocu); ?>
</body>

</html>