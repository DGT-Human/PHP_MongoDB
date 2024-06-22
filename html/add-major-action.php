<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $major_id = $_POST['id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    
    // Extract other fields...

    // Create a document (record) to insert into the database
    $studentDocument = [
        'ma_chuyen_nganh' => $major_id,
        'ten_chuyen_nganh' => $name,
        'ma_khoa' => $department,
        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Chuyennganh';

    // Create a MongoDB InsertOne command
    $command = new MongoDB\Driver\Command([
        'insert' => $collectionName,
        'documents' => [$studentDocument],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
        //header('Location: major.php');
        $success = true;

        // Chuyển hướng đến trang thành công hoặc thực hiện các hành động khác
        header('Location: major.php?success=' . $success);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>