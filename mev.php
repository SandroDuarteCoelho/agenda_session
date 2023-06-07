<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Eventos</title>
  <!--  <link rel="stylesheet" type="text/css" href="./bootstrap-5.2.3-dist/css/bootstrap.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <?php
  session_start();
  if ((!isset($_SESSION['utilizador']) == true) and (!isset($_SESSION['senha']) == true)) {
    header('location:index.php');
  }

  $logado = $_SESSION['utilizador'];
  $id_utilizador = $_SESSION['id'];
  ?>

</head>

<body onload="time()">
  <?php
  session_start();
  ?>

  <br>
  <script>
    dayName = new Array("domingo", "segunda", "terça", "quarta", "quinta", "sexta", "sábado")
    monName = new Array("janeiro", "fevereiro", "março", "abril", "maio", "junho", "agosto", "outubro", "novembro", "dezembro")
    now = new Date
    document.write("<div style='text-align: center'><h1> Hoje é " + dayName[now.getDay()] + ", " + now.getDate() + " de " + monName[now.getMonth()] + " de " + now.getFullYear() + ". </h1>")
  </script>

  <div id="txt" style="font-size: 50px;"></div>


  <?php
  $valor = $_POST["extra"];
  /* echo $valor; */
  if ($valor == 4) {
    echo "<h1>Lista de Eventos</h1>";
  } elseif ($valor == 3) {
    echo "<h1>Modificar Evento</h1>";
  } else {
    echo "<h1>Eliminar Evento</h1>";
  }

  $servername = "localhost";
  $database = "Agenda";
  $username = "root";
  $password = "password";
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $database);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }



  $sql = "SELECT id, nome, locale, hora, notas, datas FROM Eventos WHERE id_utilizador=?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id_utilizador);

  if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
  } else {
    die('Erro ao executar a consulta: ' . mysqli_stmt_error($stmt));
  }

  ?>


  <div class="form-group">
    <?php if ($valor == "2") { ?>

      <div class="container text-center">
        <div class="row justify-content-md-center">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class='table table-light table-striped'>
                <thead class='table-dark'>
                  <tr>
                    <th>Nome</th>
                    <th>Local</th>
                    <th>Hora</th>
                    <th>Notas</th>
                    <th>Data</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["locale"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["hora"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["notas"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["datas"]) . "</td>";
                    echo "<td>";
                    echo "<form action='test.php' method='post'>";
                    echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                    echo "<input type='hidden' name='extra' value='2'>";
                    echo "<button type='submit' class='btn btn-danger'>Excluir</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                  }
                  mysqli_stmt_close($stmt);
                  mysqli_close($conn);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-dark mb-3" onclick="window.history.back()">Voltar</button>


    <?php } elseif ($valor == "3") { ?>
      <div class="container text-center">
        <div class="row justify-content-md-center">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class='table table-light table-striped'>
                <thead class='table-dark'>
                  <tr>
                    <th>Nome</th>
                    <th>Local</th>
                    <th>Hora</th>
                    <th>Notas</th>
                    <th>Data</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["locale"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["hora"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["notas"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["datas"]) . "</td>";
                    echo "<td>";
                    echo "<form action='adicionar.php' method='post'>";
                    echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                    echo "<input type='hidden' name='extra' value='3'>";
                    echo "<button type='submit' class='btn btn-warning'>Modificar</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                  }
                  mysqli_stmt_close($stmt);
                  mysqli_close($conn);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-dark mb-3" onclick="window.location.href='inicio.php'">Voltar</button>


    <?php } elseif ($valor == "4") { ?>
      <div class="container text-center">
        <div class="row justify-content-md-center">
          <div class="col-md-12">
            <div class="table-responsive">
              <?php
              echo "<table class='table table-light table-striped'>";
              echo "<thead class='table-dark'><tr><th>Nome</th><th>Local</th><th>Hora</th><th>Notas</th><th>Data</th></tr></thead>";
              echo "<tbody>";
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                /*  echo "<td>" . htmlspecialchars($row["id"]) . "</td>"; */
                echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["locale"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["hora"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["notas"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["datas"]) . "</td>";
                echo "</tr>";
              }
              echo "</tbody></table>";
              mysqli_stmt_close($stmt);
              mysqli_close($conn);
              ?>
            </div>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-success" onclick="window.print()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
          <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
          <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
        </svg>
        Imprimir
      </button>

      <button type="submit" class="btn btn-dark" onclick="window.location.href='inicio.php'">Voltar</button>
    <?php } ?>

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; Sandro Coelho 2023
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>

</html>