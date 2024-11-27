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
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o login é do admin (sem necessidade de email)
    if ($email === 'adm' && $senha === '1234') {
        // Cria a sessão para o admin
        session_start();
        $_SESSION['usuario_id'] = 0; // Id fictício para admin
        $_SESSION['usuario_nome'] = 'Administrador';
        $_SESSION['usuario_email'] = 'admin';
        $_SESSION['usuario_tipo'] = 'admin';

        // Redireciona para a página de visualizar alunos (admin)
        header("Location: visualizar_alunos.php");
        exit();
    }

    // Para outros usuários, consulta o banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        // O email foi encontrado no banco, agora vamos verificar a senha
        $usuario = $resultado->fetch_assoc();
        $senha_hash = $usuario['senha'];  // A senha armazenada no banco de dados

        // Verifica se a senha fornecida é a mesma que a criptografada
        if (password_verify($senha, $senha_hash)) {
            // Senha correta
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['usuario_tipo'] = $usuario['tipo']; // 'admin' ou 'usuario'

            // Redireciona para a página de notas após login
            header("Location: notas.php");
            exit();
        } else {
            // Senha incorreta
            $mensagem = "Senha incorreta!";
        }
    } else {
        // Email não encontrado
        $mensagem = "Email não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Login</h2>
        
        <!-- Exibe a mensagem de erro ou sucesso -->
        <?php if ($mensagem): ?>
            <div class="alert alert-danger">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" required> <!-- Alterado para aceitar texto para o admin -->
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>

        <!-- Botão de Criar Conta -->
        <div class="mt-3">
            <a href="criar_conta.php" class="btn btn-secondary">Criar Conta</a>
        </div>
    </div>
</body>
</html>
