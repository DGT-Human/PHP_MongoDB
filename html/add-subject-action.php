<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $name = $_POST['name'];
    $ID = $_POST['ID'];
    $NOC = $_POST['NOC'];


    // Extract other fields...

    // Create a document (record) to insert into the database
    $studentDocument = [
        'ten_hoc_phan' => $name,
        'ma_hoc_phan' => $ID,
        'so_tin_chi' => $NOC,

        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Hocphan';

    // Create a MongoDB InsertOne command
    $command = new MongoDB\Driver\Command([
        'insert' => $collectionName,
        'documents' => [$studentDocument],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
       // header('Location: subjects.php');
       $success = true;
        // Redirect to a success page or do other actions
        //header('Location: students.php');
        header('Location: subjects.php?success=' . $success);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
