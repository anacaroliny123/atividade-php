<?php
$pdo = new PDO("mysql:host=localhost;dbname=seu_banco", "root", "");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nome = $_POST["nome"] ?? '';
  $email = $_POST["email"] ?? '';
  $criado_em = $_POST["criado_em"] ?? '';

  if ($nome && $email && $criado_em) {
      $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, criado_em) VALUES (:nome, :email, :criado_em)");
      $stmt->execute([
          ":nome" => $nome,
          ":email" => $email,
          ":criado_em" => $criado_em
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
  <title>Criar Usuário</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 20px; }
    form { background: white; padding: 20px; max-width: 400px; margin: auto; border-radius: 6px; box-shadow: 0 0 10px #ccc; }
    input { width: 94%; padding: 10px; margin-bottom: 10px; }
    button { padding: 10px 20px; background: #2196F3; color: white; border: none; cursor: pointer; }
    .error { color: red; text-align: center; }
  </style>
</head>
<body>

<h2 style="text-align: center;">Adicionar Novo Usuário</h2>

<?php if (!empty($erro)): ?>
  <p class="error"><?= $erro ?></p>
<?php endif; ?>

<form method="POST">
  <input type="text" name="nome" value="<?= htmlspecialchars($nome ?? '') ?>" required>
  <input type="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>
  <input type="date" name="criado_em" value="<?= htmlspecialchars($criado_em ?? '') ?>" required>
  <button type="submit">Atualizar</button>
</form>

</body>
</html>
