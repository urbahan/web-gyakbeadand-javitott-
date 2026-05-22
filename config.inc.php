<?php

$ablakcim = array(
    'cim' => 'Napfény Tours Utazási Iroda',
);

$fejlec = array(
    'kepforras' => 'logo.png', // Ha van logó, ide jön a relatív útvonala
    'kepalt' => 'Napfény Tours Logo',
    'cim' => 'Napfény Tours',
    'motto' => 'Tavaszi álomutak Tunéziába és Egyiptomba – 2011'
);

$lablec = array(
    'copyright' => 'Copyright &copy; ' . date("Y") . '.',
    'ceg' => 'Napfény Tours Kft.'
);


$db_host = 'localhost';
$db_name = 'hhnapfenytours'; 
$db_user = 'hhnapfenytours';            
$db_pass = 'Hanna2317';                

try {
    
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
} catch (PDOException $e) {
    
    $errormessage = "Nem sikerült kapcsolódni az adatbázishoz: " . $e->getMessage();
}


$oldalak = array(
    '/' => array('fajl' => 'cimlap', 'szoveg' => 'Főoldal', 'menun' => array(1, 1)),
    'tablazat' => array('fajl' => 'tablazat', 'szoveg' => 'Ajánlatok', 'menun' => array(1, 1)),
    'kepek' => array('fajl' => 'kepek', 'szoveg' => 'Galéria', 'menun' => array(1, 1)),
    'kapcsolat' => array('fajl' => 'kapcsolat', 'szoveg' => 'Kapcsolat', 'menun' => array(1, 1)),
    

    'uzenetek' => array('fajl' => 'uzenetek', 'szoveg' => 'Üzenetek listája', 'menun' => array(0, 1)),
    'crud' => array('fajl' => 'crud', 'szoveg' => 'Adatkezelés (CRUD)', 'menun' => array(0, 1)),
    

    'belepes' => array('fajl' => 'belepes', 'szoveg' => 'Belépés', 'menun' => array(1, 0)),
    'regisztral' => array('fajl' => 'regisztral', 'szoveg' => 'Regisztráció', 'menun' => array(0, 0)),
    'belep' => array('fajl' => 'belep', 'szoveg' => 'Belépés aloldal', 'menun' => array(0, 0)),
    'kilepes' => array('fajl' => 'kilepes', 'szoveg' => 'Kilépés', 'menun' => array(0, 1))
);

$hiba_oldal = array('fajl' => '404', 'szoveg' => 'A keresett oldal nem található!', 'menun' => array(0, 0));

?>