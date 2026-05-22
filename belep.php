<?php
// Biztonsági konstans ellenőrzése
if(!defined('ANONYMOUS')) { exit; }

if(isset($_POST['felhasznalo']) && isset($_POST['jelszo'])) {
    try {
        // Az adatbázis kapcsolat ($db) az index.php-ből öröklődik a konfiguráción keresztül
        $sqlSelect = "SELECT id, csaladi_nev, uto_nev FROM felhasznalok WHERE bejelentkezes = :bejelentkezes AND jelszo = sha1(:jelszo)";
        $sth = $db->prepare($sqlSelect);
        $sth->execute(array(
            ':bejelentkezes' => $_POST['felhasznalo'], 
            ':jelszo' => $_POST['jelszo']
        ));
        
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            // BEÁLLÍTJUK AZ ÖSSZES LÉTEZŐ KULCSVARIÁCIÓT, hogy sehol ne dobjon Warningot az oldal!
            $_SESSION['csaladi_nev'] = $row['csaladi_nev']; 
            $_SESSION['uto_nev'] = $row['uto_nev']; 
            $_SESSION['utonev'] = $row['uto_nev']; 
            $_SESSION['csn'] = $row['csaladi_nev']; 
            $_SESSION['un'] = $row['uto_nev']; 
            $_SESSION['login'] = $_POST['felhasznalo'];
            
            // Sikeres belépés után visszadobjuk a tiszta főoldalra, ahol már látni fogja a nevét
            header("Location: .");
            exit();
        } else {
            // Ha rossz a felhasználónév vagy jelszó, elmentjük a hibát a sessionbe
            $_SESSION['belepes_hiba'] = "Hibás felhasználónév vagy jelszó!";
            header("Location: ?belepes");
            exit();
        }
    }
    catch (PDOException $e) {
        $_SESSION['belepes_hiba'] = "Adatbázis hiba a bejelentkezés során: " . $e->getMessage();
        header("Location: ?belepes");
        exit();
    }      
}
?>