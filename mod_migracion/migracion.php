<?php  
	include_once "../conf/conf.php";

	require_once 'PHPExcel/Classes/PHPExcel.php';	

	$archivo = "DATA_DEL_COLEGIO_DE_BIOLOGOS_MODIFICADO.xlsx";
	$inputFileType = PHPExcel_IOFactory::identify($archivo);
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($archivo);
	$sheet = $objPHPExcel->getSheet(3); 
	$highestRow = $sheet->getHighestRow(); 
	$highestColumn = $sheet->getHighestColumn();

// SELECT `idColegiado`, `codigo_col`, `nom_colegiado`, `ape_paterno`, `ape_materno`, `dni`, `fec_nac`, `foto`, `telefono`, `email`, `password`, `direccion`, `lug_nacim`, `lug_labores`, `info_contacto`, `estado` FROM `colegiados` WHERE 1

	$num=0;
	for ($row = 2; $row <= $highestRow; $row++){ 
		if($sheet->getCell("A".$row)->getValue() != "" &&
			 $sheet->getCell("B".$row)->getValue() != "" &&
			 $sheet->getCell("C".$row)->getValue() != ""){


			$num++;
		  // $cod_colegiado = $sheet->getCell("A".$row)->getValue();
		  $cod_colegiado = str_pad($sheet->getCell("A".$row)->getValue(), 5, "0", STR_PAD_LEFT);
		  $ape_paterno 	 = $sheet->getCell("C".$row)->getValue();
		  $ape_materno	 = $sheet->getCell("D".$row)->getValue();
		  $nombres 			 = $sheet->getCell("E".$row)->getValue();
		  // echo $sheet->getCell("F".$row)->getValue()." -- ";
		  $nro_dni			 = ($sheet->getCell("G".$row)->getValue() == "") ? "0" : $sheet->getCell("G".$row)->getValue();
		 //  $cell = $sheet->getCell("H".$row);
		 //  $InvDate = $cell->getValue();
		 //  if(PHPExcel_Shared_Date::isDateTime($cell)) {
	  //   	echo $InvDate = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($InvDate))." -- "; 
			// }

		 //  $cell = $sheet->getCell("I".$row);
		 //  $InvDate = $cell->getValue();
		 //  if(PHPExcel_Shared_Date::isDateTime($cell)) {
	  //   	echo $InvDate = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($InvDate))." -- "; 
			// }

		  $cell = $sheet->getCell("J".$row);
		  $InvDate = $cell->getValue();
		  if(PHPExcel_Shared_Date::isDateTime($cell)) {
	    	$InvDate = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($InvDate)); 
	    	$fec_nac = $InvDate;
			}
	 		
	 		$email = ($sheet->getCell("K".$row)->getValue() == "") ? "" : $sheet->getCell("K".$row)->getValue();

	 		$telefono = ($sheet->getCell("L".$row)->getValue() == "") ? "" : $sheet->getCell("L".$row)->getValue();

		  // $email 		= $sheet->getCell("K".$row)->getValue();
		  // $telefono	= $sheet->getCell("L".$row)->getValue();

	// codigo	Colegiado	Apellido Paterno	Apellido Materno	Nombres	Tip. Doc.	Nro. Documento	Fe. de Inscripcion	Fe. Titulacion	Fe. Nacimiento	E-Mail	Telefono

			$sql = "INSERT INTO `colegiados`(`codigo_col`, 
																			 `nom_colegiado`, 
																			 `ape_paterno`, 
																			 `ape_materno`, 
																			 `dni`, 
																			 `fec_nac`,
																			 `telefono`, 
																			 `email`,
																			 `estado`) 
							VALUES (:cod_colegiado,
										  :nombres,
										  :apePaterno,
										  :apeMaterno,
										  :dni,
										  :fec_nac,
										  :telefono,
										  :email,
										  :estado)";

		  $db = $dbh->prepare($sql);
		  $db->bindValue(':cod_colegiado' , $cod_colegiado, PDO::PARAM_STR);
		  $db->bindValue(':nombres'			  , $nombres, 			PDO::PARAM_STR);
		  $db->bindValue(':apePaterno'	  , $ape_paterno, 	PDO::PARAM_STR);
		  $db->bindValue(':apeMaterno'	  , $ape_materno, 	PDO::PARAM_STR);
		  $db->bindValue(':dni'					  , $nro_dni, 			PDO::PARAM_STR);
		  $db->bindValue(':fec_nac'			  , $fec_nac, 			PDO::PARAM_STR);
		  $db->bindValue(':telefono'		  , $telefono, 			PDO::PARAM_STR);
		  $db->bindValue(':email'				  , $email, 				PDO::PARAM_STR);
		  $db->bindValue(':estado'				, 1, 							PDO::PARAM_INT);
		  $result = $db->execute();

		  if ($result) {
		  	echo $num . " - " . $result . " - " . $cod_colegiado." -- OK <br>";
		  	echo $cod_colegiado. " - " .
		  			 $nombres. " - " .
		  			 $ape_paterno. " - " .
		  			 $ape_materno. " - " .
		  			 $nro_dni. " - " .
		  			 $fec_nac. " - " .
		  			 $telefono. " - " .$email."<br>";
		  }else {
		  	echo $num . " - " . "error <br>";
		  	echo $cod_colegiado. " - " .
		  			 $nombres. " - " .
		  			 $ape_paterno. " - " .
		  			 $ape_materno. " - " .
		  			 $nro_dni. " - " .
		  			 $fec_nac. " - " .
		  			 $telefono. " - " .$email."<br>";
		  }


		}
	
	}



?>