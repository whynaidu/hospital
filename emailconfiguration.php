<?php
include("configure.php");
session_start();

if(isset($_POST['emailSettingSubmit'])){
    $protocol=$_POST['protocol'];
    $encryption=$_POST['encryption'];
    $host=mysqli_real_escape_string($conn,$_POST['host']);
    $port=$_POST['port'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=mysqli_real_escape_string($conn,$_POST['password']);

    $sql=mysqli_query($conn,"update email_configuration set protocol='$protocol',encryption='$encryption',host='$host',port='$port',email='$email',username='$username',password='$password'");
    if($sql){
        echo "<script>alert('Email Configuration Updated Successfully');</script>";
    }
    else{
        echo "<script>alert('Email Configuration Not Updated');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Navbar & Tabs</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include("header.php")?>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include("sidebar.php")?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-12">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Setting</a></li>
                <li class="breadcrumb-item active">Email&nbsp;</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <?php

                  $sql=mysqli_query($conn,"select * from email_configuration");
                  while($arr=mysqli_fetch_assoc($sql)){
                  ?>
      <section class="content">
        <div class="row">
          <div class="col-md-12">
          <form class="form-horizontal" name="emailSetupForm" id="emailSetupForm" method="post" enctype="multipart/form-data">
                            <div class="card card-info">
                                <div class="card-header">
                                <h3 class="card-title mt-4">Email setup</h3>
                                </div>
                                <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">
                                    Protocol                      <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-4">
                                    <input type="text" name="protocol" value="<?php echo $arr['protocol'] ?>" class="form-control form-control-sm field_validation" id="protocol" placeholder="Protocol">
                                    <span id="err_protocol" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Encryption<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                    <input type="text" name="encryption" value="<?php echo $arr['encryption'] ?>" class="form-control form-control-sm field_validation" id="encryption" placeholder="Encryption">
                                    <span id="err_encryption" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Host<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                    <input type="text" name="host" value="<?php echo $arr['host'] ?>" class="form-control form-control-sm field_validation" id="host" placeholder="Host">
                                    <span id="err_host" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Port<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                    <input type="text" name="port" value="<?php echo $arr['port'] ?>" class="form-control form-control-sm field_validation" id="port" placeholder="Port">
                                    <span id="err_port" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                    <input type="email" name="email" value="<?php echo $arr['email'] ?>" class="form-control form-control-sm field_validation" id="email" placeholder="Email">
                                    <span id="err_email" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Username<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                    <input type="text" name="username" value="<?php echo $arr['username'] ?>" class="form-control form-control-sm field_validation" id="username" placeholder="Username">
                                    <span id="err_username" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                    <input type="password" name="password" value="<?php echo $arr['password'] ?>" class="form-control form-control-sm field_validation" id="password" placeholder="Password">
                                    <span id="err_password" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                
                                </div>
                                <div class="card-footer">
                                <input type="hidden" name="csrf_zivaan_pro" value="0d0916ebc5a1ddc9c6a32ef256602c6d">
                                <button type="submit" id="emailSettingSubmit" name="emailSettingSubmit" class="btn btn-primary" data-tt="tooltip" title="Click here to Save">Save</button>
                                </div>
                            </div>
                            </form>
          </div>
        </div>
      </section>
      <?php } ?>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("footer.php")?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
</body>

</html>
