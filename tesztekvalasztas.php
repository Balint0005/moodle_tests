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
                    <li><a id="active" href="tesztekvalasztas.php">Tesztek</a></li>
                <?php if(isset($_SESSION['logedin']) && $_SESSION['jogosultsag'] == 2) { ?>
                    <li><a href="tesztkeszit.php">Teszt Készítés</a></li>
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
        <?php
            include "dbcon/connectdb.php";
            $sql = "SELECT * FROM teszt";
            $result = $conn->query($sql);

            $userID = $_SESSION['Fid'];

            $sql2 = "SELECT * FROM  kitoltotte WHERE felhasznaloID=$userID";
            $result2 = $conn->query($sql2);
        ?>

        <div class="test-box-main">
            <h2>Kitöltött tesztek</h2>
            <h2>Kitölthető tesztek</h2>
            <div class="test-box-left">
                <?php
                    while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                        $adottTesztID = $row2['tesztID'];
                        $sql3 = "SELECT * FROM teszt WHERE Tid=$adottTesztID";
                        $result3 = $conn->query($sql3);
                        $adottTesztAdatai = $result3->fetch(PDO::FETCH_ASSOC);

                        //-----------------------MAXPONT-----------------------------
                        $maxpont = 0;
                        $kerdesDB = 0;
                        $adottID = $adottTesztAdatai['Tid'];
                        $sql0 = "SELECT * FROM teszttartalmazza WHERE tesztID = $adottID";
                        $result0 = $conn->query($sql0);
                        while($row0 =  $result0->fetch(PDO::FETCH_ASSOC)) {
                            $kerdesDB++;
                        }
                        $maxpont = $adottTesztAdatai['kerdesenkent_pont'] * $kerdesDB;
                        //-------------------------------------------------------------

                        if($row2['felhasznaloID'] == $_SESSION['Fid']){
                            if($row2['sikeres'] == 1){
                                $sikeres = "Sikeres kitöltés!";
                            }
                            else {
                                $sikeres = "Sikertelen kitöltés!";
                            }
                        echo '<form style="display: inline" action="" method="POST">
                        <button name="actTestID" class="btn" value='.$row2['tesztID'].'>Teszt neve: '.$adottTesztAdatai['tnev'].'<br> Elért pontszám: '.$row2['elertPontSzam'].'/'.$maxpont.'<br>'.$sikeres.'<br>Minimum pont: '.$adottTesztAdatai['minpont'].'</button>
                        </form>';
                        
                        }
                    }
                ?>
            </div>
            <div class="test-box-right">
                <?php
                    $ido = date("Y-m-d H:i:s"); 
                    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo '<form style="display: inline" action="teszt.php" method="POST">
                        <button name="actTestID" class="btn" value='.$row['Tid'].'>'.$row['tnev'].'</button>
                        <input type="hidden" name="ido" value="'.$ido.'"> </form>';
                    }
                ?>
                
            </div>
        </div>

    </main>

    <footer>

    </footer>

</body>
</html>