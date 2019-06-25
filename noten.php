<!-- PHP Tag -->
<?php
// Includieren des dbconnectors
include('dbconnector.inc.php');
//starten der Session
session_start();
//error Variable LEER definieren
$error = '';
// Wenn die Methode des Servers POST ist wird der Code ausgeführt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fach erstellung
    if (isset($_POST['createFach'])) {
        // Clientseitige Validierung
        if (isset($_POST['fachname']) && !empty(trim($_POST['fachname'])) && strlen(trim($_POST['fachname'])) <= 45) {
            $fachname = htmlspecialchars(trim($_POST['fachname']));
        } else {
            $error .= "Fach input falsch";
        }
        // SQL Abfrage um Fächer hinzuzufügen
        if (empty($error)) {
            $query = "INSERT INTO faecher (name) VALUES (?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("s", $fachname);
            $stmt->execute();
            $stmt->close();
        }
    }

    //Noten hinzufügen
    if (isset($_POST['addNote'])) {
        $fachid = $_POST['fachid'];

        if (isset($_POST['pruefungname']) && !empty(trim($_POST['pruefungname'])) && strlen(trim($_POST['pruefungname'])) <= 45) {
            $pruefungname = htmlspecialchars(trim($_POST['pruefungname']));
        } else {
            $error .= "Pruefungsname input falsch";
        }

        if (isset($_POST['beschreibung']) && !empty(trim($_POST['beschreibung'])) && strlen(trim($_POST['beschreibung'])) <= 100) {
            $beschreibung = htmlspecialchars(trim($_POST['beschreibung']));
        } else {
            $error .= "Beschreibung input falsch";
        }

        if (isset($_POST['note'])) {
            if (!preg_match("/^(?=.*[1-6])[1-6](?:\.\d+)?/", $_POST['note'])) {
                $error .= "Die Note entspricht nicht dem geforderten Format.";
            } else {
                $note = floatval($_POST['note']);
            }
        } else {
            $error .= "Note input falsch";
        }
        // SQL Statement um Neine Prüfung (Note) zu erstellen
        if (empty($error)) {
            $query = "INSERT INTO pruefung (name, description, grade, Users_idUsers, Faecher_idFaecher) VALUES (?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("ssdii", $pruefungname, $beschreibung, $note, $_SESSION['userid'], $fachid);
            $stmt->execute();
            $stmt->close();
        }
    }
}


// Wenn man eingeloggt ist hat man im Header den Punkt "Noten" zur Auswahl.
if (isset($_SESSION['loggedin'])) {
    $Login = "<a href='logout.php'><button type=\"button\" class=\"btn btn-info\">Logout: " . $_SESSION['username'] . "</button></a>";
    $Noten = "<a class=\"nav-link\" href=\"noten.php\">Noten<span class=\"sr-only\">(current)</span></a>";
} else {
    header('Location: login.php');
    $Login = "<button type=\"button\" class=\"btn btn-primary disabled\">Logout</button>";
}

if (!empty($error)) {
    echo "<script type='text/javascript'>alert('$error');</script>";
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

    <title>Noten</title>
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
                            <?php
                            echo $Noten;
                            ?>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0"><?php
                                                            // Session wird Regeneriert
                                                            session_regenerate_id(true);
                                                            echo $Login;
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
                    <?php
                    // SQL Statement um die Fächer anzuzeigen. (DISCTINCT ist da, weil es jedes Fach nur 1 mal anzeigen darf)
                    $query = "SELECT DISTINCT f.name AS fach, f.idFaecher AS fachid 
                        FROM faecher f 
                        INNER JOIN pruefung p ON p.Faecher_idFaecher = f.idFaecher 
                        WHERE p.Users_idUsers = ? 
                        ORDER BY f.name ASC";
                    $stmt = $mysqli->prepare($query);
                    $stmt->bind_param("i", $_SESSION['userid']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    //Schleife welche, über alle Fächer loopt und dann immer die Durchschnitts des jeweiligen Faches holt
                    while ($row = $result->fetch_assoc()) {
                        $notequery = "SELECT AVG(grade) AS note FROM pruefung where Faecher_idFaecher = ?";
                        $notestmt = $mysqli->prepare($notequery);
                        $notestmt->bind_param("i", $row['fachid']);
                        // Wenn notestmt true ist wird das SQL Statement ausgeführt
                        if (!$notestmt->execute()) {
                            echo 'execute() failed ' . $mysqli->error . '<br />';
                        }
                        $noteresult = $notestmt->get_result();
                        if ($noteresult->num_rows) {
                            $avg = $noteresult->fetch_assoc();
                        }
                        ?>
                        <tr class="<?php
                                    // Ausgabe der Durchschnittsnote
                                    if ($avg['note'] >= 4) {
                                        echo 'table-success';
                                    } else {
                                        echo 'table-warning';
                                    }
                                    ?>">
                            <td scope="row">
                                <?php echo $row['fach']; ?>
                            </td>

                            <td>
                                <?php echo $avg["note"]; ?>
                            </td>
                        </tr>
                        <?php
                        $noteresult->free();
                        $notestmt->close();
                    }

                    $result->free();
                    $stmt->close();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Formular um eine Prüfung einzutragen -->
        <form name="noteform" method="post">
            <div class="input-group mb-3">
                <select name="fachid" class="form-control" id="fach_select">
                    <?php
                    $query = "SELECT * FROM faecher";
                    $stmt = $mysqli->prepare($query);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    // Gibt alle Fächer ins Select aus
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['idFaecher'] . "'>" . $row['name'] . "</option>";
                    }
                    $result->free();
                    $stmt->close();
                    ?>
                </select>

                <br />
                <!-- Inputs für eine Prüfung / Note einzutragen -->
                <input name="pruefungname" type="text" class="form-control" placeholder="Prüfung" aria-label="Prüfung" maxlength="45" required>
                <input name="beschreibung" type="text" class="form-control" placeholder="Beschreibung" aria-label="Beschreibung" maxlength="100" required>
                <input name="note" type="number" class="form-control" placeholder="1-6" aria-label="Note" required>
                <div class="input-group-append">
                    <input name="addNote" class="btn btn-success" type="submit" value="Note hinzufügen">
                </div>
            </div>
        </form>

        <!-- Inputs um ein Fach einzutragen -->
        <form name="fachform" method="post">
            <div class="input-group mb-3">
                <input name="fachname" type="text" class="form-control" placeholder="Fachname" aria-label="Fachname" maxlength="45" required>
                <div class="input-group-append">
                    <input name="createFach" class="btn btn-success" type="submit" value="Fach hinzufügen">
                </div>
            </div>
        </form>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>