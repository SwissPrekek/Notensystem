<?php

//Datenbankverbindung
include('dbconnector.inc.php');

session_start();
if (isset($_SESSION['loggedin'])) {
    $Noten = "<a class=\"nav-link\" href=\"noten.php\">Noten<span class=\"sr-only\">(current)</span></a>";
} else {
}

// Initialisierung
$error = $message = '';
$firstname = $lastname = $email = $username = '';

// Wurden Daten mit "POST" gesendet?
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Ausgabe des gesamten $_POST Arrays
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // vorname vorhanden, mindestens 1 Zeichen und maximal 30 Zeichen lang
    if (isset($_POST['firstname']) && !empty(trim($_POST['firstname'])) && strlen(trim($_POST['firstname'])) <= 30) {
        // Spezielle Zeichen Escapen > Script Injection verhindern
        $firstname = htmlspecialchars(trim($_POST['firstname']));
    } else {
        // Ausgabe Fehlermeldung
        $error .= "Geben Sie bitte einen korrekten Vornamen ein.<br />";
    }

    // nachname vorhanden, mindestens 1 Zeichen und maximal 30 zeichen lang
    if (isset($_POST['lastname']) && !empty(trim($_POST['lastname'])) && strlen(trim($_POST['lastname'])) <= 30) {
        // Spezielle Zeichen Escapen > Script Injection verhindern
        $lastname = htmlspecialchars(trim($_POST['lastname']));
    } else {
        // Ausgabe Fehlermeldung
        $error .= "Geben Sie bitte einen korrekten Nachnamen ein.<br />";
    }

    // emailadresse vorhanden, mindestens 1 Zeichen und maximal 100 zeichen lang
    if (isset($_POST['email']) && !empty(trim($_POST['email'])) && strlen(trim($_POST['email'])) <= 100) {
        $email = htmlspecialchars(trim($_POST['email']));
        // korrekte emailadresse?
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $error .= "Geben Sie bitte eine korrekte Email-Adresse ein<br />";
        }
    } else {
        // Ausgabe Fehlermeldung
        $error .= "Geben Sie bitte eine korrekte Email-Adresse ein.<br />";
    }

    // benutzername vorhanden, mindestens 6 Zeichen und maximal 30 zeichen lang
    if (isset($_POST['username']) && !empty(trim($_POST['username'])) && strlen(trim($_POST['username'])) <= 30) {
        $username = trim($_POST['username']);
        // entspricht der benutzername unseren vogaben (minimal 6 Zeichen, Gross- und Kleinbuchstaben)
        if (!preg_match("/(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}/", $username)) {
            $error .= "Der Benutzername entspricht nicht dem geforderten Format.<br />";
        }
    } else {
        // Ausgabe Fehlermeldung
        $error .= "Geben Sie bitte einen korrekten Benutzernamen ein.<br />";
    }

    // passwort vorhanden, mindestens 8 Zeichen
    if (isset($_POST['password']) && !empty(trim($_POST['password']))) {
        $password = trim($_POST['password']);
        //entspricht das passwort unseren vorgaben? (minimal 8 Zeichen, Zahlen, Buchstaben, keine Zeilenumbrüche, mindestens ein Gross- und ein Kleinbuchstabe)
        if (!preg_match("/(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)) {
            $error .= "Das Passwort entspricht nicht dem geforderten Format.<br />";
        }
    } else {
        // Ausgabe Fehlermeldung
        $error .= "Geben Sie bitte einen korrekten Nachnamen ein.<br />";
    }

    // wenn kein Fehler vorhanden ist, schreiben der Daten in die Datenbank
    if (empty($error)) {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare("INSERT INTO users (firstname, lastname, username, password, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $username, $hash, $email);
        $stmt->execute();

        echo "New records created successfully";
        echo $password;
        $stmt->close();
        header('location: login.php');

    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrierung</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>



    <div id="navbar">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Notenverwaltung</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="registrierung.php">Registrieren<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <?php
                        echo $Noten;
                        ?>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0"></form>
            </div>
        </nav>
    </div>

    <h1>Registrierung</h1>
    <p>
        Bitte registrieren Sie sich, damit Sie diesen Dienst benutzen können.
    </p>
    <?php
    // Ausgabe der Fehlermeldungen
    if (!empty($error)) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
    } else if (!empty($message)) {
        echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
    }
    ?>
    <form action="" method="post">
        <!-- vorname -->
        <div class="form-group">
            <label for="firstname">Vorname *</label>
            <input type="text" name="firstname" class="form-control" id="firstname"
                   value="<?php echo $firstname ?>"
                   placeholder="Geben Sie Ihren Vornamen an."
                   required="true">
        </div>
        <!-- nachname -->
        <div class="form-group">
            <label for="lastname">Nachname *</label>
            <input type="text" name="lastname" class="form-control" id="lastname"
                   value="<?php echo $lastname ?>"
                   placeholder="Geben Sie Ihren Nachnamen an"
                   maxlength="30"
                   required="true">
        </div>
        <!-- email -->
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" name="email" class="form-control" id="email"
                   value="<?php echo $email ?>"
                   placeholder="Geben Sie Ihre Email-Adresse an."
                   maxlength="100"
                   required="true">
        </div>
        <!-- benutzername -->
        <div class="form-group">
            <label for="username">Benutzername *</label>
            <input type="text" name="username" class="form-control" id="username"
                   value="<?php echo $username ?>"
                   placeholder="Gross- und Keinbuchstaben, min 6 Zeichen."
                   maxlength="30" required="true"
                   pattern="(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}"
                   title="Gross- und Keinbuchstaben, min 6 Zeichen.">
        </div>
        <!-- password -->
        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" name="password" class="form-control" id="password"
                   placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute"
                   pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                   title="mindestens einen Gross-, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang,keine Umlaute."
                   required="true">
        </div>
        <button type="submit" name="button" value="submit" class="btn btn-info">Senden</button>
        <button type="reset" name="button" value="reset" class="btn btn-warning">Löschen</button>
    </form>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>
