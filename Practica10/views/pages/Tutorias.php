<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tutorias
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tutorias</a></li>
      </ol>
         <!-- /.content -->
    </section>

    <!-- Main content -->
<?php
if(isset($_SESSION["validar"])){
 ?>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">REGISTRO</h3>
            </div>
            <div class="box-body">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default1">
                Tutoria Individual
              </button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default2">
                Tutoria Grupales
              </button>
            </div>
          </div>
        </div>
      </div>

        <div class="modal fade" id="modal-default1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nueva</h4>
              </div>
              <div class="modal-body">
              <form role="form" enctype="multipart/form-data" method="POST" >
              <div class="box-body">
                <div class="form-group">
                <label>Alumno</label>
                <select class="form-control select2" style="width: 100%;" name="id_alumno" required>
                  <?php
                    $mvc=new mvc_controller();
                    $mvc -> OptionController3("alumnos");
                  ?>
                </select>
              </div>
            <!-- /.box-header -->
            <div class="form-group">             
                <textarea class="textarea" placeholder="Place some text here" name="tema"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
       <div class="modal fade" id="modal-default2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nueva</h4>
              </div>
              <div class="modal-body">
              <form role="form" enctype="multipart/form-data" method="POST" >
              <div class="box-body">
                 <div class="form-group">
                <label>Alumno</label>
                <select class="form-control select2" multiple="multiple" style="width: 100%;" name="id_alumnoM[]" required>
                  <?php
                    $mvc=new mvc_controller();
                    $mvc -> OptionController3("alumnos");
                  ?>
                </select>
              </div>
            <!-- /.box-header -->
            <div class="form-group">             
                <textarea class="textarea" placeholder="Place some text here" name="tema"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
  $mvc -> registroTutotiaIC();
  $mvc -> registroTutotiaGC();


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
                  <th>ID</th>
                  <th>Alumno</th>
                  <th>Tutor</th>
                  <th>fecha</th>
                  <th>Hora</th>
                  <th>Tipo</th>                 
                  <th>Editar</th>
                   <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $mvc = new mvc_controller();
                  $mvc -> VistarTutoriasC();
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