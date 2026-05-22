<div class="message-container">
    <?php if(isset($row)): ?>
        <?php if($row): ?>
            <div class="success-box">
                <h1>Sikeres bejelentkezés!</h1>
                <p>Üdvözöljük a rendszerben!</p>
                <div class="user-details">
                    Azonosító: <strong><?= htmlspecialchars($row['id']) ?></strong><br>
                    Név: <strong><?= htmlspecialchars($row['csaladi_nev'] . " " . $row['uto_nev']) ?></strong>
                </div>
                <p><a href="cimlap" class="btn-link">Vissza a főoldalra</a></p>
            </div>
        <?php else: ?>
            <div class="error-box">
                <h1>A bejelentkezés nem sikerült!</h1>
                <p class="error-detail">Hibás felhasználónév vagy jelszó.</p>
                <a href="belepes" class="btn-link retry">Próbálja újra!</a>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(isset($errormessage)): ?>
        <div class="system-error">
            <h2>Rendszerüzenet: <?= htmlspecialchars($errormessage) ?></h2>
        </div>
    <?php endif; ?>
</div>