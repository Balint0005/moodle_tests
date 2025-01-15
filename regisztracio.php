<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Moodle</title>
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
                <li><a id="active" href="regisztracio.php">Regisztráció</a></li>
                <li><a href="belep.php">Bejelentkezés</a></li>
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
                <form action="PHP_process/regisztracio/regisztracio.php" method="post">
                    <fieldset>
                        <legend><h2>Regisztráció</h2></legend>

                        <?php 
                        if (isset($_GET['error'])) {
                    
                            if ($_GET['error'] == "emptyfields") { 
                                echo' <p style="color:#54291A" class="message">Hiba, minden mezőt ki kell tölteni!</p>';
                            } else if ($_GET['error'] == "badfullname") {
                                echo' <p style="color:#54291A" class="message">Hiba, a teljes névben csak betűk szerepelhetnek!</p>';
                            } else if ($_GET['error'] == "passnotmatch") {
                                echo' <p style="color:#54291A" class="message">Hiba, a két jelszó nem egyezik!</p>';
                            } else if ($_GET['error'] == "bademail") {
                                echo' <p style="color:#54291A" class="message">Hiba, az email nem megfelelő!</p>';
                            } else if ($_GET['error'] == "userexist") {
                                echo' <p style="color:#54291A" class="message">Hiba, ez az email már foglalt!</p>';
                            } else if ($_GET['error'] == "success") {
                                echo' <p style="color:#3AFF00" class="message">Sikeres regisztráció!</p>';
                            }
                        }
                        ?>

                        <label class="inputLabel" for="fullname">Teljes név: </label><br><input class="field" id="fullname" type="text" name="fullname" placeholder="Teljes név" maxlength="30" required/><br>
                        <label class="inputLabel" for="username">Felhasználónév: </label><br><input class="field" id="username" type="text" name="username" placeholder="Felhasználónév" maxlength="30" required/><br>
                        <label class="inputLabel" for="pass">Jelszó: </label><br><input class="field" id="pass" type="password" name="passw" placeholder="Jelszó" maxlength="30" required/><br>
                        <label class="inputLabel" for="pass2">Jelszó ismét: </label><input class="field" id="pass2" type="password" name="passw2" placeholder="Jelszó" maxlength="30" required/><br>
                        <label class="inputLabel" for="email">E-mail:</label><br><input class="field" id="email" type="email" name="email" placeholder="Email cím" maxlength="30" required/><br>         
                        <label class="inputlabel" for="stud">Tanuló vagyok:</label><br><input class="field" id="stud" name="studentTeacher" type="radio" value="1">
                        <label class="inputlabel" for="stud">Tanár vagyok:</label><br><input class="field" id="teacher" name="studentTeacher" type="radio" value="2">

                    </fieldset>
                    <div class="formButton">
                        <input class="btn" type="reset" name="reset-btn" value="Törlés"/>
                        <input class="btn" type="submit" name="submit-btn" value="Regisztráció"/>
                    </div>           
                </form>
                </div>
            </div>
        </div>

    </main>

    <footer>

    </footer>

</body>
</html>