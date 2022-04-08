<?php
session_start();
if (isset($_SESSION['usuario'])){
	print "<script>window.location='../';</script>";
}else{
	if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]==null){
	/*print "<script>alert('Acceso invalido! - Inicia Sesion para Acceder');window.location='$enlace_actual';</script>";*/
	}
}
include("../conf/conf.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include("titulo.php"); ?>
    <!-- web-fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,500" rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- off-canvas -->
    <link href="../css/mobile-menu.css" rel="stylesheet">
    <!-- font-awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">    
    <!-- Flat Icon -->
    <link href="../fonts/flaticon/flaticon.css" rel="stylesheet">
    <!-- Bootstrap -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Style CSS -->
    <link href="../css/style.css" rel="stylesheet">
    
</head>
<body style="background-image: url(dist/img/bg11.jpg); repeat left top;">
<div id="main-wrapper">
<!-- Page Preloader -->
<!--<div id="preloader">
    <div id="status">
        <div class="status-mes"></div>
    </div>
</div>-->

<div class="uc-mobile-menu-pusher">

	<div class="content-wrapper">
		<section class="client-logo ptb-100">
		    <div class="container" style="margin-top: 5rem;">
		     <a href="<?php echo ENLACE_WEB; ?>" class="pull-right"><i class="fa fa-reply"></i> Regresar</a><br>
		      <center><img class="img-responsive" src="dist/img/logo_cobol.png" width="450px"></center><br>
		      <hr>
		       
		       <form method="post" action="<?php echo ENLACE_WEB;?>mod_usuarios/login.php" style="background-color: rgba(255,255,255,0.6); width: 60%; margin: 0px auto; padding: 10px;">
		          <div class="row">
		          <div class="col-lg-3"></div>
		         	<div class="col-lg-6">
		          	<div class="form-group">
		          	  <label for="inputUsuario">Usuario</label>
		          	  <input type="email" class="form-control" name="userini" id="inputUsuario" aria-describedby="emailHelp" placeholder="Ingrese su usuario" required>
		          	</div>
		          	<div class="form-group">
		          	  <label for="inputPassword">Contraseña</label>
		          	  <input type="password" class="form-control" name="claveini" id="inputPassword" placeholder="Ingrese clave" required>
		          	</div>
		          	<button type="submit" name="ingresa" class="btn btn-primary btn-md">Ingresar</button>

<!-- 		          		<label>Usuario</label>
		          		<input type="text" class="form-control" name="userini" placeholder="Ingrese su usuario" required >
		          		<label>Contraseña</label>
		          		<input type="password" class="form-control" name="claveini" placeholder="Ingrese clave" required>
		          		<br><br>
		          		<button type="submit" name="ingresa" class="btn btn-primary">Ingresar</button><br><br> -->
		          	
		          	</div>
		          	<div class="col-lg-3"></div>
		          </div>
		          </form>
		          <div class="row">
		          	<div class="col-lg-12">
		          		<hr>
		          	</div>
		          </div>
		    </div>
		</section>
		<!-- /.client-logo -->
	</div>
<!-- .content-wrapper -->
</div>
<?php //include("../menu_movil.php"); ?>

</div>
<!-- #main-wrapper -->


<!-- Script -->
<script src="../js/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="../js/smoothscroll.js"></script>
<script src="../js/mobile-menu.js"></script>
<script src="../js/scripts.js"></script>
</body>
</html>