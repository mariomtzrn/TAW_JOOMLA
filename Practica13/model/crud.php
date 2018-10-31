<?php
require_once "conexion.php";
class Datos extends Conexion { 
  #-------------------------------- G E N E R A L E S ------------------------------------------------
  #/Se trae la informacion de todos los usuarios
  public function VistaDatosModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
		return $stmt->fetchAll();
		$stmt->close();
	}
  
  #Trae la informacion de un tutor en especifico
  public function InfoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
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
  
  #------------------------------------- A L U M N O S ---------------------------------------------
  #Se envian los datos del alumno a la base de datos y si todo es correcto se guardan en esta
  public function registroJugadorM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, nombre, apellido, dorsal,  imagen)
		 VALUES (:id, :nombre, :apellido, :dorsal, :imagen)");	
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":dorsal", $datosModel["dorsal"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
    $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  
  #Realiza un update a la base da datos para modificar la información que contenia
  public function actualizarJugadorM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido = :apellido, dorsal= :dorsal, 
                                         imagen = :imagen  WHERE id = :id");
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":dorsal", $datosModel["dorsal"], PDO::PARAM_INT);
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
    $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  
  #---------------------------- C A R R E R A S ---------------------------------------------------
  #Se registra solamente el nombre de una carrera
  public function registroEquipoM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, nombre, tipo) VALUES (:id, :nombre, :tipo)");	
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_STR);
		if($stmt->execute()){
         return "success";
     }
        else{
          return "error";
          #echo '<script> alert("ERROR") </script>';
        }
		$stmt->close();
	}
  
  #Se buscan todaos los profesores que esten asignado a una carrera esto sirve para hacer contador.
  public function CountJugadorEquipo($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_equipo = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
  
  #Se realiza el update del nombre de una carrera 
  public function actualizarEquipoM ($datosModel, $tabla){
  $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre, tipo=:tipo WHERE id= :id");
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_STR);
    #Se vefifica si la ejecucion fue correcta o no y se retorna un resultado
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  
  #------------------------------- S E L E C C I O N ---------------------------------------------------
  #se inserta en la tabla de muchos a muchos para crear las tutorias grupales
  public function registroSeleccionM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, id_equipo, id_jugador) 
              VALUES (:id, :id_equipo, :id_jugador)");	
    $stmt->bindParam(":id_equipo", $datosModel["id_equipo"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_jugador", $datosModel["id_jugador"], PDO::PARAM_INT);
		if($stmt->execute()){
          return "success1";
     }
        else{
          return "error";
        }
		$stmt->close();
	}
  
  public function borrarSeleccionGM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_equipo = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  
  
  

}