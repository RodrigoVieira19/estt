<?php
// Incluir o arquivo de configuração do banco de dados
include 'dbconfig.php';

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os campos do formulário foram enviados
    if (isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['rg']) && isset($_POST['email']) && isset($_POST['telefone1'])) {
        // Atribuir valores dos campos do formulário às variáveis
        $nome      = $_POST['nome'];
        $cpf       = $_POST['cpf'];
        $rg        = $_POST['rg'];
        $email     = $_POST['email'];
        $telefone1 = $_POST['telefone1'];
        $telefone2 = isset($_POST['telefone2']) ? $_POST['telefone2'] : ''; // Verificar se telefone2 foi enviado

        // Determinar o valor de ativo (padrão: 1 se checkbox estiver marcada, caso contrário, 0)
        $ativo     = isset($_POST['ativo']) ? 1 : 0;

        // Inserir dados no banco de dados
        $query = "INSERT INTO crud_clientes (nome, cpf, rg, email, telefone1, telefone2, ativo) VALUES ('$nome', '$cpf', '$rg', '$email', '$telefone1', '$telefone2', '$ativo')";
        $result = $conn->query($query);

        if ($result === TRUE) {
            // Redirecionar para a página listar.php após o cadastro bem-sucedido
            header("Location: listar.php");
            exit();
        } else {
            echo "Erro ao cadastrar usuário: " . $conn->error;
        }
        $conn->close();
    } else {
        echo "Todos os campos do formulário devem ser preenchidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Cadastro de Usuário</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Campos do formulário -->
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="mb-3">
                <label for="rg" class="form-label">RG:</label>
                <input type="text" class="form-control" id="rg" name="rg" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefone1" class="form-label">Telefone 1:</label>
                <input type="text" class="form-control" id="telefone1" name="telefone1" required>
            </div>
            <div class="mb-3">
                <label for="telefone2" class="form-label">Telefone 2:</label>
                <input type="text" class="form-control" id="telefone2" name="telefone2">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1">
                <label class="form-check-label" for="ativo">Ativo</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>
