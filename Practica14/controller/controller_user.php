<?php
  class mvc_controller_user {
    public function actContrasenaC(){
      echo "<form method='post' class='form-horizontal'>
              <div class='form-group row d-flex align-items-center mb-5'>
                  <label class='col-lg-3 form-control-label'>Contraseña actual</label>
                  <div class='col-lg-9'>
                      <input type='password' class='form-control' name='actual' placeholder='Introduzca su contraseña actual'>
                  </div>
              </div>
              <div class='form-group row d-flex align-items-center mb-5'>
                  <label class='col-lg-3 form-control-label'>Contraseña nueva</label>
                  <div class='col-lg-9'>
                      <input type='password' class='form-control' name='nueva' placeholder='Introduzca su contraseña nueva'>
                  </div>
              </div>
              <div class='wrapper' style='text-align:center'>
                  <button type='submit' class='btn btn-primary' style='position:relative;' name='act'>
                      Actualizar
                  </button>
              </div>
           </form>";
        if(isset($_POST["act"])){
          if(($_POST["actual"] == NULL && $_POST["nueva"] == NULL) || ($_POST["actual"] == NULL) || ($_POST["nueva"] == NULL)){
            #echo "<p style='color:red;'>Faltan campos por llenar</p>";
            echo "<div class='wrapper' style='text-align:center; padding-top:10px'>
                    <div class='alert alert-warning' role='alert'>
                        <strong>Faltan campos por llenar</strong>
                    </div>
                  </div>";
          } else {
            if($_POST["actual"] == $_POST["nueva"]){
              #echo "<p style='color:red;'>Las contraseñas son iguales</p>";
              echo "<div class='wrapper' style='text-align:center; padding-top:10px'>
                      <div class='alert alert-warning' role='alert'>
                          <strong>Las contraseñas son iguales</strong>
                      </div>
                    </div>";
            } else {
              $validarContrasena = Datos::InfoDatosM($_SESSION["id"], "usuarios");
              if($_POST["actual"] == $validarContrasena["password"]){
                $datosController = array("nueva"=>$_POST["nueva"], "id_usuario"=>$_SESSION["id"]);
                $respuesta = Datos::actContrasenaM($datosController, "usuarios");
                if($respuesta == 1){
                  echo "<div class='wrapper' style='text-align:center; padding-top:10px'>
                        <div class='alert alert-success' role='alert'>
                            <strong>La contraseña se ha cambiado con exito</strong>
                        </div>
                        <a href='index.php?action=dashboard'>Volver</a>
                      </div>";
                } else {
                  echo "<div class='wrapper' style='text-align:center; padding-top:10px'>
                        <div class='alert alert-danger' role='alert'>
                            <strong>La contraseña no ha podido ser cambiada</strong>
                        </div>
                      </div>";
                }
              } else {
                echo "<div class='wrapper' style='text-align:center; padding-top:10px'>
                      <div class='alert alert-warning' role='alert'>
                          <strong>La contraseña actual es incorrecta</strong>
                      </div>
                    </div>";
              }
            }
          }
        }
    }
    
    public function promosC(){
      $promos = Datos::VistaDatosM("promociones");
      echo '<div class="container">
              <!-- Begin Widget 10 -->
              <div class="widget widget-10 has-shadow">
                  <!-- End Widget Header -->
                  <!-- Begin Widget Body -->
                  <div class="widget-body no-padding">
                      <ul class="ticket list-group w-100">';
      foreach($promos as $key => $pr){
        $visitas = $pr['visitas'];
        $nombre = $pr['nombre'];
        $descripcion = $pr['descripcion'];
        echo '<!-- 01 -->
              <li class="list-group-item">
                  <div class="media">
                      <div class="media-left align-self-center pr-4">
                          <i class="la la-trophy" style="font-size: 4rem; color: gold;"></i>
                      </div>
                      <div class="media-body align-self-center">
                          <div class="username">
                              <h4>' . $nombre . '</h4>
                          </div>
                          <div class="msg">
                              <p>
                                ' . $descripcion . '
                              </p>
                          </div>
                          <div class="status"><span class="open mr-2">Visitas necesarias: </span>' . $visitas . '</div>
                      </div>
                  </div>
              </li>
              <!-- End 01 -->';
      }
      echo '</ul>
            </div>
            <!-- End Widget Body -->
        </div>
        <!-- End Widget 10 -->
    </div>';
    }
    
    public function visitasUsuarioC(){
      #Contador de visitas
      $count = 0;
      #Trae las visitas del usuario
      $visitas = Datos::VisitasTablaM($_SESSION["id"], "visitas");
      #Trae las promociones
      $promos = Datos::VistaDatosM("promociones");
      echo '<div class="row justify-content-center">
              <div class="col-xl-10 col-12">
                  <!-- Begin Timeline -->
                  <div class="timeline timeline-line-solid">
                      <span class="timeline-label">
                          <span class="label">Mis Visitas</span>
                      </span>';
      foreach($visitas as $key => $visita){
        $count += 1;
        $fecha = $visita["fecha"];
        $hora = date('g:i a', strtotime($visita["hora"]));
        $dia = $visita["dia"];
        echo '<!-- Begin Timeline Item -->
              <div class="timeline-item">
                  <div class="timeline-point timeline-point"></div>
                  <!-- Begin Timeline Event -->
                  <div class="timeline-event">
                      <!-- Begin Widget -->
                      <div class="widget has-shadow">
                          <div class="alert alert-success" role="alert">
                              <strong>' . $dia . ' </strong>' . $hora . '
                          </div>
                      </div>
                      <!-- End Widget -->
                      <div class="time-right">' . $fecha . '</div>
                  </div>
                  <!-- End Timeline Event -->
              </div>';
        foreach($promos as $key => $promo){
          $visitas = $promo['visitas'];
          if($count == $visitas){
            $nombre = $promo['nombre'];
            $descripcion = $promo['descripcion'];
            echo '<!-- Begin Timeline Item -->
                  <div class="timeline-item">
                      <div class="timeline-point timeline-point" style="background-color: #cc181e; color: #cc181e;"></div>
                      <!-- Begin Timeline Event -->
                      <div class="timeline-event">
                          <!-- Begin Widget -->
                          <div class="widget icon-widget has-shadow">
                              <!-- Begin Widget Body -->
                              <div class="widget-body">
                                  <div class="media">
                                      <div class="media-left align-self-center">
                                          <i class="la la-trophy" style="font-size: 4rem; color: gold;"></i>
                                      </div>
                                      <div class="media-body align-self-center pl-4">
                                          ' . $nombre . ' (Visitas necesarias: ' . $visitas . ')
                                          <h3>' . $descripcion . '</h3>
                                      </div>
                                  </div>
                              </div>
                              <!-- End Widget Body -->
                          </div>
                          <!-- End Widget -->
                      </div>
                      <!-- End Timeline Event -->
                  </div>';
          }
        }
      }
      echo "</div>
           </div>";
    }
    
    public function horariosUsuarioC(){
      $horarios = Datos::VistaDatosM("horarios");
      echo "<div class='row flex-row'>";
      $dias = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");
      foreach($dias as $key => $d){
        foreach($horarios as $key => $horario){
          if($d == $horario['dia']){
            $dia = $horario['dia'];
            $hora_abrir = date('g:i a', strtotime($horario['hora_abrir']));
            $hora_cerrar = date('g:i a', strtotime($horario['hora_cerrar']));
            echo "<div class='col-xl-4 col-md-6 col-sm-6'>
                      <div class='widget widget-12 has-shadow'>
                          <div class='widget-body'>
                              <div class='media'>
                                  <div class='align-self-center ml-3 mr-3'>
                                      <i class='la la-calendar'></i>
                                  </div>
                                  <div class='media-body align-self-center'>
                                      <div class='title'>$dia</div>
                                      <div class='number'>$hora_abrir - $hora_cerrar</div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>";
          }
        }
      }
      echo "</div>";
    }
    
    public function climaC(){
      setlocale(LC_TIME, 'es_ES.UTF-8');
      date_default_timezone_set("America/Mexico_City");
      $url = "http://api.openweathermap.org/data/2.5/weather?id=3530580&lang=sp&units=metric&APPID=6d1c5c1708b31c139c4a309edd9ab04c";
      $contents = file_get_contents($url);
      $clima = json_decode($contents);
      $temp = $clima->main->temp;
      $temp_max=$clima->main->temp_max;
      $temp_min=$clima->main->temp_min;
      $icon=$clima->weather[0]->icon.".png";
      //how get today date time PHP :P
      #$today = date("Y j, Y, g:i a");
      $today = date("Y-m-d H:i:s", time());
      $cityname = $clima->name;
      
      echo "<div class='col-xl-6 col-lg-12 col-md-12 col-sm-12'>
                    <div class='widget widget-15 has-shadow'>
                        <div class='widget-body'>
                            <div class='row'>
                                <div class='col-xl-6 d-flex justify-content-center align-items-center'>
                                    <div class='weather-infos'>
                                        <div class='temp'>$temp °C</div>
                                        <div class='city'>$cityname, MX</div>
                                        <div class='risk'><i class='la la-calendar'></i>$today</div>
                                    </div>
                                </div>
                                <div class='col-xl-6 d-flex justify-content-center align-items-center'>
                                    <div class='weather-icon'>
                                        <img height='150px' width='150px' src='http://openweathermap.org/img/w/" . $icon ."'/ >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   </div>";
    }

    public function acercaC(){
      echo "<div class='container'>
              <h4>Sitio web desarrollado como evidencia de la Practica 14, por Mario Francisco Martínez Alvarado, utilizando la plantilla de administración
                  <a href='https://github.com/mhrodriguez/demo-taw/blob/master/themeforest-21917353-elisyam-web-app-admin-dashboard-template.zip'>Elisyam</a>,
                  para la asignatura de Tecnologías y Aplicaciones Web en la carrera de Ingeniería en Tecnologías de Información.
              </h4><br>
              <h4>
                Contacto: <a href='#'>1430088@upv.edu.mx</a><br>
                Universidad Politecnica de Victoria<br>
                Cd. Victoria, Tamps., MX.
              </h4>
            </div>";
    }
  }
?>
