<?php
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