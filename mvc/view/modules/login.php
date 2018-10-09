<?php
		session_start();
		if($_SESSION["validar"] ){
			header("location:index.php?action=usuarios");
			exit();
		}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MVC</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">       

    <style media="screen">
      header {
        position: relative;
        margin: auto;
        text-align: center;
        padding: 5px;
      }
      nav {
        position: relative;
        margin: auto;
        width: 100%;
        height: auto;
        background: black;
      }
      nav ul {
        position: relative;
        margin: auto;
        width: 50%;
        text-align: center;
      }
      nav ul li {
        display: inline-block;
        width: 24%;
        line-height: 50px;
        list-style: none;
      }
      nav ul li a {
        color: white;
        text-decoration: none;
      }
      section {
        position: relative;
        padding: 20%;
      }
      container {
        padding-left:500px;
        
      }
    </style>
  </head>
<body>

	<div class="card" style="padding:20px; padding-left:500px; padding-right:500px">
    <center><h4>Iniciar sesión</h4></center>
    <form method="post">
      <div class="form-group has-feedback">
		    <input type="email" class="form-control" placeholder="Correo" name="email" required>
      </div>
      <div class="form-group has-feedback">
		    <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
      </div>
		  <center><input type="submit" class="btn btn-primary" value="Ingresar" style="padding:10px;"></center>
	</form>
  </div>
</body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>

<?php
$ingreso = new mvc_controller();
$ingreso -> ingresoUsuarioController();
if(isset($_GET["action"])){
	if($_GET["action"] == "fallo"){
		echo "Fallo al ingresar";

	}
}
?>
