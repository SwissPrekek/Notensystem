<?php


include('dbconnector.inc.php');

if (empty($error)) {

  // TODO SELECT Query erstellen, user und passwort mit Datenbank vergleichen
  $query = "select * from users";
  // TODO prepare()
  $stmt = $mysqli->prepare($query);


  // TODO execute()
  if (!$stmt->execute()) {
    echo "Ausführung";
    $error .= 'execute() failed ' . $mysqli->error . '<br />';
  }
  $result = $stmt->get_result();
  if ($result->num_rows) {
    $row = $result->fetch_assoc();

    }
  }



?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

  <div id="container">

    <div id="navbar">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Notenverwaltung</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registrierung.php">Registrieren</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <?
      phpsession_start();
      session_regenerate_id(true);
      echo ($_SESSION["username"]);
      ?>
    </form>
  </div>
</nav>
    </div>

    <div id="notentabelle">
    <table class="table table-hover">
      <thead>
      <tr class="table-active">
        <th scope="col">Fach</th>
        <th scope="col">Note</th>
      </tr>
      </thead>
      <tbody>
      <tr class="table-success">
        <th scope="row">Deutsch</th>
        <td>5.0</td>
      </tr>
      <tr class="table-success">
        <th scope="row">Franz</th>
        <td>4.7</td>

      </tr>
      <tr class="table-warning">
        <th scope="row">Mathe</th>
        <td>3</td>
      </tr>
      </tbody>
    </table>
    </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>