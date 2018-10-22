  <?php
if(isset($_SESSION["validar"])){
if($_SESSION["tipo"] == 0){
   if($_GET["select"] == "Alumno"){
    $mvcA = new mvc_controller();
    $mvcA -> borrarAlumnoC();
     $direccion="index.php?action=Alumnos" ;
   }
   if($_GET["select"] == "Tutor"){
    $mvcT = new mvc_controller();
    $mvcT -> borrarTutorC();
      $direccion="index.php?action=Tutores" ;
   }
  if($_GET["select"] == "Carrera"){
    $mvcT = new mvc_controller();
    $mvcT -> borrarTutorC();
      $direccion="index.php?action=Carreras" ;
   }
}
  if($_GET["select"] == "Tutorias"){
    $mvcT2 = new mvc_controller();
    $mvcT2 -> borrarTutoriaC();
    $direccion="index.php?action=Tutorias" ;
   }

  ?>
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <h3>Confirmar Contraseña</h3>
           </div>
           <div class="modal-body">
                <form method="POST">
 
          <div class="form-group">
            <label>Contraseña</label>
            <input type="password" class="form-control"  name="password" required>
          </div>
 
       </div>
           <div class="modal-footer">
                <?php echo '<a href= "'.$direccion.' " class="btn btn-danger">Salir</a>'?>
               <button type="submit" class="btn btn-primary">Confirmar</button>
           </div>
           
    </form> 
      </div>
   </div>
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
   <script>
      $(document).ready(function()
      {
         $("#mostrarmodal").modal("show");
      });
    </script>
<?php
}
?>