<div class="message-container text-center">
    <?php if(isset($uzenet)): ?>
        <div class="result-box">
            <h1>Regisztrációs visszajelzés</h1>
            <p class="status-message"><?= htmlspecialchars($uzenet) ?></p>
            
            <?php if(isset($ujra) && $ujra): ?>
                <a href="belepes" class="btn-link retry">Próbálja újra!</a>
            <?php else: ?>
                <a href="belepes" class="btn-link">Tovább a bejelentkezéshez</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>