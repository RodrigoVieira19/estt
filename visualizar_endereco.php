<?php
// Verifique se o parâmetro "id" foi passado 
if (!isset($_GET['id'])) {
    echo "ID do cliente não fornecido.";
    exit;
}

$codigo_cliente = $_GET['id'];

require_once 'dbconfig.php';

// selecionar os endereços associados ao cliente especificado
$sql = "SELECT * FROM crud_enderecos WHERE cliente_id = $codigo_cliente";

$resultado = $conn->query($sql);
if (!$resultado) {
    echo "Erro na consulta SQL: " . $conn->error;
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Endereço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Longadoro</th>
                    <th scope="col">Número</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Rua</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["longadoro"] . "</td>";
                        echo "<td>" . $row["numero"] . "</td>";
                        echo "<td>" . $row["bairro"] . "</td>";
                        echo "<td>" . $row["rua"] . "</td>";
                        echo "<td>" . $row["cidade"] . "</td>";
                        echo "<td>" . $row["estado"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum endereço encontrado para este cliente.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
