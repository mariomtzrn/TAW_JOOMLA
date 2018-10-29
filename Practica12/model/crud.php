<?php
require_once "conexion.php";
class Datos extends Conexion { 
  #-------------------------------- G E N E R A L E S ------------------------------------------------
  	public function VistaDatosM($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}
  public function InfoDatosM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
   public function borrarDatosM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  #-------------------------------- C A T E G O R I A S ------------------------------------------------
	#Este modelo registra las nuevas categorias 
	public function registroCategoriaM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, nombre, descripcion, fecha)
		 VALUES (:id,:nombre,:descripcion, :fecha)");	
    $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  public function actualizarCategoriaM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre	, descripcion= :descripcion, fecha=:fecha
			WHERE id = :id");
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  
  #-------------------------------- U S U A R I O S ------------------------------------------------
  public function registroUsuarioM($datosModel, $tabla){
		//prepara la conexion a la base de datos y prepara ls entencia SQL 
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, nombre, apellido, usuario,  email, password, fecha, imagen)
		 VALUES (:id,:nombre,:apellido, :usuario,:email, :password,  :fecha, :imagen)");	
		//Inserta los valores del array en las varaibles que se utlizan para hacer la inserccion y se ejecuta la
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();

    }
  public function actualizarUsuarioM($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido = :apellido, usuario = :usuario, 
                                                email = :email, password = :password, fecha = :fecha, imagen = :imagen  
                                                WHERE id = :id");
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
    $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  
   #-------------------------------- P R O D U C T O S ------------------------------------------------
  #Esta funcion registra nuevos productos 
	public function registroProductosM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id,codigo, nombre, categoria,  precio,  stock,  fecha, imagen)
		 VALUES (:id,:codigo, :nombre, :categoria, :precio, :stock, :fecha, :imagen)");	
		
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datosModel["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datosModel["precio"], PDO::PARAM_INT);
		$stmt->bindParam(":stock", $datosModel["stock"], PDO::PARAM_INT);
		$stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":categoria", $datosModel["categoria"], PDO::PARAM_INT);
		
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  public function actualizarProductoM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo=:codigo, nombre=:nombre,
    categoria=:categoria, precio=:precio, stock=:stock, fecha=:fecha, imagen=:imagen WHERE id=:id");
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datosModel["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
    $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datosModel["precio"], PDO::PARAM_INT);
		$stmt->bindParam(":stock", $datosModel["stock"], PDO::PARAM_INT);
		$stmt->bindParam(":categoria", $datosModel["categoria"], PDO::PARAM_INT);
		
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  public function actualizarStockM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  stock=:stock WHERE id=:id");
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":stock", $datosModel["stock"], PDO::PARAM_INT);
		
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  
   #-------------------------------- S E S I O N E S ------------------------------------------------
      #Se crea la conexion a la base de datos y valida que el usuario exista
  public function ingresoUsuarioM($datosModel, $tabla){
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuario = :usuario AND password = :password");
    $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);

    if ($stmt->execute()) {
      #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
      return $stmt->fetch();
    }
    $stmt->close();
  }
  
  
  #-------------------------------- H I S TO R I A L  ------------------------------------------------
  public function registroHistoralM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, producto, usuario, fecha, hora, referencia, cantidad, tipo) 
    VALUES  (:id, :producto, :usuario, :fecha, :hora, :referencia, :cantidad, :tipo)");	
		
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":producto", $datosModel["producto"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $datosModel["hora"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datosModel["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":referencia", $datosModel["referencia"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_STR);
		
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  public function InfoHistorialM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE producto = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);	
    $a=print_r($stmt);
    echo'<script> alert($a) </script>';
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
  
	}