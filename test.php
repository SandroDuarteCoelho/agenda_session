<?php
session_start();
$id_utilizador = $_POST['id_utilizador'];
$id = $_POST['id'];
$nome = $_POST["nome"];
$local = $_POST["local"];
$hora = $_POST['hora'];
$notas = $_POST["notas"];
$data = $_POST["data"];
$utilizador = $_POST["utilizador"];
$senha = $_POST["senha"];

$servername = "localhost";
$database = "Agenda";
$username = "root";
$password = "password";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
/* if ($conn) {
      $version = mysqli_get_server_info($conn);
      echo "Versão do MariaDB: " . $version;
  } else {
      echo "Erro ao conectar ao banco de dados.";
  } */

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}


$fazer = $_POST["extra"];
if ($fazer == 0) login($utilizador, $senha);
if ($fazer == 1) adicionar($nome, $local, $hora, $notas, $data, $id_utilizador);
if ($fazer == 2) eliminar($id);
if ($fazer == 3) modificar($id, $nome, $local, $hora, $notas, $data);
if ($fazer == 4) logout();
if ($fazer == 5) novo_utilizador($utilizador, $senha);
if ($fazer == 6) alterar_utilizador($id_utilizador, $utilizador, $senha);
if ($fazer == 7) apagar_utilizador($id_utilizador);



function login($utilizador, $senha)
{
      global $conn;
      $N = 16384; // Fator de custo
      $r = 8; // Tamanho do bloco
      $p = 1; // Fator de paralelismo
      $hashLength = 32; // Tamanho da saída do hash em bytes

      // Crie uma consulta SQL para recuperar a senha encriptada e o salt do usuário especificado
      $selectQuery = "SELECT id, senha, salt FROM Utilizadores WHERE utilizador = ?";
      /* echo $utilizador; */

      // Prepare a instrução SQL
      $stmt = mysqli_prepare($conn, $selectQuery);

      // Verifique se a instrução foi preparada com sucesso
      if ($stmt) {
            // Defina os parâmetros da instrução
            mysqli_stmt_bind_param($stmt, 's', $utilizador);

            // Execute a instrução SQL
            mysqli_stmt_execute($stmt);

            // Obtenha o resultado da consulta
            $result = mysqli_stmt_get_result($stmt);

            // Verifique se a consulta retornou resultados
            if (mysqli_num_rows($result) > 0) {
                  // Recupere a senha encriptada e o salt do primeiro registro retornado
                  $row = mysqli_fetch_assoc($result);
                  /* $id = $row['id']; */

                  // Verifique se a senha fornecida pelo usuário é válida
                  $hashedPassword = hash_pbkdf2('sha256', $senha, $row['salt'], $N * $r * $p, $hashLength, true);

                  if ($hashedPassword === $row['senha']) {
                        // A senha é válida
                        $_SESSION['utilizador'] = $utilizador;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['id'] = $row['id'];
                      
                        // Crie um formulário oculto com um campo de entrada para o valor de $id
                        /* echo '<form id="redirectForm" method="post" action="inicio.php">';
                        echo '<input type="hidden" name="user" value="' .$utilizador. '">';
                        echo '<input type="hidden" name="id_user" value="' .$row['id']. '">';
                        echo '</form>';

                        echo '<script>';
                        echo 'document.getElementById("redirectForm").submit();'; 
                        echo '</script>'; */

                        header("Location: inicio.php?user=".$utilizador);
                        exit;
                  } else {
                        // A senha é inválida
                        unset($_SESSION['utilizador']);
                        unset($_SESSION['senha']);
                        header('Location: index.php');
                        exit;
                  }
            } else {
                  // O usuário não foi encontrado
                  unset($_SESSION['utilizador']);
                  unset($_SESSION['senha']);
                  header('Location: index.php');
                  exit;
            }

            // Libere a instrução preparada
            mysqli_stmt_close($stmt);
      } else {
            // Erro ao preparar a instrução SQL
            die('Erro ao preparar a instrução SQL: ' . mysqli_error($conn));
      }
}


function adicionar($nome, $local, $hora, $notas, $data, $id_utilizador)
{
      global $conn;

      // Prepara a query com os placeholders
      $sql = "INSERT INTO Eventos (nome, locale, hora, notas, datas, id_utilizador) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);

      // Verifica se a query foi preparada com sucesso
      if ($stmt === false) {
            echo "Erro ao preparar a query: " . mysqli_error($conn);
            return;
      }

      // Bind dos valores aos placeholders
      mysqli_stmt_bind_param($stmt, "ssssss", $nome, $local, $hora, $notas, $data, $id_utilizador);

      // Executa a query
      if (mysqli_stmt_execute($stmt)) {
            /*             echo "Novo registro criado com sucesso"; */
            mysqli_stmt_close($stmt);
            /*  mysqli_close($conn); */
            mysqli_close($conn);
            header('Location: inicio.php');
            exit;
      } else {
            echo "Erro ao executar a query: " . mysqli_error($conn);
      }

      // Fecha o statement e a conexão com o banco de dados
      mysqli_stmt_close($stmt);
      /*  mysqli_close($conn); */
      mysqli_close($conn);
      header('Location: inicio.php');
      exit;
}


function eliminar($id)
{

      global $conn;

      $id = mysqli_real_escape_string($conn, $id);

      // Prepare a statement
      $stmt = mysqli_prepare($conn, "DELETE FROM Eventos WHERE id = ?");

      // Bind the parameter
      mysqli_stmt_bind_param($stmt, "i", $id);

      // Execute the statement
      if (mysqli_stmt_execute($stmt)) {
            echo "Registro excluído com sucesso";
      } else {
            echo "Erro ao excluir registro: " . mysqli_error($conn);
      }

      // Close the statement
      mysqli_stmt_close($stmt);

      // Reset AUTO_INCREMENT to 1
      $sql = "ALTER TABLE Eventos AUTO_INCREMENT = 1;";

      if (mysqli_query($conn, $sql)) {
            echo "Tabela ordenada com sucesso";
      } else {
            echo "Erro ao ordenar tabela: " . mysqli_error($conn);
      }

      // Update the ids of the remaining records
      $sql = "UPDATE Eventos SET id = id - 1 WHERE id > " . $id . " ORDER BY id ASC;";

      if (mysqli_query($conn, $sql)) {
            echo "Tabela ordenada com sucesso";
      } else {
            echo "Erro ao ordenar tabela: " . mysqli_error($conn);
      }
      mysqli_close($conn);
      header('Location: inicio.php');
      exit;
}


function modificar($id, $nome, $local, $hora, $notas, $data)
{
      global $conn;
      // Prepare a consulta SQL com parâmetros
      $sql = "UPDATE Eventos SET nome = ?, locale = ?, hora = ?, notas = ?, datas = ? WHERE id = ?";
      $stmt = $conn->prepare($sql);

      // Verifique se a preparação da consulta foi bem sucedida
      if (!$stmt) {
            die('Erro ao preparar a consulta: ' . $conn->error);
      }

      // Defina os valores dos parâmetros e execute a consulta
      $stmt->bind_param('sssssi', $nome, $local, $hora, $notas, $data, $id);
      $result = $stmt->execute();

      // Verifique se a execução da consulta foi bem sucedida
      if (!$result) {
            die('Erro ao executar a consulta: ' . $conn->error);
      }
      mysqli_close($conn);
      header('Location: inicio.php');
      exit;
}

function logout()
{
      session_destroy();
      header("Location: index.php");
      exit;
}


function novo_utilizador($utilizador, $senha)
{
      // encriptar com algoritmo scrypt
      $N = 16384; // Fator de custo
      $r = 8; // Tamanho do bloco
      $p = 1; // Fator de paralelismo
      $hashLength = 32; // Tamanho da saída do hash em bytes
      $salt = openssl_random_pseudo_bytes(16); // Gere um salt aleatório

      $hashedPassword = hash_pbkdf2('sha256', $senha, $salt, $N * $r * $p, $hashLength, true);

      // Crie uma consulta SQL para inserir a senha encriptada na tabela de usuários
      global $conn;
      $insertQuery = "INSERT INTO Utilizadores (utilizador, senha, salt) VALUES ('$utilizador', '$hashedPassword', '$salt')";

      // Execute a consulta SQL usando a função mysqli_query
      if (mysqli_query($conn, $insertQuery)) {
            /* echo "Senha inserida com sucesso!"; */
            mysqli_close($conn);
            header('Location: index.php');
            exit;
      } else {
            echo "Erro ao inserir senha: " . mysqli_error($conn);
      }

      mysqli_close($conn);
      header('Location: index.php');
      exit;
}

function alterar_utilizador($id_utilizador, $utilizador, $senha)
{

      // encriptar com algoritmo scrypt
      $N = 16384; // Fator de custo
      $r = 8; // Tamanho do bloco
      $p = 1; // Fator de paralelismo
      $hashLength = 32; // Tamanho da saída do hash em bytes
      $salt = openssl_random_pseudo_bytes(16); // Gere um salt aleatório

      $hashedPassword = hash_pbkdf2('sha256', $senha, $salt, $N * $r * $p, $hashLength, true);

      global $conn;
      $updateQuery = "UPDATE Utilizadores SET utilizador = '$utilizador', senha = '$hashedPassword', salt = '$salt' WHERE id = $id_utilizador";

      // Execute a consulta SQL usando a função mysqli_query
      if (mysqli_query($conn, $updateQuery)) {
            echo "Atualização feita com sucesso!";
      } else {
            echo "Erro ao atualizar: " . mysqli_error($conn);
      }
      mysqli_close($conn);
      header('Location: inicio.php');
      exit;
}


function apagar_utilizador($id_utilizador)
{
      echo $id_utilizador;

      global $conn;
      $deleteUtilizadoresQuery = "DELETE FROM Utilizadores WHERE id = $id_utilizador";
      $deleteEventosQuery = "DELETE FROM Eventos WHERE id_utilizador = $id_utilizador";

      if ($conn->query($deleteUtilizadoresQuery) === TRUE && $conn->query($deleteEventosQuery) === TRUE) {
            echo "Apagado com sucesso!";
      } else {
            echo "Erro ao apagar: " . mysqli_error($conn);
      }
      mysqli_close($conn);
      header('Location: index.php');
      exit;
}
