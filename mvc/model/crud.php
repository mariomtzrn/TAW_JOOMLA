<?php
#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.
require_once "conexion.php";
//heredar la clase conexion de conexion.php para poder utilizar "Conexion" del archivo conexion.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del models/conexion.php:
class Datos extends Conexion {
  #Se crea la conexion a la base de datos y valida que el usuario exista
  public function ingresoUsuarioModel($datosModel, $tabla){
    #echo "<script> alert(2) </script>";
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = :email");
    $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
    $stmt->execute();
    #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
    return $stmt->fetch();
    $stmt->close();
  }

  ///Se trae la informacion de todos los usuarios
  public function vistaUsuariosModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
		return $stmt->fetchAll();
		$stmt->close();
	}
  
  #Se crea la funcion para registarse, para poderse registrase , necesita no estar logado
  # y que no el correo no se encuentre registrado,
  	public function registroUsuarioModel($datosModel, $tabla){
		//prepara la conexion a la base de datos y prepara ls entencia SQL 
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, email, password, nombre, apellido, date)
		 VALUES (:id, :email, :password, :nombre,:apellido, :fecha)");	
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
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
  
  #Trae la nformación de la tabla de usuarios de una fila en especifico,
  #esta es traida atraves de su llave primaria "id"
  public function InformacionModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
  
  #Se realiza un update a la base de datos y es modificada la informacioón en cierta fila,
  #esta fila se define por el "id" que es enviado a traves de la URL, por el método GET
  public function actualizarUsuarioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET email = :email, password = :password, 
                            nombre = :nombre, apellido = :apellido , date = :fecha WHERE id = :id");
		$stmt->bindParam(":apellido", $datosModel["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
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
  
    public function borrarUsuarioModel($datosModel, $tabla){
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
     public static function eliminarUsuarioModel($data,$tabla1,$tabla2)
    {
        //preparamos la sentencia para realizar el update
        $stmt1 = Conexion::conectar() -> prepare("UPDATE $tabla1 SET id_usuario = NULL WHERE id_usuario = :id");
        //se realiza la asignacion de los datos a actualizar
        $stmt1 -> bindParam(":id",$data,PDO::PARAM_INT);
        
        //preparamos la sentencia para realizar el delete
        $stmt2 = Conexion::conectar() -> prepare("DELETE FROM $tabla2 WHERE id_usuario = :id");
        //se realiza la asignacion de los datos a eliminar
        $stmt2 -> bindParam(":id",$data,PDO::PARAM_INT);
        //se ejecuta la sentencia
        if($stmt1 -> execute() && $stmt2 -> execute())
        {
            //si se ejecuto correctamente nos retorna success
            return "success";
        }
        else
        {
            //en caso de no ser asi nos retorna fail
            return "fail";
        }
        //cerramos la conexion
        $stmt -> close();
    }
    
  
  
}
?>
