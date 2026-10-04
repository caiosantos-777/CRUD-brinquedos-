<?php
include '../infra/connect.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $categoria = trim($_POST['categoria']);
    $faixa_etaria = trim($_POST['faixa_etaria']);
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    if ($nome == '' || $categoria == '' || $faixa_etaria == '' || $preco == '' || $estoque == '') {
        $erro = 'Preencha todos os campos.';
    } elseif (!is_numeric($preco) || $preco < 0) {
        $erro = 'O preço deve ser um número maior ou igual a zero.';
    } elseif (!is_numeric($estoque) || $estoque < 0) {
        $erro = 'O estoque deve ser um número maior ou igual a zero.';
    } else {
        $sql = "INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, estoque) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            die('Erro ao preparar a inserção: ' . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, 'sssdi', $nome, $categoria, $faixa_etaria, $preco, $estoque);

        if (mysqli_stmt_execute($stmt)) {
            echo "Brinquedo cadastrado com sucesso!";
            echo "<br><a href='../index.php'>Voltar</a>";
            mysqli_stmt_close($stmt);
            exit();
        } else {
            $erro = 'Erro ao cadastrar brinquedo: ' . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Brinquedos</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <?php
    if ($erro != '') {
        echo "<p>$erro</p>";
    }
    ?>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <br>
        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" id="categoria" required>
        <br>
        <label for="faixa_etaria">Faixa etária:</label>
        <input type="text" name="faixa_etaria" id="faixa_etaria" placeholder="Ex.: 3 a 6 anos" required>
        <br>
        <label for="preco">Preço:</label>
        <input type="number" name="preco" id="preco" step="0.01" min="0" required>
        <br>
        <label for="estoque">Estoque:</label>
        <input type="number" name="estoque" id="estoque" min="0" required>
        <br>
        <button type="submit">Cadastrar Brinquedo</button>
    </form>
    <button type="button" onclick="window.location.href='../index.php'">Voltar</button>
</body>

</html>
