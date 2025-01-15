<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moodle</title>
    <link rel="stylesheet" href="CSS/style.css">
    <title>Moodle Tesztek</title>
</head>
<body>
<?php
session_start();

if(isset($_SESSION['logedin'])) {
    header('Location: tesztekvalasztas.php');
    exit;
}

?>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Kezdőlap</a></li>
                <li><a href="regisztracio.php">Regisztráció</a></li>
                <li><a id="active" href="belep.php">Bejelentkezés</a></li>
                <?php if(isset($_SESSION['logedin'])) { ?>
                    <li><a id="active" href="tesztekvalasztas.php">Tesztek</a></li>
                <?php } ?>
              </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="contact-box">
                <div class="left"></div>
                <div class="right">
                <form action="PHP_process/belepes.php" method="post">
                    <h2>Bejelentkezés</h2>
                    <input type="text" class="field" name="email" placeholder="Email">
                    <input type="password" class="field" name="passw" placeholder="Jelszó">
                    <button name="login-submit" class="btn">Bejelentkezés</button>
                    <?php 
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "fnevmissing") { 
                                echo' <p class="message">Hiba, üres az email mező!</p>';
                        } else if ($_GET['error'] == "passmissing") {
                                echo' <p class="message">Hiba, üres a jelszó mező!</p>';
                        } else if ($_GET['error'] == "invaliduser") {
                            echo' <p class="message">Hiba, nem létezik ez a fiók!</p>';
                        } else if ($_GET['error'] == "badfnev") {
                            echo' <p class="message">Hiba, a felhasználónév nem megfelelő!</p>';
                        } else if ($_GET['error'] == "badpass") {
                            echo' <p class="message">Hiba, a jelszó nem megfelelő!</p>';
                        }
                    }
                    ?>
                </form>
                </div>
            </div>
        </div>
    </main>

    <footer>

    </footer>

</body>
</html>