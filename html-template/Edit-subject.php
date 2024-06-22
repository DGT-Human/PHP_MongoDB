<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['user_name'])) {
    $loggedInUsername = $_SESSION['user_name'];
} else {
    // Người dùng chưa đăng nhập, bạn có thể xử lý tùy ý, ví dụ: chuyển hướng về trang đăng nhập
    header('Location: login.php');
    exit();
}
if(isset($_REQUEST['ma_hoc_phan']));

$ma_hoc_phan = $_REQUEST['ma_hoc_phan'];
try{
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
} catch (MongoDBDriverExceptionException $e) {
    echo 'Failed to connect to MongoDB, is the service intalled and running?<br /><br />';
    echo $e->getMessage();
    exit();
}
$query = new MongoDB\Driver\Query(['ma_hoc_phan' => $ma_hoc_phan],[]);
$result = $conn->executeQuery('QLSV.Hocphan', $query);

?>
<html lang="en">

<!-- Mirrored from preschool.dreamguystech.com/html-template/add-subject.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:50 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Preskool - Subject</title>

<link rel="shortcut icon" href="assets/img/favicon.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="main-wrapper">

<div class="header">

<div class="header-left">
<a href="index.html" class="logo">
<img src="assets/img/logo.png" alt="Logo">
</a>
<a href="index.html" class="logo logo-small">
<img src="assets/img/logo-small.png" alt="Logo" width="30" height="30">
</a>
</div>

<a href="javascript:void(0);" id="toggle_btn">
<i class="fas fa-align-left"></i>
</a>

<div class="top-nav-search">
<form>
<input type="text" class="form-control" placeholder="Search here">
<button class="btn" type="submit"><i class="fas fa-search"></i></button>
</form>
</div>


<a class="mobile_btn" id="mobile_btn">
<i class="fas fa-bars"></i>
</a>


<ul class="nav user-menu">
<li class="nav-item dropdown has-arrow">
               <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <span class="user-img"><img class="rounded-circle" src="assets/img/profiles/account.png" width="31" alt="Ryan Taylor"></span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="user-header">
                        <div class="avatar avatar-sm">
                           <img src="assets/img/profiles/account.png" alt="User Image" class="avatar-img rounded-circle">
                        </div>
                        <div class="user-text">
                           <h6><?php echo $loggedInUsername; ?></h6>
                           <p class="text-muted mb-0">Administrator</p>
                        </div>
                     </div>
                     <a class="dropdown-item" href="logout.php">Logout</a>
                  </div>
               </li>

</ul>
</div>


<div class="sidebar" id="sidebar">
<div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
<ul>
    <li class="menu-title">
        <span>Main Menu</span>
    </li>
    <li class="submenu">
        <a href="#"><i class="fas fa-user-graduate"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
        <ul>
            <li><a href="index.html">Admin Dashboard</a></li>
            <li><a href="teacher-dashboard.html">Teacher Dashboard</a></li>
            <li><a href="student-dashboard.html">Student Dashboard</a></li>
        </ul>
    </li>
    <li class="submenu">
        <a href="#"><i class="fas fa-user-graduate"></i> <span> Students</span> <span class="menu-arrow"></span></a>
        <ul>
            <li><a href="students.php">Student List</a></li>
            <li><a href="add-student.php">Student Add</a></li>
        </ul>
    </li>
    <li class="submenu">
        <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span class="menu-arrow"></span></a>
        <ul>
            <li><a href="teachers.php">Teacher List</a></li>
            <li><a href="add-teacher.php">Teacher Add</a></li>

        </ul>
    </li>
    <li class="submenu">
        <a href="#"><i class="fas fa-building"></i> <span> Departments</span> <span class="menu-arrow"></span></a>
        <ul>
            <li><a href="departments.php">Department List</a></li>
            <li><a href="add-department.php">Department Add</a></li>
        </ul>
    </li>
    <li class="submenu active">
        <a href="#"><i class="fas fa-book-reader"></i> <span> Subjects</span> <span class="menu-arrow"></span></a>
        <ul>
            <li><a href="subjects.php" class="active">Subject List</a></li>
            <li><a href="add-subject.php">Subject Add</a></li>
            <li><a href="students-subject.php">Subject Sign List</a></li>
        </ul>
    </li>
    <li class="submenu ">
        <a href="#"><i class="fas fa-book-reader"></i> <span> Class</span> <span class="menu-arrow"></span></a>
        <ul>
            <li><a href="classes.php">Class List</a></li>
            <li><a href="add-class.php">Class Add</a></li>
        </ul>
    </li>
    <li class="submenu">
        <a href="#"><i class="fas fa-book-reader"></i> <span> Score</span> <span class="menu-arrow"></span></a>
        <ul>
            <li><a href="scores.php">Score List</a></li>
            <li><a href="add-score.php">Score Add</a></li>
        </ul>
    </li>
    <li class="submenu">
        <a href="#"><i class="fas fa-book-reader"></i> <span> Majors</span> <span class="menu-arrow"></span></a>
        <ul>
            <li><a href="major.php" >Major</a></li>
            <li><a href="add-major.php">Major Add</a></li>
        </ul>
    </li>

</div>
</div>
</div>


<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Edit Subject</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="subjects.php">Subject</a></li>
<li class="breadcrumb-item active">Add Subject</li>
</ul>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<form action="update-subject-action.php" method="post">
<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Subject Information</span></h5>
</div>
<div class="col-12 col-sm-6">
<div class="form-group">
    <?php
    foreach ($result as $rs)
echo '<label>Subject ID</label><br>
<label>'.$rs ->{'ma_hoc_phan'}.'</label>';
echo    ' <input type="hidden" class="form-control" name="ID" value="'.$rs ->{'ma_hoc_phan'}.'" >';
        echo '
    
</div>
</div>
<div class="col-12 col-sm-6">
<div class="form-group">
<label>Subject Name</label>
<input type="text" class="form-control" name="name" value="'.$rs ->{'ten_hoc_phan'}.'">
</div>
</div>
<div class="col-12 col-sm-6">
<div class="form-group">
<label>Number of credits</label>
<input type="text" class="form-control" name="NOC" value="'.$rs ->{'so_tin_chi'}.'">
</div>
</div>';
?>
<div class="col-12">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/js/script.js"></script>
</body>

<!-- Mirrored from preschool.dreamguystech.com/html-template/add-subject.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:50 GMT -->
</html>