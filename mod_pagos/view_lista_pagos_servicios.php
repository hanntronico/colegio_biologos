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
            <h1 class="m-0">Listado de pagos de servicio</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../administrador/">Inicio</a></li>
              <li class="breadcrumb-item active">Listado pagos de servicios</li>
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
              <div class="card-body">
                
                <form>
                  <div class="form-row">
                    <div class="col-md-4">
                      <a href="<?php echo ENLACE_WEB;?>mod_pagos/view_pagos_servicios.php" class="btn btn-primary">
                        Registrar pago
                      </a>
                    </div>
                  </div>
                </form>

              </div>              

            </div>


        <div class="card">

          <div class="card-body">
            <table id="lista_pagos_servicios_id" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>FECHA PAGO</th>
                  <th style="text-align: center;">CBP</th>
                  <th>COLEGIADO</th>
                  <th>DESCRIPCION</th>
                  <th>IMPORTE</th>
                  <th>RECIBO</th>
                </tr>
              </thead>
              <tbody id="lista_pago_serv">
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


  <?php include_once "../foot.php"; ?>

<script type="text/javascript">

  $( document ).ready(function() {
    // llenarComboServicios();
    cargaPagosServicios();
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
            alert("Pago de servicios realizado con éxito");
            location.reload();
          }
      });

    }else{
      alert("Por favor, ingrese datos válidos");
    }

  });

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

          $('#formGroupDescripcion').val("");
          $('#formGroupCantidad').val("");
          $('#formGroupPrecio').val("");

          $("#cancelar").click();
          $("#estadoServicio").val("2");

        }

    });

  }

  function eliminaFila(idserv) {

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
    
    alert("Colegiado seleccionado!");
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

  function cargaPagosServicios() {

    tabla=$('#lista_pagos_servicios_id').dataTable(
    {
      "lengthMenu": [ 5, 10, 25, 75, 100],
      "aProcessing": true,
      "aServerSide": true,
      "ajax":
          {
            url: '<?php echo ENLACE_WEB?>mod_servicios/controller_servicios.php?op=listar_pagos_servicios',
            type : "get",
            dataType : "json",            
            error: function(e){
              console.log('respuesta de error: ' + e.responseText);
              if (e.responseText == 'error') {
                // alert("vacio");
                $("#lista_pago_serv").empty().html('<tr><td colspan="5" class="text-center">Sin pagos de servicios registrados</td></tr>');
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
            "className": "dt-body-center"
            ,"width": "12%"
         },
         {
            "targets": 2,
            "className": "dt-body-center",
         },
         {
            "targets": 3,
            "className": "dt-body-left"
            ,"width": "30%"
         },
         {
            "targets": 4,
            "className": "dt-body-left"
            ,"width": "30%"
         },
         {
            "targets": 5,
            "className": "dt-body-center",
         },
         {
            "targets": 6,
            "className": "dt-body-center",
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

</script>

</body>
</html>
