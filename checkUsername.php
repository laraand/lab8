<?php

    include '../../dbConnection.php';
    
    $conn = getDatabaseConnection("Lab8");
    
    $username = $_GET['username'];
    $sql = "SELECT * FROM lab8_user WHERE username =: $username ";
    
    $stmt = $conn->prepare(@sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    print_r($record);


?>