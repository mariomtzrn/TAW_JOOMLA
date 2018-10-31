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
                   if($_GET["select"] == "Jugador")
                   {
                    $mvcA=new mvc_controller();
                    $mvcA -> editarJugadorC();
                    $mvcA -> actualizarJugadorC();
                   }
                   if($_GET["select"] == "Equipo")
                   {
                    $mvcC =new mvc_controller();
                    $mvcC -> editarEquipoC();
                    $mvcC -> actualizarEquipoC();
                   }
                 if($_GET["select"] == "Seleccion")
                   {
                    $mvcC =new mvc_controller();
                    $mvcC -> editarSeleccionC();
                    $mvcC -> actualizarEquipoC();
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