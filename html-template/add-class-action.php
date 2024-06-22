<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $name = $_POST['name'];
    $classID = $_POST['classID'];
    $teacher = $_POST['teacher'];
  

    // Extract other fields...

    // Create a document (record) to insert into the database
    $studentDocument = [
        'ma_lop' => $classID,
        'ten_lop' => $name,
        'ma_giang_vien' => $teacher,
        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Lop';

    // Create a MongoDB InsertOne command
    $command = new MongoDB\Driver\Command([
        'insert' => $collectionName,
        'documents' => [$studentDocument],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        $success = true;

    // Chuyển hướng đến trang thành công hoặc thực hiện các hành động khác
    header('Location: classes.php?success=' . $success);
        // Redirect to a success page or do other actions
       // header('Location: classes.php');
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>