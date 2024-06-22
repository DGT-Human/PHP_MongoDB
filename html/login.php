<!DOCTYPE html>
<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Failed to connect to MongoDB, is the service installed and running?<br /><br />';
        echo $e->getMessage();
        exit();
    }

    // Validate inputs (you may want to add more validation)
    if (empty($email) || empty($password)) {
        echo '<script>alert("Email hoặc pass bạn đang trống, vui lòng nhập đầy đủ.");</script>';
    } else {
        // Check if the user exists in the database
        $filter = ['email' => $email];
        $query = new MongoDB\Driver\Query($filter);

        $cursor = $conn->executeQuery('QLSV.Taikhoan', $query);

        $user = current($cursor->toArray());

        if ($user && password_verify($password, $user->password)) {
            // Password is correct, set session variables and redirect to dashboard or another page
            $_SESSION['user_id'] = $user->_id; // Assuming MongoDB document has '_id' field
            $_SESSION['user_name'] = $user->name;
            header('Location: students.php'); // Redirect to dashboard or another page
            exit();
        } else {
         $emailValue = $email;
         $passwordValue = $password;
            echo '<script>alert("Email hoặc pass bạn nhập không đúng, vui lòng nhập lại.");</script>';
        }
    }
}

if (isset($_GET['success3']) && $_GET['success3'] == true) {
   echo '<script>alert("Tạo tài khoản thành thành công, mời bạn đăng nhập.");</script>';
}
?>
<html lang="en">
   <!-- Mirrored from preschool.dreamguystech.com/html-template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:39 GMT -->
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <title>Preskool - Login</title>
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
                        <h1>Login</h1>
                        <p class="account-subtitle">Access to our dashboard</p>
                        <form action="login.php" method="post">
                           <div class="form-group">
                              <input class="form-control" type="text" placeholder="Email" name="email" value="<?php echo isset($emailValue) ? $emailValue : ''; ?>">
                           </div>
                           <div class="form-group">
                              <input class="form-control" type="text" placeholder="Password" name="password" value="<?php echo isset($passwordValue) ? $passwordValue : ''; ?>">
                           </div>
                           <div class="form-group">
                              <button class="btn btn-primary btn-block" type="submit">Login</button>
                           </div>
                        </form>
                        <div class="text-center forgotpass"><a href="forgot-password.html">Forgot Password?</a></div>
                        <div class="login-or">
                           <span class="or-line"></span>
                           <span class="span-or">or</span>
                        </div>
                        <div class="social-login">
                           <span>Login with</span>
                           <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a><a href="#" class="google"><i class="fab fa-google"></i></a>
                        </div>
                        <div class="text-center dont-have">Don’t have an account? <a href="register.php">Register</a></div>
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
   <!-- Mirrored from preschool.dreamguystech.com/html-template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:40 GMT -->
</html>