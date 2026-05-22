<div class="message-container text-center">
    <div class="info-box">
        <h1>Sikeresen kijelentkezett!</h1>
        <p>Köszönjük, hogy meglátogatta a Napfény Tours oldalt.</p>
        
        <?php if(isset($data)): ?>
            <p class="muted-text">
                Viszlát, <?= htmlspecialchars($data['csn'] . " " . $data['un'] . " (" . $data['login'] . ")") ?>!
            </p>
        <?php endif; ?>
        
        <br>
        <a href="cimlap" class="btn-link">Vissza a főoldalra</a>
    </div>
</div>