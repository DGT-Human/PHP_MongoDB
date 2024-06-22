<?php
// registration.php

function registerUser($name, $email, $password, $conn) {
    // Validate inputs (you may want to add more validation)
    if (empty($name) || empty($email) || empty($password)) {
        echo 'All fields are required.';
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Your MongoDB insert query here, using $hashedPassword for the password field
        $document = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
        ];

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert($document);

        try {
            $result = $conn->executeBulkWrite('QLSV.Taikhoan', $bulk);
           // echo 'User registered successfully.';
            

            //header('Location: login.php');
            $success3 = true;

            // Chuyển hướng đến trang thành công hoặc thực hiện các hành động khác
            header('Location: login.php?success3=' . $success3);
            exit();
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo 'Failed to register user.<br />';
            echo $e->getMessage();
        }
    }
}
?>
