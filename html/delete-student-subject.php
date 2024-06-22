<?php
session_start();
if (isset($_SESSION['user_name'])) {
    // Add your MongoDB connection code here
    try{
        $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    } catch (MongoDBDriverExceptionException $e) {
        echo 'Failed to connect to MongoDB, is the service intalled and running?<br /><br />';
        echo $e->getMessage();
        exit();
    }
    // Get the subject ID from the URL
    $id_DK = $_GET['id_DK'];
    $MASV  = $_GET['ma_sinh_vien'];
    // Perform the deletion in the database
    // Replace the following line with your actual MongoDB delete operation
    $deleteQuery = new MongoDB\Driver\BulkWrite;
    $deleteQuery->delete(['id_DK' => $id_DK]);
    $result = $conn->executeBulkWrite('QLSV.Dangky', $deleteQuery);

    // Check if deletion was successful and redirect
    if ($result->getDeletedCount() > 0) {
        header('Location: students-subject_ID.php?ma_sinh_vien='.$MASV.''); // Redirect to the subjects page
        exit();
    } else {
        echo 'Failed to delete subject.';
        // Add error handling as needed
    }
} else {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

