<?php 
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Connect to MongoDB
//     $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

//     // Extract data from the form
//     $studentID = $_POST['student_id'];
//     $score = $_POST['score'];
//     $studyGroupID = $_POST['ma_nhom_hoc_phan'];
    
//     // Extract other fields...

//     // Create a document (record) to insert into the database
//     $studentDocument = [
//         'ma_sinh_vien' => $studentID,
//         'ma_nhom_hoc_phan' => $studyGroupID,
//         'diem' => $score
//         // Add other fields...
//     ];

//     // Specify the database and collection
//     $databaseName = 'QLSV';
//     $collectionName = 'Ketqua';

//     // Create a MongoDB InsertOne command
//     $command = new MongoDB\Driver\Command([
//         'insert' => $collectionName,
//         'documents' => [$studentDocument],
//     ]);

//     try {
//         // Execute the command
//         $conn->executeCommand($databaseName, $command);

//         // Redirect to a success page or do other actions
//         header('Location: students.php');
//         exit();
//     } catch (MongoDB\Driver\Exception\Exception $e) {
//         echo 'Error: ' . $e->getMessage();
//     }
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Extract data from the form
    $studentID = $_POST['student_id'];
    $score = $_POST['score'];
    $term = $_POST['term'];
    $studyGroupID = $_POST['ma_nhom_hoc_phan'];
    
    // Specify the database and collection
    $databaseName = 'QLSV';
    $collectionName = 'Ketqua';

    // Specify the filter to find the document
    $filter = ['ma_sinh_vien' => $studentID, 'ma_nhom_hoc_phan' => $studyGroupID];

    $query = new MongoDB\Driver\Query($filter);

    // Execute the query
    $cursor = $conn->executeQuery("$databaseName.$collectionName", $query);
    $recordExists = count($cursor->toArray()) > 0;
    if($recordExists){

    }

    // Specify the update to be applied
    $update = [
        '$set' => ['diem' => $score, 'hoc_ky' => $term,],
        
        // Add other fields...
    ];

    // Specify the options
    $options = [
        'upsert' => true, // Insert if not found
    ];

    // Create a MongoDB UpdateOne command
    $command = new MongoDB\Driver\Command([
        'update' => $collectionName,
        'updates' => [['q' => $filter, 'u' => $update, 'upsert' => true]],
    ]);

    try {
        $success = true;
        $cursor = $conn->executeQuery("$databaseName.$collectionName", $query);
        $recordExists = count($cursor->toArray()) > 0;
        if($recordExists){
            $success = false;
        }
        // Execute the command
         $conn->executeCommand($databaseName, $command);
       
        
        // Redirect to a success page or do other actions
        //header('Location: scores.php');

    // Chuyển hướng đến trang thành công hoặc thực hiện các hành động khác
    header('Location: scores.php?success=' . $success);
        exit();
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

