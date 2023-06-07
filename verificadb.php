
<?php

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "Agenda";

// Cria conexão com o servidor MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro de conexão
if ($conn->connect_error) {
  die("Erro de conexão: " . $conn->connect_error);
}

// Limpar todos os registros da tabela Eventos
$sql = "TRUNCATE TABLE Eventos";
if (mysqli_query($conn, $sql)) {
  echo "Tabela Eventos foi truncada com sucesso";
} else {
  echo "Erro ao truncar tabela: " . mysqli_error($conn);
}

// Limpar todos os registros da tabela Utilizadores
$sql = "TRUNCATE TABLE Utilizadores";
if (mysqli_query($conn, $sql)) {
  echo "Tabela Utilizadores foi truncada com sucesso";
} else {
  echo "Erro ao truncar tabela: " . mysqli_error($conn);
}

$conn->close();

header("Location: index.php");
exit;

?>
