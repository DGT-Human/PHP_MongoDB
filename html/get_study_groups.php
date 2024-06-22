<?php
try {
    // Connect to MongoDB
    $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Get the selected class ID from the AJAX request
    $ma_hoc_phan = $_GET['ma_hoc_phan'];

    // Query to get students based on the selected class ID
    $filter = ['ma_hoc_phan' => $ma_hoc_phan];
    $query = new MongoDB\Driver\Query($filter, []);

    // Execute the query
    $result = $conn->executeQuery('QLSV.Nhomhocphan', $query);

    // Generate options for the student dropdown
    $options = '';
    foreach ($result as $document) {
        $options .= '<option value="' . $document->ma_nhom_hoc_phan . '">' . $document->ten_nhom_hoc_phan . '</option>';
    }

    // Return the generated options
    echo $options;

} catch (MongoDB\Driver\Exception\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
