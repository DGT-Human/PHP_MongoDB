<?php
// Connect to MongoDB
$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Extract data from the URL
if (isset($_GET['ma_sinh_vien'])) {
    $student_id = $_GET['ma_sinh_vien'];

    // Find the student in the collection
    $filter = ['ma_sinh_vien' => $student_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $conn->executeQuery('QLSV.Sinhvien', $query);

    // Get the current status
    $current_status = 'Đang học'; // Assuming the default status is 'Đang học'
    foreach ($cursor as $document) {
        $current_status = $document->trang_thai;
    }

    // Determine the new status
    $new_status = ($current_status === 'Tốt nghiệp') ? 'Đang học' : 'Tốt nghiệp';

    // Create a document to update in the database
    $studentDocument = [
        'trang_thai' => $new_status,
    ];

    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Sinhvien';

    // Create a MongoDB UpdateOne command
    $filter = ['ma_sinh_vien' => $student_id];
    $update = ['$set' => $studentDocument];
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
