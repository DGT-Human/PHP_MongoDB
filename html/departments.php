<!DOCTYPE html>
<html lang="en">
<?php
session_start(); // Bắt đầu session (đảm bảo gọi trước mọi mã HTML)

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if(isset($_SESSION['user_name'])) {
    $loggedInUsername = $_SESSION['user_name'];
} else {
    // Người dùng chưa đăng nhập, bạn có thể xử lý tùy ý, ví dụ: chuyển hướng về trang đăng nhập
    header('Location: login.php');
    exit();
}

try{
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
} catch (MongoDBDriverExceptionException $e) {
    echo 'Failed to connect to MongoDB, is the service intalled and running?<br /><br />';
    echo $e->getMessage();
    exit();
}
    $query = new MongoDB\Driver\Query([],[]);
    $result = $conn->executeQuery('QLSV.Khoa', $query);
    
    if (isset($_GET['success']) && $_GET['success'] == true) {
        echo '<script>alert("Thêm khoa thành công!");</script>';
    }

    if (isset($_GET['success1']) && $_GET['success1'] == true) {
        echo '<script>alert("Chỉnh sửa khoa thành công!");</script>';
    }
?>
<!-- Mirrored from preschool.dreamguystech.com/html-template/departments.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:50 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Preskool - Departments</title>

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
        <form id="searchForm">
            <input type="text" class="form-control" id="searchInput" placeholder="Search here">
            <button type="button" class="btn" onclick="searchStudent()"><i class="fas fa-search"></i></button>
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
    <li class="submenu active">
        <a href="#"><i class="fas fa-building"></i> <span> Departments</span> <span class="menu-arrow"></span></a>
        <ul>
            <li><a href="departments.php" class="active" >Department List</a></li>
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
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Departments</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">Departments</li>
</ul>
</div>
<div class="col-auto text-right float-right ml-auto">
    <a href="#" class="btn btn-outline-primary mr-2" id="downloadBtn"><i class="fas fa-download"></i> Download</a>
<a href="add-department.php" class="btn btn-primary"><i class="fas fa-plus"></i></a>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card card-table">
<div class="card-body">
<div class="table-responsive">
<table class="table table-hover table-center mb-0 datatable">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>HOD</th>
<th>Office</th>
<th>No of Students</th>
<th class="text-right">Action</th>
</tr>
</thead>
<tbody>
  <?php
  foreach ($result as $rs){
    $maGiangVien = $rs->{'ma_giang_vien'};

// Đảm bảo $maGiangVien có giá trị

    // Sử dụng cùng một đối tượng kết nối cho cả hai truy vấn
    $query1 = new MongoDB\Driver\Query([], []);
    $result1 = $conn->executeQuery('QLSV.Giangvien', $query1);

    $queryGiaovien = new MongoDB\Driver\Query(['ma_giang_vien' => $maGiangVien]);
    $resultGiaovien = $conn->executeQuery('QLSV.Giangvien', $queryGiaovien);

    // Lấy bản ghi đầu tiên từ kết quả (nếu có)
    $giangVien = current($resultGiaovien->toArray());


    $maKhoa = $rs->{'ma_khoa'};
    $filter = ['ma_khoa' => $maKhoa];

    $query2 = new MongoDB\Driver\Query($filter, []);
    $result2 = $conn->executeQuery('QLSV.Sinhvien', $query2);

    $count = iterator_count($result2);

echo'<tr>
<td>'.$rs ->{'ma_khoa'}.'</td>
<td>
<h2>
<a>'.$rs->{'ten_khoa'}.'</a>
</h2>
</td>
<td>'. $giangVien->ten. '</td>
<td>'.$rs->{'phong'} .'</td>
<td>'.$count.'</td>
<td class="text-right">
<div class="actions">
<a href="edit-department.php?ma_khoa='.$rs -> {'ma_khoa'}.'" class="btn btn-sm bg-success-light mr-2">
<i class="fas fa-pen"></i>
</a>
</div>
</td>
</tr>';
}
  ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

<footer>
<p>Copyright © 2020 Dreamguys.</p>
</footer>

</div>

</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/plugins/datatables/datatables.min.js"></script>

<script src="assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script>
    var searchInput = document.getElementById("searchInput");
    document.getElementById("downloadBtn").addEventListener("click", function() {
        // Xuất dữ liệu thành file XLSX
        exportToXLSX();
    });
    // Thêm sự kiện "keydown" cho ô nhập liệu
    searchInput.addEventListener("keydown", handleEnterKey);
    function handleEnterKey(event) {
        // Kiểm tra xem phím được nhấn có phải là phím "Enter" không (mã phím 13)
        if (event.keyCode === 13) {
            // Ngăn chặn hành động mặc định của phím "Enter" trong ô nhập liệu
            event.preventDefault();

            // Gọi hàm tìm kiếm
            searchStudent();
        }
    }

    function searchStudent() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".datatable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            var nameColumn = tr[i].getElementsByTagName("td")[1]; // Adjust index based on your requirement
            var hodColumn = tr[i].getElementsByTagName("td")[2];  // Adjust index based on your requirement
            var officeColumn = tr[i].getElementsByTagName("td")[3]; // Adjust index based on your requirement
            var noOfStudentsColumn = tr[i].getElementsByTagName("td")[4]; // Adjust index based on your requirement

            if (nameColumn || hodColumn || officeColumn || noOfStudentsColumn) {
                var nameText = nameColumn.textContent || nameColumn.innerText;
                var hodText = hodColumn.textContent || hodColumn.innerText;
                var officeText = officeColumn.textContent || officeColumn.innerText;
                var noOfStudentsText = noOfStudentsColumn.textContent || noOfStudentsColumn.innerText;

                // Adjust the columns you want to filter based on your requirement
                if (nameText.toUpperCase().indexOf(filter) > -1 ||
                    hodText.toUpperCase().indexOf(filter) > -1 ||
                    officeText.toUpperCase().indexOf(filter) > -1 ||
                    noOfStudentsText.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function searchStudents() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".datatable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            var nameColumn = tr[i].getElementsByTagName("td")[1]; // Adjust index based on your requirement
            var hodColumn = tr[i].getElementsByTagName("td")[2];  // Adjust index based on your requirement
            var officeColumn = tr[i].getElementsByTagName("td")[3]; // Adjust index based on your requirement
            var noOfStudentsColumn = tr[i].getElementsByTagName("td")[4]; // Adjust index based on your requirement

            if (nameColumn || hodColumn || officeColumn || noOfStudentsColumn) {
                var nameText = nameColumn.textContent || nameColumn.innerText;
                var hodText = hodColumn.textContent || hodColumn.innerText;
                var officeText = officeColumn.textContent || officeColumn.innerText;
                var noOfStudentsText = noOfStudentsColumn.textContent || noOfStudentsColumn.innerText;

                // Adjust the columns you want to filter based on your requirement
                if (nameText.toUpperCase().indexOf(filter) > -1 ||
                    hodText.toUpperCase().indexOf(filter) > -1 ||
                    officeText.toUpperCase().indexOf(filter) > -1 ||
                    noOfStudentsText.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
        input.value = ''; // Clear the input field after searching
        exportToXLSX();
    }

    function exportToXLSX() {
        // Lấy phần tử bảng
        var table = document.querySelector(".datatable");

        // Tạo một workbook mới
        var wb = XLSX.utils.book_new();

        // Thêm một worksheet vào workbook
        var ws = XLSX.utils.table_to_sheet(table);

        // Thêm worksheet vào workbook
        XLSX.utils.book_append_sheet(wb, ws, "Departments");

        // Lưu workbook thành file XLSX
        XLSX.writeFile(wb, "departments.xlsx");
    }
</script>
</body>

<!-- Mirrored from preschool.dreamguystech.com/html-template/departments.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:50 GMT -->
</html>