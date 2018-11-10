<?php
  class mvc_controller {
   
    #Llama a la plantilla
    public function plantilla(){
        #Include se utiliza para invocar el archivo que contiene el codigo html
        include('views/template.php');
    }
    #Interaccion con el usuario
    public function enlaces_paginas_controller(){
        #Validar si la variable action viene vacia, es decir, cuando se abre la pagina por primera vez, se debe cargar la vista index.php
        if (isset($_GET['action'])) {
          #Guardar el valor de la variable action en view/modules/navigation.php,
          #en el cual se recibe mediante el metodo GET esa variable
          $enlacesController = $_GET['action'];
        } else {
          #Si viene vacio inicializo con index.php
          $enlacesController = 'index';
        }
        #Mostrar los archivos de los enlaces de cada una de las secciones
        $respuesta = EnlacesPagina::enlacesPaginasModel($enlacesController);
        include($respuesta);
    }
    
   public function PerfilC($id,$Tabla){
     $datosController = $id;
		  $respuesta = Datos::InfoDatosM($datosController, $Tabla);
     return $respuesta;
   }
    
    public function borrarC($tabla){
      if(isset($_GET["idBorrar"])){
         $datosController = $_GET["idBorrar"]; 
        #Valiación de la respuesta del modelo para ver si es un usuario correcto.
        #Se borra el usuario con el id indicado
        $respuesta = Datos::borrarDatosM($datosController, $tabla);
        if($respuesta == "success"){
          if($tabla=="horarios"){ echo'<script> window.location.replace("index.php?action=Horarios"); </script>';}
           if($tabla=="promociones"){ echo'<script> window.location.replace("index.php?action=Promociones"); </script>';}
          
       }else{echo'<script> alert("ERROR")</script>';}
     }
   }
  #------------------------------- S E S I O N E S ------------------------------------
  #Se logea el usuario
  public function ingresoUsuarioController(){
    #Se verifica que se envie los datos del formulario
		if(isset($_POST["usuario"])){
      #Se crea un arreglo con los datos que se enviaron del formulario
			$datosController = array( "usuario"=>$_POST["usuario"],
								            "password"=>$_POST["password"]);
      #Se envia al modelo los datos que del formulario
			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
       #echo "<script> alert(2) </script>";
			#Valiación de la respuesta del modelo para ver si es un usuario correcto.
			if($respuesta["usuario"] == $_POST["usuario"] && $respuesta["password"] == $_POST["password"]){
				/*Si es correcto el usuario y contraseña se inicia una sesion y se crean las variables de sesiones y
        se redirecciona al dashboard*/
        session_start();
				$_SESSION["validar"] = true;
				$_SESSION["id"] = $respuesta["id"];
        $_SESSION["email"] = $respuesta["email"];
        $_SESSION["usuario"] = $respuesta["usuario"];
        $_SESSION["tipo"] = $respuesta["tipo"];
        if( $respuesta["tipo"]==1){
        echo'<script> window.location.replace("index.php?action=dashboard2"); </script>';
        }elseif( $respuesta["tipo"]==2){
          echo'<script> window.location.replace("index.php?action=dashboard"); </script>';
        }
        
			}
			else{
        #En caso de que sea falso se crea una ventana emergente que marca "error"
				#echo'<script> alert("ERROR")</script>';
        echo'<script> alert("")</script>';
       ## echo '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
               #<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                #<strong>Hey!</strong> This is a danger alert
             # </div>        ';
			}
		}
	}
   
  
  
  #------------------------------- A D M I N I S T R A D O R ------------------------------------
            #---------------------------- U S U A R I O S ----------------------#
  public function registroUsuarioC(){
    #Valida que las contraseñas que se pusieron sean iguales 
    if($_POST["validacion"]==1){
        if(isset($_POST["apellido"])){
          date_default_timezone_set("America/Mexico_City");
           #Se valida que se haya enviado una imagen en caso de ser asi, 
          #se guarda en una carpeta y se copia la direccion y esta es guardada en la base de datos
           if(!empty($_FILES["imagen"]["name"])){
                  $name = $_FILES["imagen"]["name"];
                  $tmp = $_FILES["imagen"]["tmp_name"];
                  $date = getdate();
              move_uploaded_file($tmp, "views/ImagenUser/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name);
              $imagen="views/ImagenUser/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name;
           }else{
             #En caso de no cargar una imagen se usara una predeterminada
              $imagen= "views/ImagenUser/no-imagen.jpg";
           }
          $id=NULL;
          $fecha= date("Y-m-d");
          //Recibe a traves del método POST los datos del formulario y los envia al modelo
          $datosController = array( "id"=>$id, "apellido"=>$_POST["apellido"],"tipo"=>$_POST["tipo"],
                                    "nombre"=>$_POST["nombre"],"email"=>$_POST["email"], "password"=>$_POST["password"],
                                    "fecha"=>$fecha,"usuario"=>$_POST["usuario"],"imagen"=>$imagen);
          //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos",
          $print=print_r($datosController);
          $respuesta = Datos::registroUsuarioM($datosController, "usuarios");
          //se imprime la respuesta en la vista $imagen
          if($respuesta == "success"){
            echo'<script> window.location.replace("index.php?action=usuarios"); </script>';
          }
          else{
            echo'<script> alert($print) </script>';
          }
    }
		}
	}
    
 	public function vistaUsuariosC(){
    #Se traen todos los datos de la tabla que se envia como parametro
		$respuesta = Datos::VistaDatosM("usuarios");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. 
    #foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo 
    #diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
     #Se verifica que tipo de usuario y se selecciona un color para mostralo en la tabla
      if($item["tipo"]==1){
        $tipo="Administrador";
        $color="danger";
      }else{
        $tipo="Cliente";
        $color="info";
      }
      #seimprimen los datos en una tabla 
      echo'<tr>
          <td><span class="text-primary">'.$item["usuario"].'</span></td>
          <td>'.$item["nombre"].'  '.$item["apellido"].'</td>
          <td><span class="badge-text badge-text-small '.$color.'">'.$tipo.'</span></td>
          <td>'.$item["email"].'</td>
          <td>'.$item["fecha"].'</td>
          <td class="td-actions">
              <a href="index.php?action=usuarios" data-toggle="modal" data-target="#modal-Editar" onclick="url('.$item["id"].')">
              <i class="la la-edit edit"></i></a>
              <a href="index.php?action=Perfil&id='.$item["id"].'"><i class="la la-eye eye"></i></a>';
              if($_SESSION["id"]==$item["id"]){
                echo'<a href="#"><i class="la la-trash delete"></i></a>';
              }elseif($_SESSION["id"]!=$item["id"]){
                echo'<a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><i class="la la-trash delete"></i></a>';
              }
         echo'</td></tr>';
      }
    }
  
   public function borrarUsuarioC(){
      if(isset($_GET["idBorrar"])){
         $datosController = $_GET["idBorrar"]; 
         #trae la direccion del donde se encuentra la imagen y se elimina de la carpeta del cerivdor
          $carpeta = Datos::InfoDatosM($datosController, "usuarios");
          $ruta=$carpeta["imagen"];
          if($ruta != "views/ImagenUser/no-imagen.jpg"){
            unlink($ruta);
          }
        #Valiación de la respuesta del modelo para ver si es un usuario correcto.
        #Se borra el usuario con el id indicado
        $respuesta = Datos::borrarDatosM($datosController, "usuarios");
        if($respuesta == "success"){echo'<script> window.location.replace("index.php?action=usuarios"); </script>';
       }else{echo'<script> alert("Contraseña Invalida")</script>';}
     }
   }
    
  #----------------------------------------- H O R A R I O -------------------------------------
  public function registroHorarioC(){
    #Valida que las contraseñas que se pusieron sean iguales 
    #if($_POST["validacion"]==1){
        if(isset($_POST["dia"])){
          $id=NULL;
          //Recibe a traves del método POST los datos del formulario y los envia al modelo
          $datosController = array( "id"=>$id,"dia"=>$_POST["dia"],"hora_abrir"=>$_POST["hora_abrir"],"hora_cerrar"=>$_POST["hora_cerrar"]);
          //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos",
          $print=print_r($datosController);
          $respuesta = Datos::registroHorariosM($datosController, "horarios");
          //se imprime la respuesta en la vista $imagen
          if($respuesta == "success"){
            echo'<script> window.location.replace("index.php?action=Horarios"); </script>';
          }
          else{
            echo'<script> alert($print) </script>';
          }
    }
		#}
	}
    
  public function vistaHorariosC(){
    #Se traen todos los datos de la tabla que se envia como parametro
		$respuesta = Datos::VistaDatosM("horarios");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. 
    #foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo 
    #diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
      #seimprimen los datos en una tabla 
      echo'<tr>
          <td>'.$item["id"].' </td> 
          <td>'.$item["dia"].'</td>
          <td>'.$item["hora_abrir"].'</td>
          <td>'.$item["hora_cerrar"].'</td>
          <td class="td-actions">
              <a href="index.php?action=usuarios" data-toggle="modal" data-target="#modal-Editar" onclick="url('.$item["id"].')"><i class="la la-edit edit"></i></a>
             <a href="index.php?action=Horarios&idBorrar='.$item["id"].'"><i class="la la-trash delete"></i></a>
         </td>
         </tr>';
      }
    }
    
   #----------------------------------------- V I S I A T A S -------------------------------------
  public function registroVisitaC(){
        #Se valida que se precione el boton
        if(isset($_POST["id_usuario"])){
          date_default_timezone_set("America/Mexico_City");
          $id=NULL;
          $fecha= date("Y-m-d");
          $hora= date("H:i:s");
          $dias= date("N");
          if($dias=1){$dia="Lunes";}
          if($dias=2){$dia="Martes";}
          if($dias=3){$dia="Miercoles";}
          if($dias=4){$dia="Jueves";}
          if($dias=5){$dia="Viernes";}
          if($dias=6){$dia="Sabado";}
          if($dias=7){$dia="Domingo";}
          $D=print_r($dia);
          echo"<script> alert($D)</script>";
          //Recibe a traves del método POST los datos del formulario y los envia al modelo
          $datosController = array( "id"=>$id,"id_usuario"=>$_GET["id"],"hora"=>$hora,"fecha"=>$fecha,"dia"=>$dia);
          //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos",
          $print=print_r($datosController);
          $respuesta = Datos::registroVisitaM($datosController, "visitas");
          //se imprime la respuesta en la vista $imagen
          if($respuesta == "success"){
            echo'<script> window.location.replace("index.php?action=Perfil"); </script>';
          }
          else{
            echo'<script> alert("ERROR") </script>';
          }
    }
	}
    
  public function vistaVisitasC(){
    #Se traen todos los datos de la tabla que se envia como parametro
		$respuesta = Datos::VistaDatosM("visitas");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. 
    #foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo 
    #diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
      #seimprimen los datos en una tabla 
      if($item["id_usuario"]==$_GET["id"]){
      echo'<tr>
          <td>'.$item["id"].' </td> 
          <td>'.$item["dia"].'</td>
          <td>'.$item["fecha"].'</td>
          <td>'.$item["hora"].'</td>
         </tr>';
      }
    }
  }
  
 #----------------------------------------- P R O M O C I O N E S -------------------------------------
  public function registroPromocionC(){
    #Valida que las contraseñas que se pusieron sean iguales 
    if(isset($_POST["nombre"])){
      date_default_timezone_set("America/Mexico_City");
      $id=NULL;
      $fecha= date("Y-m-d");
      //Recibe a traves del método POST los datos del formulario y los envia al modelo
      $datosController = array( "id"=>$id, "descripcion"=>$_POST["descripcion"],"nombre"=>$_POST["nombre"],
                                "fecha"=>$fecha,"visitas"=>$_POST["visitas"]);
      //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos",
      $print=print_r($datosController);
      $respuesta = Datos::registroPromocionM($datosController, "promociones");
      //se imprime la respuesta en la vista $imagen
      if($respuesta == "success"){
        echo'<script> window.location.replace("index.php?action=Promociones"); </script>';
      }
      else{
        echo'<script> alert($print) </script>';
      }
    }
	}
  public function vistaPromocionesC(){
    #Se traen todos los datos de la tabla que se envia como parametro
		$respuesta = Datos::VistaDatosM("promociones");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. 
    #foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo 
    #diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
      #seimprimen los datos en una tabla 
      echo'<tr>
          <td>'.$item["id"].' </td> 
          <td>'.$item["nombre"].'</td>
          <td>'.$item["descripcion"].'</td>
          <td>'.$item["visitas"].'</td>
          <td class="td-actions">
             <a href="index.php?action=usuarios" data-toggle="modal" data-target="#modal-Editar" onclick="url('.$item["id"].')"><i class="la la-edit edit"></i></a>
             <a href="index.php?action=Promociones&idBorrar='.$item["id"].'"><i class="la la-trash delete"></i></a>
         </td>
         </tr>';
    }
  }
}
?>