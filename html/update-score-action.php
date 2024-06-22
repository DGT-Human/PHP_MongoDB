<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $score = $_POST['score'];
    $term = $_POST['term'];
    $maSinhVien = $_POST['ma_sinh_vien'];
    $maNhomHocPhan = $_POST['ma_nhom_hoc_phan'];
    
    // Extract other fields...

    // Create a document (record) to update in the database
    $studentDocument = [
        'diem' => $score,
        'hoc_ky'=>$term
        // Add other fields...
    ];


 // Specify the database and collection
 $databaseName = 'QLSV';
 $collectionName = 'Ketqua';

    // Create a MongoDB UpdateOne command
    $filter = ['ma_sinh_vien' =>  $maSinhVien, 'ma_nhom_hoc_phan' => $maNhomHocPhan];
    $update = ['$set' => $studentDocument];
    $command = new MongoDB\Driver\Command([
        'update' => $collectionName,
        'updates' => [['q' => $filter, 'u' => $update, 'upsert' => true]],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
        // header('Location: scores.php');

        $success1 = true;
        // Redirect to a success page or do other actions
        //header('Location: students.php');
        header('Location: scores.php?success1=' . $success1);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
