<?php

include_once './connection.php';

$data_start = str_replace('/', '-', $_POST['start']);
$data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));

$data_end = str_replace('/', '-', $_POST['end']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

if (!empty($_POST['id'])){
    $stmt = $conn->prepare("UPDATE eventos SET titulo=:titulo, cor=:cor, inicio_evento=:inicio_evento, fim_evento=:fim_evento WHERE id=:id");
    $stmt->bindValue(':titulo', $_POST['title']);
    $stmt->bindValue(':cor', $_POST['color']);
    $stmt->bindValue(':inicio_evento', $data_start_conv);
    $stmt->bindValue(':fim_evento', $data_end_conv);
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();
}

header('Location: index.php');





