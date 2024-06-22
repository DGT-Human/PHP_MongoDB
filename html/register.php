<!DOCTYPE html>
<html lang="en">
<?php
   try{
      $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  } catch (MongoDBDriverExceptionException $e) {
      echo 'Failed to connect to MongoDB, is the service intalled and running?<br /><br />';
      echo $e->getMessage();
      exit();
  }
  include 'registration.php'; // Include the registration logic file

  // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //     // Retrieve user input
  //     $name = $_POST['name'];
  //     $email = $_POST['email'];
  //     $password = $_POST['password'];
  //     // Call the registerUser function from registration.php
  //     registerUser($name, $email, $password, $conn);
  // }
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cPassword = $_POST['cPassword'];

    $passwordLength = strlen($password);
    $hasUppercase = preg_match('/[A-Z]/', $password);
    $hasNumber = preg_match('/\d/', $password);

    // Check if the email already exists
    $filter = ['email' => $email];
    $query = new MongoDB\Driver\Query($filter);

    $cursor = $conn->executeQuery('QLSV.Taikhoan', $query);
    $existingUser = current($cursor->toArray());

    if ($existingUser) {
        $nameValue = $name;
        $emailValue = $email;
        $passwordValue = $password;
        // Email already exists, display a message to the user
        echo '<script>alert("Email đã tồn tại, vui lòng nhập lại.");</script>';
    } 
    elseif($password!=$cPassword){
        $nameValue = $name;
        $emailValue = $email;
        $passwordValue = $password;
        // Email already exists, display a message to the user
        echo '<script>alert("Mật khẩu và mật khẩu nhập lại không khớp, vui lòng nhập lại.");</script>';
    }
    elseif ($passwordLength < 8 || !$hasUppercase || !$hasNumber) {
        // Mật khẩu không đáp ứng yêu cầu, hiển thị thông báo
        $nameValue = $name;
        $emailValue = $email;
        $passwordValue = $password;
        echo '<script>alert("Mật khẩu phải có ít nhất 8 ký tự, bao gồm ít nhất một chữ cái viết hoa và ít nhất một số.");</script>';
    }
    else {
        // Call the registerUser function from registration.php
        registerUser($name, $email, $password, $conn);
    }
}
  
?>
<!-- Mirrored from preschool.dreamguystech.com/html-template/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:58 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Preskool - Register</title>

<link rel="shortcut icon" href="assets/img/favicon.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="main-wrapper login-body">
<div class="login-wrapper">
<div class="container">
<div class="loginbox">
<div class="login-left">
<img class="img-fluid" src="assets/img/logo-white.png" alt="Logo">
</div>
<div class="login-right">
<div class="login-right-wrap">
<h1>Register</h1>
<p class="account-subtitle">Access to our dashboard</p>

<form action="register.php" method="post">
<!-- <div class="form-group">
<input class="form-control" type="text" placeholder="Name" name="name">
</div>
<div class="form-group">
<input class="form-control" type="text" placeholder="Email" name="email">
</div>
<div class="form-group">
<input class="form-control" type="text" placeholder="Password" name="password">
</div>
<div class="form-group">
<input class="form-control" type="text" placeholder="Confirm Password">
</div>
<div class="form-group mb-0">
<button class="btn btn-primary btn-block" type="submit">Register</button>
</div> -->
<div class="form-group">
        <input class="form-control" type="text" placeholder="Name" name="name" value="<?php echo isset($nameValue) ? $nameValue : ''; ?>">
    </div>
    <div class="form-group">
        <input class="form-control" type="text" placeholder="Email" name="email" value="<?php echo isset($emailValue) ? $emailValue : ''; ?>">
    </div>
    <div class="form-group">
        <input class="form-control" type="text" placeholder="Password" name="password" value="<?php echo isset($passwordValue) ? $passwordValue : ''; ?>">
    </div>
    <div class="form-group">
        <input class="form-control" type="text" placeholder="Confirm Password" name="cPassword">
    </div>
    <div class="form-group mb-0">
        <button class="btn btn-primary btn-block" type="submit">Register</button>
    </div>
</form>

<div class="login-or">
<span class="or-line"></span>
<span class="span-or">or</span>
</div>

<div class="social-login">
<span>Register with</span>
<a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a><a href="#" class="google"><i class="fab fa-google"></i></a>
</div>

<div class="text-center dont-have">Already have an account? <a href="login.php">Login</a></div>
</div>
</div>
</div>
</div>
</div>
</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="assets/js/script.js"></script>
</body>

<!-- Mirrored from preschool.dreamguystech.com/html-template/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:58 GMT -->
</html>