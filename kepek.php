<?php
if(!defined('ANONYMOUS')) { exit; }


$galeria_uzenet = "";
$MAPPA = "./kepek/"; 

if (!file_exists($MAPPA)) {
    mkdir($MAPPA, 0777, true);
}


if (isset($_POST['kep_feltoltes']) && isset($_SESSION['login'])) {
    if (isset($_FILES['uj_kep']) && $_FILES['uj_kep']['error'] == 0) {
        
        
        $elfogadott_tipusok = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif');
        $fajl_tipus = $_FILES['uj_kep']['type'];
        
        if (in_array($fajl_tipus, $elfogadott_tipusok)) {
            
            
            $eredeti_nev = basename($_FILES['uj_kep']['name']);
            $tiszta_nev = preg_replace("/[^A-Za-z0-9\.\-_]/", "_", $eredeti_nev);
            $cel_fajl = $MAPPA . time() . "_" . $tiszta_nev;
            
           
            if (move_uploaded_file($_FILES['uj_kep']['tmp_name'], $cel_fajl)) {
                $_SESSION['galeria_siker'] = "A kép sikeresen feltöltésre került a galériába!";
                header("Location: ?kepek");
                exit();
            } else {
                $galeria_uzenet = "<span class='error-msg'>Rendszerhiba: Nem sikerült a fájl mentése a szerverre.</span>";
            }
        } else {
            $galeria_uzenet = "<span class='error-msg'>Hiba: Csak JPG, JPEG, PNG és GIF képek tölthetők fel!</span>";
        }
    } else {
        $galeria_uzenet = "<span class='error-msg'>Hiba: Nem választott ki fájlt, vagy a fájl mérete túl nagy!</span>";
    }
}


$kepek_listaja = array();
if (file_exists($MAPPA)) {
    $olvaso = opendir($MAPPA);
    while (($fajl = readdir($olvaso)) !== false) {
        if ($fajl != "." && $fajl != ".." && in_array(pathinfo($fajl, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'))) {
            $kepek_listaja[] = $MAPPA . $fajl;
        }
    }
    closedir($olvaso);
    
    rsort($kepek_listaja);
}
?>