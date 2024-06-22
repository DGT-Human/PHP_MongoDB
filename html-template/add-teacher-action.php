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
    $status = $_POST['status'];
    $department = $_POST['department'];
    $status = $_POST['status'];
    $teacher_id = $_POST['teacher_id'];
    // Extract other fields...

    // Create a document (record) to insert into the database
    $teacherDocument = [
        'ten' => $name,
        'email' => $email,
        'gioi_tinh' => $gender,
        'sdt' => $phone,
        'ngay_sinh' => $date,
        'trang_thai' => $status,
        'ma_khoa' => $department,
        'trang_thai' => $status,
        'ma_giang_vien' =>  $teacher_id,
        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Giangvien';

    // Create a MongoDB InsertOne command
    $command = new MongoDB\Driver\Command([
        'insert' => $collectionName,
        'documents' => [$teacherDocument],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
        //header('Location: teachers.php');

        $success = true;

        // Chuyển hướng đến trang thành công hoặc thực hiện các hành động khác
        header('Location: teachers.php?success=' . $success);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>