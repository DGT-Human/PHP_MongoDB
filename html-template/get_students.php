<?php
try {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Get the selected class ID from the AJAX request
    $classId = $_GET['class_id'];

    // Query to get students based on the selected class ID
    $filter = ['ma_lop' => $classId];
    $query = new MongoDB\Driver\Query($filter, []);

    // Execute the query
    $result = $conn->executeQuery('QLSV.Sinhvien', $query);

    // Generate options for the student dropdown
    $options = '';
    $options1 = '';
    foreach ($result as $document) {
        $options .= '<option value="' . $document->ma_sinh_vien . '">' . $document->ten . '</option>';


//    $filterDangKy = ['ma_sinh_vien' => $document->ma_sinh_vien];
//    $queryDangKy = new MongoDB\Driver\Query($filterDangKy, []);
//    $resultDangKy = $conn->executeQuery('Dangky', $queryDangKy);
//
//    foreach ($resultDangKy as $dangKy) {
//        // $dangKy->ma_hoc_phan, $dangKy->ten_hoc_phan là thông tin về học phần đã đăng ký
//        // Bạn có thể sử dụng thông tin này để xây dựng các options cho dropdown học phần
//        // Ví dụ: $options .= '<option value="' . $dangKy->ma_hoc_phan . '">' . $dangKy->ten_hoc_phan .k
//        // '</option>';
//
//        $options1 .= '<option value="' . $dangKy->ma_nhom_hoc_phan . '">' . $dangKy->ma_nhom_hoc_phan . '</option>';
//    }
//    }
    }


    // Return the generated options
    echo $options;
    //echo $options1;

} catch (MongoDB\Driver\Exception\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
