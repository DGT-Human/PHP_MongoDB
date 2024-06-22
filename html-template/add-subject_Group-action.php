<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $name = $_POST['name'];
    $ID = $_POST['ID'];
    $id_sub = $_POST['id_sub'];
    $NOS = $_POST['NOS'];
    $DOW = $_POST['DOW'];
    $CS = $_POST['CS'];
    $NOL = $_POST['NOL'];


    // Extract other fields...

    // Create a document (record) to insert into the database
    $studentDocument = [
        'ten_nhom_hoc_phan' => $name,
        'ma_nhom_hoc_phan' => $ID,
        'ma_hoc_phan' => $id_sub,
        'so_luong' => $NOS,
        'thu' => $DOW,
        'tiet_bat_dau' => $CS,
        'so_tiet' => $NOL,
        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Nhomhocphan';

    // Create a MongoDB InsertOne command
    $command = new MongoDB\Driver\Command([
        'insert' => $collectionName,
        'documents' => [$studentDocument],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Redirect to a success page or do other actions
        header('Location: subjects_group_ID.php?ma_hoc_phan='.$id_sub);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
