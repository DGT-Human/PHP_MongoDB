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
if(isset($_REQUEST['ma_sinh_vien']));

    $productID = $_REQUEST['ma_sinh_vien'];

    try {
        $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    } catch (MongoDBDriverExceptionException $e) {
        echo 'Failed to connect to MongoDB, is the service intalled and running?<br /><br />';
        echo $e->getMessage();
        exit();
    }
    $query = new MongoDB\Driver\Query(['ma_sinh_vien'=>$productID], []);
    $result = $conn->executeQuery('QLSV.Sinhvien', $query);
    $query1 = new MongoDB\Driver\Query([], []);
    $result1 = $conn->executeQuery('QLSV.Lop', $query1);
    $result2 = $conn->executeQuery('QLSV.Chuyennganh', $query1);
    $result3 = $conn->executeQuery('QLSV.Khoa', $query1);

    $result4 = $conn->executeQuery('QLSV.Dangky', $query);
    $result5 = $conn->executeQuery('QLSV.Dangky', $query1);
$index = 1;
foreach ($result5 as $rs5){
    $index++;
}
?>
?>
<html lang="en">

<!-- Mirrored from preschool.dreamguystech.com/html-template/student-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:49 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Preskool - Student Details</title>

<link rel="shortcut icon" href="assets/img/favicon.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

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
    <li class="submenu active">
        <a href="#"><i class="fas fa-user-graduate"></i> <span> Students</span> <span class="menu-arrow"></span></a>
        <ul>
            <li><a href="students.php" class="active">Student List</a></li>
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
    <li class="submenu ">
        <a href="#"><i class="fas fa-book-reader"></i> <span> Subjects</span> <span class="menu-arrow"></span></a>
        <ul>
            <li><a href="subjects.php" >Subject List</a></li>
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
<div class="row">
<div class="col-sm-12">
<h3 class="page-title">Student Details</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="students.php">Student</a></li>
<li class="breadcrumb-item active">Student Details</li>
</ul>
</div>
</div>
</div>
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-md-12">
<div class="about-info">
<h4>About Me</h4>
<div class="media mt-3">
    <img src="assets/img/user.jpg" class="mr-3" alt="...">
    <div class="media-body">
        <ul>
            <?php foreach ($result as $rs) : ?>
                <li>
                    <span class="title-span">Full Name : </span>
                    <span class="info-span"><?php echo $rs->{'ten'}; ?></span>
                </li>
                <li>
                    <span class="title-span">Status : </span>
                    <span class="info-span"><?php echo $rs->{'trang_thai'}; ?></span>
                </li>
                <li>
                    <span class="title-span">Mobile : </span>
                    <span class="info-span"><?php echo $rs->{'sdt'}; ?></span>
                </li>
                <li>
                    <span class="title-span">Email : </span>
                    <span class="info-span">
                        <?php echo $rs->{'email'}; ?>
                    </span>
                </li>
                <li>
                    <span class="title-span">Gender : </span>
                    <span class="info-span"><?php echo $rs->{'gioi_tinh'}; ?></span>
                </li>
                <li>
                    <span class="title-span">DOB : </span>
                    <span class="info-span"><?php echo $rs->{'ngay_sinh'}; ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

</form>
<br>
<h3>Result of Student: </h3>
<?php

$maSinhVien = $rs->{'ma_sinh_vien'};
$querySinhvien = new MongoDB\Driver\Query(['ma_sinh_vien' => $maSinhVien]);
$resultSinhvien = $conn->executeQuery('QLSV.Sinhvien', $querySinhvien);
$sinhVien = current($resultSinhvien->toArray());

$queryKetQua = new MongoDB\Driver\Query(['ma_sinh_vien' => $maSinhVien]);
$resultKetqua = $conn->executeQuery('QLSV.Ketqua', $queryKetQua);

// Group results by term
$groupedResults = [];
foreach ($resultKetqua as $rs) {
    $term = $rs->{'hoc_ky'};
    if (!isset($groupedResults[$term])) {
        $groupedResults[$term] = [];
    }
    $groupedResults[$term][] = $rs;
}

foreach ($groupedResults as $term => $termResults) {
    echo '<div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h3>Term: ' . $term . '</h3>
                            <table class="table table-hover table-center mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Study Group</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>';

    foreach ($termResults as $rs) {
        $maNhomHocPhan = $rs->{'ma_nhom_hoc_phan'};
        $queryMaNhomHocPhan = new MongoDB\Driver\Query(['ma_nhom_hoc_phan' => $maNhomHocPhan]);
        $resultMaNhomHocPhan = $conn->executeQuery('QLSV.Nhomhocphan', $queryMaNhomHocPhan);

        $nhomHocPhan = current($resultMaNhomHocPhan->toArray());

        $maHocPhan = $nhomHocPhan->{'ma_hoc_phan'};
        $queryMaHocPhan = new MongoDB\Driver\Query(['ma_hoc_phan' => $maHocPhan]);
        $resultMaHocPhan = $conn->executeQuery('QLSV.Hocphan', $queryMaHocPhan);

        $hocPhan = current($resultMaHocPhan->toArray());

        echo '<tr>
                <td>
                    <h2><a>'.$sinhVien->{'ten'}.'</a></h2>
                </td>
                <td>'. $hocPhan->{'ten_hoc_phan'}. '</td>
                <td>'.  $maNhomHocPhan. '</td>
                <td>'.$rs->{'diem'}.'</td>
            </tr>';

    }
    echo '</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
  }
?>
    <br>
    <h3>Time Table: </h3>
    <?php

    $maSinhVien = $rs->{'ma_sinh_vien'};
    $querySinhvien = new MongoDB\Driver\Query(['ma_sinh_vien' => $maSinhVien]);
    $resultSinhvien = $conn->executeQuery('QLSV.Sinhvien', $querySinhvien);
    $sinhVien = current($resultSinhvien->toArray());

    $queryKetQua = new MongoDB\Driver\Query(['ma_sinh_vien' => $maSinhVien]);
    $resultKetqua = $conn->executeQuery('QLSV.Dangky', $queryKetQua);

    // Group results by term
    $groupedResults = [];
    foreach ($resultKetqua as $rs) {
        $term = $rs->{'hoc_ky'};
        if (!isset($groupedResults[$term])) {
            $groupedResults[$term] = [];
        }
        $groupedResults[$term][] = $rs;
    }

    foreach ($groupedResults as $term => $termResults) {
        echo '<div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h3>Term: ' . $term . '</h3>
                            <table class="table table-hover table-center mb-0 datatable">
                                <thead>
                                    <tr>
                                       <th>Name_Subjects</th>
                                       <th>Number of credits</th>
                                       <th>ID_subjects_Group</th>
                                        <th>Days of Week</th>
                                        <th>Class start</th>
                                        <th>Number of lessons</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>';
        $totalTinChi=0;
        $TinChi=0;
        foreach ($termResults as $rs) {
            echo '<tr>';
            $query3 = new MongoDB\Driver\Query(['ma_nhom_hoc_phan' => $rs -> {'ma_nhom_hoc_phan'}],[]);
            $result3 = $conn->executeQuery('QLSV.Nhomhocphan', $query3);
            foreach ($result3 as $rs3) {
                $query4 = new MongoDB\Driver\Query(['ma_hoc_phan' => $rs3->{'ma_hoc_phan'}], []);
                $result4 = $conn->executeQuery('QLSV.Hocphan', $query4);
            }
            foreach ($result4 as $rs4) {
                echo '<td>' . $rs4->{'ten_hoc_phan'} . '</td>';
                echo '<td>' . $rs4->{'so_tin_chi'} . '</td>';
                $totalTinChi += intval($rs4->{'so_tin_chi'});
                $TinChi = $rs4->{'so_tin_chi'} * 400000;
            }


            echo '<td>'. $rs->{'ma_nhom_hoc_phan'}. '</td >';
            $query1 = new MongoDB\Driver\Query(['ma_nhom_hoc_phan' => $rs -> {'ma_nhom_hoc_phan'}],[]);
            $result2 = $conn->executeQuery('QLSV.Nhomhocphan', $query1);
            foreach ($result2 as $rs2) {
                echo '<td>' . $rs2->{'thu'} . '</td >';
                echo '<td>' . $rs2->{'tiet_bat_dau'} . '</td >';
                echo '<td>' . $rs2->{'so_tiet'} . '</td >';
                echo '<td>' . number_format($TinChi) . ' VND</td >';;
            }
            '</tr>';
        }
        $totalCost = $totalTinChi * 400000;
        echo '<p style="color: orangered">Tổng học phí: ' . number_format($totalCost) . ' VND</p>';
        echo '</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
    ?>


</div>
</div>
</div>

<footer>
<p>Copyright © 2020 Dreamguys.</p>
</footer>

</div>

</div>


<script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/js/script.js"></script>
</body>

<!-- Mirrored from preschool.dreamguystech.com/html-template/student-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:50 GMT -->
</html>