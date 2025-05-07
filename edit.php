<?php
$pdo = new PDO("mysql:host=localhost;dbname=seu_banco", "root", "");

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? '';
    $email = $_POST["email"] ?? '';
    $criado = $_POST["criado"] ?? '';



    if ($nome && $email) {
        $stmt = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, criado_em = :criado WHERE id = :id");
        $stmt->execute([
            ":nome" => $nome,
            ":email" => $email,
            ":criado" => $criado,
            ":id" => $id
        ]);
        header("Location: index.php");
        exit;
    } else {
        $erro = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuário</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 20px; }
    form { background: white; padding: 20px; max-width: 400px; margin: auto; border-radius: 6px; box-shadow: 0 0 10px #ccc; }
    input { width: 94%; padding: 10px; margin-bottom: 10px; }
    button { padding: 10px 20px; background: #4CAF50; color: white; border: none; cursor: pointer; }
    .error { color: red; text-align: center; }
  </style>
</head>
<body>

<h2 style="text-align: center;">Editar Usuário</h2>

<?php if (!empty($erro)): ?>
  <p class="error"><?= $erro ?></p>
<?php endif; ?>

<form method="POST">
  <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
  <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
  <input type="date" name="criado" value="<?= htmlspecialchars($usuario['criado_em']) ?>" required>
  <button type="submit">Atualizar</button>
</form>

</body>
</html>
