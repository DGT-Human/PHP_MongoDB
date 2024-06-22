<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $department = $_POST['department'];
    $class = $_POST['class'];
    $status = $_POST['status'];
    $student_id = $_POST['student_id'];
    $CN = $_POST['CN'];
    $schoolYear = $_POST['schoolyear'];
    // Extract other fields...

    // Create a document (record) to insert into the database
    $studentDocument = [
        'ten' => $name,
        'email' => $email,
        'gioi_tinh' => $gender,
        'sdt' => $phone,
        'ngay_sinh' => $date,
        'ma_khoa' => $department,
        'ma_lop' => $class,
        'trang_thai' => $status,
        'ma_sinh_vien' =>  $student_id,
        'ma_chuyen_nganh' => $CN,
        'ma_nien_khoa' => $schoolYear
        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Sinhvien';

    // Create a MongoDB InsertOne command
    $command = new MongoDB\Driver\Command([
        'insert' => $collectionName,
        'documents' => [$studentDocument],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);
        
        $success = true;
        // Redirect to a success page or do other actions
        //header('Location: students.php');
        header('Location: students.php?success=' . $success);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>