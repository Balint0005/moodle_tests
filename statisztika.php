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

if(isset($_SESSION['logedin']) == FALSE) {
    header('Location: index.php');
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
                    <li><a href="tesztmodosit.php">Tesztek Módosítása</a></li>
                <?php } ?>
                <?php if(isset($_SESSION['logedin']) && $_SESSION['jogosultsag'] == 2) { ?>
                    <li><a href="tesztlista.php">Teszt kitöltések</a></li>
                <?php } ?>
                <?php
                    if(isset($_SESSION['logedin'])){ ?>
                    <li><a id="active" href="statisztika.php">Statisztika</a></li>
                <?php }
                ?>
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
            
        ?>

        <div class="test-box-main-center">
            <div class="test-box-center">
                <h1>Statisztika</h1>
                <!-- Listázzam ki azoknak a felhasználóknak a neveit akik több mint 5 tesztet kitöltöttek-->
                <p class="decor">Azon felhasználók nevei akik már legalább 5 tesztet kitöltöttek:</p>
                <?php
                include "dbcon/connectdb.php";
                $sql = "SELECT nev FROM felhasznalok INNER JOIN kitoltotte ON felhasznalok.Fid = kitoltotte.felhasznaloID GROUP BY felhasznalok.nev HAVING COUNT(*) >= 5";
                
                $result = $conn->query($sql);
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<span class="decor2">'.$row['nev'].'</span><br>';
                }
                ?>
                <hr>

                <!-- Listázza ki azoknak a felhasználóknak a nevét akik több mint 3 tesztet sikeresen töltöttek ki-->
                <p class="decor">Azon felhasználók neve akik már legalább 3 tesztet sikeresen kitöltöttek:</p>
                <?php
                    $sql2 = "SELECT nev
                    FROM felhasznalok f
                    INNER JOIN kitoltotte k ON f.Fid = k.felhasznaloID
                    WHERE k.sikeres = 1
                    GROUP BY f.Fid, f.nev
                    HAVING COUNT(k.tesztID) > 2";

                    $result2 = $conn->query($sql2);
                    while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                        echo '<span class="decor2">'.$row2['nev'].'</span><br>';
                    }
                ?>

                <!-- Listázza ki annak a felhasználónak a nevét aki a legtöbb sikeres tesztet töltötte ki!-->
                <hr>
                <p class="decor">Azon felhasználó neve aki a legtöbb sikeres tesztet töltötte ki:</p>
                <?php
                    $sql3 = "SELECT f.nev, (
                        SELECT COUNT(kitoltID)
                        FROM kitoltotte
                        WHERE felhasznaloID = f.Fid AND sikeres = TRUE
                    ) AS sikeres_tesztek_szama
                    FROM felhasznalok f
                    ORDER BY sikeres_tesztek_szama DESC
                    LIMIT 1";

                    $result3 = $conn->query($sql3);
                    while($row3 = $result3->fetch(PDO::FETCH_ASSOC)) {
                        echo '<span class="decor2">'.$row3['nev'].'</span><br>';
                    }
                ?>

            </div>
        </div>
    </main>
</body>