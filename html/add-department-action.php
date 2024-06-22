<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $name = $_POST['name'];
    $hod = $_POST['hod'];
    $phong = $_POST['phong'];
    $ma_khoa = $_POST['ma_khoa'];

    // Extract other fields...

    // Create a document (record) to insert into the database
    $studentDocument = [
        'ma_khoa' => $ma_khoa,
        'ten_khoa' => $name,
        'ma_giang_vien' => $hod,
        'phong' => $phong
        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Khoa';

    // Create a MongoDB InsertOne command
    $command = new MongoDB\Driver\Command([
        'insert' => $collectionName,
        'documents' => [$studentDocument],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
        //header('Location: departments.php');

        $success = true;

    // Chuyển hướng đến trang thành công hoặc thực hiện các hành động khác
    header('Location: departments.php?success=' . $success);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>