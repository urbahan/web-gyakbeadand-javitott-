<div class="error-page-container text-center">
    <div class="error-404-graphics">404</div>
    <h1>A keresett oldal nem található!</h1>
    <p class="muted-text">Úgy tűnik, a keresett utazási aloldal vagy menüpont elköltözött vagy megszűnt.</p>
    
    <?php if(isset($keres['szoveg'])): ?>
        <div class="debug-info">
            <small>Részletek: <?= htmlspecialchars($keres['szoveg']) ?></small>
        </div>
    <?php endif; ?>
    
    <br><br>
    <a href="cimlap" class="btn-link">Vissza a kezdőlapra</a>
</div>