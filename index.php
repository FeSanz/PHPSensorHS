<!DOCTYPE html>
<?php require_once 'dboperations.php'; ?>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <!--<meta http-equiv="refresh" content="5" />-->

        <title>Sensor humedad suelo</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/fontsGoogle.css" rel="stylesheet" type="text/css"/>

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link href="assets/alertify/css/themes/default.rtl.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/alertify/css/alertify.min.css" rel="stylesheet" type="text/css"/>
        <!-- alertify -->
        <script src="assets/alertify/alertify.js" type="text/javascript"></script>
        <script src="assets/alertify/alertify.min.js" type="text/javascript"></script>
        
        <!--  jQuery -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="assets/js/datepickerCustom.js" type="text/javascript"></script>

        <!-- Bootstrap core JavaScript
        <script src="assets/js/jQuery.js" type="text/javascript"></script> 

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>-->
        <script src="js/sb-admin-2.min.js"></script>
        <script src="vendor/chart.js/Chart.min.js"></script>


        <script src="assets/js/gstaticLoaderCharts.js" type="text/javascript"></script>
        <script src="assets/js/chartline.js" type="text/javascript"></script>
        <script src="assets/js/chartgauje.js" type="text/javascript"></script>
    </head>


    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Acuaponia</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Utilidades
                </div>

                <li class="nav-item">
                    <a class="nav-link" href="tables.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Tablas</span></a>
                </li>


                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <ul class="navbar-nav ml-auto">
                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Condor</span>
                                    <img class="img-profile rounded-circle"
                                         src="img/undraw_profile.svg">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                     aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->

                        <!-- Content Row -->
                        <div class="row">

                            <div class="col-xl-12 col-lg-7">

                                  <!-- Manometro -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Humedad actual</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-auto" id="chart_div" style="width: 1300px; height: 250px; overflow-x:auto;"></div>
                                        <hr><span id="debugTextManometer"></span>
                                    </div>
                                </div>
                                  
                                <!-- Grafica -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Humedad registrada</h6>
                                    </div>
                                    <div class="card-body">
                                        <label class="col-12" style="background-color:powderblue;">Seleccione las fechas que desea mostrar en la gráfica</label>
                                        <br><br>
                                        <form class="form-horizontal" name="formDates" role="form" enctype="multipar/form-data">
                                            <div class="row">
                                                <label class="col-1">Fecha inicio:</label>
                                                <div class="col">
                                                    <input type="text" id="startDateValue" class="form-control" required="required">
                                                </div>
                                                <label class="col-1">Fecha fin:</label>
                                                <div class="col">
                                                    <input type="text" id="endDateValue" class="form-control" required="required">
                                                </div>

                                               
                                                <div class="btn-group pull-right">
                                                    <button type="button" id="serachButton" class="btn btn-primary">Buscar</button>
                                                </div>
                                                
                                            </div>
                                            <br>
                                                 <p style="color:red;" id="responseSearch"></p>
                                        </form>
                                        <div class="col-auto" id="curve_chart" style="width: 1300px; height: 500px; overflow-x:auto;"></div>
                                        <hr><span id="debugTextGraphic"></span>
                                    </div>  
                                </div>

                            </div>

                            <!-- Donut Chart -->

                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

    </body>

</html>