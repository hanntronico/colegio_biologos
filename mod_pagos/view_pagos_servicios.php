<?php 
  SESSION_START();
  include_once "../conf/conf.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro de pagos de servicios - <?php echo PROY_TITULO; ?></title>

  <?php include_once "../head.php"; ?>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
<!--   <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php //echo ENLACE_WEB; ?>dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->
  
  <?php include '../mod_menu/menu_dashboard_h.php'; ?>

  <!-- Main Sidebar Container -->
  <!-- <aside class="main-sidebar sidebar-blue-primary elevation-4"> -->
  
    <?php include '../mod_menu/menu_dashboard_v.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registro de Pagos de Servicio</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../administrador/">Inicio</a></li>
              <li class="breadcrumb-item active">Registro pagos de servicios</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  Ingrese los datos del pago de servicios
                </h3>
              </div>

              <div class="card-body">
                
                <form id="frmRegServ" name="frmRegServ" enctype="multipart/form-data" method="POST">
                  <div class="form-row">
                    <div class="col-md-4">
                      <label for="validationServer01">Seleccionar colegiado:</label>
                      <input type="text" class="form-control" id="colegiado" name="colegiado" placeholder="Colegiado" readonly="true" required>
                      <input type="hidden" name="idcolegiado" id="idcolegiado" value="">
                    </div>

                    <div>
                      <br>
                      <button type="button" class="btn btn-primary btn-sm form-control px-3 mt-2" data-toggle="modal" data-target="#exampleModalLong">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>

<!--                     <div class="col-md-1">
                      &nbsp;
                    </div> -->

                    <div class="col-md-2 ml-4">
                      <label for="fecha_pago_serv">Fecha de pago:</label>
                      <input type="date" class="form-control" name="fecha_pago_serv" id="fecha_pago_serv" required>
<!--                       <label for="validationServer02">Nro </label>
                      <input type="text" class="form-control" id="validationServer02" placeholder="Last name" required> -->
<!--                       <button type="button" class="btn btn-primary mt-2" style="margin-left: 25px;" onclick="buscarPagos()">
                        Buscar Pagos
                      </button> -->
                    </div>


                    <div class="col-md-3">
                      <label for="optServicio">Servicios:</label>
                      <select class="form-control" name="optServicio" id="optServicio">
                        <option value="0">Selecciona Servicio</option>
                      </select>

<!--                       <button type="button" class="btn btn-primary mt-2" style="margin-left: 25px;" onclick="buscarPagos()">
                        Buscar Pagos
                      </button> -->

<!--                       <button type="button" class="btn btn-primary mt-2" onclick="buscarPagos()">
                        Buscar Pagos
                      </button> -->

<!--                       <label for="validationServerUsername">Username</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupPrepend3">@</span>
                        </div>
                        <input type="text" class="form-control is-invalid" id="validationServerUsername" placeholder="Username" aria-describedby="inputGroupPrepend3" required>
                        <div class="invalid-feedback">
                          Please choose a username.
                        </div>
                      </div> -->
                    </div>
                    
                    <div class="col-md-2"><br>
                      <!-- <button type="submit" class="btn btn-primary mt-2 px-4"> -->
                      <button type="button" class="btn btn-primary mt-2 px-4" onclick="agregarServicio()" id="btnAgregar">
                          AGREGAR
                      </button>    
                    </div>

                  </div>


<!--                   <hr>
                  <div class="form-row">
                    <div class="col-md-6">hannotrnico</div>
                    <div class="col-md-6">content</div>
                  </div> -->

<!--                   <div class="form-row">
                    <div class="col-md-6">
                      <label for="validationServer03">City</label>
                      <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="City" required>
                      <div class="invalid-feedback">
                        Please provide a valid city.
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationServer04">State</label>
                      <input type="text" class="form-control is-invalid" id="validationServer04" placeholder="State" required>
                      <div class="invalid-feedback">
                        Please provide a valid state.
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationServer05">Zip</label>
                      <input type="text" class="form-control is-invalid" id="validationServer05" placeholder="Zip" required>
                      <div class="invalid-feedback">
                        Please provide a valid zip.
                      </div>
                    </div>
                  </div> -->

                  <input type="hidden" name="estadoServicio" id="estadoServicio" value="0">
                  <input type="hidden" name="descripcionServ" id="descripcionServ" value="">

                  <input type="hidden" name="montoFinancia" id="montoFinancia" value="">

                  <input type="hidden" name="financia" id="financia" value="">

                  <div class="form-row">
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-primary mt-2 px-4">GUARDAR</button>
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="form-check">
<!--                       <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" required>
                      <label class="form-check-label" for="invalidCheck3">
                        Agree to terms and conditions
                      </label> -->
<!--                       <div class="invalid-feedback">
                        You must agree before submitting.
                      </div> -->
                    </div>
                  </div>
                  <!-- <button class="btn btn-primary btn-xl" type="submit">Submit form</button> -->
                </form>

              </div>              

            </div>


        <div class="card">

          <div class="card-header">
            <h3 class="card-title">
              Pagos del colegiado
              <button type="button" class="btn btn-info btn-sm ml-3" onclick="eliminaFila(0)">Limpiar</button>
              <!-- <button type="button" class="btn btn-primary btn-sm">Button</button> -->
              
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pagos_servicios" id="btnServicio">
                <i class="fas fa-plus mr-1"></i> SERVICIO
              </button>

            </h3>
          </div>

          <div class="card-body">
            <table id="lista_servicios_id" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ITEM</th>
                  <th>DESCRIPCIÓN</th>
                  <th>CANTIDAD</th>
                  <th>P. UNITARIO</th>
                  <th>IMPORTE</th>
                </tr>
              </thead>
              <tbody id="lista_serv">
              </tbody>
            </table>
          </div>

        </div>


        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="#">Grupo Alcedo</a>.</strong>
    Todos los derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


                      <!-- Modal -->
                      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <!-- <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document"> -->
                        <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Búsqueda de colegiados</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                              <form>
                                <div class="form-row">
                                  <div class="col-md-4">
                                    <label for="validationServer01">Seleccionar colegiado:</label>
                                    <input type="text" name="dni_codigo" id="dni_codigo" class="form-control" placeholder="DNI o CODIGO o APELLIDOS">
                                  </div>
                                  <div class="col-md-4">
                                    <label for="validationServer01">&nbsp;</label><br>
                                    <button type="button" class="btn btn-success btn-xl" onclick="buscarColegiado()">Buscar</button>
                                  </div>
                                </div>
                              </form>

                              <div class="row mt-4">
                                <div class="col-md-12">
                                  <table id="tabla_busca_colegiados_id" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th>DNI</th>
                                      <th>CODIGO</th>
                                      <th>Nombres</th>
                                      <th>Apellidos</th>
                                      <th>Estado</th>
                                      <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody id="lista_colegiados_busca">
                                      <tr><td colspan="6">
                                        <div id="content"></div>
                                      </td></tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" id="cerrar" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>

                     
              <!-- Modal -->
              <div class="modal fade" id="pagos_servicios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Especificar datos</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <form id="frmServModal">
                        <fieldset class="form-group">
                          <label for="formGroupDescripcion">Descripción:</label>
                          <input type="text" class="form-control" id="formGroupDescripcion" name="formGroupDescripcion" placeholder="Descripción concepto">
                        </fieldset>
                        <fieldset class="form-group">
                          <label for="formGroupCantidad">Cantidad:</label>
                          <input type="number" class="form-control" id="formGroupCantidad" name="formGroupCantidad" placeholder="Cantidad">
                        </fieldset>
                        <fieldset class="form-group">
                          <label for="formGroupPrecio">Precio:</label>
                          <input type="number" class="form-control" id="formGroupPrecio" name="formGroupPrecio" placeholder="Precio">
                       
                        </fieldset>                        
                      </form>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="agregarServicioModal()">AGREGAR</button>
                      <button type="button" class="btn btn-dark" data-dismiss="modal" id="cancelar">CANCELAR</button>
                    </div>
                  </div>
                </div>
              </div>                      


  <?php include_once "../foot.php"; ?>

<script type="text/javascript">

  let decripServ = "";

  $( document ).ready(function() {
    llenarComboServicios();
    cargaServicios();
    verificaPagos();

    if("<?php echo $_GET['idcol'];?>" == ""){
      // alert("sin codigo");
    }else{
      // alert("con codigo " + "<?php //echo $_GET['idcol'];?>");

      $("#formGroupCantidad").val(1);
      $("#formGroupPrecio").val( "<?php echo $_SESSION["total_deuda"];?>" );
      $("#montoFinancia").val( "<?php echo $_SESSION["total_deuda"];?>" );
      

      $.post('<?php echo ENLACE_WEB?>mod_servicios/controller_servicios.php?op=limpia_deuda',function(r){
        console.log(r);
      });

      $("#financia").val(1);
      $("#btnServicio").click();
      seleccionarColegiado("<?php echo $_GET['idcol'];?>");

    }


  });

  $("#frmRegServ").on("submit",function(e){
    e.preventDefault();
    var formData = new FormData($("#frmRegServ")[0]);

    if($("#colegiado").val() != '' && $("#idcolegiado").val() !=''){

      $.ajax({
        url: "<?php echo ENLACE_WEB?>mod_servicios/controller_servicios.php?op=registrar_servicios",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

          success: function(datos)
          {                    
            // bootbox.alert(datos);           
            // mostrarform(false);
            // tabla.ajax.reload();
            console.log(datos);
            // alert("Pago de servicios realizado con éxito");
            Swal.fire(
                'Exito!',
                'Pago de servicios realizado con correctamente!',
                'success'
            )
            // location.reload();
            location.href="<?php echo ENLACE_WEB;?>mod_pagos/view_lista_pagos_servicios.php";
          }
      });

    }else{
      alert("Por favor, ingrese datos válidos");
    }

  });

  function verificaPagos() {
    if($("#estadoServicio").val() == 0){
      // alert("vacio");
      $("#btnServicio").prop("disabled", false);
      $("#btnAgregar").prop("disabled", false);
    }else{
      // alert("lleno");
      $("#btnServicio").prop("disabled", true);
      $("#btnAgregar").prop("disabled", true);
    }
  }

  function agregarServicioModal() {
    
    var formData = new FormData($("#frmServModal")[0]);

    $.ajax({
      url: "<?php echo ENLACE_WEB?>mod_servicios/controller_servicios.php?op=agregar_servicios2",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

        success: function(datos)
        {                    
        //       bootbox.alert(datos);           
        //       mostrarform(false);
          tabla.ajax.reload();
          console.log(datos);
          $('#descripcionServ').val( $('#formGroupDescripcion').val() );

          $('#formGroupDescripcion').val("");
          $('#formGroupCantidad').val("");
          $('#formGroupPrecio').val("");

          $("#cancelar").click();
          $("#estadoServicio").val("2");

          verificaPagos();

        }

    });

  }

  function eliminaFila(idserv) {

    // alert(idfila);  
    $.ajax({
      url: "<?php echo ENLACE_WEB?>mod_servicios/controller_servicios.php?op=elimina_servicios&idserv=" + idserv,
      type: "POST",
      contentType: false,
      processData: false,

        success: function(datos)
        {                    
        //       bootbox.alert(datos);           
        //       mostrarform(false);
          tabla.ajax.reload();
          $("#estadoServicio").val("0");
          $('#descripcionServ').val("");
          decripServ = "";
          verificaPagos();
          // alert(datos);
          // console.log(datos);
        }

    });

  }


  $( "#btnSalir" ).click(function() {
    if (confirm("Esta seguro de salir del sistema")) {
      location.href="<?php echo ENLACE_WEB;?>mod_login/logout.php";
    }else{
      return false;
    }
  });

  function llenarComboServicios() {
    $.post('<?php echo ENLACE_WEB?>mod_servicios/controller_servicios.php?op=listar_servicios',function(r){
      $("#optServicio").html(r);
    });
  }

  function seleccionarColegiado(idColegiado) {
    
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'success',
        title: 'Agregado correctamente'
      })

    $.ajax({
      url: '<?php echo ENLACE_WEB?>mod_pagos/controller_pagos.php',
      type: 'POST',
      data: {accion: 'carga_datos_cole', idColegiado: idColegiado},
    })
    .done(function(data) {
      var resp = JSON.parse(data);
      // $("#colegiado").val(data);
      console.log(resp.idcolegiado);
      console.log(resp.datosColegiado);
      $("#idcolegiado").val(resp.idcolegiado);
      $("#colegiado").val(resp.datosColegiado);
      $("#lista_colegiados_busca").empty();
      $("#dni_codigo").val('');
      $("#cerrar").click();
    })
    .fail(function() {
      console.log("error");
    })

  }

  function agregarServicio() {

    decripServ = decripServ + $('select[name="optServicio"] option:selected').text() + ' - ';
    $('#descripcionServ').val( decripServ );

    var formData = new FormData($("#frmRegServ")[0]);

    $.ajax({
      url: "<?php echo ENLACE_WEB?>mod_servicios/controller_servicios.php?op=agregar_servicios",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

        success: function(datos)
        {                    
        //       bootbox.alert(datos);           
        //       mostrarform(false);
          tabla.ajax.reload();

        }

    });

  }

  function cargaServicios() {

    tabla=$('#lista_servicios_id').dataTable(
    {
      "lengthMenu": [ 5, 10, 25, 75, 100],
      "aProcessing": true,
      "aServerSide": true,
      "ajax":
          {
            url: '<?php echo ENLACE_WEB?>mod_servicios/controller_servicios.php?op=listar_servicios_seleccionados',
            type : "get",
            dataType : "json",            
            error: function(e){
              console.log('respuesta de error: ' + e.responseText);
              if (e.responseText == 'error') {
                // alert("vacio");
                $("#lista_serv").empty().html('<tr><td colspan="5" class="text-center">Sin servicios registrados</td></tr>');
              }
            }
            // ,
            // success: function(e)
            // { 
            //   console.log('respuesta de exito: ' + e.aaData);
            // }
          },
        "language": {
          url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
      "bDestroy": true,
      "iDisplayLength": 10 
      ,"order": [[ 0, "desc" ]]
      ,"columnDefs": [
          {
            "targets": 0, // Tu primera columna
            "className": "dt-body-center"
            ,"width": "4%"
         },
         {
            "targets": 1,
            "className": "dt-body-left"
            ,"width": "40%"
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
         }]
    }).DataTable();


  }


  function buscarColegiado() {

    $('#content').html('<div class="loading text-center" style="text-align: center;"><img src="../dist/img/loading.gif" alt="loading" width="5%" /><br/>Un momento, por favor...</div>');

    $.ajax({
      url: '<?php echo ENLACE_WEB?>mod_colegiados/controller_colegiados.php',
      type: 'POST',
      data: {accion: 'carga_busqueda_colegiados', dni_codigo: $("#dni_codigo").val()},
    })
    .done(function(data) {
      // console.log(data);
      if(data != ''){
        $('#lista_colegiados_busca').empty().html(data);  
      }else{
        $('#lista_colegiados_busca').empty().html('<tr><td colspan="6" class="text-center">Vacio</td></tr>');
      }
      
    })
    .fail(function() {
      console.log("error");
    })

  }

  function goodbye(e) {
      if(!e) e = window.event;
      //e.cancelBubble is supported by IE - this will kill the bubbling process.
      e.cancelBubble = true;
      e.returnValue = 'You sure you want to leave?'; //This is displayed on the dialog

      //e.stopPropagation works in Firefox.
      if (e.stopPropagation) {
          e.stopPropagation();
          e.preventDefault();
      }

      eliminaFila(0);
  }
  window.onbeforeunload=goodbye; 

  // function verPagos(idColegiado) {
  //   // console.log(idColegiado);
  //   location.href="<?php //echo ENLACE_WEB;?>mod_colegiados/view_pagos_colegiados.php?idcol=" + idColegiado;
  // }


</script>

</body>
</html>
