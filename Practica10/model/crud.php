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
  
  #------------------------------------- A L U M N O S ---------------------------------------------
  #Se envian los datos del alumno a la base de datos y si todo es correcto se guardan en esta
  public function registroAlumnosM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (matricula, nombre, apellido, imagen,  carrera, tutor, sa)
		 VALUES (:matricula, :nombre, :apellido, :imagen, :carrera, :tutor, :sa)");	
    $stmt->bindParam(":sa", $datosModel["sa"], PDO::PARAM_STR);
		$stmt->bindParam(":matricula", $datosModel["matricula"], PDO::PARAM_INT);
		$stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
    $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
    $stmt->bindParam(":tutor", $datosModel["tutor"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  
  public function InfoAlumnoM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE matricula = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
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
  
   #Realiza un update a la base da datos para modificar la información que contenia
  public function actualizarAlumnoM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido = :apellido, imagen= :imagen, carrera = :carrera, 
                                          tutor = :tutor, sa = :sa  WHERE matricula = :matricula");
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":sa", $datosModel["sa"], PDO::PARAM_STR);
		$stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_INT);
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":matricula", $datosModel["matricula"], PDO::PARAM_INT);
    $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
    $stmt->bindParam(":tutor", $datosModel["tutor"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  
  
  #----------------------------- T  U T O R E S --------------------------------------------------
  #Se envian los datos del alumno a la base de datos y si todo es correcto se guardan en esta
  public function registroTutorM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, nombre, apellido,  imagen, email, password , tipo, titulo)
		 VALUES (:id, :nombre, :apellido, :imagen, :email, :password,  :tipo, :titulo)");	
    $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
    $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
    $stmt->bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_INT);
		if($stmt->execute()){
          header("location:index.php?action=Alumnos");
     }
        else{
          echo '<script> alert("ERROR") </script>';
          #header("location:index.php?action=Alumnos");
        }
		$stmt->close();
	}
  
  #Realiza un update a la base da datos para modificar la información que contenia
  public function actualizarTutorM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre, apellido=:apellido,
                                                          imagen=:imagen, email=:email, password=:password, tipo=:tipo, 
                                                          titulo=:titulo WHERE id= :id");
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
    $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
    $stmt->bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_INT);

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
  public function registroCarreraM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, nombre) VALUES (:id, :nombre)");	
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
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
  public function CounTutorCarreras($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE carrera = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
  
  #Se realiza el update del nombre de una carrera 
  public function actualizarCarreraM ($datosModel, $tabla){
  $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre WHERE id= :id");
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
    #Se vefifica si la ejecucion fue correcta o no y se retorna un resultado
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}
  
  
  #------------------------------ T U T O R I A S -----------------------------------------------------------------
  public function registroTutoriasM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, id_alumno, id_maestro, fecha, hora, tipo, tema) 
              VALUES (:id, :id_alumno, :id_maestro, :fecha, :hora, :tipo, :tema)");	
    $stmt->bindParam(":id_alumno", $datosModel["id_alumno"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_maestro", $datosModel["id_maestro"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $datosModel["hora"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_STR);
    $stmt->bindParam(":tema", $datosModel["tema"], PDO::PARAM_STR);
		if($stmt->execute()){
          return "success";
     }
        else{
          return "error";
        }
		$stmt->close();
	}
  #se inserta en la tabla de muchos a muchos para crear las tutorias grupales
  public function registroTutoriasGM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, id_alumno, id_tutoria) 
              VALUES (:id, :id_alumno, :id_tutoria)");	
    $stmt->bindParam(":id_alumno", $datosModel["id_alumno"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_tutoria", $datosModel["id_tutoria"], PDO::PARAM_INT);
		if($stmt->execute()){
          return "success1";
     }
        else{
          return "error";
        }
		$stmt->close();
	}
  
  public function borrarTutoriaGM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_tutoria = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}
		$stmt->close();
	}

  public function actualizarTutoriasM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_alumno = :id_alumno, id_maestro = :id_maestro, 
                                                             fecha = :fecha, hora = :hora, tipo = :tipo, tema =:tema WHERE id= :id");
    $stmt->bindParam(":id_alumno", $datosModel["id_alumno"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_maestro", $datosModel["id_maestro"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $datosModel["hora"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_STR);
    $stmt->bindParam(":tema", $datosModel["tema"], PDO::PARAM_STR);

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
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = :email AND password = :password");
    $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);

    if ($stmt->execute()) {
      #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
      return $stmt->fetch();
    }
    $stmt->close();
  }
  #se inserta en la tabla de muchos a muchos para crear las tutorias grupales
  public function registrohistorialM($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, usuario, fecha , hora) 
              VALUES (:id, :usuario, :fecha , :hora)");	
    $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
    $stmt->bindParam(":hora", $datosModel["hora"], PDO::PARAM_STR);
		if($stmt->execute()){
          return "success1";
     }
        else{
          return "error";
        }
		$stmt->close();
	}
}