<?php
// Conexão com o banco de dados
require_once 'dbconfig.php';

// Inicialização de variáveis
$search_results = '';

// Processamento do formulário de pesquisa quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome'])) {
    // Limpa e armazena o termo de pesquisa
    $nome_pesquisado = trim($_POST['nome']);

    // Consulta SQL para recuperar informações do usuário pelo nome
    $sql = "SELECT nome, cpf, email FROM crud_clientes WHERE nome LIKE '%$nome_pesquisado%'";
    $result = $conn->query($sql);

    // Construção dos resultados da pesquisa
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $search_results .= "<p>Nome: " . $row['nome'] . "<br>CPF: " . $row['cpf'] . "<br>Email: " . $row['email'] . "</p>";
        }
    } else {
        // Se nenhum resultado foi encontrado, exibir uma mensagem
        $search_results = "Nenhum resultado encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pesquisa de Usuários</title>
    <!-- Adicionando Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .search-container {
            margin-top: 50px;
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 search-container">
                <h2 class="mb-3">Pesquisa de Usuários</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">OK</button>
                </form>

                <div class="mt-4">
                    <?php echo $search_results; ?>
                </div>
            </div>
        </div>
    </div>

  
    <div class="container mt-4 text-center">
        <a href="cadastrar.php" class="btn btn-success">Ou deseja se cadastrar?</a>
    </div>
</body>
</html>

<?php

$conn->close();
?>
