<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $name = $_POST['name'];
    $teacherID = $_POST['teacherID'];
    $classID = $_POST['classID'];
    // Extract other fields...

    // Create a document (record) to update in the database
    $studentDocument = [
        'ten_lop' => $name,
        'ma_giang_vien' => $teacherID,

        // Add other fields...
    ];


 // Specify the database and collection
 $databaseName = 'QLSV';
 $collectionName = 'Lop';

    // Create a MongoDB UpdateOne command
    $filter = ['ma_lop' =>  $classID];
    $update = ['$set' => $studentDocument];
    $command = new MongoDB\Driver\Command([
        'update' => $collectionName,
        'updates' => [['q' => $filter, 'u' => $update, 'upsert' => true]],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
       // header('Location: classes.php');
       $success1 = true;
       // Redirect to a success page or do other actions
       //header('Location: students.php');
       header('Location: classes.php?success1=' . $success1);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
