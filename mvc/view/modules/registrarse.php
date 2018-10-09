<?php
		session_start();
		if($_SESSION["validar"] ){
			header("location:index.php?action=login");
			exit();
		}
?>

<div class="card" style="padding:20px; padding-left:500px; padding-right:450px">
    <center><h4>Registro de usuario</h4></center>
    <form method="post">
		      <div class="form-group has-feedback">
            <input type="text" placeholder="Nombre" class="form-control" name="nombre" required>
            <span class="fa fa-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" placeholder="Apellido" class="form-control" name="apellido" required>
            <span class="fa fa-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" placeholder="Email" class="form-control" name="email" required>
            <span class="fa fa-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" placeholder="Password" class="form-control" name="password" required>
            <span class="fa fa-lock form-control-feedback"></span>
          </div>
          <div class="row">
           <div class="col-2">
              <button type="submit" class="btn btn-primary">Registrarse</button>
            </div>
           </div>
	</form>
  </div>

<?php
$mvc=new mvc_controller();
$mvc -> registroUsuarioController();
?>