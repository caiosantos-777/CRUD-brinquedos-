<?php
include '../infra/connect.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM brinquedos WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultadoBrinquedo = mysqli_stmt_get_result($stmt);
$brinquedo = mysqli_fetch_assoc($resultadoBrinquedo);
mysqli_stmt_close($stmt);

if (!$brinquedo) {
    die('Brinquedo não encontrado.');
}

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
        $sql = "UPDATE brinquedos SET nome = ?, categoria = ?, faixa_etaria = ?, preco = ?, estoque = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssdii', $nome, $categoria, $faixa_etaria, $preco, $estoque, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Brinquedo atualizado com sucesso!";
            echo "<br><a href='../index.php'>Voltar</a>";
            mysqli_stmt_close($stmt);
            exit();
        } else {
            $erro = 'Erro ao atualizar brinquedo: ' . mysqli_error($conn);
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
    <title>Editar Brinquedo</title>
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
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($brinquedo['nome']); ?>" required>
        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" id="categoria" value="<?php echo htmlspecialchars($brinquedo['categoria']); ?>" required>
        <label for="faixa_etaria">Faixa etária:</label>
        <input type="text" name="faixa_etaria" id="faixa_etaria" value="<?php echo htmlspecialchars($brinquedo['faixa_etaria']); ?>" required>
        <label for="preco">Preço:</label>
        <input type="number" name="preco" id="preco" value="<?php echo $brinquedo['preco']; ?>" step="0.01" min="0" required>
        <label for="estoque">Estoque:</label>
        <input type="number" name="estoque" id="estoque" value="<?php echo $brinquedo['estoque']; ?>" min="0" required>
        <button type="submit">Atualizar Brinquedo</button>
    </form>
    <button type="button" onclick="window.location.href='../index.php'">Voltar</button>
</body>

</html>
