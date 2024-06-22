<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $major_id = $_POST['id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    // Extract other fields...

    // Create a document (record) to update in the database
    $majorDocument = [
        'ma_chuyen_nganh' => $major_id,
        'ten_chuyen_nganh' => $name,
        'ma_khoa' => $department
        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Chuyennganh';

    // Create a MongoDB UpdateOne command
    $filter = ['ma_chuyen_nganh' => $major_id];
    $update = ['$set' => $majorDocument];
    $command = new MongoDB\Driver\Command([
        'update' => $collectionName,
        'updates' => [['q' => $filter, 'u' => $update, 'upsert' => true]],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
        //header('Location: major.php');

        $success1 = true;
       // Redirect to a success page or do other actions
       //header('Location: students.php');
       header('Location: major.php?success1=' . $success1);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
