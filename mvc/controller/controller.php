<?php
  class mvc_controller {
    //Llama a la plantilla
  public function plantilla(){
      //Include se utiliza para invocar el archivo que contiene el codigo html
      include('view/template.php');
    }
  //Se logea el usuario
  public function ingresoUsuarioController(){

		if(isset($_POST["email"])){
			$datosController = array( "email"=>$_POST["email"],
								      "password"=>$_POST["password"]);

			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

			//Valiación de la respuesta del modelo para ver si es un usuario correcto.
			if($respuesta["email"] == $_POST["email"] && $respuesta["password"] == $_POST["password"]){
				session_start();
				$_SESSION["validar"] = true;
				$_SESSION["id"] = $respuesta["id"];
        $_SESSION["nombre"] = $respuesta["nombre"];
        $_SESSION["email"] = $respuesta["email"];
        #echo '$_SESSION["validar"]';
				header("location:index.php?action=usuarios");
			}
			else{
				header("location:index.php?action=fallo");
			}
		}
	}
  //Interaccion con el usuario
  public function enlaces_paginas_controller(){
      //Trabajar con los enlaces de las paginas
      //Validar si la variable action viene vacia, es decir, cuando se abre la
      //pagina por primera vez, se debe cargar la vista index.php
      if (isset($_GET['action'])) {
        //Guardar el valor de la variable action en view/modules/navigation.php,
        //en el cual se recibe mediante el metodo GET esa variable
        $enlacesController = $_GET['action'];
      } else {
        //Si viene vacio inicializo con index.php
        $enlacesController = 'index';
      }
      //Mostrar los archivos de los enlaces de cada una de las secciones
      //Para esto, hay que mandar al modelo para que haga dicho proceso y
      //muestre la informacion
      $respuesta = EnlacesPagina::enlacesPaginasModel($enlacesController);
      include($respuesta);
    }
  ///Se trae la informacion de todos los Usuarios
  public function vistaUsuariosController(){
    $respuesta = Datos::vistaUsuariosModel("usuarios");
    #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
      foreach($respuesta as $row => $item){
      echo'<tr>
          <td>'.$item["id"].'</td>
          <td>'.$item["nombre"].'</td>
          <td>'.$item["apellido"].'</td>
          <td>'.$item["email"].'</td>
          <td><a href="index.php?action=EditarUsuario&id='.$item["id"].'">
          <button class="btn btn-primary" >Editar</button></a></td>';
        if ($_SESSION["id"] != $item["id"]){
        echo'
          <td><a href="index.php?action=delete&idBorrar='.$item["id"].'">
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"> 
          Eliminar </button></a></td>';
        }
        echo' </tr>';
      }
   }
  //Se registra los datos del alumno
  public function registroUsuarioController(){
		if(isset($_POST["apellido"])){
			$id=NULL;
			$fecha= date("Y-m-d");

			//Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):
			$datosController = array( "id"=>$id,
								      "apellido"=>$_POST["apellido"],
								      "nombre"=>$_POST["nombre"],
								  	  "email"=>$_POST["email"],
								      "password"=>$_POST["password"],
									  "fecha"=>$fecha);
			//Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");
			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				//header("location:index.php?action=ok");
        echo "<script> alert('Registro Exitoso') </script>";
				echo "<script>location.href='index.php?action=login';</script>";
			}
			else{
				//header("location:index.php");
        echo "<script> alert('Registro no exitoso') </script>";
				#echo "<script>location.href='index.php?action=inicio;</script>";
			}
		}
	}
  public function editarUsuarioController(){
      $datosController = $_GET["id"];
      $respuesta = Datos::InformacionModel($datosController, "usuarios");
      echo'
              <input type="hidden" value="'.$respuesta["id"].'" name="id">
              <input type="hidden" value="'.$respuesta["date_added"].'" name="fecha">
              <div class="form-group has-feedback">
                <input type="text" placeholder="Nombre" value="'.$respuesta["nombre"].'" name="nombre" required>
                <span class="fa fa-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="text" placeholder="Apellido" value="'.$respuesta["apellido"].'" name="apellido" required>
                <span class="fa fa-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="email" placeholder="Email" value="'.$respuesta["email"].'" name="email" required>
                <span class="fa fa-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" placeholder="Password" value="'.$respuesta["password"].'" name="password" required>
                <span class="fa fa-lock form-control-feedback"></span>
              </div>
              <div class="row">
               <div class="col-2">
                  <button type="submit" class="btn btn-primary">Actualizar</button>
               </div>';
	}
  public function actualizarUsuarioController(){
		$fechas= date("Y-m-d");
		if(isset($_POST["id"])){
			$datosController =  array( "id"=>$_POST["id"],
								      "apellido"=>$_POST["apellido"],
								      "nombre"=>$_POST["nombre"],
								  	  "email"=>$_POST["email"],
								      "password"=>$_POST["password"],
									  "fecha"=>$fechas);
			
			$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");
			if($respuesta == "success"){
				header("location:index.php?action=usuarios");
			}
			else{
				echo "error";
			}
		}
	
	  }
    public function VerificarController(){

      if(isset($_POST["password"])){
        $email=$_SESSION["email"];
        $datosController = array( "email"=>$email,
                        "password"=>$_POST["password"]);
          $respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
          //Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta["email"] == $email && $respuesta["password"] == $_POST["password"]){
            if(isset($_GET["idBorrar"])){
  			$datosController = $_GET["idBorrar"];
  			$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");
  			if($respuesta == "success"){
  				header("location:index.php?action=usuarios");
  			}
  		}
          }
      }
    }
          public function borrarUsuarioConroller(){
  		if(isset($_GET["idBorrar"])){
  			$datosController = $_GET["idBorrar"];
  			$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");
  			if($respuesta == "success"){
  				header("location:index.php?action=usuarios");
  			}
  		}
    }
    
    
   }
?>
