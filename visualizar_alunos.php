<?php
// Conexão com o BD
$conn = new mysqli("localhost", "root", "", "sistema_escolar");

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Buscar todos os alunos do BD
$sql = "SELECT id, nome, rgm, turma, nota1, nota2, media FROM alunos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Lista de Alunos</h2>
        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Turma</th>
                    <th>RGM</th>
                    <th>Nota 1</th>
                    <th>Nota 2</th>
                    <th>Média</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli("localhost", "root", "", "sistema_escolar");
                $sql = "SELECT * FROM alunos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['nome']}</td>
                                <td>{$row['turma']}</td>
                                <td>{$row['rgm']}</td>
                                <td>{$row['nota1']}</td>
                                <td>{$row['nota2']}</td>
                                <td>{$row['media']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Nenhum aluno registrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

