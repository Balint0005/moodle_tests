<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moodle</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<?php
session_start();

if(!isset($_SESSION['logedin'])) {
    header('Location: belep.php');
    exit;
}

?>

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
                    <li><a href="tesztkeszit.php">Teszt Készítés</a></li>
                <?php } ?>
                <?php if(isset($_SESSION['logedin']) && $_SESSION['jogosultsag'] == 2) { ?>
                    <li><a id="active" href="tesztmodosit.php">Tesztek Módosítása</a></li>
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
        <?php
            include "dbcon/connectdb.php";
            
            $sql = "SELECT * FROM teszt";
            $result = $conn->query($sql);

        ?>

        <div class="test-box-main">
            <h2>Teszt módosítás</h2>
            <h2>Az adott teszthez tartozó kérdések módosítása</h2>
            <div class="test-box-left">
                <form action="PHP_process/tesztmodosit.php" method="post">
                <?php 
                         if (isset($_GET['feedback'])) {
                            if ($_GET['feedback'] == "error") { 
                                echo' <p style="color:#54291A" class="message">Valami hiba történt!</p>';
                            } else if ($_GET['feedback'] == "success") {
                                echo' <p style="color:#3AFF00" class="message">A teszt módosítása sikeres volt!</p>';
                            } 
                        }
                ?>
                    <label class="inputLabel">Kiválasztott teszt:</label>
                    <select name="testSelect" id="testID">
                        <?php
                            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value='.$row['Tid'].'>'.$row['tnev'].'</option>';
                            }
                        ?>
                    </select>
                    <hr>

                    <label class="inputLabel" for="testTitle">Teszt neve: </label><br><input class="field" id="testTitle" type="text" name="testName" placeholder="A teszt új neve"/><br>
                    
                    <div class="formButton">
                        <input class="btn" type="submit" name="submit-btn" value="Módosít">
                    </div>
                </form>
                <hr>
                <form action="PHP_process/teszttorol.php" method="post">
                        <?php
            
                            $sql2 = "SELECT * FROM teszt";
                            $result2 = $conn->query($sql2);

                        ?>
                        <?php 
                         if (isset($_GET['feedback2'])) {
                            if ($_GET['feedback2'] == "error") { 
                                echo' <p style="color:#54291A" class="message">Valami hiba történt!</p>';
                            } else if ($_GET['feedback2'] == "success") {
                                echo' <p style="color:#3AFF00" class="message">A teszt törlése sikeres volt!</p>';
                            } 
                        }
                        ?>
                        <label class="inputLabel" for="testTitle2">Törlésre kiválasztott teszt neve: </label>
                        <select name="testSelect2" id="testSelect2">
                        <?php
                            while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value='.$row2['Tid'].'>'.$row2['tnev'].'</option>';
                            }
                        ?>
                        </select>
                    

                    <div class="formButton">    
                        <input class="btn" type="submit" name="submit-btn" value="Kijelölt Teszt Törlése">
                    </div>
                </form>
            </div>



            <div class="test-box-right">
                <form action="PHP_process/kerdesmodosit.php" method="post">
                <?php 
                         if (isset($_GET['feedback3'])) {
                            if ($_GET['feedback3'] == "error") { 
                                echo' <p style="color:#54291A" class="message">Valami hiba történt!</p>';
                            } else if ($_GET['feedback3'] == "success") {
                                echo' <p style="color:#3AFF00" class="message">A kérdés módosítása sikeres volt!</p>';
                            } 
                        }
                ?>
                    <label class="inputLabel">Kiválasztott kérdés:</label>
                    <select name="questID" id="questID">
                        <?php
                            $sql3 = "SELECT * FROM kerdes";
                            $result3 = $conn->query($sql3);
                            
                            while($row3 = $result3->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value='.$row3['Kid'].'>'.$row3['kerdesszovege'].'</option>';
                            }
                        ?>
                    </select>
                    <hr>
                    <label class="inputLabel" for="questText">Kérdés új szövege: </label><br><input class="field" id="questText" type="text" name="questText" placeholder="A kérdés új szövege"/><br>
                    <label class="inputLabel" for="questGoodAnsw">Kérdés új jó válasza: </label><br><input class="field" id="questGoodAnsw" type="text" name="questGoodAnsw" placeholder="A kérdés új jó válasza"/><br>
                    <label class="inputLabel" for="questBadAnsw1">Kérdés új egyik rossz válasza: </label><br><input class="field" id="questBadAnsw1" type="text" name="questBadAnsw1" placeholder="A kérdés új egyik rossz válasza"/><br>
                    <label class="inputLabel" for="questBadAnsw2">Kérdés új egyik rossz válasza: </label><br><input class="field" id="questBadAnsw2" type="text" name="questBadAnsw2" placeholder="A kérdés új egyik rossz válasza"/><br>
                    <label class="inputLabel" for="questBadAnsw3">Kérdés új egyik rossz válasza: </label><br><input class="field" id="questBadAnsw3" type="text" name="questBadAnsw3" placeholder="A kérdés új egyik rossz válasza"/><br>
                    <div class="formButton">
                        <input class="btn" type="submit" name="submit-btn" value="Módosít">
                    </div>
                </form>
                <hr>
                <form action="PHP_process/kerdestorol.php" method="post">
                        <?php
            
                            $sql4 = "SELECT * FROM kerdes";
                            $result4 = $conn->query($sql4);

                        ?>
                        <?php 
                         if (isset($_GET['feedback4'])) {
                            if ($_GET['feedback4'] == "error") { 
                                echo' <p style="color:#54291A" class="message">Valami hiba történt!</p>';
                            } else if ($_GET['feedback4'] == "success") {
                                echo' <p style="color:#3AFF00" class="message">A kérdés törlése sikeres volt!</p>';
                            } 
                        }
                        ?>
                        <label class="inputLabel" for="testTitle2">Törlésre kiválasztott kérdés szövege: </label>
                        <select name="testID" id="testID">
                        <?php
                            while($row4 = $result4->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value='.$row4['Kid'].'>'.$row4['kerdesszovege'].'</option>';
                            }
                        ?>
                        </select>
                    

                    <div class="formButton">    
                        <input class="btn" type="submit" name="submit-btn" value="Kijelölt Kérdés Törlése">
                    </div>
                </form>

            </div>
        </div>

    </main>

    <footer>

    </footer>

</body>
</html>