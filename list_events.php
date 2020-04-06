<?php

    include_once 'connection.php';

    $stmt = $conn->prepare("SELECT * from events");
    $stmt->execute();
    $eventos = [];

    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $e){
        $eventos[] = ['id' => $e['id'], 'title' => $e['title'], 'color' => $e['color'], 'start' => $e['start'], 'end' => $e['end']];
    }

    echo json_encode($eventos);
?>