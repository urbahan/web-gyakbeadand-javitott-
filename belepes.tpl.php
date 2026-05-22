<?php if(!defined('ANONYMOUS')) { exit; } ?>

<?php if(isset($uzenet)): ?>
    <div style="background-color: #e2e3e5; padding: 15px; margin-bottom: 20px; border-radius: 4px; font-weight: bold; text-align: center;">
        <?= htmlspecialchars($uzenet) ?>
    </div>
<?php endif; ?>

<div class="auth-grid" style="display: flex; gap: 40px; margin-top: 20px; font-family: Arial, sans-serif;">
    <div class="auth-card" style="flex: 1; background: #fff; padding: 20px; border-radius: 6px; border: 1px solid #ddd;">
        <form action="?belep" method="post" class="auth-form">
          <fieldset style="border: none; padding: 0; margin: 0;">
            <legend style="font-size: 1.4em; font-weight: bold; margin-bottom: 15px; color: #333;">Bejelentkezés</legend>
            <div class="form-field" style="margin-bottom: 15px;">
                <input type="text" name="felhasznalo" placeholder="Felhasználónév" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>
            <div class="form-field" style="margin-bottom: 15px;">
                <input type="password" name="jelszo" placeholder="Jelszó" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>
            <button type="submit" name="belepes" style="background: #ff9900; color: white; border: none; padding: 10px 20px; font-weight: bold; border-radius: 4px; cursor: pointer; width: 100%;">Belépés</button>
          </fieldset>
        </form>
    </div>

    <div class="auth-card" style="flex: 1; background: #fff; padding: 20px; border-radius: 6px; border: 1px solid #ddd;">
        <h2 style="font-size: 1.2em; margin-top: 0; color: #555;">Még nem tagunk? Regisztráljon!</h2>
        <form action="?regisztral" method="post" class="auth-form">
          <fieldset style="border: none; padding: 0; margin: 0;">
            <legend style="font-size: 1.4em; font-weight: bold; margin-bottom: 15px; color: #333;">Regisztráció</legend>
            <div class="form-field" style="margin-bottom: 12px;">
                <input type="text" name="vezeteknev" placeholder="Vezetéknév" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>
            <div class="form-field" style="margin-bottom: 12px;">
                <input type="text" name="utonev" placeholder="Utónév" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>
            <div class="form-field" style="margin-bottom: 12px;">
                <input type="text" name="felhasznalo" placeholder="Választott felhasználói név" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>
            <div class="form-field" style="margin-bottom: 15px;">
                <input type="password" name="jelszo" placeholder="Választott jelszó" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>
            <button type="submit" name="regisztracio" style="background: #333; color: white; border: none; padding: 10px 20px; font-weight: bold; border-radius: 4px; cursor: pointer; width: 100%;">Regisztráció</button>
          </fieldset>
        </form>
    </div>
</div>