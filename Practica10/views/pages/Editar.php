<?php
if(isset($_SESSION["validar"])){
 ?>
    <section class="content-header">
      <h1>
        <?php echo $_GET["select"]; ?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $_GET["select"]; ?></a></li>
        <li><a href="#">Editar <?php echo $_GET["select"]; ?></a></li>
      </ol>
         <!-- /.content -->
    </section>

    <!-- Main content -->
    <section class="content">
        
            <div class="box">
              <div class="box-header">
                <h4 class="box-title">Editar <?php echo $_GET["select"]; ?></h4>
              </div>
              <div class="box-body">
               <form role="form" enctype="multipart/form-data" method="POST" >
               <?php
                 if($_SESSION["tipo"] == 0){
                   if($_GET["select"] == "Alumno")
                   {
                    $mvcA=new mvc_controller();
                    $mvcA -> editarAlumnoC();
                    $mvcA -> actualizarAlumnoC();
                   }
                   if($_GET["select"] == "Tutor")
                   {
                    $mvcT =new mvc_controller();
                    $mvcT -> editarTutorC();
                    $mvcT -> actualizarTutorC();
                   }
                   if($_GET["select"] == "Carrera")
                   {
                    $mvcC =new mvc_controller();
                    $mvcC -> editarCarreraC();
                    $mvcC -> actualizarCarreraC();
                   }
                 }
                 if($_SESSION["tipo"] == 1 or $_SESSION["tipo"] == 0){
                  if($_GET["select"] == "Tutorias")
                 {
                  $mvcC =new mvc_controller();
                  $mvcC -> editarTutoriasC();
                  $mvcC -> actualizarTutoriasC();
                 }
                 }

                ?>
              </form>
                </div>
              <!-- /.box-body -->
            </div>
            <!-- /.modal-content -->
        </section>
<?php
}
  ?>