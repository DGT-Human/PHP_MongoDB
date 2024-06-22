<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $ID = $_POST['ID'];
    $name = $_POST['name'];
    $id_sub = $_POST['id_sub'];
    $DOW = $_POST['DOW'];
    $CS = $_POST['CS'];
    $NOL = $_POST['NOL'];

    // Extract other fields...

    // Create a document (record) to update in the database
    $studentDocument = [
        'ma_nhom_hoc_phan' => $ID,
        'ten_nhom_hoc_phan' => $name,
        'ma_hoc_phan' => $id_sub,
        'thu' => $DOW,
        'tiet_bat_dau' => $CS,
        'so_tiet' => $NOL,
        // Add other fields...
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Nhomhocphan';

    // Create a MongoDB UpdateOne command
    $filter = ['ma_nhom_hoc_phan' => $ID];
    $update = ['$set' => $studentDocument];
    $command = new MongoDB\Driver\Command([
        'update' => $collectionName,
        'updates' => [['q' => $filter, 'u' => $update, 'upsert' => true]],
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
