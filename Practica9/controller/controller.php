<?php
  class mvc_controller {
    //Llama a la plantilla
    public function plantilla(){
      //Include se utiliza para invocar el archivo que contiene el codigo html
      include('views/template.php');
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
    public function VistaAlumnosC(){
     # echo '<script> alert(1) </script>';
      $respuesta = Datos::VistaAlumnosM("alumnos");
     
      #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
      foreach($respuesta as $row => $item){
      echo'<tr>
          <td>'.$item["matricula"].'</td>
          <td>'.$item["nombre"].'</td>
          <td>'.$item["apellido"].'</td>
          <td>'.$item["carrera"].'</td>
         <td><a  class="btn btn-small btn-info" href="index.php?action=EditarAlumno&id='.$item["matricula"].'">Editar</a></td>
      <td><a class="btn btn-small btn-danger" href="index.php?action=Alumnos&idBorrar='.$item["matricula"].'">Borrar</a></td>
        </tr>';
      }
    }
    
    
    //Se registra los datos del alumno
    public function registroAlumnosC(){
      if(isset($_POST["matricula"])){
        #$imagen"=>addslashes(file_get_contents($_FILES["photography"]["temp_name"]));
        $imagen= "views/ImagenesServidor/no-imagen.jpg";
        //Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):
        $datosController = array( "matricula"=>$_POST["matricula"], 
                      "nombre"=>$_POST["nombre"],
                      "carrera"=>$_POST["carrera"],
                      "imagen"=>$imagen,
                      "apellido"=>$_POST["apellido"]);
        //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
        $respuesta = Datos::registroAlumnosM($datosController, "alumnos");
        //se imprime la respuesta en la vista 
        if($respuesta == "success"){
          header("location:index.php?action=Alumnos");
        }
        else{
          header("location:index.php?action=Alumnos");
        }
      }
	  }
    
    
    
     
    
    public function editarAlumnoC(){
      $datosController = $_GET["id"];
      $respuesta = Datos::editarAlumnoM($datosController, "alumnos");
      echo'
            <input type="hidden" value="'.$respuesta["matricula"].'" name="matricula" class="span10">
            <br>
            </br>
            <input type="text" placeholder="Nombre" name="nombre" required value="'.$respuesta["nombre"].'" class="span10">
             <br>
            </br>
            <input type="text" placeholder="Apellido" name="apellido" required value="'.$respuesta["apellido"].'" class="span10">
             <br>
            </br>
            <select name="carrera" class="js-example-basic-single span10">
               <option value='.$respuesta["carrera"].'> '.$respuesta["carrera"].' </option>
               <option value="ITI">ITI</option>
               <option value="IM">IM</option>
               <option value="PYMES">PYMES</option>
               <option value="ISA">ISA</option>
             </select>
              <br>
            </br>
            <input type="file" class="span8">
             <br>
            </br>
            <input type="submit" class="btn btn-primary" name="submit" value="Actualizar">';
    }
    public function actualizarAlumnoC(){
		if(isset($_POST["matricula"])){
			$datosController = array( "matricula"=>$_POST["matricula"], 
										"nombre"=>$_POST["nombre"],
								      	"carrera"=>$_POST["carrera"],
								  		"apellido"=>$_POST["apellido"]);
			$respuesta = Datos::actualizarAlumnoM($datosController, "alumnos");
			if($respuesta == "success"){
				header("location:index.php?action=Alumnos");
			}
			else{
				echo "error";
			}
		}
	
	}
      public function borrarAlumnoC(){
  		if(isset($_GET["idBorrar"])){
  			$datosController = $_GET["idBorrar"];
  			$respuesta = Datos::borrarAlumnoM($datosController, "alumnos");
  			if($respuesta == "success"){
  				header("location:index.php?action=Alumnos");
  			}
  		}
    }
}
/*
    //Funcion para el inicio de sesion del usuario
    public function ingresoUsuarioController(){
  		if(isset($_POST["submit"])){
  			$datosController = array("email"=>$_POST["email"], "password"=>$_POST["password"]);
  			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
  			//Validación de la respuesta del modelo para ver si es un usuario registrado.
  			if($respuesta["email"] == $_POST["email"] && $respuesta["password"] == $_POST["password"]){
  				session_start();
  				$_SESSION["validar"] = true;
  				$_SESSION["id"] = $respuesta["id"];
          $_SESSION["nombre"] = $respuesta["nombre"];
  				header("location:index.php?action=usuarios");
  			}
  			else{
  				header("location:index.php?action=register");
  			}
  		}
  	}

*/

?>
