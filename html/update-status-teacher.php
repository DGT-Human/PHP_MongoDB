<?php
// Connect to MongoDB
$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Extract data from the URL
if (isset($_GET['ma_giang_vien'])) {
    $teacher_id = $_GET['ma_giang_vien'];

    // Find the student in the collection
    $filter = ['ma_giang_vien' => $teacher_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $conn->executeQuery('QLSV.Giangvien', $query);

    // Get the current status
    $current_status = 'Đang dạy'; // Assuming the default status is 'Đang học'
    foreach ($cursor as $document) {
        $current_status = $document->trang_thai;
    }

    // Determine the new status
    $new_status = ($current_status === 'Nghỉ hưu') ? 'Đang dạy' : 'Nghỉ hưu';

    // Create a document to update in the database
    $teacherDocument = [
        'trang_thai' => $new_status,
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Giangvien';

    // Create a MongoDB UpdateOne command
    $filter = ['ma_giang_vien' => $teacher_id];
    $update = ['$set' => $teacherDocument];
    $command = new MongoDB\Driver\Command([
        'update' => $collectionName,
        'updates' => [['q' => $filter, 'u' => $update, 'upsert' => true]],
    ]);

    try {
        // Execute the command
        $conn->executeCommand($databaseName, $command);

        // Send a response
        echo 'Update successful';
    } catch (MongoDB\Driver\Exception\Exception $e) {
        // Handle errors
        echo 'Error: ' . $e->getMessage();
    }
} else {
    // Handle invalid request
    echo 'Invalid request';
}
?>
