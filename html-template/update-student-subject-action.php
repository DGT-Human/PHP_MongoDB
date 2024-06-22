<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $id_DK = $_POST['id_DK'];
    $id_NHP = $_POST['id_NHP'];

    // Extract other fields...

    // Create a document (record) to update in the database
    $studentDocument = [
        'id_DK' => $id_DK,
        'ma_nhom_hoc_phan' => $id_NHP,

        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Dangky';

    // Create a MongoDB UpdateOne command
    $filter = ['id_DK' => $id_DK];
    $update = ['$set' => $studentDocument];
    $command = new MongoDB\Driver\Command([
        'update' => $collectionName,
        'updates' => [['q' => $filter, 'u' => $update, 'upsert' => true]],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
        header('Location: students-subject.php');
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
