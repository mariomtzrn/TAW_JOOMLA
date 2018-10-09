<?php
#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.
require_once "conexion.php";
//heredar la clase conexion de conexion.php para poder utilizar "Conexion" del archivo conexion.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del models/conexion.php:
class Datos extends Conexion {
  
  ///Se trae la informacion de todos los usuarios
  public function VistaAlumnosM($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
		return $stmt->fetchAll();
		$stmt->close();
	}
  public function registroAlumnosM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (matricula, nombre, apellido,  carrera, imagen)
		 VALUES (:matricula, :nombre, :apellido,  :carrera, :imagen)");	
		$stmt->bindParam(":matricula", $datosModel["matricula"], PDO::PARAM_INT);
		$stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
    $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_LOB);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  
  
  //Trae la informacion del alumno que se va a editar
  public function editarAlumnoM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE matricula = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
  
  //Realiza un update a la base da datos para modificar la información que contenia
  public function actualizarAlumnoM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, carrera = :carrera, apellido = :apellido WHERE matricula = :matricula");
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":matricula", $datosModel["matricula"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  public function borrarAlumnoM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE matricula = :id");
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
/*
  #Se crea la conexion a la base de datos y valida que el usuario exista
  public function ingresoUsuarioModel($datosModel, $tabla){
    #echo "<script> alert(2) </script>";
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = :email AND password = :password");
    $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);

    if ($stmt->execute()) {
      #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
      return $stmt->fetch();
    }
    $stmt->close();
  }
*/
?>
