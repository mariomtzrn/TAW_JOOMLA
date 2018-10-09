	<?php
 
if(!isset($_SESSION["id"]))
{
  header("location:index.php?action=login");
  exit();
}
?>
<div class="container">
      <h4>Usuarios</h4>

  	<table class="table table-striped">

  		<thead class="thead-light">

  			<tr>
  				<th>id</th>
  				<th>Nombre</th>
  				<th>Apellido</th>
  				<th>Email</th>
  				<th>Editar</th>
  				<th>Eliminar</th>

  			</tr>

  		</thead>

  		<tbody>
  					<?php

  			$vistaUsuario = new mvc_controller();
  			$vistaUsuario -> vistaUsuariosController();
  			#$vistaUsuario -> borrarUsuarioConroller();

  		?>

  		</tbody>

  	</table>
</div>
<!-- Button trigger modal -->
<!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button-->

<!-- Modal -->
