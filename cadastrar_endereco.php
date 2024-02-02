<?php
// Verifica se o parâmetro "codigo" foi passado na URL
if (!isset($_GET['codigo'])) {
    echo "Erro: Código do cliente não fornecido.";
    exit;
}

$codigo_cliente = $_GET['codigo'];

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'dbconfig.php';
    
    // Recebe os dados do formulário
    $longadoro = $_POST['longadoro'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    // Verifica se o cliente com o código fornecido existe na tabela de clientes
    $checkCliente = "SELECT id FROM crud_clientes WHERE id = $codigo_cliente";
    $resultCliente = $conn->query($checkCliente);

    if ($resultCliente->num_rows == 0) {
        // Cliente não encontrado, exibe uma mensagem de erro ou redireciona para uma página de erro
        echo "Erro: Cliente não encontrado.";
        exit();
    }
    
    // Insira os dados na tabela de endereços sem consulta preparada
    $sql = "INSERT INTO crud_enderecos (longadoro, numero, bairro, rua, cidade, estado, cliente_id) 
        VALUES ('$longadoro', '$numero', '$bairro', '$rua', '$cidade', '$estado', '$codigo_cliente')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Endereço cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar endereço: " . $conn->error;
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Endereço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Cadastrar Endereço </h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?codigo=" . $codigo_cliente);?>">
            <div class="mb-3">
                <label for="longadoro" class="form-label">Longadoro:</label>
                <input type="text" class="form-control" id="longadoro" name="longadoro">
            </div>
            <div class="mb-3">
                <label for="numero" class="form-label">Número:</label>
                <input type="text" class="form-control" id="numero" name="numero">
            </div>
            <div class="mb-3">
                <label for="bairro" class="form-label">Bairro:</label>
                <input type="text" class="form-control" id="bairro" name="bairro">
            </div>
            <div class="mb-3">
                <label for="rua" class="form-label">Rua:</label>
                <input type="text" class="form-control" id="rua" name="rua">
            </div>
            <div class="mb-3">
                <label for="cidade" class="form-label">Cidade:</label>
                <input type="text" class="form-control" id="cidade" name="cidade">
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <input type="text" class="form-control" id="estado" name="estado">
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>
