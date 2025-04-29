<?php
// Conexão com o banco
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "meu_banco";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT id, nome, email, idade FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #888;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Usuários Cadastrados</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Idade</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Gerar linhas da tabela
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["idade"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhum usuário encontrado</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$conn->close();
?>

</body>
</html>