<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Adicionar Evento</title>

  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="./bootstrap-5.2.3-dist/css/bootstrap.css">
  
</head>

<body>
  <br>

  <div class="container text-center">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col">
        <div class="row row-cols-1 row-cols-md-3 g-0">
          <div class="card w-200 mx-auto" style="max-width: 21em;">
            <img src="./images/u2.jpg" class="card-img-top" alt="pessoas contentes" style="height: 229px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title text-center"><b>Novo Utilizador</b></h5>
              <br>
              <form action="test.php" method="POST" autocomplete="off">
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" name="utilizador" id="iutilizador" autocomplete="off" placeholder="name@example.com">
                  <input type="hidden" name="extra" value="5">
                  <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                  <input type="password" class="form-control" name="senha" id="isenha" autocomplete="off" placeholder="Password">
                  <label for="floatingPassword">Password</label>
                </div>
                <br>
                <div class="col-12 d-flex justify-content-center text-center">
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="submit" class="btn btn-warning">Registar</button>
                    <button type="submit" class="btn btn-dark" onclick="window.location.href='index.php'">Sair</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>


</html>