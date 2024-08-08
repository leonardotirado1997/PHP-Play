<?php

$dbPath = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$dbPath");;

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    header("Location: /?sucesso=0");
    exit();
}

$url = filter_input(INPUT_POST, "url", FILTER_VALIDATE_URL);
if ($url === false) {
    header("location: /?sucesso=0");
    exit();
}
$titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING);
if ($titulo === false) {
    header("location: /?sucesso=0");
    exit();
}

$sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':url', $url);
$stmt->bindValue(':title', $titulo);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

if ($stmt->execute() === false) {
    header("location: /?sucesso=0");
} else {
    header("Location: /?sucesso=1");
}
