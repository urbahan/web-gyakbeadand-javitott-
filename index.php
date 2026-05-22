<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();


define('ANONYMOUS', true);


include('./includes/config.inc.php');


if (!isset($db) && isset($dbh)) {
    $db = $dbh;
}


if (!isset($hiba_oldal)) {
    $hiba_oldal = array('fajl' => '404', 'szoveg' => 'A keresett oldal nem található!', 'menun' => array(0, 0));
}


$teljes_query = $_SERVER['QUERY_STRING'];
$query_reszek = explode('&', $teljes_query);
$oldal = $query_reszek[0]; 


if ($oldal == "kilepes") {
    if (file_exists("./logicals/kilepes.php")) {
        include("./logicals/kilepes.php");
    }
    header("Location: .");
    exit();
}


if ($oldal == "belep" && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (file_exists("./logicals/belep.php")) {
        include("./logicals/belep.php");
    }
    if (isset($_SESSION['login'])) {
        header("Location: .");
        exit();
    }
}

if ($oldal == "regisztral" && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (file_exists("./logicals/regisztral.php")) {
        include("./logicals/regisztral.php");
    }
}



if ($oldal == 'kapcsolat_ellenoriz' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $szoveg = isset($_POST['kapcs_uzenet']) ? trim($_POST['kapcs_uzenet']) : '';
    $nev = isset($_POST['kapcs_nev']) ? trim($_POST['kapcs_nev']) : '';
    
    if (!empty($szoveg)) {
        try {
            if (isset($_SESSION['login'])) {
                $mentendo_nev = (isset($_SESSION['csaladi_nev']) && isset($_SESSION['uto_nev'])) ? ($_SESSION['csaladi_nev'] . " " . $_SESSION['uto_nev']) : $_SESSION['login'];
            } else {
                $mentendo_nev = empty($nev) ? "Vendég" : $nev;
            }
            
            $stmt = $db->prepare("INSERT INTO uzenetek (nev, szoveg) VALUES (?, ?)");
            $stmt->execute([$mentendo_nev, $szoveg]);
            $_SESSION['kapcs_sikeres_uzenet'] = "Köszönjük! Üzenetét sikeresen rögzítettük az adatbázisban.";
        } catch (PDOException $e) {
            $_SESSION['kapcs_szerver_hiba'] = "Hiba az üzenet mentésekor: " . $e->getMessage();
        }
    }
    
    $oldal = 'kapcsolat';
}


if ($oldal == "" || $oldal == "cimlap" || $oldal == "belep" || $oldal == "regisztral") {
    $keres = $oldalak['/'];
}
elseif ($oldal == "belepes") {
    $keres = $oldalak['belepes'];
}
elseif (isset($oldalak[$oldal])) {
    $jog = isset($_SESSION['login']) ? 1 : 0;
    if (isset($oldalak[$oldal]['menun'][$jog]) && $oldalak[$oldal]['menun'][$jog] == 1) {
        $keres = $oldalak[$oldal];
    } else {
        $keres = $oldalak['/'];
    }
} 
else {
    
    $keres = $hiba_oldal;
    header("HTTP/1.0 404 Not Found");
}


if (isset($keres['fajl']) && $keres['fajl'] == 'kepek') {
    if (file_exists("./logicals/kepek.php")) { 
        include("./logicals/kepek.php"); 
    }
}


if (isset($keres['fajl']) && $keres['fajl'] == 'crud') {
    if (file_exists("./logicals/crud.php")) { 
        include("./logicals/crud.php"); 
    }
}


if (isset($keres['fajl']) && $keres['fajl'] == 'tablazat') {
    try {
        $sql = "SELECT t.id, t.indulas, t.idotartam, t.ar, 
                       sz.nev AS szalloda_nev, sz.besorolas, sz.felpanzio,
                       h.nev AS helyseg_nev, h.orszag
                FROM tavasz t
                JOIN szalloda sz ON t.szalloda_az = sz.az
                JOIN helyseg h ON sz.helyseg_az = h.az
                ORDER BY t.indulas ASC";
        $stmt = $db->query($sql); 
        $ajanlatok = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $errormessage = "Adatbázis hiba az ajánlatok betöltésekor: " . $e->getMessage();
    }
}


if (isset($keres['fajl']) && $keres['fajl'] == 'uzenetek') {
    try {
        $stmt = $db->query("SELECT idopont, nev, szoveg FROM uzenetek ORDER BY idopont DESC");
        $uzenetek_listaja = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $errormessage = "Hiba az üzenetek lekérésekor: " . $e->getMessage();
    }
}


include('./templates/index.tpl.php');
?>