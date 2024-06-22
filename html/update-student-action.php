<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $date = $_POST['DOB'];
    $class = $_POST['class'];
    $student_id = $_POST['id'];
    $department = $_POST['department'];
    $major = $_POST['major'];
    $status = $_POST['status'];
    $email = $_POST['email'];
    // Extract other fields...

    // Create a document (record) to update in the database
    $studentDocument = [
        'ten' => $name,
        'email' => $email,
        'gioi_tinh' => $gender,
        'sdt' => $phone,
        'ngay_sinh' => $date,
        'ma_chuyen_nganh' => $major,
        'ma_lop' => $class,
        'trang_thai' => $status,
        'ma_khoa' => $department
        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Sinhvien';

    // Create a MongoDB UpdateOne command
    $filter = ['ma_sinh_vien' => $student_id];
    $update = ['$set' => $studentDocument];
    $command = new MongoDB\Driver\Command([
        'update' => $collectionName,
        'updates' => [['q' => $filter, 'u' => $update, 'upsert' => true]],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
        //header('Location: students.php');
        $success1 = true;
        // Redirect to a success page or do other actions
        //header('Location: students.php');
        header('Location: students.php?success1=' . $success1);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
