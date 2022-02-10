<?php

include '../config/db.php';

try {
    $sql = "SELECT QueueNumber = FORMAT(ISNULL(MAX(TranQueueNumber), 0) + 1, '00') FROM SRQTransactions WHERE TranDate = CONVERT(DATE, GETDATE())";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchColumn();
    $jsonData = json_encode($result);

    header('Content-Type: application/json');
    echo $jsonData;

} catch (PDOException $ex) {
    header('Content-Type: application/json');
    echo json_encode(array(
        "status" => "danger",
        "message" => "Fail " . $ex->getMessage()
    ));
}

$conn = null;
