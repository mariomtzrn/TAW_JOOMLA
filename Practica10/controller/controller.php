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
    
    
    #--------------------------Generales------------------------------#
    #Se utiliza para poner en un select las opciones que existen
    public function OptionController($tabla){
      $respuesta = Datos::VistaDatosModel($tabla);
       foreach($respuesta as $row => $item){
          echo' <option value="'.$item["id"].'"> '.$item["nombre"].' </option>';
       }
    }
    
    #Se utiliza para poner en un select las opciones que existen
    public function OptionController2($tabla){
      $respuesta = Datos::VistaDatosModel($tabla);
       foreach($respuesta as $row => $item){
         if($_SESSION["tipo"] == 1 and $tabla == "alumnos" and $item["tutor"] == $_SESSION["id"]){
            echo '<script> alert($item["id"]) </script>';
            echo' <option value="'.$item["id"].'"> '.$item["nombre"].' '.$item["apellido"].' </option>';
         }
          if($_SESSION["tipo"]== 0){
            echo' <option value="'.$item["id"].'"> '.$item["nombre"].' '.$item["apellido"].' </option>';
          }
       }
    }
    
    #Se utiliza para poner en un select las opciones que existen
    public function OptionController3($tabla){
      $respuesta = Datos::VistaDatosModel($tabla);
       foreach($respuesta as $row => $item){
         if($item["tutor"] == $_SESSION["id"]){
            echo' <option value="'.$item["matricula"].'"> '.$item["nombre"].' '.$item["apellido"].' </option>';
         }
       }
    }  
      
    
    #----------------------------A L U M N O S------------------------------#
    #Se visualiza los datos de los alumnos en la tablas 
    public function VistaAlumnosC(){
     # echo '<script> alert(1) </script>';
        $respuesta = Datos::VistaDatosModel("alumnos");
        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        foreach($respuesta as $row => $item){
          $datosController = $item["tutor"];
          $tutor = Datos::InfoModel($datosController, "profesor");
          $datosController = $item["carrera"];
          $carrera = Datos::InfoModel($datosController, "carrera");
        if($_SESSION["id"] == $tutor["id"] and $_SESSION["tipo"] == 1){
        echo'<tr>
            <td>'.$item["matricula"].'</td>
            <td>'.$item["nombre"].' '.$item["apellido"].'</td>
            <td>'.$carrera["nombre"].'</td>
            <td>'.$tutor["nombre"].' '.$tutor["apellido"].'</td>
            <td><a class="fa fa-eye btn btn-success" href="index.php?action=Perfil&id='.$item["matricula"].'&select=Alumno"></a></td>
          </tr>';
      }
      if($_SESSION["tipo"] == 0){
        echo'<tr>
            <td>'.$item["matricula"].'</td>
            <td>'.$item["nombre"].' '.$item["apellido"].'</td>
            <td>'.$carrera["nombre"].'</td>
            <td>'.$tutor["nombre"].' '.$tutor["apellido"].'</td>
            <td><a class="fa fa-edit btn btn-info" href="index.php?action=Editar&id='.$item["matricula"].'&select=Alumno"></a></td>
            <td><a class="fa fa-trash btn btn-danger" href="index.php?action=Delete&idBorrar='.$item["matricula"].'&select=Alumno"></a></td>
            <td><a class="fa fa-eye btn btn-success" href="index.php?action=Perfil&id='.$item["matricula"].'&select=Alumno"></a></td>
          </tr>';
      }
     }
    }
  
    #Se registra los datos del alumno
    public function registroAlumnosC(){
      if(isset($_POST["matricula"])){
        #Se valida que se haya enviado una imagen en caso de ser asi, 
        #se guarda en una carpeta y se copia la direccion y esta es guardada en la base de datos
         if(!empty($_FILES["imagen"]["name"])){
                $name = $_FILES["imagen"]["name"];
                $tmp = $_FILES["imagen"]["tmp_name"];
                $date = getdate();
            move_uploaded_file($tmp, "views/ImagenesA/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name);
            $imagen="views/ImagenesA/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name;
         }else{
           #En caso de no cargar una imagen se usara una predeterminada
            $imagen= "views/ImagenesA/no-imagen.jpg";
         }
        //Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):
        $datosController = array( "matricula"=>$_POST["matricula"], 
                                  "nombre"=>$_POST["nombre"],
                                  "carrera"=>$_POST["carrera"],
                                  "tutor"=>$_POST["tutor"],
                                 "sa"=>$_POST["sa"],
                                  "imagen"=>$imagen,
                                  "apellido"=>$_POST["apellido"]);
          //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
        $respuesta = Datos::registroAlumnosM($datosController, "alumnos");
         //se imprime la respuesta en la vista 
        if($respuesta == "success"){
          header("location:index.php?action=Alumnos");
        }
        else{
          echo '<script> alert("ERROR") </script>';
          #header("location:index.php?action=Alumnos");
        }
      }
	  }
    
    #La informacion de un alumno se agrega a un formulario para poder ser editado
    public function editarAlumnoC(){
      #Trae la informacion del alumno segun su matricula, esta se recupera de la URL
      $datosController = $_GET["id"];
      $respuesta = Datos::InfoAlumnoM($datosController, "alumnos");
      #Trae la informacion del profesor y de la carrera segun sea la llave foranea que tiene el alumno en la base de batos
      $datosController = $respuesta["tutor"];
      $tutor = Datos::InfoModel($datosController, "profesor");
      $datosController = $respuesta["carrera"];
      $carrera = Datos::InfoModel($datosController, "carrera");
      echo'
       <div class="form-group">
          <input type="hidden" class="form-control" name="matricula" value="'.$respuesta["matricula"].'"  required>
        </div>
        <div class="form-group">
          <label>Nombre</label>
          <input type="text" class="form-control" name="nombre"  value="'.$respuesta["nombre"].'" required >
        </div>
        <div class="form-group">
          <label>Apellido</label>
          <input type="text" class="form-control" name="apellido"  value="'.$respuesta["apellido"].'" required >
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Imagen</label>
          <input type="hidden" name="imagen" required value="'.$respuesta["imagen"].'" class="span10">
          <input type="file" id="exampleInputFile" name="imagen"  accept="image/jpeg, image/png">
        </div>
      <div class="form-group">
        <label>Carrera</label>
        <select class="form-control select2" style="width: 100%;" name="carrera" required>
         <option value="'.$respuesta["carrera"].'"> '.$carrera["nombre"].' </option>';
      #se muestran todas las carreras existentes en la base de datos
          $respuesta1 = Datos::VistaDatosModel("carrera");
          foreach($respuesta1 as $row => $item){
              echo' <option value="'.$item["id"].'"> '.$item["nombre"].' </option>';
          }
        echo'
        </select>
      </div>              
        <div class="form-group">
        <label>Tutores</label>
        <select class="form-control select2" style="width: 100%;" name="tutor" required>
        <option value='.$respuesta["tutor"].'> '.$tutor["nombre"].' '.$tutor["apellido"].' </option>';
      #se muestran todas los profesores existentes en la base de datos
           $respuesta2 = Datos::VistaDatosModel("profesor");
          foreach($respuesta2 as $row => $item){
              echo' <option value="'.$item["id"].'"> '.$item["nombre"].' '.$item["apellido"].' </option>';
          }
      echo'
        </select>
      </div>
      <div class="form-group">
        <label>Situacion Academica</label>
        <select class="form-control select2" style="width: 100%;" name="sa" required>
          <option value="'.$respuesta["sa"].'"> '.$respuesta["sa"].' </option>
          <option value="Regular">Regular</option>
          <option value="Especial">Especial</option>
        </select>
      </div>
          <div class="form-group">
         <input type="submit" class="btn btn-success" name="submit" value="Registrar">
        </div>';
    }
   
    #Se muestra el perfil de un alumno seleccionado
    public function perfilAlumnoC (){
       #Trae la informacion del alumno segun su matricula, esta se recupera de la URL
      $datosController = $_GET["id"];
      $respuesta = Datos::InfoAlumnoM($datosController, "alumnos");
      #Trae la informacion del profesor y de la carrera segun sea la llave foranea que tiene el alumno en la base de batos
      $datosController = $respuesta["tutor"];
      $tutor = Datos::InfoModel($datosController, "profesor");
      $datosController = $respuesta["carrera"];
      $carrera = Datos::InfoModel($datosController, "carrera");
      echo'
          <div class="col-md-4">
              <center>
              <img class=" img-responsive " src='.$respuesta["imagen"].' alt="User profile picture">
              </br>
               <a class="fa  fa-arrow-left btn btn-small btn-default" href="index.php?action=Alumnos"></a>';
              if($_SESSION["tipo"] == 0){
      echo'
              <a class="fa fa-edit btn btn-small btn-default" href="index.php?action=Editar&id='.$respuesta["matricula"].'&select=Alumno"></a>';
              }echo'
             
                </center>
                </div>

             <div class="col-md-6">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <p class="fa fa-barcode"><b> Matricula: </b></p>
                    <a> '.$respuesta["matricula"].'</a>
                </li>
                <li class="list-group-item">
                  <p class="fa fa-user"><b> Nombre: </b></p>
                    <a> '.$respuesta["nombre"].' '.$respuesta["apellido"].'</a>
                </li>
                <li class="list-group-item">
                  <p class="fa fa-cube"><b> Carrera: </b> </p>
                    <a> '.$carrera["nombre"].'</a>
                </li>
                <li class="list-group-item">
                  <p class="fa  fa-users"><b> Tutor: </b> </p>
                    <a> '.$tutor["nombre"].' '.$tutor["apellido"].'</a>
                </li>
                <li class="list-group-item">
                  <p class="fa  fa-users"><b> Situacion Academica: </b> </p>
                    <a> '.$respuesta["sa"].'</a>
                </li>
              </ul>
                  </div>';
      
    }
    
    #Borra al alumno Seleccionada, primero se verifica que la contraseña sea la del administrador
    public function borrarAlumnoC(){
  		 if(isset($_POST["password"])){
        $email=$_SESSION["email"];
        $datosController = array( "email"=>$email,
                        "password"=>$_POST["password"]);
          $respuesta = Datos::ingresoUsuarioModel($datosController, "profesor");
          //Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta["email"] == $email && $respuesta["password"] == $_POST["password"]){
            if(isset($_GET["idBorrar"])){
              $datosController = $_GET["idBorrar"];
               $carpeta = Datos::InfoAlumnoM($datosController, "alumnos");
                $ruta=$carpeta["imagen"];
                  if($ruta != "views/ImagenesA/no-imagen.jpg"){
                  unlink($ruta);
                }
              $respuestas = Datos::borrarAlumnoM($datosController, "alumnos");
              if($respuestas == "success"){
               echo'<script> window.location.replace("index.php?action=Alumnos"); </script>';
             }
              else{
                echo'<script> alert("ERROR") </script>';
              }
  		     }
         }
       }
    }
    
    #Se envia la informacion al modelo para hacer la actualizacion en la base de datos en la fila correspondiente
    public function actualizarAlumnoC(){
		if(isset($_POST["matricula"])){
       if(!empty($_FILES["imagen"]["name"])){
                $datosController = $_POST["matricula"];
                $carpeta = Datos::InfoAlumnoM($datosController, "alumnos");
                $ruta=$carpeta["imagen"];
                if($ruta != "views/ImagenesA/no-imagen.jpg"){
                  unlink($ruta);
                }
                $name = $_FILES["imagen"]["name"];
                $tmp = $_FILES["imagen"]["tmp_name"];
                $date = getdate();
           move_uploaded_file($tmp, "views/ImagenesA/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name);
            $imagen="views/ImagenesA/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name;
         }else{
          $imagen = $_POST["imagen"];
         }
      
			$datosController = array( "matricula"=>$_POST["matricula"], 
                                "nombre"=>$_POST["nombre"],
                                "carrera"=>$_POST["carrera"],
                                "tutor"=>$_POST["tutor"],
                                "sa"=>$_POST["sa"],
                                "imagen"=>$imagen,        
                                "apellido"=>$_POST["apellido"]);
			$respuesta = Datos::actualizarAlumnoM($datosController, "alumnos");
			if($respuesta == "success"){
          echo'<script> window.location.replace("index.php?action=Alumnos"); </script>';
        #header("location:index.php?action=Alumnos");
        }
        else{
          echo '<script> alert("ERROR") </script>';
          #header("location:index.php?action=Alumnos");
        }
		}
	
	}
    
    
    
    #------------------------------------------ T U T O R E S--------------------------------# 
    #Se registra los datos de un nuevo tutor, estos tambien son usuarios
    public function registroTutorC(){
      if(isset($_POST["id"])){
        #Se valida que se haya enviado una imagen en caso de ser asi, 
        #se guarda en una carpeta y se copia la direccion y esta es guardada en la base de datos
         if(!empty($_FILES["imagen"]["name"])){
                $name = $_FILES["imagen"]["name"];
                $tmp = $_FILES["imagen"]["tmp_name"];
                $date = getdate();
            move_uploaded_file($tmp, "views/ImagenesT/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name);
            $imagen="views/ImagenesT/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name;
         }else{
           #En caso de no cargar una imagen se usara una predeterminada
            $imagen= "views/ImagenesT/no-imagen.jpg";
         }
        $tipo = 1 ;
        //Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):
        $datosController = array( "id"=>$_POST["id"], 
                                  "nombre"=>$_POST["nombre"],
                                  "titulo"=>$_POST["titulo"],
                                 "email"=>$_POST["email"],
                                 "password"=>$_POST["password"],
                                  "imagen"=>$imagen,
                                 "tipo"=>$tipo,
                                  "apellido"=>$_POST["apellido"]);
          //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
        $respuesta = Datos::registroTutorM($datosController, "profesor");
         //se imprime la respuesta en la vista 
        if($respuesta == "success"){
          
        echo'<script> window.location.replace("index.php?action=Tutores"); </script>';
        }
        else{
          echo '<script> alert("ERROR") </script>';
          #header("location:index.php?action=Alumnos");
        }
      }
	  }
    
    #Se visualizan todos los tutores, esto se visualiza a traves de una tabla
    public function VistaTutorC(){
     # echo '<script> alert(1) </script>';
        $respuesta = Datos::VistaDatosModel("profesor");
        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        foreach($respuesta as $row => $item){
          $datosController = $item["carrera"];
          $carrera = Datos::InfoModel($datosController, "carrera");
        
        echo'<tr>
            <td>'.$item["id"].'</td>
            <td>'.$item["nombre"].' '.$item["apellido"].'</td>
            <td>'.$item["email"].'</td>
            <td><a class="fa fa-edit btn btn-info" href="index.php?action=Editar&id='.$item["id"].'&select=Tutor"></a></td>';
            if($_SESSION["id"] != $item["id"]){
            echo'
            <td><a class="fa fa-trash btn btn-danger" href="index.php?action=Delete&idBorrar='.$item["id"].'&select=Tutor"></a></td>';
            }
          if($_SESSION["id"] == $item["id"]){
            echo'
            <td><a class="fa fa-trash btn btn-danger" href="#" disabled></a></td>';
            }
          echo'
            <td><a class="fa fa-eye btn btn-success" href="index.php?action=Perfil&id='.$item["id"].'&select=Tutor"></a></td>
          </tr>';
        
      }
    }
    
    #Se muestra el perfil de un tutor seleccionado
    public function perfilTutorC (){
      #Trae la informacion del profesor y de la carrera segun sea la llave foranea que tiene el alumno en la base de batos
      $datosController = $_GET["id"];
      $respuesta = Datos::InfoModel($datosController, "profesor");
      $datosController = $respuesta["carrera"];
      $carrera = Datos::InfoModel($datosController, "carrera");
      if($respuesta["tipo"]==1){
        $tipo="Tutor";
      }
      if($respuesta["tipo"]==0){
        $tipo="Administrador";
      }
      echo'
          <div class="col-md-4">
              <center>
              <img class=" img-responsive " src='.$respuesta["imagen"].' alt="User profile picture">
              </br>
               <a class="fa  fa-arrow-left btn btn-small btn-default" href="index.php?action=Tutores"></a>
              <a class="fa fa-edit btn btn-small btn-default" href="index.php?action=Editar&id='.$respuesta["id"].'&select=Tutor"></a>
             
                </center>
                </div>

             <div class="col-md-6">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <p class="fa fa-barcode"><b> N° Empleado: </b></p>
                    <a> '.$respuesta["id"].'</a>
                </li>
                <li class="list-group-item">
                  <p class="fa fa-user"><b> Nombre: </b></p>
                    <a> '.$respuesta["titulo"].' '.$respuesta["nombre"].' '.$respuesta["apellido"].'</a>
                </li>
                <li class="list-group-item">
                  <p class="fa  fa-envelope"><b> correo: </b> </p>
                    <a> '.$respuesta["email"].'</a>
                </li>
                <li class="list-group-item">
                  <p class="fa  fa-users"><b> Tipo: </b> </p>
                    <a> '.$tipo.'</a>
                </li>
              </ul>
                  </div>';
      
    }
    
    #La informacion de un tutor se agrega a un formulario para poder ser editado
    public function editarTutorC(){
      #Trae la informacion del profesor segun su numero de empleado, esta se recupera de la URL
      $datosController = $_GET["id"];
      $tutor = Datos::InfoModel($datosController, "profesor");
      $datosController = $tutor["carrera"];
      $carrera = Datos::InfoModel($datosController, "carrera");
      echo'
          <div class="form-group">
                  <input type="hidden" class="form-control" name="id" required value='.$tutor["id"].'>
                </div>
                <div class="form-group">
                  <label>Titulo</label>
                  <input type="text" class="form-control" name="titulo" required value="'.$tutor["titulo"].'">
                </div>
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" name="nombre" required value="'.$tutor["nombre"].'">
                </div>
                <div class="form-group">
                  <label>Apellido</label>
                  <input type="text" class="form-control" name="apellido" required value="'.$tutor["apellido"].'">
                </div>
                 <div class="form-group">
                  <label>Correo</label>
                  <input type="email" class="form-control" name="email" required value="'.$tutor["email"].'">
                </div>
                 <div class="form-group">
                 <label>Contraseña</label>
                  <input type="password" class="form-control" name="password" required value="'.$tutor["password"].'">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Imagen</label>
                  
          <input type="hidden" name="imagen" required value="'.$tutor["imagen"].'" class="span10">
                  <input type="file" id="exampleInputFile" name="imagen"  accept="image/jpeg, image/png">
                </div>
             <input type="submit" class="btn btn-success" name="submit" value="Actualizar">';

    }
    
    #Se envia la informacion al modelo para hacer la actualizacion en la base de datos en la fila correspondiente
    public function actualizarTutorC(){
		if(isset($_POST["id"])){
       if(!empty($_FILES["imagen"]["name"])){
                $datosController = $_POST["id"];
                $carpeta = Datos::InfoModel($datosController, "profesor");
                $ruta=$carpeta["imagen"];
                if($ruta != "views/ImagenesT/no-imagen.jpg"){
                  unlink($ruta);
                }
                $name = $_FILES["imagen"]["name"];
                $tmp = $_FILES["imagen"]["tmp_name"];
                $date = getdate();
           move_uploaded_file($tmp, "views/ImagenesT/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name);
            $imagen="views/ImagenesT/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name;
         }else{
          $imagen = $_POST["imagen"];
         }
      $tipo=1;
			$datosController =array( "id"=>$_POST["id"], 
                                  "nombre"=>$_POST["nombre"],
                                  "titulo"=>$_POST["titulo"],
                                 "email"=>$_POST["email"],
                                 "password"=>$_POST["password"],
                                  "imagen"=>$imagen,
                                 "tipo"=>$tipo,
                                  "apellido"=>$_POST["apellido"]);
          //Se le dice al modelo models/crud.php (Datos::registroUsua
			$respuesta = Datos::actualizarTutorM($datosController, "profesor");
			if($respuesta == "success"){
        echo'<script> window.location.replace("index.php?action=Tutores"); </script>';
          #header("location:index.php?action=Tutores");
        }
        else{
          echo '<script> alert("ERROR") </script>';
          #header("location:index.php?action=Alumnos");
        }
		}
	
	}
    
    #Borra al tutor Seleccionada, primero se verifica que la contraseña sea la del administrador
    public function borrarTutorC(){
  		 if(isset($_POST["password"])){
        $email=$_SESSION["email"];
        $datosController = array( "email"=>$email,
                        "password"=>$_POST["password"]);
          $respuesta = Datos::ingresoUsuarioModel($datosController, "profesor");
          //Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta["email"] == $email && $respuesta["password"] == $_POST["password"]){
            if(isset($_GET["idBorrar"])){
              $datosController = $_GET["idBorrar"];
               $carpeta = Datos::borrarDatosM($datosController, "profesor");
                $ruta=$carpeta["imagen"];
                  if($ruta != "views/ImagenesT/no-imagen.jpg"){
                  unlink($ruta);
                }
              $respuesta = Datos::borrarAlumnoM($datosController, "profesor");
              if($respuesta == "success"){
                 echo'<script> window.location.replace("index.php?action=Tutores"); </script>';
             }
  		     }
         }
       }
    }
    

    
    #-------------------------------- C A R R E R A S ------------------------------------
    
    #Se registra los datos de un nueva carrera, estos tambien son usuarios
    public function registroCarreraC(){
      if(isset($_POST["nombre"])){
        #Se declara una variable que sea nuella para enviarla como id,
        #por que el id en la base de datos es auto-incrementable
        $id=NULL;
        #Recibe a traves del método POST el nombre de la nueva carrera
        $datosController = array( "id"=>$id,
                                 "nombre"=>$_POST["nombre"]);
        #Se envian los datos al modelador 
        $respuesta = Datos::registroCarreraM($datosController, "carrera");
        #se imprime la respuesta en la vista 
        if($respuesta == "success"){
          header("location:index.php?action=Carreras");
        }
        else{
          echo '<script> alert("ERROR") </script>';
        }
      }
	  }
      #SSe visualizan todos los tutores, esto se visualiza a traves de una tabla
    public function VistaCarrerasC(){
        $respuesta = Datos::VistaDatosModel("carrera");      
        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. 
        #foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo 
        #con una variable de un tipo diferente de datos o una variable no inicializada.
        foreach($respuesta as $row => $item){
          $datosController=$item["id"];
          $contador = Datos::CounTutorCarreras($datosController, "profesor");
          
          $count=0;
          foreach($contador as $rows => $items){
            $count= $cont + 1;
          }
          echo'<tr>
              <td>'.$item["id"].'</td>
              <td>'.$item["nombre"].'</td>
               <td>'.$count.'</td>
              <td><a class="fa fa-edit btn btn-info" href="index.php?action=Editar&id='.$item["id"].'&select=Carrera">
              </a></td>
              <td><a class="fa fa-trash btn btn-danger" href="index.php?action=Delete&idBorrar='.$item["id"].'&select=Carrera">
              </a></td>
            </tr>';
      }
    }
    
     #La informacion de un Carrera se agrega a un formulario para poder ser editado
    public function editarCarreraC(){
      $datosController = $_GET["id"];
      $carrera = Datos::InfoModel($datosController, "carrera");
      #Muestra el nombre del alumno
      echo'
          <div class="form-group">
                  <input type="hidden" class="form-control" name="id" required value='.$carrera["id"].'>
                </div>
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" name="nombre" required value="'.$carrera["nombre"].'">
                </div>
                 <input type="submit" class="btn btn-success" name="submit" value="Actualizar">';
    }
    
    #Se envia la informacion al modelo para hacer la actualizacion en la base de datos en la fila correspondiente
    public function actualizarCarreraC(){
		if(isset($_POST["id"])){
			$datosController =array( "id"=>$_POST["id"], 
                                  "nombre"=>$_POST["nombre"]);
      #Se le dice al modelo models/crud.php que datos debe actualizar
			$respuesta = Datos::actualizarCarreraM($datosController, "carrera");
			if($respuesta == "success"){
         echo'<script> window.location.replace("index.php?action=Carreras"); </script>';
          #header("location:index.php?action=Tutores");
        }
        else{
          echo '<script> alert("ERROR") </script>';
          #header("location:index.php?action=Alumnos");
        }
		}
	
	}
    
    #Borra la carrera seleccionada, pero primero se verifica que la contraseña sea la del administrador
    public function borrarCarreraC(){
  		 if(isset($_POST["password"])){
        $email=$_SESSION["email"];
        $datosController = array( "email"=>$email,
                        "password"=>$_POST["password"]);
          $respuesta = Datos::ingresoUsuarioModel($datosController, "profesor");
          //Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta["email"] == $email && $respuesta["password"] == $_POST["password"]){
            if(isset($_GET["idBorrar"])){
              $datosController = $_GET["idBorrar"];
              $respuesta = Datos::borrarDatosM($datosController, "carrera");
              if($respuesta == "success"){
                echo'<script> window.location.replace("index.php?action=Carreras"); </script>';
                #header("location:index.php?action=Tutores");
             }
  		     }
         }
       }
    }
    
    #------------------------------ T U T O R I A S ------------------------------------
    public function VistarTutoriasC(){
        $respuesta = Datos::VistaDatosModel("tutorias");      
        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. 
        #foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo 
        #con una variable de un tipo diferente de datos o una variable no inicializada.
        foreach($respuesta as $row => $item){
          $datosController=$item["id_maestro"];
          $maestro = Datos::InfoModel($datosController, "profesor");
           $datosController=$item["id_alumno"];
          $alumno = Datos::InfoAlumnoM($datosController, "alumnos");
           if($_SESSION["id"] == $maestro["id"] and $_SESSION["tipo"] == 1){
          echo'<tr>
              <td>'.$item["id"].'</td>
              <td>'.$alumno["nombre"].' '.$alumno["apellido"].'</td>
               <td>'.$maestro["nombre"].' '.$maestro["apellido"].'</td>
               <td>'.$item["fecha"].'</td>
               <td>'.$item["hora"].'</td>
               <td>'.$item["tipo"].'</td>
              <td><a class="fa fa-edit btn btn-info" href="index.php?action=Editar&id='.$item["id"].'&select=Tutorias">
              </a></td>
              <td><a class="fa fa-trash btn btn-danger" href="index.php?action=Delete&idBorrar='.$item["id"].'&select=Tutorias">
              </a></td>
            </tr>';
           
           $respuestas = Datos::VistaDatosModel("grupal_Tutorias"); 
             foreach($respuestas as $rows => $items){
              if($items["id_tutoria"] == $item["id"]){
               $datosController=$items["id_alumno"];
              $alumno = Datos::InfoAlumnoM($datosController, "alumnos");
               $datosController=$item["id_maestro"];
               $maestro = Datos::InfoModel($datosController, "profesor");

             echo'<tr>
              <td>'.$item["id"].'</td>
              <td>'.$alumno["nombre"].' '.$alumno["apellido"].'</td>
               <td>'.$maestro["nombre"].' '.$maestro["apellido"].'</td>
               <td>'.$item["fecha"].'</td>
               <td>'.$item["hora"].'</td>
               <td>'.$item["tipo"].'</td>
              <td><a class="fa fa-edit btn btn-info" href="index.php?action=Editar&id='.$item["id"].'&select=Tutorias">
              </a></td>
              <td><a class="fa fa-trash btn btn-danger" href="index.php?action=Delete&idBorrar='.$item["id"].'&select=Tutorias">
              </a></td>
            </tr>';
                 }
           }
             }
         if($_SESSION["tipo"] == 0){
          echo'<tr>
              <td>'.$item["id"].'</td>
              <td>'.$alumno["nombre"].' '.$alumno["apellido"].'</td>
               <td>'.$maestro["nombre"].' '.$maestro["apellido"].'</td>
               <td>'.$item["fecha"].'</td>
               <td>'.$item["hora"].'</td>
               <td>'.$item["tipo"].'</td>
              <td><a class="fa fa-edit btn btn-info" href="index.php?action=Editar&id='.$item["id"].'&select=Tutorias">
              </a></td>
              <td><a class="fa fa-trash btn btn-danger" href="index.php?action=Delete&idBorrar='.$item["id"].'&select=Tutorias">
              </a></td>
            </tr>';
           
           $respuestas = Datos::VistaDatosModel("grupal_Tutorias"); 
             foreach($respuestas as $rows => $items){
              if($items["id_tutoria"] == $item["id"]){
               $datosController=$items["id_alumno"];
              $alumno = Datos::InfoAlumnoM($datosController, "alumnos");
               $datosController=$item["id_maestro"];
               $maestro = Datos::InfoModel($datosController, "profesor");

             echo'<tr>
              <td>'.$item["id"].'</td>
              <td>'.$alumno["nombre"].' '.$alumno["apellido"].'</td>
               <td>'.$maestro["nombre"].' '.$maestro["apellido"].'</td>
               <td>'.$item["fecha"].'</td>
               <td>'.$item["hora"].'</td>
               <td>'.$item["tipo"].'</td>
              <td><a class="fa fa-edit btn btn-info" href="index.php?action=Editar&id='.$item["id"].'&select=Tutorias">
              </a></td>
              <td><a class="fa fa-trash btn btn-danger" href="index.php?action=Delete&idBorrar='.$item["id"].'&select=Tutorias">
              </a></td>
            </tr>';
                 }
           }
             }
      } 
 

     
      }
      
    #Se registra los datos de un nueva carrera, estos tambien son usuarios
    public function registroTutotiaIC(){
      if(isset($_POST["id_alumno"])){
        #Se declara una variable que sea nuella para enviarla como id,
        #por que el id en la base de datos es auto-incrementable
         date_default_timezone_set("America/Mexico_City");
        $id=NULL;
        $id_maestro=$_SESSION["id"];
        $fecha= date("Y-m-d");
        $hora=date("h:i:s A");
        $tipo="Individual";
        #Recibe a traves del método POST el nombre de la nueva carrera
        $datosController = array( "id"=>$id,
                                 "id_maestro"=>$id_maestro,
                                 "fecha"=>$fecha,
                                 "hora"=>$hora,
                                 "tipo"=>$tipo,
                                 "tema"=>$_POST["tema"],
                                 "id_alumno"=>$_POST["id_alumno"]);

        #Se envian los datos al modelador 
        $respuesta = Datos::registroTutoriasM($datosController, "tutorias");
        #se imprime la respuesta en la vista 
        if($respuesta == "success"){
          header("location:index.php?action=Tutorias");
        }
        else{
          echo '<script> alert(ERROR) </script>';
        }
      }
	  }
    
    #Se registra los datos de un nueva carrera, estos tambien son usuarios
    public function registroTutotiaGC(){
      if(isset($_POST["id_alumnoM"])){
        #Se declara una variable que sea nuella para enviarla como id,
        #por que el id en la base de datos es auto-incrementable
         date_default_timezone_set("America/Mexico_City");
        $id=NULL;
        $id_maestro=$_SESSION["id"];
        $fecha= date("Y-m-d");
        $hora=date("h:i:s A");
        $tipo="Grupal";
        $id_alumno=$_POST["id_alumnoM"];
        #Recibe a traves del método POST el nombre de la nueva carrera
        $datosController = array( "id"=>$id,
                                 "id_maestro"=>$id_maestro,
                                 "fecha"=>$fecha,
                                 "hora"=>$hora,
                                 "tipo"=>$tipo,
                                 "tema"=>$_POST["tema"],
                                 "id_alumno"=>$id_alumno[0]);
        
        #Se envian los datos al modelo para guardar los datos del primer alumno en la tablatutorias             
        $respuesta = Datos::registroTutoriasM($datosController, "tutorias");
        #Los demas alumnos son guardados en otra traba 
        #Se traen todos los datos de las tutorias, contando el utltimo que se agrego
        $respuestaV = Datos::VistaDatosModel("tutorias");
        $count=count($id_alumno) -1;
        if($count>0){
         #Se reccore todo el arreglo y se saca la información del ultimo registro
        foreach($respuestaV as $row => $item){
          $datosController = $item["id"];
          $tutorias = Datos::InfoModel($datosController, "tutorias");
        }
         #Se insertan los demas alumnos en la tabla grupal_Tutorias
        for ($i=1;$i<=$count;$i++){     
           $datosController = array( "id"=>$id,
                                    "id_alumno"=>$id_alumno[$i],
                                    "id_tutoria"=>$tutorias["id"]);                                  
            $respuesta2 = Datos::registroTutoriasGM($datosController, "grupal_Tutorias");
         } 
        }
       
        #se imprime la respuesta en la vista 
        if($respuesta2 == "success1"){
          header("location:index.php?action=Tutorias");
        }
        else{
          echo '<script> alert("ERROR") </script>';
        }
      }
	  }
    
    #Borra la carrera seleccionada, pero primero se verifica que la contraseña sea la del administrador
    public function borrarTutoriaC(){
  		 if(isset($_POST["password"])){
        $email=$_SESSION["email"];
        $datosController = array( "email"=>$email,
                        "password"=>$_POST["password"]);
          $respuesta = Datos::ingresoUsuarioModel($datosController, "profesor");
          //Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta["email"] == $email && $respuesta["password"] == $_POST["password"]){
            if(isset($_GET["idBorrar"])){
              $datosController = $_GET["idBorrar"];
              $respuestas = Datos::borrarTutoriaGM($datosController, "grupal_Tutorias");
              $respuesta = Datos::borrarDatosM($datosController, "tutorias");
              
              if($respuesta == "success"){
                echo'<script> window.location.replace("index.php?action=Tutorias"); </script>';
                #header("location:index.php?action=Tutores");
             }
  		     }
         }
       }
    }
    
    #Se envia la informacion al modelo para hacer la actualizacion en la base de datos en la fila correspondiente
    public function actualizarTutoriasC(){
      if(isset($_POST["id"])){
        $datosController = $_POST["id"];
        $respuestas = Datos::borrarTutoriaGM($datosController, "grupal_Tutorias");
        #Se declara una variable que sea nuella para enviarla como id,
          #por que el id en la base de datos es auto-incrementable
          date_default_timezone_set("America/Mexico_City");
          $fecha= date("Y-m-d");
          $hora=date("h:i:s A");
          $id_alumno=$_POST["id_alumno"];
          #Recibe a traves del método POST el nombre de la nueva carrera
          $datosController = array( "id"=>$_POST["id"],
                                   "id_maestro"=>$_POST["id_maestro"],
                                   "fecha"=>$fecha,
                                   "hora"=>$hora,
                                   "tipo"=>$_POST["tipo"],
                                   "tema"=>$_POST["tema"],
                                   "id_alumno"=>$id_alumno[0]);
            //Se le dice al modelo models/crud.php (Datos::registroUsua
        $respuesta = Datos::actualizarTutoriasM($datosController, "tutorias");

        $count=count($id_alumno) -1;
        if($count>0){
           #Se insertan los demas alumnos en la tabla grupal_Tutorias
          $datosController = $_POST["id"];
        $respuestas = Datos::borrarTutoriaGM($datosController, "grupal_Tutorias");
          for ($i=1;$i<=$count;$i++){
            $id=NULL;
             $datosController = array( "id"=>$id,
                                      "id_alumno"=>$id_alumno[$i],
                                      "id_tutoria"=>$_POST["id"]);                                  
              $respuesta2 = Datos::registroTutoriasGM($datosController, "grupal_Tutorias");
           } 
          }

        if($respuesta == "success"){
          echo'<script> window.location.replace("index.php?action=Tutorias"); </script>';
            #header("location:index.php?action=Tutores");
          }
          else{
            echo '<script> alert("ERROR") </script>';
            #header("location:index.php?action=Alumnos");
          }
      }

	}

     #La informacion de un Carrera se agrega a un formulario para poder ser editado
    public function editarTutoriasC(){
      $datosController = $_GET["id"];
      $tutorias = Datos::InfoModel($datosController, "tutorias");
      $alumnos = Datos::VistaDatosModel("alumnos");

      #Muestra el nombre del alumno
      echo'<div class="form-group">
            <input type="hidden" class="form-control" name="id" required value="'.$tutorias["id"].'">
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control" name="tipo" required value="'.$tutorias["tipo"].'">
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control" name="id_maestro" required value="'.$tutorias["id_maestro"].'">
          </div>
            <div class="form-group">
          <label>Alumno</label>
          <select class="form-control select2" multiple="multiple" style="width: 100%;" name="id_alumno[]" required>';
            if($tutorias["tipo"]=="Individual") {
            foreach($alumnos as $row => $item){
               $selected=NULL;
                if($item["matricula"]==$tutorias["id_alumno"]){
                   $selected="selected";
                }
               if($item["tutor"] == $_SESSION["id"]){
                  echo' <option '.$selected.' value="'.$item["matricula"].'"> '.$item["nombre"].' '.$item["apellido"].' </option>';
               }
             }
            }
       if($tutorias["tipo"]=="Grupal") {
            foreach($alumnos as $row => $item){
               $selected=NULL;
              $pila = array();
               $respuestas = Datos::VistaDatosModel("grupal_Tutorias"); 
             foreach($respuestas as $rows => $items){
              if($items["id_tutoria"] == $tutorias["id"]){
               $datosController=$items["id_alumno"];
              $alum = Datos::InfoAlumnoM($datosController, "alumnos");
              array_push($pila, $alum["matricula"]);
              }
             }
              for ($i=0;$i<count($pila);$i++){
              if($item["matricula"]==$pila[$i]){
                   $selected="selected";
                }
              }
                if($item["matricula"]==$tutorias["id_alumno"]){
                   $selected="selected";
                }
               if($item["tutor"] == $_SESSION["id"]){
                  echo' <option '.$selected.' value="'.$item["matricula"].'"> '.$item["nombre"].' '.$item["apellido"].' </option>';
               }
             }
            }
      
          echo'</select>
              </div>
            <!-- /.box-header -->
            <div class="form-group">             
                <textarea class="textarea"  name="tema" 
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                          '.$tutorias["tema"].'
                 </textarea>
            </div>
                 <input type="submit" class="btn btn-success" name="submit" value="Actualizar">';
    }
    
    #------------------------------- S E S I O N E S ------------------------------------
    #Se visualizan todas las sesiones que han ingresado
    public function VistarHistorialC(){    
        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. 
        #foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo 
        #con una variable de un tipo diferente de datos o una variable no inicializada.
        $respuesta = Datos::VistaDatosModel("historal");  
        foreach($respuesta as $row => $item){
          $datosController=$item["usuario"];
          $maestro = Datos::InfoModel($datosController, "profesor");
          #Imprimimos los resultados 
          echo'<tr>
              <td>'.$item["id"].'</td>
               <td>'.$maestro["nombre"].' '.$maestro["apellido"].'</td>
               <td>'.$item["fecha"].'</td>
               <td>'.$item["hora"].'</td>
            </tr>';
      } 
 

     
      }
    
    #Se logea el usuario
    public function ingresoUsuarioController(){
   #echo '<script> alert(1) </script>';
		if(isset($_POST["email"])){
			$datosController = array( "email"=>$_POST["email"],
								      "password"=>$_POST["password"]);
    #echo '<script> alert(3) </script>';
			$respuesta = Datos::ingresoUsuarioModel($datosController, "profesor");
   #echo "<script> alert(2) </script>";
			//Valiación de la respuesta del modelo para ver si es un usuario correcto.
			if($respuesta["email"] == $_POST["email"] && $respuesta["password"] == $_POST["password"]){
				session_start();
				$_SESSION["validar"] = true;
				$_SESSION["id"] = $respuesta["id"];
        $_SESSION["nombre"] = $respuesta["nombre"];
        $_SESSION["apellido"] = $respuesta["apellido"];
        $_SESSION["email"] = $respuesta["email"];
        $_SESSION["tipo"] = $respuesta["tipo"];
        $_SESSION["imagen"] = $respuesta["imagen"];
        
        date_default_timezone_set("America/Mexico_City");
        $fecha= date("Y-m-d");
        $hora=date("h:i:s A");
        $datosController = array( "usuario"=> $respuesta["id"],
								                  "fecha"=>$fecha,
                                  "hora"=>$hora);
  			$respuesta2 = Datos::registrohistorialM($datosController, "historal");
        
        echo'<script> window.location.replace("index.php?action=dashboard"); </script>';
			}
			else{
				echo'<script> alert("ERROR")</script>';
			}
		}
	}
}

?>