<?php
session_start();
  error_reporting(0);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Inventario | Practica 12</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="views/assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="views/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="views/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="views/assets/icon/icofont/css/icofont.css">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="views/assets/pages/menu-search/css/component.css">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css"
          href="views/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="views/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
          href="views/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="views/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="views/assets/css/jquery.mCustomScrollbar.css">
    <!-- jquery file upload Frame work -->
    <link href="views/assets/pages/jquery.filer/css/jquery.filer.css" type="text/css" rel="stylesheet" />
    <link href="views/assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
   <!-- Select2 -->
  <link rel="stylesheet" href="views/bower_components/select2/css/select2.min.css">

  
</head>
<?php
  #verificamos si se encuentra logeado
  if(isset($_SESSION["validar"]))
  {
  ?>
<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="index.html">
                            <img class="img-fluid" src="views/assets/images/auth/Logo-small-bottom.png" alt="Theme-Logo" />
                            
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                            <li>
                                <a class="main-search morphsearch-search" href="#">
                                    <!-- themify icon -->
                                    <i class="ti-search"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                        <i class="ti-fullscreen"></i>
                                    </a>
                            </li>
                            
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <a href="#!">
                                        <img src="<?php echo $_SESSION["imagen"]?>" class="img-radius" alt="User-Profile-Image">
                                        <span><?php echo $_SESSION["nombre"]?></span>
                                        <i class="ti-angle-down"></i>
                                    </a>
                                <ul class="show-notification profile-notification">
                                    <li>
                                        <a href="index.php?action=Perfil&id=<?php echo $_SESSION["id"]?>">
                                                <i class="ti-user"></i> Profile
                                            </a>
                                    </li>
                                    
                                    <li>
                                        <a href="index.php?action=log_out">
                                        <i class="ti-layout-sidebar-left"></i> Logout
                                    </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- search -->
                        <div id="morphsearch" class="morphsearch">
                            <form class="morphsearch-form">
                                <input class="morphsearch-input" type="search" placeholder="Searchviews." />
                                <button class="morphsearch-submit" type="submit">Search</button>
                            </form>
                            <div class="morphsearch-content">
                                <div class="dummy-column">
                                    <h2>People</h2>
                                    <a class="dummy-media-object img-radius" href="#!">
                                            <img src="views/assets/images/avatar-4.jpg" class="img-radius" alt="Sara Soueidan" />
                                            <h3>Sara Soueidan</h3>
                                        </a>
                                    <a class="dummy-media-object img-radius" href="#!">
                                            <img src="views/assets/images/avatar-2.jpg" class="img-radius" alt="Shaun Dona" />
                                            <h3>Shaun Dona</h3>
                                        </a>
                                </div>
                                <div class="dummy-column">
                                    <h2>Popular</h2>
                                    <a class="dummy-media-object img-radius" href="#!">
                                            <img src="views/assets/images/avatar-3.jpg" class="img-radius" alt="PagePreloadingEffect" />
                                            <h3>Page Preloading Effect</h3>
                                        </a>
                                    <a class="dummy-media-object img-radius" href="#!">
                                            <img src="views/assets/images/avatar-4.jpg" class="img-radius" alt="DraggableDualViewSlideshow" />
                                            <h3>Draggable Dual-View Slideshow</h3>
                                        </a>
                                </div>
                                <div class="dummy-column">
                                    <h2>Recent</h2>
                                    <a class="dummy-media-object img-radius" href="#!">
                                            <img src="views/assets/images/avatar-2.jpg" class="img-radius" alt="TooltipStylesInspiration" />
                                            <h3>Tooltip Styles Inspiration</h3>
                                        </a>
                                    <a class="dummy-media-object img-radius" href="#!">
                                            <img src="views/assets/images/avatar-3.jpg" class="img-radius" alt="NotificationStyles" />
                                            <h3>Notification Styles Inspiration</h3>
                                        </a>
                                </div>
                            </div>
                            <!-- /morphsearch-content -->
                            <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
                        </div>
                        <!-- search end -->
                    </div>
                </div>
            </nav>

            <!-- Sidebar chat start -->
            <div id="sidebar" class="users p-chat-user showChat">
                <div class="had-container">
                    <div class="card card_main p-fixed users-main">
                        <div class="user-box">
                            <div class="card-block">
                                <div class="right-icon-control">
                                    <input type="text" class="form-control  search-text" placeholder="Search Friend" id="search-friends">
                                    <div class="form-icon">
                                        <i class="icofont icofont-search"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="main-friend-list">
                                <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius img-radius" src="views/assets/images/avatar-3.jpg" alt="Generic placeholder image ">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Josephin Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe" data-toggle="tooltip" data-placement="left" title="Lary Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="views/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Lary Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice" data-toggle="tooltip" data-placement="left" title="Alice">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="views/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alice</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="4" data-status="online" data-username="Alia" data-toggle="tooltip" data-placement="left" title="Alia">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="views/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alia</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="5" data-status="online" data-username="Suzen" data-toggle="tooltip" data-placement="left" title="Suzen">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="views/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Suzen</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat start-->
            <div class="showChat_inner">
                <div class="media chat-inner-header">
                    <a class="back_chatBox">
                        <i class="icofont icofont-rounded-left"></i> Josephin Doe
                    </a>
                </div>
                <div class="media chat-messages">
                    <a class="media-left photo-table" href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="views/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                    </a>
                    <div class="media-body chat-menu-content">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                </div>
                <div class="media chat-messages">
                    <div class="media-body chat-menu-reply">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                    <div class="media-right photo-table">
                        <a href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="views/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                        </a>
                    </div>
                </div>
                <div class="chat-reply-box p-b-20">
                    <div class="right-icon-control">
                        <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                        <div class="form-icon">
                            <i class="icofont icofont-paper-plane"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                   <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-40 img-radius" src="<?php echo $_SESSION["imagen"]?>" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span><?php echo $_SESSION["nombre"]?></span>
                                        <span id="more-details"><?php echo $_SESSION["usuario"]?><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="pcoded-search">
                                <span class="searchbar-toggle">  </span>
                                <div class="pcoded-search-box ">
                                    <input type="text" placeholder="Search">
                                    <span class="search-icon"><i class="ti-search" aria-hidden="true"></i></span>
                                </div>
                            </div> 
                  <?PHP 
                          include('pages/Navegacion.php');
                    ?>
                     </div>
                     </nav>
                    <div class="pcoded-content">
                      <?php
                        //Mostraremos un controlador que muestra la plantilla
                        $mvc = new mvc_controller();
                        //Mostramos la funcion
                        $mvc->enlacesPaginasC();
                      ?>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="views/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="views/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="views/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="views/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="views/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="views/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="views/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="views/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="views/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="views/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="views/bower_components/modernizr/js/modernizr.js"></script>
    <!-- am chart -->
    <script src="views/assets/pages/widget/amchart/amcharts.min.js"></script>
    <script src="views/assets/pages/widget/amchart/serial.min.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="views/bower_components/chart.js/js/Chart.js"></script>
    <!-- Todo js -->
    <script type="text/javascript" src="views/assets/pages/todo/todo.js "></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="views/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="views/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="views/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="views/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="views/assets/pages/dashboard/custom-dashboard.min.js"></script>
    <script type="text/javascript" src="views/assets/js/SmoothScroll.js"></script>
    <script src="views/assets/js/pcoded.min.js"></script>
    <script src="views/assets/js/demo-12.js"></script>
    <script src="views/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="views/assets/js/script.min.js"></script>
    <script src="views/assets/pages/data-table/js/data-table-custom.js"></script>
    <script type="text/javascript" src="views/assets/pages/advance-elements/select2-custom.js"></script>
     <!-- data-table js -->
    <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="views/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="views/assets/pages/data-table/js/jszip.min.js"></script>
    <script src="views/assets/pages/data-table/js/pdfmake.min.js"></script>
    <script src="iiews/assets/pages/data-table/js/vfs_fonts.js"></script>
    <script src="views/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="views/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="views/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="views/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="views/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <!-- jquery file upload js -->
    <script src="views/assets/pages/jquery.filer/js/jquery.filer.min.js"></script>
    <script src="views/assets/pages/filer/custom-filer.js" type="text/javascript"></script>
    <script src="views/assets/pages/filer/jquery.fileuploads.init.js" type="text/javascript"></script>
    <!-- Select 2 js -->
    <script src="views/bower_components/select2/js/select2.full.min.js"></script>
  
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
    dropdownParent: $("#default-Modal")
    });
  });
</script>

</body>
    <?php
}
if (!isset($_SESSION["id"])) {

       include "pages/login.php";
    }
?>
</html>

