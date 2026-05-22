<?php

if (!isset($_SESSION['login'])) {
    header("Location: .");
    exit();
}

$crud_uzenet = "";
$szerkesztendo_helyseg = null;


if (isset($_GET['muvelet']) && $_GET['muvelet'] == 'torol' && isset($_GET['id'])) {
    try {
        
        $chk = $db->prepare("SELECT COUNT(*) FROM szalloda WHERE helyseg_az = ?");
        $chk->execute([$_GET['id']]);
        if ($chk->fetchColumn() > 0) {
            $crud_uzenet = "<span class='error-msg'>A helység nem törölhető, mert vannak hozzárendelt szállodák!</span>";
        } else {
            $stmt = $db->prepare("DELETE FROM helyseg WHERE az = ?");
            $stmt->execute([$_GET['id']]);
            $crud_uzenet = "<span class='success-msg'>Helység sikeresen törölve!</span>";
        }
    } catch (PDOException $e) {
        $crud_uzenet = "<span class='error-msg'>Hiba a törlés során: " . $e->getMessage() . "</span>";
    }
}


if (isset($_GET['muvelet']) && $_GET['muvelet'] == 'szerkeszt' && isset($_GET['id'])) {
    $stmt = $db->prepare("SELECT az, nev, orszag FROM helyseg WHERE az = ?");
    $stmt->execute([$_GET['id']]);
    $szerkesztendo_helyseg = $stmt->fetch(PDO::FETCH_ASSOC);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crud_mentes'])) {
    $az = intval($_POST['az']);
    $nev = trim($_POST['nev']);
    $orszag = trim($_POST['orszag']);
    $mod = $_POST['form_mod']; // 'uj' vagy 'szerkeszt'

    if (empty($az) || empty($nev) || empty($orszag)) {
        $crud_uzenet = "<span class='error-msg'>Minden mezőt kötelező kitölteni!</span>";
    } else {
        try {
            if ($mod == 'uj') {
                
                $chk = $db->prepare("SELECT COUNT(*) FROM helyseg WHERE az = ?");
                $chk->execute([$az]);
                if ($chk->fetchColumn() > 0) {
                    $crud_uzenet = "<span class='error-msg'>Hiba: Ez az azonosító (ID) már létezik!</span>";
                } else {
                    
                    $stmt = $db->prepare("INSERT INTO helyseg (az, nev, orszag) VALUES (?, ?, ?)");
                    $stmt->execute([$az, $nev, $orszag]);
                    $crud_uzenet = "<span class='success-msg'>Új helység sikeresen hozzáadva!</span>";
                }
            } elseif ($mod == 'szerkeszt') {
                
                $stmt = $db->prepare("UPDATE helyseg SET nev = ?, orszag = ? WHERE az = ?");
                $stmt->execute([$nev, $orszag, $az]);
                $crud_uzenet = "<span class='success-msg'>Helység adatai sikeresen frissítve!</span>";
            }
        } catch (PDOException $e) {
            $crud_uzenet = "<span class='error-msg'>Adatbázis hiba: " . $e->getMessage() . "</span>";
        }
    }
}


try {
    $stmt = $db->query("SELECT az, nev, orszag FROM helyseg ORDER BY az ASC");
    $helysegek_listaja = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $crud_uzenet = "Nem sikerült a listázás: " . $e->getMessage();
}
?>