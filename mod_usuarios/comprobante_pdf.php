<?php
//Activamos el almacenamiento en el buffer

ob_start();
if (strlen(session_id()) < 1) 
  session_start();
  include_once "../conf/conf.php";

if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{
  // $_SESSION['ventas'] = 1;

// if ($_SESSION['ventas']==1)
if (1==1)
{

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
  $data_colegiado = $db->fetch(PDO::FETCH_OBJ);

//Incluímos el archivo Factura.php
require('Recibo.php');

//Establecemos los datos de la empresa
$logo = "recibo_A_OK.jpg";
$ext_logo = "jpg";
// $empresa = "Soluciones Innovadoras Perú S.A.C.";
// $documento = "20477157772";
// $direccion = "Chongoyape, José Gálvez 1368";
// $telefono = "931742904";
// $email = "jcarlos.ad7@gmail.com";

// //Obtenemos los datos de la cabecera de la venta actual
// require_once "../modelos/Venta.php";
// $venta= new Venta();
// $rsptav = $venta->ventacabecera($_GET["id"]);
// //Recorremos todos los valores obtenidos
// $regv = $rsptav->fetch_object();

//Establecemos la configuración de la factura
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();

//Enviamos los datos de la empresa al método addSociete de la clase Factura
// $pdf->addSociete(utf8_decode("QUE EL BIÓLOGO"),
//                   $documento."\n" .
//                   utf8_decode("Dirección: ").utf8_decode($direccion)."\n".
//                   utf8_decode("Teléfono: ").$telefono."\n" .
//                   "Email : ".$email, $logo, $ext_logo);

  // $originalDate = $data_colegiado->fecha_col;
  // $newDate = date("d" . "DE" . "Y", strtotime($originalDate));  
  // $dia = date("d", strtotime($originalDate));
  // $mes = date("M", strtotime($originalDate));
  // $anio = date("Y", strtotime($originalDate));
  // $fechaCol = $dia . " DE " . $mes . " DE " . $anio; 

// $block_text_izq = utf8_decode("QUE EL BIÓLOGO") . "\n\n\n\n" . 
//                   utf8_decode("CON FECHA DE COLEGIATURA") . "\n\n" .
//                   utf8_decode("CON REGISTRO") . "\n\n" .
//                   utf8_decode("HABILITADO AL");

$datos_colegiado = utf8_decode($data_colegiado->ape_paterno) . ' ' . utf8_decode($data_colegiado->ape_materno) . " " . utf8_decode($data_colegiado->nom_colegiado);

$direccion = "direccion del colegiado";

$codigo_colegiado = $data_colegiado->codigo;

  $sqlpagoServ = "SELECT `idPagoServ`, 
                 `fecha_pago_serv`, 
                 `idColegiado`, 
                 `descripcion`, 
                 `monto`, 
                 `estado` 
          FROM `pagos_servicios`
          WHERE idPagoServ=". $_GET["id"] ." AND idColegiado = " . $_SESSION['idColegiado'];

  $db = $dbh->prepare($sqlpagoServ);
  $db->execute();
  $data_pagoServ = $db->fetch(PDO::FETCH_OBJ);


$pdf->addSociete( $datos_colegiado, $direccion, $codigo_colegiado, $logo, $ext_logo );

// $fechaPagoServ = date("d/m/Y", strtotime($data_pagoServ->fecha_pago_serv));

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$originalDate = $data_pagoServ->fecha_pago_serv;
// $newDate = date("d" . "DE" . "Y", strtotime($originalDate));  
$dia = date("d", strtotime($originalDate));
// // $mes = date("M", strtotime($originalDate));
$mes = date('n', strtotime($originalDate));
$mes = $meses[$mes-1];
$anio = date("Y", strtotime($originalDate));
$fechaPagoServ = "Lima " . $dia . " de " . $mes . " de " . $anio; 

$pdf->addFechaRecibo( $fechaPagoServ );


// $pdf->fact_dev( "$regv->tipo_comprobante ", "$regv->serie_comprobante-$regv->num_comprobante" );
$pdf->temporaire( "" );
// $pdf->addDate( $regv->fecha);

//Enviamos los datos del cliente al método addClientAdresse de la clase Factura
// $pdf->addClientAdresse(utf8_decode($regv->cliente),"Domicilio: ".utf8_decode($regv->direccion),$regv->tipo_documento.": ".$regv->num_documento,"Email: ".$regv->email,"Telefono: ".$regv->telefono);

//Establecemos las columnas que va a tener la sección donde mostramos los detalles de la venta
$cols=array( "CODIGO"=>23,
             "DESCRIPCION"=>78,
             "CANTIDAD"=>22,
             "P.U."=>25,
             "DSCTO"=>20,
             "SUBTOTAL"=>22);
$pdf->addCols( $cols);
$cols=array( "CODIGO"=>"L",
             "DESCRIPCION"=>"L",
             "CANTIDAD"=>"C",
             "P.U."=>"R",
             "DSCTO" =>"R",
             "SUBTOTAL"=>"C");
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//Actualizamos el valor de la coordenada "y", que será la ubicación desde donde empezaremos a mostrar los datos
$y= 70;

//Obtenemos todos los detalles de la venta actual
// $rsptad = $venta->ventadetalle($_GET["id"]);



  if( $data_pagoServ->idPagoServ > 0 ){

    $sqlpagoServ = "SELECT PSD.idPagoServ, 
                           PSD.idServicio, 
                           S.nom_servicio, 
                           PSD.cantidad, 
                           PSD.precio, 
                           PSD.importe 
                    FROM pagos_servicios_detalle PSD 
                    LEFT JOIN servicios S
                    ON PSD.idServicio = S.idServicio
                    WHERE idPagoServ = " . $data_pagoServ->idPagoServ;

          $db = $dbh->prepare($sqlpagoServ);
          $db->execute();
          // $data_pagoServ = $db->fetch(PDO::FETCH_OBJ);
          $i = 1;
          while ($regd =$db->fetch(PDO::FETCH_OBJ)) {
            $line = array( "CODIGO"=> $i,
                          "DESCRIPCION"=> utf8_decode("$regd->nom_servicio"),
                          "CANTIDAD"=> "$regd->cantidad",
                          "P.U."=> "$regd->precio",
                          "DSCTO" => 0,
                          "SUBTOTAL"=> "$regd->importe");
                      $size = $pdf->addLine( $y, $line );
                      $y   += $size + 2;
            $i++;          
          }


  }


// while ($regd = $rsptad->fetch_object()) {
//   $line = array( "CODIGO"=> "$regd->codigo",
//                 "DESCRIPCION"=> utf8_decode("$regd->articulo"),
//                 "CANTIDAD"=> "$regd->cantidad",
//                 "P.U."=> "$regd->precio_venta",
//                 "DSCTO" => "$regd->descuento",
//                 "SUBTOTAL"=> "$regd->subtotal");
//             $size = $pdf->addLine( $y, $line );
//             $y   += $size + 2;
// }

//Convertimos el total en letras
// require_once "Letras.php";
// $V=new EnLetras(); 
// $con_letra=strtoupper($V->ValorEnLetras($regv->total_venta,"NUEVOS SOLES"));
// $pdf->addCadreTVAs("---".$con_letra);

//Mostramos el impuesto
$pdf->addTVAs( $regv->impuesto, $data_pagoServ->monto,"S/ ");
$pdf->addCadreEurosFrancs("IGV"." $regv->impuesto %");

$pdf->addFechaFirma();

$pdf->Output('certificado_','I');


}
else
{
  echo 'No tiene permiso para visualizar el certificado';
}

}
ob_end_flush();
?>