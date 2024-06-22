<!DOCTYPE html>
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
if(isset($_REQUEST['ma_sinh_vien']));
{
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
}
?>
<html lang="en">
   <!-- Mirrored from preschool.dreamguystech.com/html-template/edit-student.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:50 GMT -->
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <title>Preskool - Students</title>
      <link rel="shortcut icon" href="assets/img/favicon.png">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
      <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
      <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="assets/css/style.css">
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
       <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


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
                  <div class="row align-items-center">
                     <div class="col">
                        <h3 class="page-title">Edit Students</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="students.php">Students</a></li>
                           <li class="breadcrumb-item active">Edit Students</li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card">
                        <div class="card-body">
                           <form action="update-student-action.php" method="post">
                              <div class="row">
                                 <div class="col-12">
                                    <h5 class="form-title"><span>Student Information</span></h5>
                                 </div>
                                  <?php
                                  foreach ($result as $rs) {
                                      echo '<div class="col-12 col-sm-6">';
                                      echo '<div class="form-group">';
                                      echo '<label>Name</label>';
                                      echo '<input name="name" type="text" class="form-control" value="' . $rs->{'ten'} . '">';
                                      echo '</div>';
                                      echo '</div>';
                                      echo '<div class="col-12 col-sm-6">',
                                      '<div class="form-group">',
                                      '<label>Student Id</label><br>',
                                      
                                      '<label>'.$rs->{'ma_sinh_vien'}.'</label>',
                                          '<input type="hidden" class="form-control" name="id" value="'.$rs->{'ma_sinh_vien'}.'" >',
                                      '</div>',
                                      '</div>';
                                      echo '<div class="col-12 col-sm-6">',
                                      '<div class="form-group">',
                                      '<label>Email</label>',
                                          '<input name="email" type="text" class="form-control" value="'.$rs->{'email'}.'">',
                                      '</div>',
                                      '</div>';
                                      echo '<div class="col-12 col-sm-6">',
                                      '<div class="form-group">',
                                      '<label>Department</label>';
                                      echo '<select class="form-control" name="department">';
                                      foreach ($result3 as $rs3) {
                                       echo '<option value="' . $rs3->{'ma_khoa'} . '" ' . (($rs->{'ma_khoa'} == $rs3->{'ma_khoa'}) ? 'selected' : '') . '>'.$rs3->{'ten_khoa'}.'</option>';
                                       }
                                       echo '</select>';
                                      echo '</div>',
                                      '</div>';
                                      echo '<div class="col-12 col-sm-6">';
                                       echo '<div class="form-group">';
                                       echo '<label>Gender</label>';
                                       echo '<select class="form-control" name="gender">';
                                       echo '<option value="Female" ' . (($rs->{'gioi_tinh'} == 'Female') ? 'selected' : '') . '>Female</option>';
                                       echo '<option value="Male" ' . (($rs->{'gioi_tinh'} == 'Male') ? 'selected' : '') . '>Male</option>';
                                       echo '<option value="Others" ' . (($rs->{'gioi_tinh'} == 'Others') ? 'selected' : '') . '>Others</option>';
                                       echo '<option value="Select Gender" ' . (($rs->{'gioi_tinh'} == 'Select Gender') ? 'selected' : '') . '>Select Gender</option>';
                                       echo '</select>';
                                       echo '</div>';
                                       echo '</div>';
                                        echo '<div class="col-12 col-sm-6">';
                                      echo '<div class="form-group">';
                                      echo '<label>Class</label>';
                                      echo '<select class="form-control" name="class">';
                                      foreach ($result1 as $rs1) {
                                          echo '<option value="' . $rs1->{'ma_lop'} . '" ' . (($rs->{'ma_lop'} == $rs1->{'ma_lop'}) ? 'selected' : '') . '>'.$rs1->{'ma_lop'}.'</option>';
                                      }
                                      echo '</select>';
                                      echo '</div>';
                                      echo '</div>';
                                      echo '<div class="col-12 col-sm-6">';
                                      echo '<div class="form-group">';
                                      echo '<label>Major</label>';
                                      echo '<select class="form-control" name="major">';
                                      foreach ($result2 as $rs2) {
                                          echo '<option value="' . $rs2->{'ma_chuyen_nganh'} . '" ' . (($rs->{'ma_chuyen_nganh'} == $rs2->{'ma_chuyen_nganh'}) ? 'selected' : '') . '>'.$rs2->{'ten_chuyen_nganh'}.'</option>';
                                      }
                                      echo '</select>';
                                      echo '</div>';
                                      echo '</div>';
                                       echo ' <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Date of Birth</label>
                                                        <div>
                                                            <input name="DOB" type="text" class="form-control" id="datepicker" value="'.$rs->{'ngay_sinh'}.'">
                                                        </div>
                                                    </div>
                                                </div>';
                                    echo '<div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Mobile Number</label>
                                       <input name="phone" type="text" class="form-control" value="'.$rs->{'sdt'}.'">
                                    </div>
                                 </div>
                                 ',
                                 '<div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Status</label>
                                       <select class="form-control" name="status">
                                          <option>Đang học</option>
                                          <option>Nghỉ học</option>
                                          <option>Tôt nghiệp</option>
                                       </select>
                                    </div>
                                 </div>';
                                  }
                                  ?>
                                 <!-- <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Gender</label>
                                       <select class="form-control">
                                          <option>Female</option>
                                          <option>Select Gender</option>
                                          <option>Male</option>
                                          <option>Others</option>
                                       </select>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Date of Birth</label>
                                       <div>
                                          <input id="DOB" type="text" class="form-control" value="26 Apr 1994">
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Class</label>
                                       <input id="class" type="text" class="form-control" value="10">
                                    </div>
                                 </div>
                                 <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Religion</label>
                                       <input id="religion" type="text" class="form-control" value="Religion">
                                    </div>
                                 </div>
                                 
                                 <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                       <label>Mobile Number</label>
                                       <input id="phone" type="text" class="form-control" value="077 3499 9959">
                                    </div>
                                 </div> -->
                                 
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
      <script>
          flatpickr('#datepicker', {
              dateFormat: 'Y-m-d',
              // Các tùy chọn khác nếu cần
          });
      </script>

   </body>
   <!-- Mirrored from preschool.dreamguystech.com/html-template/edit-student.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:50 GMT -->
</html>