<div class="module">
  <div class="module-head">
    <h3>Alumnos</h3>
  </div>
  <div class="module-body">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModals">
      Registrar Alumno
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="form-horizontal row-fluid" method="POST" enctype="multipart/form-data">

              <input type="number" class="span10" placeholder="Matricula" name="matricula" required>
              <input type="text" class="span10" placeholder="Nombre" name="nombre" required>
              <input type="text" class="span10" placeholder="Apellido" name="apellido" required>
              <select class="js-example-basic-single span10" name="carrera">
              <option value="ITI">ITI</option>
               <option value="IM">IM</option>
               <option value="PYMES">PYMES</option>
               <option value="ISA">ISA</option>
               </select>
              <input type="file" class="span8" name="photography"  accept="image/jpeg, image/png" required >

           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            <input type="submit" class="btn btn-primary" name="submit" value="Registrar">
            <!--button type="button" class="btn btn-primary">Registrar</butto-n-->
          </div>
             </form>
        </div>
      </div>
    </div>
</div>
<?php
  $crud=new mvc_controller();
  $crud -> registroAlumnosC();
  #$crud -> borrarAlumnoC();
?>
  <!-------------------------  Fin del Formulario  en el modal ------------------------------------------------>


  <!-------------------------  Tabla de Alumnos  ------------------------------------------------>
  <div class="module-body">
    <div class="module">
      <div class="module-head">
        <h3>DataTables</h3>
      </div>
      <div class="module-body table">
        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
          <thead>
            <tr>
              <th>Matricula</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Carrera</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
<?php

  			$mvc = new mvc_controller();
  			$mvc -> VistaAlumnosC();
  			$mvc -> borrarAlumnoC();

  		?>
          </tbody>
        </table>
      </div>
    </div>
    <!--/.module-->
  </div>
</div>
