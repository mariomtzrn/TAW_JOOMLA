<?php
require_once "conexion.php";
class Datos extends Conexion { 
 #------------------------------------ S E S I O N E S ---------------------------------------------------
 #Se crea la conexion a la base de datos y valida que el usuario exista
  public function ingresoUsuarioModel($datosModel, $tabla){
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuario = :usuario AND password = :password");
    $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);

    if ($stmt->execute()) {
      #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
      return $stmt->fetch();
    }
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
   #-------------------------------- G E N E R A L E S ------------------------------------------------
  	public function VistaDatosM($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}
    #Trae las visitas de un usuario
    public function VisitasTablaM($id, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}
  
  public function actContrasenaM($datosModel, $tabla){
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET password = :password WHERE id = :id_usuario");
    $stmt->bindParam(":id_usuario", $datosModel["id_usuario"], PDO::PARAM_INT);
    $stmt->bindParam(":password", $datosModel["nueva"], PDO::PARAM_STR);
    if ($stmt->execute()){
      return 1;
    } else {
      return 0;
    }
    $stmt->close();
  }
  
 #------------------------------- A D M I N I S T R A D O R ------------------------------------
            #---------------------------- U S U A R I O S ----------------------#
  public function registroUsuarioM($datosModel, $tabla){
		//prepara la conexion a la base de datos y prepara ls entencia SQL 
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, nombre, apellido, usuario, email, password, tipo, fecha, imagen)
		 VALUES (:id,:nombre,:apellido, :usuario,:email, :password, :tipo,  :fecha, :imagen)");	
		//Inserta los valores del array en las varaibles que se utlizan para hacer la inserccion y se ejecuta la
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();

    }
   #--------------------------------------H O R A R I O S-----------------------------------
    public function registroHorariosM($datosModel, $tabla){
		//prepara la conexion a la base de datos y prepara ls entencia SQL 
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, dia, hora_abrir, hora_cerrar )
		 VALUES (:id,:dia,:hora_abrir, :hora_cerrar )");	
		//Inserta los valores del array en las varaibles que se utlizan para hacer la inserccion y se ejecuta la
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":dia", $datosModel["dia"], PDO::PARAM_STR);
		$stmt->bindParam(":hora_abrir", $datosModel["hora_abrir"]);
    $stmt->bindParam(":hora_cerrar", $datosModel["hora_cerrar"]);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();

    }
     #--------------------------------------H O R A R I O S-----------------------------------
    public function registroVisitaM($datosModel, $tabla){
		//prepara la conexion a la base de datos y prepara ls entencia SQL 
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, id_usuario, fecha, hora, dia )
		 VALUES (:id, :id_usuario, :fecha, :hora, :dia)");	
		//Inserta los valores del array en las varaibles que se utlizan para hacer la inserccion y se ejecuta la
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
    $stmt->bindParam(":id_usuario", $datosModel["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":dia", $datosModel["dia"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datosModel["fecha"]);
    $stmt->bindParam(":hora", $datosModel["hora"]);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();

    }
}
?>
  