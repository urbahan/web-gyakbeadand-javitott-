<?php
if(isset($_POST['felhasznalo']) && isset($_POST['jelszo']) && isset($_POST['vezeteknev']) && isset($_POST['utonev'])) {
    try {
        
        $sqlSelect = "SELECT id FROM felhasznalok WHERE bejelentkezes = :bejelentkezes";
        $sth = $db->prepare($sqlSelect);
        $sth->execute(array(':bejelentkezes' => $_POST['felhasznalo']));
        
        if($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $uzenet = "A választott felhasználói név már foglalt! Kérjük, válasszon másikat.";
            $ujra = true;
        }
        else {
            
            $sqlInsert = "INSERT INTO felhasznalok (id, csaladi_nev, uto_nev, bejelentkezes, jelszo)
                          VALUES(0, :csaladinev, :utonev, :bejelentkezes, :jelszo)";
            $stmt = $db->prepare($sqlInsert); 
            
            $stmt->execute(array(
                ':csaladinev' => $_POST['vezeteknev'], 
                ':utonev' => $_POST['utonev'],
                ':bejelentkezes' => $_POST['felhasznalo'], 
                ':jelszo' => sha1($_POST['jelszo']) 
            )); 
            
            if($stmt->rowCount()) {
                $newid = $db->lastInsertId();
                $uzenet = "Sikeres regisztráció! Az Ön belső azonosítója: {$newid}. Most már bejelentkezhet a rendszerbe.";                     
                $ujra = false; 
            }
            else {
                $uzenet = "A regisztráció szerverhiba miatt nem sikerült.";
                $ujra = true;
            }
        }
    }
    catch (PDOException $e) {
        $uzenet = "Adatbázis hiba: " . $e->getMessage();
        $ujra = true;
    }      
}
else {
    header("Location: .");
    exit();
}
?>