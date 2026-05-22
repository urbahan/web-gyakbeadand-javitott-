<div class="contact-container">
    <h1>Kapcsolatfelvétel</h1>
    <p>Kérdése van a tavaszi utakról? Írjon nekünk közvetlenül!</p>

    <form action="?kapcsolat_ellenoriz" method="post" id="kapcsolatForm" novalidate>
        <div class="form-group">
            <label for="kapcs_nev">Név:</label>
            <input type="text" id="kapcs_nev" name="kapcs_nev" value="<?= isset($_SESSION['login']) ? htmlspecialchars($_SESSION['csaladi_nev'] . ' ' . $_SESSION['uto_nev']) : '' ?>" placeholder="Az Ön neve...">
            <span class="error-msg" id="error_nev"></span>
        </div>

        <div class="form-group">
            <label for="kapcs_uzenet">Üzenet:</label>
            <textarea id="kapcs_uzenet" name="kapcs_uzenet" rows="6" placeholder="Írja le kérdését, észrevételét..."></textarea>
            <span class="error-msg" id="error_uzenet"></span>
        </div>

        <button type="submit" class="btn-submit">Üzenet elküldése</button>
    </form>

    <div class="contact-info">
        <h3>Napfény Tours Elérhetőségek</h3>
        <p><strong>Ügyvezető:</strong> Urbaniczki Hanna és Mladenovic Hermina</p>
        <p><strong>E-mail:</strong> info@napfenytours.hu</p>
        <p><strong>Telefon:</strong> +36 76 123 456</p>
    </div>
</div>

<script src="js/kapcsolat_validacio.js"></script>