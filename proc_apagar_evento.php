<?php

include_once './connection.php';

if (!empty($_POST['id'])) {
    $stmt = $conn->prepare("DELETE FROM eventos WHERE id=:id");
    $stmt->bindValue(":id", $_POST['id']);
    $stmt->execute();
}

header("Location: index.php");
