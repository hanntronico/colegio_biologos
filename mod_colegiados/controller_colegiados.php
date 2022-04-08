<?php 
	// // Database connection info 
	// $dbDetails = array( 
	//     'host' => 'localhost', 
	//     'user' => 'root', 
	//     'pass' => '*274053*', 
	//     'db'   => 'bdtienda' 
	// ); 
	 
	// // DB table to use 
	// $table = 'colegiados'; 
	 
	// // Table's primary key 
	// $primaryKey = 'id'; 
	 
	// // Array of database columns which should be read and sent back to DataTables. 
	// // The `db` parameter represents the column name in the database.  
	// // The `dt` parameter represents the DataTables column identifier. 
	// $columns = array( 
	//     array( 'db' => 'first_name', 'dt' => 'first_name' ), 
	//     array( 'db' => 'last_name',  'dt' => 'last_name' ), 
	//     array( 'db' => 'email',      'dt' => 'email' ), 
	//     array( 'db' => 'gender',     'dt' => 'gender' ), 
	//     array( 'db' => 'country',    'dt' => 'country' ), 
	//     array( 
	//         'db'        => 'created', 
	//         'dt'        => 'created', 
	//         'formatter' => function( $d, $row ) { 
	//             return date( 'jS M Y', strtotime($d)); 
	//         } 
	//     ), 
	//     array( 
	//         'db'        => 'status', 
	//         'dt'        => 'status', 
	//         'formatter' => function( $d, $row ) { 
	//             return ($d == 1)?'Active':'Inactive'; 
	//         } 
	//     ) 
	// ); 



	 
	// // Include SQL query processing class 
	// require 'ssp.class.php'; 
	
	// $respuesta = SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ); 	 

	// echo json_encode($respuesta);


	// // Output data as json format 
	// // echo json_encode( 
	// //     SSP::simple( $_POST, $dbDetails, $table, $primaryKey, $columns ) 
	// // );

			include_once "../conf/conf.php";

	    // $sql = 
	    //     "SELECT `idegresado`, `nom_egresado`, `ape_paterno`, `ape_materno`, `dni`, `fec_nac`, `foto`, `lug_nac`, `lug_dom_actual`, `telefono`, `email`, `password`, `link_conf`, `redes_sociales`, `info_contacto`, `estado` FROM `egresados`";



			$sql = "SELECT idColegiado, codigo_col, nom_colegiado, ape_paterno, ape_materno, dni, fec_nac, foto, telefono, email, lug_nacim, lug_labores, info_contacto, estado FROM colegiados";

	    $db = $dbh->prepare($sql);
	    $db->execute();

			$fila = "";

			while($data = $db->fetch(PDO::FETCH_OBJ)):

				$estado = ($data->estado == 1) ? "<span class='badge badge-pill badge-success'>Activo</span>" : "<span class='badge badge-pill badge-danger'>Inactivo</span>";

				$btnEstado = ($data->estado == 1) ? "<button type='button' class='btn btn-danger btn-sm' onclick='desactivar(".$data->idColegiado.")'><i class='fa fa-minus'></i></button>" : "<button type='button' class='btn btn-primary btn-sm' onclick='activar(".$data->idColegiado.")'><i class='fa fa-check'></i></button>";

				$fila .= "<tr>
				          <td>".$data->dni."</td>
				          <td><a href='javascript:;' onclick='verPagos(".$data->idColegiado.")'>".$data->codigo_col."</a></td>
				          <td>".$data->nom_colegiado."</td>
				          <td>".$data->ape_paterno . " " . $data->ape_materno ."</td>
				          <td>".$data->telefono."</td>
				          <td>".$data->email."</td>
				          <td>".$estado."</td>
				          <td>
				          	<button type='button' class='btn btn-warning btn-sm'><i class='fa fa-edit mr-1'></i>Editar</button>
				          	".$btnEstado."
				          </td>
				         </tr>";
		  endwhile;
			echo $fila;


?>