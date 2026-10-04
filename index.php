<?php
include 'infra/connect.php';

$sql = "SELECT * FROM brinquedos";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar brinquedos: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Brinquedos</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <main>
        <h1>Gerenciador de Brinquedos</h1>
        <a href="public/cadastrar.php">Novo Brinquedo</a>
        <br>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Faixa Etária</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($brinquedo = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($brinquedo['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($brinquedo['categoria']) . "</td>";
                    echo "<td>" . htmlspecialchars($brinquedo['faixa_etaria']) . "</td>";
                    echo "<td>R$ " . number_format($brinquedo['preco'], 2, ',', '.') . "</td>";
                    echo "<td>{$brinquedo['estoque']}</td>";
                    echo "<td>
                            <a href='public/editar.php?id={$brinquedo['id']}'>Editar</a> |
                            <a href='public/excluir.php?id={$brinquedo['id']}' onclick=\"return confirm('Excluir este brinquedo?');\">Excluir</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>
