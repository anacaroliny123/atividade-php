<?php
$pdo = new PDO("mysql:host=localhost;dbname=seu_banco", "root", "");

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->execute([":id" => $id]);
}

header("Location: index.php");
exit;
