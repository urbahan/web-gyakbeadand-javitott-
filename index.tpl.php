<?php if(!defined('ANONYMOUS')) { exit; } ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title><?= isset($keres['szoveg']) ? $keres['szoveg'] . " - " : "" ?>Napfény Tours</title>
    <style>
        /* Alapvető letisztult formázás, hogy jól nézzen ki */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; color: #333; }
        header { background-color: #333; color: white; padding: 20px; text-align: center; position: relative; }
        header h1 { margin: 0; color: #ff9900; }
        .user-info { position: absolute; top: 15px; right: 20px; font-size: 0.9em; color: #ccc; }
        
        
        nav { background-color: #444; display: flex; justify-content: center; padding: 0; margin: 0; list-style: none; }
        nav a { color: white; text-decoration: none; padding: 14px 20px; display: inline-block; font-weight: bold; transition: background 0.3s; }
        nav a:hover { background-color: #ff9900; color: #333; }
        nav .active { background-color: #ff9900; color: #333; }
       
        .wrapper { max-width: 1200px; margin: 20px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); min-height: 450px; }
        
        
        footer { background-color: #333; color: #aaa; text-align: center; padding: 15px; font-size: 0.85em; margin-top: 40px; border-top: 3px solid #ff9900; }
        
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.95em;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            border-radius: 5px 5px 0 0;
            overflow: hidden;
        }
        .styled-table injustices {
            border-radius: 5px 5px 0 0;
        }
        .styled-table th {
            background-color: #333;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
            padding: 12px 15px;
            border-bottom: 3px solid #ff9900;
        }
        .styled-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dddddd;
            color: #444;
        }
        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f9f9f9;
        }
        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #ff9900;
        }
        .styled-table tbody tr:hover {
            background-color: #f1f1f1;
            transition: background 0.2s ease;
        }
        .price-cell {
            font-weight: bold;
            color: #333;
            text-align: right;
            white-space: nowrap;
        }
    </style>
</head>
<body>

    <header>
        <h1>Napfény Tours Utazási Iroda</h1>
        <p>A legforróbb tavaszi ajánlatok egy helyen!</p>
        
        <div class="user-info">
            <?php if(isset($_SESSION['login'])): ?>
                Bejelentkezve: <strong><?= htmlspecialchars((isset($_SESSION['csaladi_nev']) && isset($_SESSION['uto_nev'])) ? ($_SESSION['csaladi_nev'] . " " . $_SESSION['uto_nev']) : $_SESSION['login']) ?></strong> (<?= htmlspecialchars($_SESSION['login']) ?>)
            <?php else: ?>
                Státusz: <strong>Vendég</strong>
            <?php endif; ?>
        </div>
    </header>

    <nav>
        <?php 
        
        $aktualis_jog = isset($_SESSION['login']) ? 1 : 0; 
        
        foreach($oldalak as $url => $oldal_adatok) {
            
            if($oldal_adatok['menun'][$aktualis_jog] == 1) {
                
                $szinezett_osztaly = ($oldal == $url || ($url == '/' && ($oldal == '' || $oldal == 'cimlap'))) ? 'class="active"' : '';
                
                // Szép tiszta URL-ek generálása
                $link_url = ($url == '/') ? '.' : '?' . $url;
                
                echo "<a href='{$link_url}' {$szinezett_osztaly}>" . htmlspecialchars($oldal_adatok['szoveg']) . "</a>";
            }
        }
        ?>
    </nav>

    <div class="wrapper">
        <?php
        
        if (isset($keres['fajl'])) {
            $sablon_eleres = "./templates/pages/{$keres['fajl']}.tpl.php";
            if (file_exists($sablon_eleres)) {
                include($sablon_eleres);
            } else {
                echo "<p style='color:red; font-weight:bold;'>Rendszerhiba: A keresett sablonfájl ({$sablon_eleres}) nem található!</p>";
            }
        }
        ?>
    </div>

    <footer>
        &copy;  <?= date('Y') ?> Napfény Tours Utazási Iroda. Minden jog fenntartva! <br>
       
    </footer>

</body>
</html>