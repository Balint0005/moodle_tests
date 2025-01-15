<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moodle</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">Kezdőlap</a></li>
                <?php if(!isset($_SESSION['logedin'])) { ?>
                    <li><a href="regisztracio.php">Regisztráció</a></li>
                    <li><a href="belep.php">Bejelentkezés</a></li>
                <?php } ?>
                    <li><a href="tesztekvalasztas.php">Tesztek</a></li>
                <?php if(isset($_SESSION['logedin']) && $_SESSION['jogosultsag'] == 2) { ?>
                    <li><a id="active" href="tesztkeszit.php">Teszt Készítés</a></li>
                <?php } ?>
                <?php if(isset($_SESSION['logedin']) && $_SESSION['jogosultsag'] == 2) { ?>
                    <li><a href="tesztmodosit.php">Tesztek Módosítása</a></li>
                <?php } ?>
                <?php if(isset($_SESSION['logedin']) && $_SESSION['jogosultsag'] == 2) { ?>
                    <li><a href="tesztlista.php">Teszt kitöltések</a></li>
                <?php } ?>
                <li><a href="statisztika.php">Statisztika</a></li>
                <?php if(isset($_SESSION['logedin'])){ ?>
                <form action="PHP_process/kijelentkezes.php" method="post">
                    <li> <a href="PHP_process/kijelentkezes.php">Kijelentkezés</a> </li>
                </form>
                <?php } ?>
            </ul>
                <?php
                
                if(isset($_SESSION['logedin'])){

              ?>
              <span class="right">
                <?php    echo $_SESSION['nev']; ?>
              </span>
              <?php
                }
               ?>
        </nav>
    </header>

    <main>
       
        <div class="test-box-main">
            <h2>Teszt készítése:</h2>
            <h2>Kérdés és válaszok:</h2>
            <div class="test-box-left">
                <form action="PHP_process/tesztkeszites.php" method="post">
                    <?php 
                         if (isset($_GET['feedback'])) {
                    
                            if ($_GET['feedback'] == "emptyfields") { 
                                echo' <p style="color:#54291A" class="message">Hiba, minden mezőt ki kell tölteni!</p>';
                            } else if ($_GET['feedback'] == "badpoint") {
                                echo' <p style="color:#54291A" class="message">Hiba, csak számot lehet beírni a pontokhoz!</p>';
                            } else if ($_GET['feedback'] == "badminpoint") {
                                echo' <p style="color:#54291A" class="message">Hiba, csak számot lehet beírni a  minimum pontokhoz!</p>';
                            } else if ($_GET['feedback'] == "success") {
                                echo' <p style="color:#3AFF00" class="message">Sikeres teszt készítés!</p>';
                            }
                        }
                    ?>

                    <label class="inputLabel" for="testname">Teszt neve: </label><br><input class="field" id="testname" type="text" name="testname" placeholder="Teszt neve" maxlength="50" required/><br>
                    <label class="inputLabel" for="point">Kérdésenként elérhető pontszám: </label><br><input class="field" id="point" type="text" name="point" placeholder="Pontszám" required/><br>
                    <label class="inputLabel" for="minimum">A teszthez tartozó elérendő minimum pontszám: </label><br><input class="field" id="minimum" type="text" name="minimum" placeholder="Minimum pontszám" required/><br>                    

                    <div class="formButton">
                        <input class="btn" type="submit" name="submit-btn" value="Készítés">
                        <input class="btn" type="reset" name="reset-btn" value="Adatok törlése">
                    </div>
                </form>
            </div>
            <div class="test-box-right">
                
                
                <form action="PHP_process/kerdeskeszites.php" method="post">
                <?php 
                         if (isset($_GET['feedback2'])) {
                            if ($_GET['feedback2'] == "emptyfields") { 
                                echo' <p style="color:#54291A" class="message">Hiba, minden mezőt ki kell tölteni!</p>';
                            } else if ($_GET['feedback2'] == "success") {
                                echo' <p style="color:#3AFF00" class="message">Sikeres kérdés készítés!</p>';
                            } 
                        }
                ?>

                    <label class="inputLabel" for="question">Kérdés szövege: </label><br><input class="field" id="question" type="text" name="question" placeholder="Kérdés" required/><br>   
                    <label class="inputLabel" for="rightansw">1. válasz (jó válasz) : </label><br><input class="field" id="rightansw" type="text" name="rightansw" placeholder="Jó válasz" required/><br>
                    <label class="inputLabel" for="wrongansw1">2. válasz (rossz válasz): </label><br><input class="field" id="wrongansw1" type="text" name="wrongansw1" placeholder="Rossz válasz" required/><br>   
                    <label class="inputLabel" for="wrongansw2">3. válasz (rossz válasz): </label><br><input class="field" id="wrongansw2" type="text" name="wrongansw2" placeholder="Rossz válasz" required/><br>   
                    <label class="inputLabel" for="wrongansw3">4. válasz (rossz válasz): </label><br><input class="field" id="wrongansw3" type="text" name="wrongansw3" placeholder="Rossz válasz" required/><br>

                    <div class="formButton">
                        <input class="btn" type="submit" name="submit-btn" value="Készítés">
                        <input class="btn" type="reset" name="reset-btn" value="Adatok törlése">
                    </div>
                </form>
                
                <hr>

                <?php
                    include "dbcon/connectdb.php";

                    $sql = "SELECT * FROM teszt";
                    $result = $conn->query($sql);

                    $sql2 = "SELECT * FROM kerdes";
                    $result2 = $conn->query($sql2);
                ?>

                <form action="PHP_process/kerdeshozzarendeles.php" method="post">
                <?php 
                         if (isset($_GET['feedback3'])) {
                            if ($_GET['feedback3'] == "error") { 
                                echo' <p style="color:#54291A" class="message">Valami hiba történt!</p>';
                            } else if ($_GET['feedback3'] == "success") {
                                echo' <p style="color:#3AFF00" class="message">A kérdés hozzá rendelése sikeres volt!</p>';
                            } 
                        }
                ?>
                    <label class="inputLabel">Teszthez való hozzárendelés:</label>
                    <select name="testID" id="testID">
                        <?php 
                            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value='.$row['Tid'].'>'.$row['tnev'].'</option>';
                            }
                        ?>
                    </select>

                    <br>

                    <label class="inputLabel">A hozzárendelendő kérdés szövege: </label>
                    <select name="kerdesID" id="kerdesID">
                        <?php 
                            while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value='.$row2['Kid'].'>'.$row2['kerdesszovege'].'</option>';
                            }
                        ?>
                    </select>

                    <div class="formButton">
                        <input class="btn" type="submit" name="submit-btn" value="Hozzárendelés">
                    </div>
                </form>

            </div>
        </div>

    </main>

    <footer>

    </footer>

</body>
</html>