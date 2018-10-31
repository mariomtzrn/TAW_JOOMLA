<?php
class Conexion{
	public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=practica13","admin","52c588fa31c7bbb1a566cde87112ab05960f31a30b3ae2f6");
		return $link;
	}
}
?>