<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "sistema_escolar");

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criptografando a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Verifica se o nome de usuário é "adm" para definir como admin
    $tipo = ($nome === 'adm') ? 'admin' : 'usuario';

    // Inserir no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES ('$nome', '$email', '$senha_hash', '$tipo')";
    
    if ($conn->query($sql) === TRUE) {
        // Criar sessão e redirecionar para login após criação da conta
        session_start();
        $_SESSION['usuario_nome'] = $nome;
        $_SESSION['usuario_email'] = $email;
        $_SESSION['usuario_tipo'] = $tipo;

        // Redireciona para a página de login após criação da conta
        header("Location: index.php");
        exit();
    } else {
        $mensagem = "Erro ao criar conta: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Criar Conta</h2>

        <?php if ($mensagem): ?>
            <div class="alert alert-danger">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="criar_conta.php">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Criar Conta</button>
        </form>
    </div>
</body>
</html>
