<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $ID_SV = $_POST['id_SV'];
    $ID_NHP = $_POST['id_NHP'];
    $ID_DK = $_POST['id_DK'];
    $term = $_POST['term'];


    // Extract other fields...

    // Create a document (record) to insert into the database
    $studentDocument = [
        'id_DK' => $ID_DK,
        'ma_sinh_vien' => $ID_SV,
        'ma_nhom_hoc_phan' => $ID_NHP,
        'hoc_ky' => $term,

        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Dangky';

    // Create a MongoDB InsertOne command
    $command = new MongoDB\Driver\Command([
        'insert' => $collectionName,
        'documents' => [$studentDocument],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
        header('Location: students-subject_ID.php?ma_sinh_vien='.$ID_SV);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
