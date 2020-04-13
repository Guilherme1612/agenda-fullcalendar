<?php

    include_once 'connection.php';

    $stmt = $conn->prepare("SELECT * from eventos");
    $stmt->execute();
    $eventos = [];

    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $e){
        $eventos[] = ['id' => $e['id'], 'title' => $e['titulo'], 'color' => $e['cor'], 'start' => $e['inicio_evento'], 'end' => $e['fim_evento']];
    }

    echo json_encode($eventos);
?>