<?php

$dbPath = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$dbPath");;

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

$sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $_POST ['url']);
$stmt->bindValue(2, $_POST ['titulo']);

if ($stmt->execute() === false) {
    header("Location: /?sucesso=0");
} else {
    header("Location: /?sucesso=1");
}
