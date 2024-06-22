<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $name = $_POST['name'];
    $gv = $_POST['gv'];
    $phong = $_POST['phong'];
    $objectIdString = $_POST['id'];
    
    // Extract other fields...

    // Create a document (record) to update in the database
    $studentDocument = [
        'ten_khoa' => $name,
        'phong' => $phong,
        'ma_giang_vien' => $gv
        // Add other fields...
    ];

    $objectId = new MongoDB\BSON\ObjectId($objectIdString);
    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Khoa';

    // Create a MongoDB UpdateOne command
    $filter = ['_id' =>  $objectId];
    $update = ['$set' => $studentDocument];
    $command = new MongoDB\Driver\Command([
        'update' => $collectionName,
        'updates' => [['q' => $filter, 'u' => $update, 'upsert' => true]],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
       // header('Location: departments.php');
       $success1 = true;
       // Redirect to a success page or do other actions
       //header('Location: students.php');
       header('Location: departments.php?success1=' . $success1);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
