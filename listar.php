<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Usuário não está logado, redireciona para a página de login
    header("Location: adm.php");
    exit();
}

// Verifica se o botão de logout foi acionado
if (isset($_POST['logout'])) {
    // Encerra a sessão e redireciona para a página de login
    session_unset();
    session_destroy();
    header("Location: adm.php");
    exit();
}

// Conectar ao banco de dados
require_once 'dbconfig.php';

// Selecionar todos os registros da tabela
$sql = "SELECT * FROM crud_clientes";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .inactive {
            background-color: #f2f2f2; /* Cor de fundo cinza para usuários inativos */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Listagem de Clientes</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <button type="submit" name="logout" class="btn btn-danger">Deslogar</button>
        </form>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>Email</th>
                    <th>Telefone 1</th>
                    <th>Telefone 2</th>
                    <th>Ativo</th>
                    <th>Editar</th>
                    <th>Endereco</th>
                    <th>Visualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        $class = $row["ativo"] ? "" : "inactive"; // Adiciona a classe "inactive" se o usuário estiver inativo
                        echo "<tr class='$class'>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nome"] . "</td>";
                        echo "<td>" . $row["cpf"] . "</td>";
                        echo "<td>" . $row["rg"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["telefone1"] . "</td>";
                        echo "<td>" . $row["telefone2"] . "</td>";
                        echo "<td>" . ($row["ativo"] ? "Sim" : "Não") . "</td>";

                        // Editar
                        echo "<td><a href='atualizar.php?id=" . $row["id"] . "'>Editar</a></td>";
                        // Adicionar endereço
                        echo "<td><a href='cadastrar_endereco.php?codigo=" . $row["id"] . "'>Adicionar Endereço</a></td>";
                        // Visualizar endereço
                        echo "<td><a href='visualizar_endereco.php?id=" . $row["id"] . "'>Visualizar Endereço</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Nenhum cliente encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
