<?php
if(isset($_SESSION["validar"])){
if($_SESSION["tipo"] == 0){
 ?>
  <div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $_GET["select"]; ?></a></li>
        <li class="active">User profile</li>
      </ol>
    </section>  
        <section class="content">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <div class="box-body">
              <div class="row">
              <?php
                if($_GET["select"] == "Alumno"){
                 $mvcA=new mvc_controller();
                 $mvcA -> perfilAlumnoC();
                }
                  if($_GET["select"] == "Tutor"){
                    $mvcT=new mvc_controller();
                     $mvcT -> perfilTutorC();
                  
                }
                ?>
                
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
</div>
<?php
  }
}
?>
