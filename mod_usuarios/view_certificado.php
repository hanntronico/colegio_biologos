<?php
session_start();

if(!isset($_SESSION['idColegiado']) || $_SESSION["idColegiado"]==null ){
	print "<script>alert('Acceso invalido! - Inicia Sesion para Acceder');window.location='index.php';</script>";
	exit();
}


$datuser 		= $_SESSION["nombre"] . ' ' . $_SESSION['apellido_paterno'];
$datnomuser = $_SESSION["nombre"];




//cuenta libros
	$mensa="";

  $totahr = "0";
  $totapre = "0";
  $totarese = "0";
  $totauuse = "0";

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
        
        <?php if($mensa=="delete"){ ?>
         <!--<div class="row purchace-popup">-->
            <div class="col-12">
              <span class="d-block d-md-flex align-items-center">
                <p class="text-success"><strong>Mensaje !</strong> Se elimino el registro satisfactoriamente ! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                <!--<i class="mdi mdi-close popup-dismiss d-none d-md-block"></i>-->
              </span>
            </div>
          <!--</div>-->
          <?php } ?>
           <?php if($mensa=="ok"){ ?>
         <!--<div class="row purchace-popup">-->
            <div class="col-12">
              <span class="d-block d-md-flex align-items-center">
                <p class="text-success"><strong>Mensaje !</strong> Se modifico el registro satisfactoriamente ! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                <!--<i class="mdi mdi-close popup-dismiss d-none d-md-block"></i>-->
              </span>
            </div>
          <!--</div>-->
          <?php } ?>
          <?php if($mensa=="vok"){ ?>
         <!--<div class="row purchace-popup">-->
            <div class="col-12">
              <span class="d-block d-md-flex align-items-center">
                <p class="text-success"><strong>Mensaje !</strong> Se registro satisfactoriamente la visita! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                <!--<i class="mdi mdi-close popup-dismiss d-none d-md-block"></i>-->
              </span>
            </div>
          <!--</div>-->
          <?php } ?>
          <?php if($mensa=="ok-pass"){ ?>
            <div class="col-12">
              <span class="d-block d-md-flex align-items-center">
                <p class="text-success"><strong>Mensaje !</strong> tu clave se cambio  satisfactoriamente ! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              </span>
            </div>
          <?php } ?>
          <?php if($mensa=="faild-pass"){ ?>
            <div class="col-12">
              <span class="d-block d-md-flex align-items-center">
                <p class="text-danger"><strong>Mensaje !</strong> tu clave no se cambio  verificalo ! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              </span>
            </div>
          <?php } ?>

         <center><img src="../dist/img/logo-ini.png"></center><br>
          <div class="row purchace-popup">
            <div class="col-12">
              <h1 align="center">Dashboard de colegiado</h1>
            </div>
          </div>
          
          
          <div class="row">
           
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                
                 

                <div class="panel panel-container">
                  <div class="row" style="height: 800px;" >




                    <div class="card text-center">
                      <!-- <img src="../dist/img/certificado.jpg" width="40%" style="margin: 0px auto;"> -->
                      <div class="card-body" style="margin:0px auto; 
                                                    text-align: center; 
                                                    background-image: url('../dist/img/certificado.jpg'); 
                                                    background-repeat: no-repeat;
                                                    background-position: center center;
                                                    background-size: cover; width: 560px; border: 1px solid red;">
                        <!-- <h4 class="card-title">Card title</h4> -->
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                          <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="" value="Nombre" placeholder="">
                            </div>
                            
                          </div>
                      </div>
                    </div>


<!--                         <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                          <div class="card card-statistics">
                            <div class="card-body">
                              <div class="clearfix">

                                <img src="../dist/img/certificado.jpg" width="120%">
                              
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

	

  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php ENLACE_WEB;?>mod_usuarios/js/off-canvas.js"></script>
  <script src="<?php ENLACE_WEB;?>mod_usuarios/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php ENLACE_WEB;?>mod_usuarios/js/dashboard.js"></script>
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
<script src="<?php ENLACE_WEB;?>mod_usuarios/js/scripts_descarga.js"></script>
	
	<?php // mysqli_close($linkdocu); ?>
</body>

</html>