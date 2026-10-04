<?php
$host = "localhost";
$user = "root";
$password = "root";
$database = "crud_brinquedos";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($host, $user, $password, $database);
    mysqli_set_charset($conn, "utf8mb4");
} catch (mysqli_sql_exception $e) {
    error_log('Falha na conexão: ' . $e->getMessage());
    die('Não foi possível conectar ao banco de dados.');
}
