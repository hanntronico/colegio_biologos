<?php 
	include_once "../conf/conf.php";

   
	if(!empty($_POST)){
		if(isset($_POST["userini"]) &&isset($_POST["claveini"])){
			if($_POST["userini"]!=""&&$_POST["claveini"]!=""){
				// include("../ctrl_admin/conexion/config.php");
					
				$idColegiado=null;
				$mdcincopass = md5($_POST["claveini"]);
				
				/*********************** ESTAD CONSULTA ES PARA LOS COLEGIADOS CON ESTADO 1 ***************/
				// $sql1 = "SELECT * FROM colegiados WHERE (email='".$_POST["userini"]."' AND password='".$mdcincopass."' AND estado=1)";

				$sql1 = "SELECT `idColegiado`, `codigo_col`, `nom_colegiado`, `ape_paterno`, `ape_materno`, `dni`, `fec_nac`, `foto`, `telefono`, `email`, `password`, `direccion`, `lug_nacim`, `lug_labores`, `info_contacto`, `estado` FROM colegiados WHERE (codigo_col=:usuario AND password=:password AND estado=1)";
				// echo $sql1 = "SELECT * FROM colegiados WHERE (email='".$_POST['userini']."' AND password='".$mdcincopass."' AND estado=1)";
				$db = $dbh->prepare($sql1);
	    	$db->bindValue(":usuario", $_POST['userini'], PDO::PARAM_STR);
	    	$db->bindValue(":password", $mdcincopass, PDO::PARAM_STR);
	    	$db->execute();
	    	// $data = $db->fetch(PDO::FETCH_ASSOC);
	    	$data = $db->fetch(PDO::FETCH_OBJ);

	    	
	    	$filas = $db->rowCount();

				if( $filas>0 && !empty($data->idColegiado) ){
	        SESSION_START();
	        $_SESSION['idColegiado']    		= $data->idColegiado;
	        $_SESSION['nombre']         		= $data->nom_colegiado;
	        $_SESSION['apellido_paterno']   = $data->ape_paterno;
	        $_SESSION['apellido_materno']   = $data->ape_materno;
	        $_SESSION['codigo_col']					= $data->codigo_col;

	        $_SESSION["nivel"]							= 2;

	        header("location: " . ENLACE_WEB . "mod_usuarios/view_dashboard.php");
					// echo "encontro algo";
				}else{
					header("location: " . ENLACE_WEB . "login-usuarios");
				}


			}
		}
	}		

?>