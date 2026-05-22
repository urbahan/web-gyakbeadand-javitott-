<?php if(!defined('ANONYMOUS')) { exit; } ?>

<div class="gallery-container" style="font-family: Arial, sans-serif;">
    <h1 style="color: #333; border-bottom: 2px solid #ff9900; padding-bottom: 10px;">Képgaléria</h1>
    <p style="color: #666; margin-bottom: 25px;">Tekintse meg a Napfény Tours korábbi utazásain készült hangulatos képeket!</p>

    <?php if (isset($_SESSION['galeria_siker'])): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 20px; font-weight: bold; text-align: center;">
            <?= $_SESSION['galeria_siker']; unset($_SESSION['galeria_siker']); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($galeria_uzenet)): ?>
        <div style="margin-bottom: 20px; text-align: center; font-weight: bold;"><?= $galeria_uzenet ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['login'])): ?>
        <div class="upload-section" style="background: #fdfdfd; border: 1px dashed #ff9900; padding: 20px; border-radius: 6px; margin-bottom: 30px; text-align: center;">
            <h3 style="margin-top: 0; color: #ff9900;">Új kép feltöltése a galériába</h3>
            <form action="?kepek" method="post" enctype="multipart/form-data" style="display: inline-block; text-align: left; gap: 15px;">
                <input type="file" name="uj_kep" accept="image/*" required style="padding: 10px; border: 1px solid #ccc; background: #fff; border-radius: 4px; margin-right: 10px;">
                <button type="submit" name="kep_feltoltes" style="background: #ff9900; color: white; border: none; padding: 11px 20px; font-weight: bold; border-radius: 4px; cursor: pointer;">Feltöltés indítása</button>
            </form>
            <p style="font-size: 0.85em; color: #888; margin-top: 10px; margin-bottom: 0;">Engedélyezett formátumok: JPG, JPEG, PNG, GIF</p>
        </div>
    <?php else: ?>
        <div class="info-login-box" style="background: #e2e3e5; color: #383d41; padding: 12px; border-radius: 4px; text-align: center; margin-bottom: 30px; font-size: 0.95em;">
            💡 Képek feltöltéséhez kérjük, <a href="?belepes" style="color: #ff9900; font-weight: bold; text-decoration: none;">jelentkezzen be</a> a fiókjába!
        </div>
    <?php endif; ?>

    <h2 style="font-size: 1.3em; color: #444; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-top: 30px;">Feltöltött fotók</h2>
    
    <?php if (!empty($kepek_listaja)): ?>
        <div class="image-grid" style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
            <?php foreach ($kepek_listaja as $kep_utvonal): ?>
                <div class="image-card" style="background: #fff; border: 1px solid #eee; padding: 8px; border-radius: 4px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); width: calc(25% - 15px); box-sizing: border-box; min-width: 200px; text-align: center;">
                    <a href="<?= $kep_utvonal ?>" target="_blank">
                        <img src="<?= $kep_utvonal ?>" alt="Galéria kép" style="max-width: 100%; height: 150px; object-fit: cover; border-radius: 2px; display: block; margin: 0 auto;">
                    </a>
                    <div style="font-size: 0.75em; color: #999; margin-top: 5px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        <?= basename($kep_utvonal) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p style="color: #999; font-style: italic; text-align: center; margin-top: 30px;">A galéria jelenleg még üres.</p>
    <?php endif; ?>
</div>