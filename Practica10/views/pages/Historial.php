<?php
if(isset($_SESSION["validar"])){
if($_SESSION["tipo"] == 0){
 ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Historial de Sesiones
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Historial</a></li>
      </ol>
         <!-- /.content -->
    </section>
  
    <!-- Main content -->
    <section class="content">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Historial</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>usuario</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $mvc = new mvc_controller();
                  $mvc -> VistarHistorialC();
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
          </section>
<?php
}}
?>