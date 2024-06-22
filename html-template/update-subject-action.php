<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $name = $_POST['name'];
    $ID = $_POST['ID'];
    $NOC = $_POST['NOC'];

    // Extract other fields...

    // Create a document (record) to update in the database
    $studentDocument = [
        'ten_hoc_phan' => $name,
        'ma_hoc_phan' => $ID,
        'so_tin_chi' => $NOC,

        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Hocphan';

    // Create a MongoDB UpdateOne command
    $filter = ['ma_hoc_phan' => $ID];
    $update = ['$set' => $studentDocument];
    $command = new MongoDB\Driver\Command([
        'update' => $collectionName,
        'updates' => [['q' => $filter, 'u' => $update, 'upsert' => true]],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
        //header('Location: subjects.php');

        $success1 = true;
        // Redirect to a success page or do other actions
        //header('Location: students.php');
        header('Location: subjects.php?success=' . $success1);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
