<?php
session_start();
include("../conf/conf.php");

if(!isset($_SESSION['idColegiado']) || $_SESSION["idColegiado"]==null ){
	print "<script>alert('Acceso invalido! - Inicia Sesion para Acceder');window.location='index.php';</script>";
	exit();
}

$datuser         = $_SESSION["nombre"] . ' ' . $_SESSION['apellido_paterno'];
$datnomuser      = $_SESSION["nombre"];
$datapepaterno   = $_SESSION['apellido_paterno'];
$datapematerno   = $_SESSION['apellido_materno'];
$apellidos       = $_SESSION['apellido_paterno'] . ' ' . $_SESSION['apellido_materno'];
$nombre_completo = $_SESSION['nombre'] . ' ' . 
                   $_SESSION['apellido_paterno'] . ' ' . 
                   $_SESSION['apellido_materno'];
$codigo_col      = $_SESSION['codigo_col'];

  $sql = "SELECT C.idColegiado, 
                 C.codigo_col as codigo, 
                 C.nom_colegiado, 
                 C.ape_paterno, 
                 C.ape_materno, 
                 C.dni, 
                 C.fec_nac, 
                 C.foto, 
                 C.telefono, 
                 C.email, 
                 C.lug_nacim, 
                 C.lug_labores, 
                 C.info_contacto, 
                 C.estado,
                 CA.idColegiatura,
                 CA.fec_colegiatura as fecha_col
          FROM colegiados C INNER JOIN colegiatura CA
          ON CA.idColegiado = C.idColegiado
          WHERE C.idColegiado = " . $_SESSION['idColegiado'];


  $db = $dbh->prepare($sql);
  $db->execute();
  $data = $db->fetch(PDO::FETCH_OBJ);

  // idColegiatura
  // idColegiado
  // fec_colegiatura
  // desc_colegiatura
  // estado_colegiatura

  // echo "<pre>";
  // print_r($data_servicios);
  // echo "</pre>";
  // exit();
  
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
  <!-- <link rel="shortcut icon" href="images/favicon.png" /> -->
  
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
              <h3 align="center">Dashboard de colegiado</h3>
            </div>
          </div>
          
         
          <div class="row">
           
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <a href="certificado_pdf.php" target="_blank" class="btn btn-info btn-sm ml-3">IMPRIMRI PDF</a>
                  </h3>
                </div>

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
                                                    background-size: cover; width: 560px;">
                        <!-- <h4 class="card-title">Card title</h4> -->
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                          <div class="text-left" style="margin-top: 320px; margin-left: 60px;">

                            <div class="row" style="padding: 0px;">
                              <div class="col-md-6">
                                  <span style="font-size: 12px;">QUE EL BIÓLOGO</span>
                              </div>
                              <div class="col-md-6">
                                  <span style="font-weight: bolder; font-size: 12px;">
                                    <?php echo $data->ape_paterno. ' ' . 
                                               $data->ape_materno . ', ' . 
                                               $data->nom_colegiado; ?>
                                  </span>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6">
                                <span style="font-size: 12px;">CON FECHA DE COLEGIATURA</span>
                              </div>
                              <div class="col-md-6">
                                <span style="font-weight: bolder; font-size: 12px;"><?php 

                                      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

                                      $originalDate = $data->fecha_col;
                                      $newDate = date("d" . "DE" . "Y", strtotime($originalDate));  
                                      $dia = date("d", strtotime($originalDate));
                                      // $mes = date("n", strtotime($originalDate));
                                      $mes = $meses[date('n', strtotime($originalDate))-1];
                                      $anio = date("Y", strtotime($originalDate));
                                      echo $dia . " DE " . strtoupper($mes) . " DE " . $anio; 
                                  ?>
                                </span>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6">
                                <span style="font-size: 12px;">CON REGISTRO</span>
                              </div>
                              <div class="col-md-6">
                                <span style="font-weight: bolder; font-size: 12px;"><?php echo "CBP Nº " . $data->codigo; ?></span>  
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6">
                                <span style="font-size: 12px;">HABILITADO AL</span>
                              </div>
                              <div class="col-md-6">
                                <span id="habilidad" style="font-weight: bolder; font-size: 12px;"></span>
                              </div>
                            </div>

                            <div class="row" style="padding-top: 15px;">
                              <div class="col-md-12">
                                <p style="text-align: justify; font-size: 12px;"> DE CONFORMIDAD CON LO DISPUESTO EN EL ARTÍCULO 05 DE LA LEY N° 28847 LEY DEL TRABAJO DEL BIÓLOGO Y DEL ARTÍCULO 06 DE SU REGLAMENTO APROBADO MEDIANTE DECRETO SUPREMO N° 025-2008-SA, SE ENCUENTRA HÁBIL Y EN CONSECUENCIA ESTA AUTORIZADO PARA EJERCER LA PROFESIÓN DE BIÓLOGO.</p>
                              </div>
                              <span style="text-align: justify; font-size: 12px; margin-top: -10px;">LIMA, 19 DE MARZO DE 2022</span>
                              
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

  <script type="text/javascript">
    
    function cargaDatosCertificado() {
      $.post('<?php echo ENLACE_WEB?>mod_usuarios/controller_usuarios.php?op=obtenerFechaHabilidad',function(r){
        // $("#optEspecialidad").html(r);
        $("#habilidad").html(r);
        // console.log(r);
      });
    }

    cargaDatosCertificado();

  </script>

	
	<!-- script para descargar archivos en la misma pagina sin recargar -->
<!-- <script src="<?php //ENLACE_WEB;?>mod_usuarios/js/scripts_descarga.js"></script> -->
	
	<?php // mysqli_close($linkdocu); ?>
</body>

</html>