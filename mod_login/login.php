<?php 

if( empty($_POST["usuario"]) && empty($_POST["password"]) ){
	echo "vacios ambos ";
}else{
	// echo "entro al login php : " . $_POST["usuario"] . " - " . $_POST["password"];

	include_once "../conf/conf.php";
	$error_logeo = false;
	// VALI DEFINITION USER
	if (isset($_POST['usuario']) && isset($_POST['password'])):
	    // QUERY
	    // $sql = 
	    //     "SELECT * 
	    //      FROM usuarios 
	    //      WHERE usuario =:usuario AND password    ='". md5($_POST['password']) ."' AND estado      = 1;";
	    
	    $sql = 
	        "SELECT * 
	         FROM usuarios 
	         WHERE usuario =:usuario 
	         AND password  =:password
	         AND estado      = 1;";

	    $db = $dbh->prepare($sql);
	    $db->bindValue(":usuario", $_POST['usuario'], PDO::PARAM_STR);
	    $db->bindValue(":password", md5($_POST['password']), PDO::PARAM_STR);
	    $db->execute();
	    // $data = $db->fetch(PDO::FETCH_ASSOC);
	    $data = $db->fetch(PDO::FETCH_OBJ);

	    // VALID DATA
	    if ($data->idusuario > 0 and !empty($data->idusuario)):
	        SESSION_START();
	        $_SESSION['usuario_sistema']      = $data->idusuario;
	        $_SESSION['idnivel']              = $data->idnivel;
	        $_SESSION['nombre']               = $data->nombre;
	        $_SESSION['apellidos']            = $data->apellidos;
	        echo 'exito';
	        // // $_SESSION['email']                = $data->email;
	        // // $_SESSION['perfil']               = $data->fk_perfil;
	        // // $_SESSION['licencia']                   = md5('licencia_concasa');
	        // $_SESSION['lang']                       = 'ES';
	        // // $_SESSION['valuacion_administrator']    = $data->valuacion_administrator;
	        // if (isset($_GET['lang'])) {$_SESSION['lang'] = $_GET['lang'];}
	    //     header("location: " . ENLACE_WEB . "administrador/view_dashboard.php");
					// exit(1);
	    else:
	        $error_logeo = true;
	        echo $error_logeo;
	    endif;
	endif;


}


?>