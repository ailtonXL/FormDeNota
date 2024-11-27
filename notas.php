<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "sistema_escolar");

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Mensagem de feedback
$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $rgm = $_POST['rgm'];
    $turma = $_POST['turma'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];

    // Calcula a média
    $media = ($nota1 + $nota2) / 2;

    // Insere os dados no banco de dados
    $sql = "INSERT INTO alunos (nome, rgm, turma, nota1, nota2, media) 
            VALUES ('$nome', '$rgm', '$turma', $nota1, $nota2, $media)";

    if ($conn->query($sql) === TRUE) {
        $mensagem = "Notas salvas com sucesso!";
    } else {
        $mensagem = "Erro ao salvar as notas: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Notas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Formulário de Notas</h2>
        
        <!-- Exibe a mensagem de sucesso ou erro -->
        <?php if ($mensagem): ?>
            <div class="alert alert-info">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="notas.php">
            <div class="form-group">
                <label for="nome">Nome do Aluno</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="rgm">RGM do Aluno</label>
                <input type="text" name="rgm" id="rgm" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="turma">Turma do Aluno</label>
                <input type="text" name="turma" id="turma" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nota1">Nota 1</label>
                <input type="number" name="nota1" id="nota1" class="form-control" step="0.01" min="0" max="10" required>
            </div>

            <div class="form-group">
                <label for="nota2">Nota 2</label>
                <input type="number" name="nota2" id="nota2" class="form-control" step="0.01" min="0" max="10" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Notas</button>
        </form>

        <!-- Botão para voltar para o login -->
        <a href="index.php" class="btn btn-secondary mt-3">Voltar para o Login</a>
    </div>
</body>
</html>
