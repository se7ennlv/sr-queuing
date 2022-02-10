<?php

include '../config/db.php';

try {
    $qNumber = $_POST['qNumber'];

    $sql = "INSERT INTO SRQTransactions (TranQueueNumber, TranDate) VALUES ('{$qNumber}', GETDATE()) ";

    $conn->beginTransaction();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $conn->commit();

    header('Content-Type: application/json');
    echo json_encode(array(
        "status" => "success",
        "message" => 'Inserted'
    ));
} catch (PDOException $ex) {
    header('Content-Type: application/json');
    echo json_encode(array(
        "status" => "danger",
        "message" => "Fail " . $ex->getMessage()
    ));

    $conn->rollBack();
}
$conn = null;
