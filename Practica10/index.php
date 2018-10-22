<?php
  //El index muestra al usuario la salida de las vistas, y a traves de el se
  //envian las diferentes acciones del usuario al controlador.
  //Mostrar la plantilla al usuario (template.php), la cual se alojara en views
  require_once('controller/controller.php');
  //Invocamos el modelo que se utilizara en todos los archivos
  require_once('model/enlaces.php');
  //Para poder ver el template se hace una peticion mediante a un controlador
  require_once('model/crud.php');
  //Creamos el objeto
  $mvc = new mvc_controller();
  //Muestra la funcion plantilla que se encuentra en controller/controller
  $mvc->plantilla();
?>
 
  