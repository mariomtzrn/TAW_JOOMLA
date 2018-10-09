<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"-->
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3>Confirmar Contraseña</h3>
           </div>
           <div class="modal-body">
                <form method="POST">
 
          <div class="form-group has-feedback">
            <input type="password" placeholder="Password" name="password" required>
            <span class="fa fa-lock form-control-feedback"></span>
          </div>
 
       </div>
           <div class="modal-footer">
                <a href="index.php?action=usuarios" class="btn btn-danger">Salir</a>
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
  //echo '<script> alert(2) <script>';
  $mvc = new mvc_controller();
  			$mvc -> VerificarController();
  
  ?>