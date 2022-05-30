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



  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

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
            <div class="col-12">
              <input type="hidden" name="idcolegiado" id="idcolegiado" value="<?php echo $data->idColegiado; ?>">
            </div>
          </div>
          
         
          <div class="row">
           
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-header">
                  <h2 class="card-title">
                      ESTADO DE SU DEUDA
                  </h2>
                </div>

                <div class="card-body">

                  <table id="lista_pagos_id" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Codigo colegiado</th>
                      <th>Nro cuota</th>
                      <th>Fecha venci.</th>
                      <th style="text-align: right;">Mora</th>
                      <th style="text-align: right;">Deuda</th>
                      <th>Gen</th>
                      <th style="text-align: right;">Adelanto</th>
                      <th style="text-align: right;">Saldo</th>
                    </tr>
                    </thead>
                    <tbody id="lista_pagos">
                    </tbody>
                  </table>
           
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



<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>




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


function buscarPagos() {

    tabla=$('#lista_pagos_id').dataTable(
    {
      "lengthMenu": [ 5, 12, 24, 75, 100],
      "aProcessing": true,
        "aServerSide": true,
      "ajax":
          {
            url: '<?php echo ENLACE_WEB?>mod_pagos/controller_pagos.php?op=listar_pagos&idcol=' + $("#idcolegiado").val(),
            type : "get",
            dataType : "json",            
            error: function(e){
              console.log(e.responseText);
              if (e.responseText == 'error') {
                $("#lista_pagos").empty().html('<tr><td colspan="8" class="text-center">Vacio</td></tr>');
                // alert('sin pagos');
              }
            }
            // ,
            // success: function(e)
            // { 
            //   console.log(e.aaData);
            // }
          },
        "language": {
          url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
      "rowCallback": function( row, data, index ) {
            $(row).addClass('green');
      },
      "bDestroy": true,
      "iDisplayLength": 12,
      "order": [[ 0, "desc" ]],
      "columnDefs": [
          {
            "targets": 0, 
            "className": "dt-body-center"
            // ,"width": "4%"
            ,"render": function (data, type, row) {
                if (row[4] > 0) {
                  $('td').css('background-color', '#FFC9C9');
                }
                return data;
            }            
         },
         {
            "targets": 1,
            "className": "dt-body-center"
         },
         {
            "targets": 2,
            "className": "dt-body-center",
         },
         {
            "targets": 3,
            "className": "dt-body-right",            
         },
         {
            "targets": 4,
            "className": "dt-body-right",            
         },
         {
            "targets": 5,
            "className": "dt-body-right",            
         },
         {
            "targets": 6,
            "className": "dt-body-right",            
         },
         {
            "targets": 7,
            "className": "dt-body-right",            
         }],        
    }).DataTable();    



  }

  buscarPagos();

  </script>

	
	<!-- script para descargar archivos en la misma pagina sin recargar -->
<!-- <script src="<?php //ENLACE_WEB;?>mod_usuarios/js/scripts_descarga.js"></script> -->
	
</body>

</html>