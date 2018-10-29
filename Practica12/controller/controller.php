<?php
 class mvc_controller {
   
    //Llama a la plantilla
   public function plantilla(){
        //Include se utiliza para invocar el archivo que contiene el codigo html
        include('views/template.php');
    }
   public function enlacesPaginasC(){
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
        $respuesta = EnlacesPagina::enlacesPaginasM($enlacesController);
        include($respuesta);
    }
   #Se logea el usuario
  public function ingresoUsuarioC(){
   #echo '<script> alert(1) </script>';
		if(isset($_POST["usuario"])){
			$datosController = array( "usuario"=>$_POST["usuario"],
								      "password"=>$_POST["password"]);
      #$a=print_r($datosController);
      #echo '<script> alert($a) </script>';
			$respuesta = Datos::ingresoUsuarioM($datosController, "usuarios");
   #echo "<script> alert(2) </script>";
			//Valiación de la respuesta del modelo para ver si es un usuario correcto.
			if($respuesta["usuario"] == $_POST["usuario"] && $respuesta["password"] == $_POST["password"]){
				session_start();
				$_SESSION["validar"] = true;
				$_SESSION["id"] = $respuesta["id"];
        $_SESSION["nombre"] = $respuesta["nombre"];
        $_SESSION["apellido"] = $respuesta["apellido"];
        $_SESSION["email"] = $respuesta["email"];
        $_SESSION["usuario"] = $respuesta["usuario"];
        $_SESSION["imagen"] = $respuesta["imagen"];
        
       /** date_default_timezone_set("America/Mexico_City");
        $fecha= date("Y-m-d");
        $hora=date("h:i:s A");
        $datosController = array( "usuario"=> $respuesta["id"],
								                  "fecha"=>$fecha,
                                  "hora"=>$hora);
  			$respuesta2 = Datos::registrohistorialM($datosController, "historal");*/
        
        echo'<script> window.location.replace("index.php?action=Inventario"); </script>';
			}
			else{
				echo'<script> alert("ERROR")</script>';
			}
		}
	}
   
   public function SelectC($tabla){
    $respuesta = Datos::VistaDatosM($tabla);
    foreach($respuesta as $row => $item) { 
			echo '
				<option value='.$item["id"].'> '.$item["nombre"].' </option>';
			}
  }
   public function PerfilC($Tabla){
     $datosController = $_GET["id"];
		  $respuesta = Datos::InfoDatosM($datosController, $Tabla);
     return $respuesta;
   }
     
   
  #-------------------------------- C A T E G O R I A S ------------------------------------------------
   public function registroCategoriaC(){
		if(isset($_POST["nombre"])){
      date_default_timezone_set("America/Mexico_City");
			$id=NULL;
			$fecha= date("Y-m-d");
			$datosController = array( "id"=>$id,
								      "descripcion"=>$_POST["descripcion"],
								      "nombre"=>$_POST["nombre"],
									  "fecha"=>$fecha);
      #Se llama al modelo y se envian los datos del formulario y se envia el nombre de la tabla
			$respuesta = Datos::registroCategoriaM($datosController, "categorias");
      if($respuesta == "success"){
               echo'<script> window.location.replace("index.php?action=Categorias"); </script>';
       }else{
          echo'<script> alert("ERROR") </script>';
       }
			
		}
	}
   public function vistaCategoriaC(){
		$respuesta = Datos::VistaDatosM("categorias");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
		echo'<tr>
        <td>'.$item["id"].'</td>
				<td>'.$item["nombre"].'</td>
				<td>'.$item["descripcion"].'</td>
				<td>'.$item["fecha"].'</td>
				<td><a href="index.php?action=Editar&id='.$item["id"].'&select=Categoria"><button type="button" class="btn btn-success">
        <i class="icofont icofont-ui-edit"></i></button></a></td>
				<td><a href="index.php?action=Eliminar&idBorrar='.$item["id"].'&select=Categoria"><button type="button" class="btn btn-inverse">
        <i class="icofont icofont-delete-alt"></i></button></a></td>
			</tr>';
		}
	}
   public function editarCategoriaC(){
		$datosController = $_GET["id"];
		$respuesta = Datos::InfoDatosM($datosController, "categorias");
		echo'<input type="hidden" value="'.$respuesta["id"].'" name="id">
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nombre</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" value="'.$respuesta["nombre"].'" name="nombre" id="nombre" required placeholder="Nombre">

              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Descripción</label>
              <div class="col-sm-10">
                 <textarea class="textarea" required placeholder="Place some text here" name="descripcion"
                           style="width: 100%; height: 100px; font-size: 14px; line-height: 
                            18px; border: 1px solid #dddddd; padding: 10px;">'.$respuesta["descripcion"].' </textarea>
              </div>
          </div>
          <input type="hidden" value="'.$respuesta["fecha"].'" name="fecha">';
	  }
   public function actualizarCategoriaC(){
		if(isset($_POST["id"])){
			$datosController =  array( "id"=>$_POST["id"],
                                  "descripcion"=>$_POST["descripcion"],
                                  "nombre"=>$_POST["nombre"],
                                   "fecha"=>$_POST["fecha"]);
			
			$respuesta = Datos::actualizarCategoriaM($datosController, "categorias");
			if($respuesta == "success"){
				echo'<script> window.location.replace("index.php?action=Categorias"); </script>';
			}
			else{
				echo'<script> alert("ERROR") </script>';
			}
		}
	
	}
   public function borrarCategoriaC(){
  		 if(isset($_POST["password"])){
        $email=$_SESSION["usuario"];
        $datosController = array( "usuario"=>$email,
                        "password"=>$_POST["password"]);
          $respuesta = Datos::ingresoUsuarioM($datosController, "usuarios");
          #Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta["usuario"] == $email && $respuesta["password"] == $_POST["password"]){
              $respuesta = Datos::borrarDatosM($datosController, "categorias");
              if($respuesta == "success"){
                 echo'<script> window.location.replace("index.php?action=Categorias"); </script>';
             }
  		     }
         }
       }
   
   #-------------------------------- U S U A R I O S ------------------------------------------------
   public function registroUsuarioC(){
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
			$datosController = array( "id"=>$id,
                                "apellido"=>$_POST["apellido"],
                                "nombre"=>$_POST["nombre"],
                                "email"=>$_POST["email"],
                                "password"=>$_POST["password"],
                                "fecha"=>$fecha,
                                "imagen"=>$imagen,
									              "usuario"=>$_POST["usuario"]);
			//Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos",
			$respuesta = Datos::registroUsuarioM($datosController, "usuarios");
			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo'<script> window.location.replace("index.php?action=User"); </script>';
			}
			else{
				echo'<script> alert("ERROR") </script>';
			}
		}
	}
	 public function vistaUsuariosC(){
		$respuesta = Datos::VistaDatosM("usuarios");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
		echo'<tr>
        <td>'.$item["id"].'</td>
				<td>'.$item["nombre"].'  '.$item["apellido"].'</td>
				<td>'.$item["usuario"].'</td>
				<td>'.$item["email"].'</td>
        <td>'.$item["fecha"].'</td>
        <td><a href="index.php?action=Editar&id='.$item["id"].'&select=Usuario"><button type="button" class="btn btn-success">
        <i class="icofont icofont-ui-edit"></i></button></a></td>';
        if($_SESSION["id"]==$item["id"]){
          echo'
				<td><a href="#" disabled ><button disabled type="button" class="btn btn-inverse">
        <i class="icofont icofont-delete-alt"></i></button></a></td>';
        }else{if($_SESSION["id"]!=$item["id"]){
        echo'
				<td><a href="index.php?action=Eliminar&idBorrar='.$item["id"].'&select=Usuario"><button type="button" class="btn btn-inverse">
        <i class="icofont icofont-delete-alt"></i></button></a></td>';
        }}
      echo'<td><a href="index.php?action=Perfil&id='.$item["id"].'&select=Usuario"><button type="button" class="btn btn-primary">
        <i class="icofont icofont-eye"></i></button></a></td>
        
			</tr>';
		}
		}
   public function editarUsuarioC(){
	  	$datosController = $_GET["id"];
		  $respuesta = Datos::InfoDatosM($datosController, "usuarios");
		  echo'<input type="hidden" value="'.$respuesta["id"].'" name="id">
          <input type="hidden" value="'.$respuesta["fecha"].'" name="fecha">   
           <input type="hidden" value="'.$respuesta["imagen"].'" name="imagenV">
           <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  value="'.$respuesta["nombre"].'" name="nombre" id="nombre" required placeholder="Nombre">

                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Apellido</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="apellido" value="'.$respuesta["apellido"].'" id="apellido" required placeholder="Apellido">

                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Usuario</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="usuario" id="usuario" value="'.$respuesta["usuario"].'" required placeholder="Usuario">

                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" id="email" required placeholder="Email" value="'.$respuesta["email"].'">

                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="password" value="'.$respuesta["password"].'" required placeholder="Contraseña">

                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Imagen</label>
                   <div class="col-sm-10">
                     
                      <input type="file" class="form-control" name="imagen" accept="image/jpeg, image/png">
                     </div>
                  </div>';
	}
   public function actualizarUsuarioC(){
		if(isset($_POST["id"])){
       if(!empty($_FILES["imagen"]["name"])){
                $datosController = $_POST["id"];
                $carpeta = Datos::InfoDatosM($datosController, "usuarios");
                $ruta=$carpeta["imagen"];
                if($ruta != "views/ImagenUser/no-imagen.jpg"){
                  unlink($ruta);
                }
                $name = $_FILES["imagen"]["name"];
                $tmp = $_FILES["imagen"]["tmp_name"];
                $date = getdate();
           move_uploaded_file($tmp, "views/ImagenUser/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name);
          $imagen="views/ImagenUser/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name;
       }else{
          $imagen = $_POST["imagenV"];
         }
			$datosController =  array( "id"=>$_POST["id"],
                      "imagen"=>$imagen,
								      "apellido"=>$_POST["apellido"],
								      "nombre"=>$_POST["nombre"],
								  	  "email"=>$_POST["email"],
								      "password"=>$_POST["password"],
                      "usuario"=>$_POST["usuario"],
									  "fecha"=>$_POST["fecha"]);
     
			$respuesta = Datos::actualizarUsuarioM($datosController, "usuarios");
			if($respuesta == "success"){
				echo'<script> window.location.replace("index.php?action=User"); </script>';
			}
			else{
				echo'<script> alert("ERROR") </script>';
			}
		}
	
	}
   public function borrarUsuarioC(){
  		 if(isset($_POST["password"])){
        $email=$_SESSION["usuario"];
        $datosController = array( "usuario"=>$email,
                        "password"=>$_POST["password"]);
          $respuesta = Datos::ingresoUsuarioM($datosController, "usuarios");
          #Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta["usuario"] == $email && $respuesta["password"] == $_POST["password"]){
               $datosController = $_GET["idBorrar"];           
                $carpeta = Datos::InfoDatosM($datosController, "usuarios");
                $ruta=$carpeta["imagen"];
                if($ruta != "views/ImagenUser/no-imagen.jpg"){
                  unlink($ruta);
                }
              $respuesta = Datos::borrarDatosM($datosController, "usuarios");
              if($respuesta == "success"){
                 echo'<script> window.location.replace("index.php?action=User"); </script>';
             }
  		     }
         }
       }

  
  #-------------------------------- P R O D U C T O S ------------------------------------------------
  public function registroProductoC(){
		if(isset($_POST["nombre"])){
      date_default_timezone_set("America/Mexico_City");
      #Se valida que se haya enviado una imagen en caso de ser asi, 
      #se guarda en una carpeta y se copia la direccion y esta es guardada en la base de datos
       if(!empty($_FILES["imagen"]["name"])){
              $name = $_FILES["imagen"]["name"];
              $tmp = $_FILES["imagen"]["tmp_name"];
              $date = getdate();
          move_uploaded_file($tmp, "views/ImagenProducto/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name);
          $imagen="views/ImagenProducto/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name;
       }else{
         #En caso de no cargar una imagen se usara una predeterminada
          $imagen= "views/ImagenProducto/stock.png";
       }
      
			$id=NULL;
			$fecha= date("Y-m-d");
      #Los datos del formulario se agregan a un array
			$datosController = array( "id"=>$id,
								      "precio"=>$_POST["precio"],
								      "nombre"=>$_POST["nombre"],
								      "stock"=>$_POST["stock"],
								      "categoria"=>$_POST["categoria"],
								      "codigo"=>$_POST["codigo"],
									  "fecha"=>$fecha,
									  "imagen"=>$imagen);
      
			#Se envian los datos al modelos
      $respuesta = Datos::registroProductosM($datosController, "productos");
			#Se retorna un resultado y este se muestra
      if($respuesta == "success"){
				echo'<script> window.location.replace("index.php?action=Inventario"); </script>';
			}
			else{
				echo'<script> alert("ERROR") </script>';
			}
			
		}
	}
  public function vistaProductoC(){
    $respuesta = Datos::VistaDatosM("productos");
    foreach($respuesta as $row => $item){
    $datosController = $item["categoria"];
		$categoria = Datos::InfoDatosM($datosController, "categorias");
    echo'<div class="col-xl-4 col-md-6 col-sm-6 col-xs-12">
          <div class="card prod-view">
              <div class="prod-item text-center">
                  <div class="prod-img">
                      <a  href="index.php?action=Producto&id='.$item["id"].'" class="hvr-shrink">
                          <img src="'.$item["imagen"].'" width="150px" height="150px" class="img-fluid o-hidden" alt="prod1.jpg">
                      </a>
                  </div>
                  <div class="prod-info">
                      <a href="#!" class="txt-muted"><h4>'.$item["nombre"].'</h4></a>
                      <div class="m-b-10">
                          <a class="text-muted f-w-600">categoria: '.$categoria["nombre"].' &amp; '.$item["stock"].' Stock</a>
                      </div>
                      <span class="prod-price"><i class="icofont icofont-cur-dollar"></i>'.$item["precio"].'</span>
                  </div>
              </div>
          </div>
      </div>';
    }
  }
  public function editarProductoC(){
	  	$datosController = $_GET["id"];
		  $respuesta = Datos::InfoDatosM($datosController, "productos");
    $datosController = $respuesta["categoria"];
     $categoria = Datos::InfoDatosM($datosController, "categorias");
		  echo'<input type="hidden" value="'.$respuesta["id"].'" name="id">
          <input type="hidden" value="'.$respuesta["fecha"].'" name="fecha">   
           <input type="hidden" value="'.$respuesta["imagen"].'" name="imagenV">
            <input type="hidden" name="stock"  value="'.$respuesta["stock"].'" >

            <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Codigo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="codigo" id="codigo" required value="'.$respuesta["codigo"].'" placeholder="Codigo">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nombre" id="nombre" value="'.$respuesta["nombre"].'" required placeholder="Nombre">

                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Categoria</label>
                        <div class="col-sm-10">

                      <select class="form-control select2" required name="categoria">
                        <option value="'.$respuesta["categoria"].'">'.$categoria["nombre"].'</option>';
                        
                         $respuestas = Datos::VistaDatosM("categorias");
                        foreach($respuestas as $row => $item) { 
                          echo '
                            <option value='.$item["id"].'> '.$item["nombre"].' </option>';
                          }
                           
                      echo '</select>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Precio</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="precio" id="precio" value="'.$respuesta["precio"].'" required placeholder="Precio">

                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Imagen</label>
                       <div class="col-sm-10">
                          <input type="file" class="form-control" name="imagen" accept="image/jpeg, image/png">
                         </div>
                      </div>';
	}
  public function actualizarProductoC(){
		if(isset($_POST["id"])){
      if(!empty($_FILES["imagen"]["name"])){
                $datosController = $_POST["id"];
                $carpeta = Datos::InfoDatosM($datosController, "productos");
                $ruta=$carpeta["imagen"];
                if($ruta != "views/ImagenProducto/stock.png"){
                  unlink($ruta);
                }
                $name = $_FILES["imagen"]["name"];
                $tmp = $_FILES["imagen"]["tmp_name"];
                $date = getdate();
           move_uploaded_file($tmp, "views/ImagenProducto/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name);
          $imagen="views/ImagenProducto/".$date["mday"].$date["mon"].$date["year"].$date["hours"].$date["minutes"].$date["seconds"].$name;
       }else{
          $imagen = $_POST["imagenV"];
         }
			$datosController = array( "id"=>$_POST["id"],
								      "precio"=>$_POST["precio"],
								      "nombre"=>$_POST["nombre"],
								      "stock"=>$_POST["stock"],
								      "categoria"=>$_POST["categoria"],
								      "codigo"=>$_POST["codigo"],
                      "imagen"=>$imagen,
									  "fecha"=>$_POST["fecha"]);
			$a=print_r($datosController);
      echo'<script> alert($a) </script>';
			$respuesta = Datos::actualizarProductoM($datosController, "productos");
			if($respuesta == "success"){
				echo'<script> window.location.replace("index.php?action=Inventario"); </script>';
			}
			else{
				echo'<script> alert("ERROR") </script>';
			}
		}
  }
  public function borrarProductoC(){
  		 if(isset($_POST["password"])){
        $email=$_SESSION["usuario"];
        $datosController = array( "usuario"=>$email,
                        "password"=>$_POST["password"]);
          $respuesta = Datos::ingresoUsuarioM($datosController, "usuarios");
          #Valiación de la respuesta del modelo para ver si es un usuario correcto.
          if($respuesta["usuario"] == $email && $respuesta["password"] == $_POST["password"]){
              $datosController = $_GET["idBorrar"];
              $carpeta = Datos::InfoDatosM($datosController, "productos");
              $ruta=$carpeta["imagen"];
              if($ruta != "views/ImagenProducto/stock.png"){
                 unlink($ruta);
                }
            
              $respuesta = Datos::borrarDatosM($datosController, "productos");
              if($respuesta == "success"){
                 echo'<script> window.location.replace("index.php?action=Inventario"); </script>';
             }
  		     }
         }
       }
  
  #-------------------------------- H I S T O R I A L ------------------------------------------------
  public function vistaHistorailC(){
   $respuesta = Datos::VistaDatosM("historial");
    foreach($respuesta as $row => $item){
      if($item["producto"]==$_GET["id"]){
        $datosController = $item["usuario"];
		    $usuario = Datos::InfoDatosM($datosController, "usuarios");
        echo'<tr>
            <td>'.$item["fecha"].'</td>
            <td>'.$item["hora"].' </td>
            <td>El usuario '.$item ["usuario"].' '.$item["tipo"].' '.$item["cantidad"].' producto(s) al inventario</td>
            <td>'.$item["referencia"].'</td>
            <td>'.$item["cantidad"].'</td>
          </tr>';
      }
    }
  }
  public function registroHistoralAC(){
		if(isset($_POST["cantidadA"])){
      date_default_timezone_set("America/Mexico_City");
			$id=NULL;
			$fecha= date("Y-m-d");
      $hora=date("h:i:s A");
      $tipo="agregó";
			$datosController = array( "id"=>$id,
								                "cantidad"=>$_POST["cantidadA"],
                                "referencia"=>$_POST["referencia"],
                                "hora"=>$hora,
                               "tipo"=>$tipo,
                               "producto"=>$_GET["id"],
                                "usuario"=>$_SESSION["usuario"],
                                "fecha"=>$fecha);

      #Se llama al modelo y se envian los datos del formulario y se envia el nombre de la tabla
			$respuesta = Datos::registroHistoralM($datosController, "historial");
      $datosController = $_GET["id"];
		  $respuesta1 = Datos::InfoDatosM($datosController, "productos");
      $c1=$respuesta1["stock"];
      $c2=$_POST["cantidadA"];
      $cantidad=$c1+$c2;
      
      $datosController = array( "id"=>$_GET["id"],
								                "stock"=>$cantidad);
      $respuestas = Datos::actualizarStockM($datosController, "productos");
      
      if($respuesta == "success" and $respuestas == "success" ){
                echo'<script>window.location.replace("index.php?action=Inventario"); </script>';
       }else{
          echo'<script> alert("ERROR") </script>';
       }
			
		}
	}
  public function registroHistoralEC(){
		if(isset($_POST["cantidadE"])){
      $datosController = $_GET["id"];
		  $respuesta1 = Datos::InfoDatosM($datosController, "productos");
      $c1=$respuesta1["stock"];
      $c2=$_POST["cantidadE"];
      $cantidad=$c1-$c2;
      if($cantidad==0 or $cantidad>0){
      $datosController = array( "id"=>$_GET["id"],
								                "stock"=>$cantidad);
      $respuestas = Datos::actualizarStockM($datosController, "productos");
      date_default_timezone_set("America/Mexico_City");
			$id=NULL;
			$fecha= date("Y-m-d");
      $hora=date("h:i:s A");
      $tipo="eliminó";
			$datosController = array( "id"=>$id,
								                "cantidad"=>$_POST["cantidadE"],
                                "referencia"=>$_POST["referencia"],
                                "hora"=>$hora,
                               "tipo"=>$tipo,
                               "producto"=>$_GET["id"],
                                "usuario"=>$_SESSION["usuario"],
                                "fecha"=>$fecha);
      #Se llama al modelo y se envian los datos del formulario y se envia el nombre de la tabla
			$respuesta = Datos::registroHistoralM($datosController, "historial");     
      if($respuesta == "success" and $respuestas == "success" ){
        $id=$_GET["id"];    
        echo'<script>window.location.replace("index.php?action=Inventario"); </script>';
       }else{
          echo'<script> alert("ERROR") </script>';
       }
			
		}else{
        echo'<script> 
        var cantidad = <?php echo $cantidad ?>
        alert("No se pueden eliminar más de los existentes en stock") </script>';
      }
	}
 }
   
#Termina la clase controller    
}
?>