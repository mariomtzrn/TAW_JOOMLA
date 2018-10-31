<?php
if(isset($_SESSION["validar"])){

 ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        JUGADORES
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Jugadores</a></li>
      </ol>
         <!-- /.content -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">REGISTRO</h3>
            </div>
            <div class="box-body">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Registrar Jugador
              </button>
            </div>
          </div>
        </div>
      </div>

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nuevo Jugador</h4>
              </div>
              <div class="modal-body">
               
                <form role="form" enctype="multipart/form-data" method="POST" >
              <div class="box-body">
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="form-group">
                  <label>Apellido</label>
                  <input type="text" class="form-control" name="apellido" required>
                </div>
                 <div class="form-group">
                  <label>Dorsal</label>
                  <input type="number" class="form-control" name="dorsal" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Imagen</label>
                  <input type="file" id="exampleInputFile" name="imagen"  accept="image/jpeg, image/png">
                </div>
              </div>
              <!-- /.box-body -->
              </div>
              <div class="modal-footer">
                 <input type="submit" class="btn btn-success" name="submit" value="Registrar">
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<?php

  $mvc=new mvc_controller();
  $mvc -> registroJugadoresC();


?>
      

    <!-- Main content -->
    <section class="content">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">LISTADO</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Nombre Completo</th>
                   <th>Dorsal</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
                  <th>Ver</th>
                </tr>
                </thead>
                <tbody>
                  
                <?php
                  $mvc = new mvc_controller();
                  $mvc -> VistaJugadoresC();
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
}
?>