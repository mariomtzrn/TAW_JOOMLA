<div class="module">
  <div class="module-head">
    <h3> Editar Alumnos</h3>
  </div>
  
  <div class="module-body">
      <form class="form-horizontal row-fluid" method="post">
          <?php
            $mvc = new mvc_controller();
            $mvc -> editarAlumnoC();
            $mvc -> actualizarAlumnoC();
          ?>
      </form>
  </div>
</div>