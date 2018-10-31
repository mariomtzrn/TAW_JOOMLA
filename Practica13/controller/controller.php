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
        $_SESSION["nombre"] = $respuesta["nombre"];
        $_SESSION["apellido"] = $respuesta["apellido"];
        $_SESSION["usuario"] = $respuesta["usuario"];
        $_SESSION["imagen"] = $respuesta["imagen"];
        echo'<script> window.location.replace("index.php?action=dashboard"); </script>';
			}
			else{
        #En caso de que sea falso se crea una ventana emergente que marca "error"
				echo'<script> alert("ERROR")</script>';
			}
		}
	}
    
    #--------------------------Generales------------------------------#
    #Se utiliza para poner en un select las opciones que existen
    public function OptionController(){
      $respuesta = Datos::VistaDatosModel("equipo");
       foreach($respuesta as $row => $item){
          echo' <option value="'.$item["id"].'"> '.$item["nombre"].' </option>';
       }
    }
    
    #Se utiliza para poner en un select las opciones que existen
    public function OptionController2(){
      $respuesta = Datos::VistaDatosModel("jugador");
       foreach($respuesta as $row => $item){
           
            echo' <option value="'.$item["id"].'"> '.$item["nombre"].' '.$item["apellido"].' </option>';
         }
    }
    
    

    #----------------------------J U G A D O R E S ------------------------------#
    #Se visualiza los datos de los jugadores registr$usuarioados en la tablas 
    public function VistaJugadoresC(){
     # echo '<script> alert(1) </script>';
        $respuesta = Datos::VistaDatosModel("jugador");
        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        foreach($respuesta as $row => $item){
           echo'<tr>
            <td>'.$item["id"].'</td>
            <td>'.$item["nombre"].' '.$item["apellido"].'</td>
            <td>'.$item["dorsal"].'</td>
            <td><a class="fa fa-edit btn btn-info" href="index.php?action=Editar&id='.$item["id"].'&select=Jugador"></a></td>
            <td><a class="fa fa-trash btn btn-danger" href="index.php?action=Delete&idBorrar='.$item["id"].'&select=Jugador"></a></td>
            <td><a class="fa fa-eye btn btn-success" href="index.php?action=Perfil&id='.$item["id"].'"></a></td>
          </tr>';     
        }
    }
  
    #Se registra los datos del alumno
    public function registroJugadoresC(){
      if(isset($_POST["nombre"])){
        #Se valida que se haya enviado una imagen en caso de ser asi, 
        #se guarda en una carpeta y se copia la direccion y esta es guardada en la base de datos
        $id=NULL;
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
        /*Recibe a traves del método POST el name (html) se recive el formulario y
        se almacenan los datos en una variable de tipo array con sus respectivas propiedades */
        $datosController = array( "id"=>$id,
                                  "dorsal"=>$_POST["dorsal"], 
                                  "nombre"=>$_POST["nombre"],
                                  "imagen"=>$imagen,
                                  "apellido"=>$_POST["apellido"]);
         /*Se le dice al modelo models/crud.php que en la clase "Datos",
         la funcion "registroJugadorM" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla*/
        
        $respuesta = Datos::registroJugadorM($datosController, "jugador");
         //se imprime la respuesta en la vista 
        if($respuesta == "success"){
           echo'<script> window.location.replace("index.php?action=Jugador"); </script>';
        }
        else{
          echo '<script> alert("ERROR") </script>';
        }
      }
	  }
    
     #Se envia la informacion al modelo para hacer la actualizacion en la base de datos en la fila correspondiente
    public function actualizarJugadorC(){
		if(isset($_POST["id"])){
       if(!empty($_FILES["imagen"]["name"])){
                $datosController = $_POST["id"];
                $carpeta = Datos::InfoModel($datosController, "jugador");
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
      
			$datosController = array( "id"=>$_POST["id"], 
                                "nombre"=>$_POST["nombre"],
                                "dorsal"=>$_POST["dorsal"],
                                "imagen"=>$imagen,        
                                "apellido"=>$_POST["apellido"]);
			$respuesta = Datos::actualizarJugadorM($datosController, "jugador");
			if($respuesta == "success"){
          echo'<script> window.location.replace("index.php?action=Jugador"); </script>';
        #header("location:index.php?action=Alumnos");
        }
        else{
          echo '<script> alert("ERROR") </script>';
          #header("location:index.php?action=Alumnos");
        }
		}
	
	}
    
    #La informacion de un alumno se agrega a un formulario para poder ser editado
    public function editarJugadorC(){
      #Trae la informacion del alumno segun su matricula, esta se recupera de la URL
      $datosController = $_GET["id"];
      $respuesta = Datos::InfoModel($datosController, "jugador");
      echo'
       <div class="form-group">
          <input type="hidden" class="form-control" name="id" value="'.$respuesta["id"].'"  required>
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
          <label>Dorsal</label>
          <input type="number" class="form-control" name="dorsal"  value="'.$respuesta["dorsal"].'" required >
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Imagen</label>
          <input type="hidden" name="imagen" required value="'.$respuesta["imagen"].'" class="span10">
          <input type="file" id="exampleInputFile" name="imagen"  accept="image/jpeg, image/png">
        </div>
             <div class="form-group">
         <input type="submit" class="btn btn-success" name="submit" value="Registrar">
        </div>';
    }
   
    #Se muestra el perfil de un alumno seleccionado
    public function perfilAlumnoC (){
       #Trae la informacion del alumno segun su matricula, esta se recupera de la URL
      $datosController = $_GET["id"];
      $respuesta = Datos::InfoModel($datosController, "jugador");
      echo'
          <div class="col-md-4">
              <center>
              <img class=" img-responsive " src='.$respuesta["imagen"].' alt="User profile picture">
              </br>
               <a class="fa  fa-arrow-left btn btn-small btn-default" href="index.php?action=Jugador"></a>
              <a class="fa fa-edit btn btn-small btn-default"
              href="index.php?action=Editar&id='.$respuesta["id"].'&select=Jugador"></a>
              </center>
                </div>

             <div class="col-md-6">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <p class="fa fa-barcode"><b> ID: </b></p>
                    <a> '.$respuesta["id"].'</a>
                </li>
                <li class="list-group-item">
                  <p class="fa fa-user"><b> Nombre: </b></p>
                    <a> '.$respuesta["nombre"].'</a>
                </li>
                <li class="list-group-item">
                  <p class="fa fa-cube"><b> Apellido: </b> </p>
                    <a> '.$respuesta["apellido"].'</a>
                </li>
                <li class="list-group-item">
                  <p class="fa  fa-users"><b> Dorsal: </b> </p>
                    <a> '.$respuesta["dorsal"].'</a>
                </li>
              </ul>
                  </div>';
      
    }
    
    #Borra al alumno Seleccionada, primero se verifica que la contraseña sea la del administrador
    public function borrarJugadorC(){
  		 if(isset($_POST["password"])){
        $usuario=$_SESSION["usuario"];
        $datosController = array( "usuario"=>$usuario,
                        "password"=>$_POST["password"]);
          $respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
          //Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta["usuario"] == $usuario && $respuesta["password"] == $_POST["password"]){
            if(isset($_GET["idBorrar"])){
              $datosController = $_GET["idBorrar"];
               $carpeta = Datos::InfoModel($datosController, "jugador");
                $ruta=$carpeta["imagen"];
                  if($ruta != "views/ImagenesA/no-imagen.jpg"){
                  unlink($ruta);
                }
              $respuestas = Datos::borrarDatosM($datosController, "jugador");
              if($respuestas == "success"){
               echo'<script> window.location.replace("index.php?action=Jugador"); </script>';
             }
              else{
                echo'<script> alert("ERROR") </script>';
              }
  		     }
         }
       }
    }
    
    #-------------------------------- E Q U I P O ------------------------------------
    
    #Se registra los datos de un nuevo equipo
    public function registroEquipoC(){
      if(isset($_POST["nombre"])){
        #Se declara una variable que sea nuella para enviarla como id,
        #por que el id en la base de datos es auto-incrementable
        $id=NULL;
        #Recibe a traves del método POST el nombre de la nueva carrera
        $datosController = array( "id"=>$id,
                                 "tipo"=>$_POST["tipo"],
                                 "nombre"=>$_POST["nombre"]);
        #Se envian los datos al modelador 
        $respuesta = Datos::registroEquipoM($datosController, "equipo");
        #se imprime la respuesta en la vista 
        if($respuesta == "success"){
          echo'<script> window.location.replace("index.php?action=Equipo"); </script>';
        }
        else{
          echo '<script> alert("ERROR") </script>';
        }
      }
	  }
      #SSe visualizan todos los equipos, esto se visualiza a traves de una tabla
    public function VistaEquiposC(){
        $respuesta = Datos::VistaDatosModel("equipo");      
        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. 
        #foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo 
        #con una variable de un tipo diferente de datos o una variable no inicializada.
        foreach($respuesta as $row => $item){
          $datosController=$item["id"];
          $contador = Datos::CountJugadorEquipo($datosController, "rel_equipo_jugador");
          
          $count=0;
          foreach($contador as $rows => $items){
            $count= $cont + 1;
          }
          echo'<tr>
              <td>'.$item["id"].'</td>
              <td>'.$item["nombre"].'</td>
              <td>'.$item["tipo"].'</td>
               <td>'.$count.'</td>
              <td><a class="fa fa-edit btn btn-info" href="index.php?action=Editar&id='.$item["id"].'&select=Equipo">
              </a></td>
              <td><a class="fa fa-trash btn btn-danger" href="index.php?action=Delete&idBorrar='.$item["id"].'&select=Equipo">
              </a></td>
            </tr>';
      }
    }
    
     #La informacion de un equipo se agrega a un formulario para poder ser editado
    public function editarEquipoC(){
      $datosController = $_GET["id"];
      $equipo = Datos::InfoModel($datosController, "equipo");
      #Muestra el nombre del alumno
      echo'
          <div class="form-group">
                  <input type="hidden" class="form-control" name="id" required value="'.$equipo["id"].'">
                </div>
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" name="nombre" required value="'.$equipo["nombre"].'">
                </div>
                 <div class="form-group">
                <label>Categoria </label>
                <select class="form-control select2" style="width: 100%;" name="tipo" required>
                   <option value="'.$equipo["tipo"].'">'.$equipo["tipo"].'</option>
                   <option value="Soccer">Soccer</option>
                  <option value="Basquetbol ">Basquetbol</option>
                  <option value="Volibol ">Volibol</option>
                </select>
              </div>
                 <input type="submit" class="btn btn-success" name="submit" value="Actualizar">';
    }
    
    #Se envia la informacion al modelo para hacer la actualizacion en la base de datos en la fila correspondiente
    public function actualizarEquipoC(){
		if(isset($_POST["id"])){
			$datosController =array( "id"=>$_POST["id"],
                               "tipo"=>$_POST["tipo"],
                               "nombre"=>$_POST["nombre"]);
      #Se le dice al modelo models/crud.php que datos debe actualizar
			$respuesta = Datos::actualizarEquipoM($datosController, "equipo");
			if($respuesta == "success"){
         echo'<script> window.location.replace("index.php?action=Equipo"); </script>';
          #header("location:index.php?action=Tutores");
        }
        else{
          echo '<script> alert("ERROR") </script>';
          #header("location:index.php?action=Alumnos");
        }
		}
	
	}
    
    #Borra el equipo seleccionada, pero primero se verifica que la contraseña sea la del administrador
    public function borrarEquipoC(){
  		 if(isset($_POST["password"])){
        $usuario=$_SESSION["usuario"];
        $datosController = array( "usuario"=>$usuario,
                        "password"=>$_POST["password"]);
          $respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
          //Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta["usuario"] == $usuario && $respuesta["password"] == $_POST["password"]){
            if(isset($_GET["idBorrar"])){
              $datosController = $_GET["idBorrar"];
              $respuesta = Datos::borrarDatosM($datosController, "equipo");
              if($respuesta == "success"){
                echo'<script> window.location.replace("index.php?action=Equipo"); </script>';
                #header("location:index.php?action=Tutores");
             }
  		     }
         }
       }
    }

    #------------------------------ T U T O R I A S ------------------------------------
    public function VistarSeleccionC(){
        $respuesta = Datos::VistaDatosModel("rel_equipo_jugador");      
        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. 
        #foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo 
        #con una variable de un tipo diferente de datos o una variable no inicializada.
        foreach($respuesta as $row => $item){
          $datosController=$item["id_equipo"];
          $equipo = Datos::InfoModel($datosController, "equipo");
           $datosController=$item["id_jugador"];
          $jugador = Datos::InfoModel($datosController, "jugador");
          echo'<tr>
              <td>'.$item["id"].'</td>
              <td>'.$jugador["nombre"].' '.$jugador["apellido"].'</td>
               <td>'.$equipo["nombre"].'</td>
               <td>'.$equipo["tipo"].'</td>
              <td><a class="fa fa-edit btn btn-info" href="index.php?action=Editar&id='.$item["id"].'&select=Seleccion">
              </a></td>
              <td><a class="fa fa-trash btn btn-danger" href="index.php?action=Delete&idBorrar='.$item["id"].'&select=Seleccion">
              </a></td>
            </tr>';
           }     
      }
    #Se registra los datos de un nueva carrera, estos tambien son usuarios
    public function registroSeleccionC(){
      if(isset($_POST["jugador"])){
        #Se declara una variable que sea nuella para enviarla como id,
        #por que el id en la base de datos es auto-incrementable
         $id=NULL;
        $id_jugador=$_POST["jugador"];
        $count=count($id_jugador) -1;
         #Se insertan los jugadores segun el equipo seleccionado
        $bandera=FALSE;
         $respuesta = Datos::VistaDatosModel("rel_equipo_jugador"); 
        $a=print_r(count($respuesta));
         $count2=count($respuesta);
        
        for ($i=0;$i<=$count;$i++){  
          if($count2 == 0){
          $datosController = array( "id"=>$id,
                                    "id_jugador"=>$id_jugador[$i],
                                    "id_equipo"=>$_POST["equipo"]);
            $bandera=TRUE;
            $respuesta2 = Datos::registroSeleccionM($datosController, "rel_equipo_jugador");
        }
        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. 
        #foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo 
        #con una variable de un tipo diferente de datos o una variable no inicializada.
        /*foreach($respuesta as $row => $item){
          if($id_jugador[$i] != $item["id_jugador"] or $_POST["equipo"] != $item["id_equipo"] ){
           $datosController = array( "id"=>$id,
                                    "id_jugador"=>$id_jugador[$i],
                                    "id_equipo"=>$_POST["equipo"]);
            $bandera=TRUE;
            $respuesta2 = Datos::registroSeleccionM($datosController, "rel_equipo_jugador");
          }
         } */
        } 
        #se imprime la respuesta en la vista 
        if($bandera == TRUE){
          header("location:index.php?action=Tutorias");
        }
        else{
          echo '<script> alert($a) </script>';
        }
      }
	  }
    #Borra la carrera seleccionada, pero primero se verifica que la contraseña sea la del administrador
     public function borrarSeleccionC(){
  		 if(isset($_POST["password"])){
        $usuario=$_SESSION["usuario"];
        $datosController = array( "usuario"=>$usuario,
                        "password"=>$_POST["password"]);
          $respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
          //Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta["usuario"] == $usuario && $respuesta["password"] == $_POST["password"]){
            if(isset($_GET["idBorrar"])){
              $datosController = $_GET["idBorrar"];
              $respuesta = Datos::borrarDatosM($datosController, "rel_equipo_jugador");
              if($respuesta == "success"){
                echo'<script> window.location.replace("index.php?action=Seleccion"); </script>';
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
        $respuestas = Datos::borrarSeleccionGM($datosController, "rel_equipo_jugador");
        #Se declara una variable que sea nuella para enviarla como id,
          #por que el id en la base de datos es auto-incrementable
          $id=NULL;
        $id_jugador=$_POST["jugador"];
        $count=count($id_jugador) -1;
         #Se insertan los jugadores segun el equipo seleccionado
        $bandera=FALSE;
         $respuesta = Datos::VistaDatosModel("rel_equipo_jugador"); 
        $a=print_r(count($respuesta));
         $count2=count($respuesta);
        
        for ($i=0;$i<=$count;$i++){  
          if($count2 == 0){
          $datosController = array( "id"=>$id,
                                    "id_jugador"=>$id_jugador[$i],
                                    "id_equipo"=>$_POST["id_equipo"]);
            $bandera=TRUE;
            $respuesta2 = Datos::registroSeleccionM($datosController, "rel_equipo_jugador");
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

	}}

     #La informacion de un Carrera se agrega a un formulario para poder ser editado
    public function editarSeleccionC(){
      $datosController = $_GET["id"];
       $E_J = Datos::InfoModel($datosController,"rel_equipo_jugador");
      $datosController = $E_J["id_equipo"];
       $equipo = Datos::InfoModel($datosController,"equipo");
      $jugador = Datos::VistaDatosModel("jugador");

      #Muestra el nombre del alumno
      echo'<div class="form-group">
            <input type="hidden" class="form-control" name="id" required value="'.$E_J["id_equipo"].'">
          </div>
            <div class="form-group">
          <label>Jugadores</label>
          <select class="form-control select2" multiple="multiple" style="width: 100%;" name="id_jugador[]" required>';
            #Recore toda la lista de jugadores
            foreach($jugador as $row => $item){
              #se crea una variable select y se declara nula, en caso de que el jugador no este en el equipo 
              $selected=NULL;
              $pila = array();
               $respuestas = Datos::VistaDatosModel("rel_equipo_jugador"); 
              #Recorre toda la tabla de muchos a muchos para ver que alumnos se encuentran en el mismo equipo
             foreach($respuestas as $rows => $items){
               #Si el numero de quipo en la tabla (rel_equipo_jugador) es igual al del id que se envio por $_GET
              if($items["id_equipo"] == $E_J["id_equipo"]){
               $datosController=$items["id_jugador"];
                #Sebusca la informacion del alumno en el mismo equipo y su informacion se guarda en una array
              $alum = Datos::InfoModel($datosController, "jugador");
              array_push($pila, $alum["id"]);
              }
             }
              for ($i=0;$i<count($pila);$i++){
                #si el indice del jugador en el foreach externo se encuentra en el array 
              if($item["id"]==$pila[$i]){
                #se cambia la variable , para marcar al jugador que si se encuentra en equipo
                   $selected="selected";
                }
              }
              #Nos aseguramos que el jugador del que se envio el id este seleccionado
                if($item["id"]==$E_J["id_jugador"]){
                   $selected="selected";
                }
      
                  echo' <option '.$selected.' value="'.$item["id"].'"> '.$item["nombre"].' '.$item["apellido"].' </option>';  
                 }
            
      
          echo'</select>
              </div>
          <div class="form-group">
          <label>Equipo</label>
          <select class="form-control select2" style="width: 100%;" name="id_equipo" required>
           <option value="'.$E_J["id_equipo"].'"> '.$equipo["nombre"].' </option>';
           $respuesta = Datos::VistaDatosModel("equipo");
       foreach($respuesta as $row => $item){
          echo' <option value="'.$item["id"].'"> '.$item["nombre"].' </option>';
       }
           echo'</select>
              </div>
          
                 <input type="submit" class="btn btn-success" name="submit" value="Actualizar">';
    }
    


  }

?>