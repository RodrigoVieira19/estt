<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php
        // Verifique se o parâmetro 'id' está presente na URL
        if(isset($_GET['id'])) {
           
            require_once 'dbconfig.php';
            
            // Verifique se o formulário foi enviado
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // pegar os dados do formulario
                $id = $_POST['id'];
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $rg = $_POST['rg'];
                $email = $_POST['email'];
                $telefone1 = $_POST['telefone1'];
                $telefone2 = $_POST['telefone2'];
                $ativo = isset($_POST['ativo']) ? 1 : 0; // Converte o valor do campo ativo
        
                // atualizar os dados 
                $sql = "UPDATE crud_clientes SET nome='$nome', cpf='$cpf', rg='$rg', email='$email', telefone1='$telefone1', telefone2='$telefone2', ativo=$ativo WHERE id=$id";
                if ($conn->query($sql)) {
                    echo '<p>Usuário atualizado com sucesso</p>';
                } else {
                    echo '<div>Erro ao atualizar' . $conn->error . '</div>';
                }  
            }
        
            // pegar o id do usuaril na url
            $id = $_GET['id'];
        
            // selecionar os dados do usuário com o id fornecido
            $sql = "SELECT * FROM crud_clientes WHERE id = $id";
            $resultado = $conn->query($sql);
        
            // Verificar se há resultados
            if ($resultado->num_rows > 0) {
                //pegar os dados do usuaio
                $row = $resultado->fetch_assoc();
        ?>
                <h2>Atualizar Usuário</h2>
                <form method="post" action="atualizar.php?id=<?php echo $row['id']; ?>">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row['nome']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $row['cpf']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="rg" class="form-label">RG:</label>
                        <input type="text" class="form-control" id="rg" name="rg" value="<?php echo $row['rg']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefone1" class="form-label">Telefone 1:</label>
                        <input type="text" class="form-control" id="telefone1" name="telefone1" value="<?php echo $row['telefone1']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefone2" class="form-label">Telefone 2:</label>
                        <input type="text" class="form-control" id="telefone2" name="telefone2" value="<?php echo $row['telefone2']; ?>">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="ativo" name="ativo" <?php if ($row['ativo'] == 1) echo 'checked'; ?>>
                        <label class="form-check-label" for="ativo">Ativo</label>
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
        <?php
            } else {
                echo '<p>error</p>';
            }
            
            
            $conn->close();
        } else {
            echo '<p>error.</p>';
        }
        ?>
    </div>

</body>
</html>