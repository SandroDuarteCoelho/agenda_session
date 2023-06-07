<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- <link rel="stylesheet" type="text/css" href="./bootstrap-5.2.3-dist/css/bootstrap.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Agenda</title>

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
  

  <div class="row g-0">
    <div class="col-md-4">
      <img src="./images/b7.jpg" class="img-fluid rounded-start" alt="agenda">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <br><br>
        <h2 style="text-align: center">Bem-vindo à sua Agenda, <strong><?php echo $logado; ?></strong>.</h2>
        <br>
        <script>
          dayName = new Array("domingo", "segunda", "terça", "quarta", "quinta", "sexta", "sábado")
          monName = new Array("janeiro", "fevereiro", "março", "abril", "maio", "junho", "agosto", "outubro", "novembro", "dezembro")
          now = new Date
          document.write("<div style='text-align: center'><h1> Hoje é " + dayName[now.getDay()] + ", " + now.getDate() + " de " + monName[now.getMonth()] + " de " + now.getFullYear() + ". </h1>")
        </script>
        <div id="txt" style="font-size: 50px;"></div>
      </div>
    </div>
  </div>

  </div>
  <br>
  <div class="container text-center">
    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
      <div class="col">
        <div class="p-2">
          <form method="POST" action="adicionar.php">
            <input type="hidden" name="extra" value="1">
            <button type="submit" class="btn btn-outline-primary">Adicionar Evento</button>
          </form>
        </div>
      </div>
      <div class="col">
        <div class="p-2">
          <form method="POST" action="mev.php">
            <input type="hidden" name="extra" value="2">
            <button type="submit" class="btn btn-outline-primary">Eliminar Eventos</button>
          </form>
        </div>
      </div>
      <div class="col">
        <div class="p-2">
          <form method="POST" action="mev.php">
            <input type="hidden" name="extra" value="3">
            <button type="submit" class="btn btn-outline-primary">Modificar Eventos</button>
          </form>
        </div>
      </div>
      <div class="col">
        <div class="p-2">
          <form method="POST" action="mev.php">
            <input type="hidden" name="extra" value="4">
            <input type="hidden" name="id_utiizador" value="<?php echo $id_utilizador ?>">
            <button type="submit" class="btn btn-outline-primary">Ver Eventos</button>
          </form>
        </div>
      </div>

      <div class="col">
        <div class="p-2">
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">

              Outros

            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="index.php?valor=1">Sair
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                  </svg>
                </a></li>
              <li><a class="dropdown-item" href="gerir_utili.php">Gerir Conta
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                  </svg>
                </a></li>
              <li><button onclick=limparRegistos() class="dropdown-item">Limpar Registos
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                  </svg>
                </button></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- <div class="modal modal-signin position-static d-block py-2" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header p-3 pb-2 border-bottom-0">
          <h1 class="fw-bold mb-0 fs-5">Código de segurança</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3 pt-0">
          <form>
            <div class="form-floating mb-3">
              <input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
              <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 mb-2 btn btn rounded-3 btn-primary" type="submit">Verificar</button>
          </form>
        </div>
      </div>
    </div>
  </div> -->




  <?php
  include "tempo_restante.php";
  ?>



  <script>
    function limparRegistos() {
      var resultado = confirm("Tem certeza de que deseja excluir todos os eventos? Esta ação não pode ser desfeita.");
      if (resultado == true) {
        window.location.href = "verificadb.php";
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="./js/script.js"></script>
</body>

</html>