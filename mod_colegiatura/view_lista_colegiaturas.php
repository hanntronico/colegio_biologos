<?php 
  SESSION_START();
  include_once "../conf/conf.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Colegiados exonerados - <?php echo PROY_TITULO; ?></title>

  <?php include_once "../head.php"; ?>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

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
            <h1 class="m-0">Listado de colegiaturas registradas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../administrador/">Inicio</a></li>
              <li class="breadcrumb-item active">Listado de colegiados exonerados</li>
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
								<h3 class="card-title">Colegiaturas en el SISTEMA al <?php echo date("d/m/Y") ?></h3>
								<a href="<?php echo ENLACE_WEB;?>mod_colegiatura/" class="btn btn-primary btn-xl ml-4">Registrar Colegiatura</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow: auto;">
                <table id="lista_colegiaturas_id" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>CBP</th>
                    <th>Nombres</th>
                    <th>Fecha colegiatura</th>
                    <th>Estado</th>
                  </tr>
                  </thead>
                  <tbody id="lista_colegiados">
<!--                     <tr><td colspan="8">
                      <div id="content"></div>
                    </td></tr>  -->                   
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>CBP</th>
                    <th>Nombres</th>
                    <th>Fecha colegiatura</th>
                    <th>Estado</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
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
    <strong>Copyright &copy; 2022 <a href="#">Grupo Alcedo</a>.</strong>
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

        listar();
   
      });


  $( "#btnSalir" ).click(function() {
    if (confirm("Esta seguro de salir del sistema")) {
      location.href="<?php echo ENLACE_WEB;?>mod_login/logout.php";
    }else{
      return false;
    }
  });

  
  function editar(idColegiado) {
    console.log(idColegiado);
    location.href="<?php echo ENLACE_WEB;?>mod_colegiados/view_edit_colegiado.php?idcol="+idColegiado;
  }



function listar()
{
  tabla=$('#lista_colegiaturas_id').dataTable(
  {
    "lengthMenu": [ 5, 10, 25, 75, 100],
    "aProcessing": true,
    "aServerSide": true,
    "autoWidth": true,
    "dom": 'Blfrtip',
    "buttons": ["copy", "csv", "excel", "pdf", "print"],
    "ajax":
        {
          url: '<?php echo ENLACE_WEB;?>mod_colegiatura/controller_colegiatura.php?op=listar_colegiaturas',
          type : "get",
          dataType : "json",            
          error: function(e){
            console.log(e.responseText);  
					}
//					,
//					success: function(e){
//						console.log('exito msn: ' + e);
//					},
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
						"className": "dt-body-center",
						"className": "dt-head-center"
            ,"width": "4%"
         },
         {
            "targets": 2,
            "className": "dt-body-center"
            ,"width": "4%"
         },
         {
            "targets": 3,
						"className": "dt-body-left",
						"className": "dt-head-left"						
         },
         {
            "targets": 4,
						"className": "dt-body-center"
						,"width": "16%"	
				 },
				 {
						"targets": 4,
						"className": "dt-head-center"
				 },	
         {
            "targets": 5,
            "className": "dt-body-center"
            ,"width": "4%"            
         }]
    }).DataTable();

}

   //    function cargaListadoColegios() {

   //      $('#lista_colegiados').empty().html('<tr><td colspan="8" class="text-center"><div class="loading"><img src="../dist/img/loading.gif" alt="loading" width="5%" /><br/>Un momento, por favor...</div></td></tr>');

   //      $.ajax({
   //        url: 'controller_colegiados.php',
   //        type: 'POST',
   //        data: {accion: 'carga_inicial'},
   //      })
   //      .done(function(data) {
			// 		$('#lista_colegiados').empty().html(data);
   //      })
   //      .fail(function() {
   //        console.log("error");
   //      })

   //    }

			// cargaListadoColegios();



      // $.get('controller_colegiados.php', function(data) {
      //   $('#lista_colegiados').empty().html(data);
      // });

      function verPagos(idColegiado) {
        // console.log(idColegiado);
        location.href="<?php echo ENLACE_WEB;?>mod_colegiados/view_pagos_colegiados.php?idcol=" + idColegiado;
      }

      function desactivar(idColegiado){
        console.log("desactivando: " + idColegiado);
        $.ajax({
          url: 'controller_colegiados.php',
          type: 'POST',
          data: {accion: 'desactivar', idCol:idColegiado },
        })
        .done(function(data) {
          console.log("success data:" + data);
          // cargaListadoColegios();
          // location.reload();
          // $("#lista_colegiados_id").empty();
          // listar();
          tabla.ajax.reload();
        })
        .fail(function() {
          console.log("error");
        })
      }


      function activar(idColegiado){
        console.log("desactivando: " + idColegiado);
        $.ajax({
          url: 'controller_colegiados.php',
          type: 'POST',
          data: {accion: 'activar', idCol:idColegiado },
        })
        .done(function(data) {
          console.log("success data:" + data);
          // cargaListadoColegios();
          // location.reload();
          // $("#lista_colegiados_id").empty();
          // listar();
          tabla.ajax.reload();
        })
        .fail(function() {
          console.log("error");
        })

      }


</script>

</body>
</html>
