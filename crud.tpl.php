<div class="crud-container">
    <h1>Helységek kezelése (Adatbázis CRUD)</h1>
    
    <?php if (!empty($crud_uzenet)): ?>
        <div class="crud-alert"><?= $crud_uzenet ?></div>
    <?php endif; ?>

    <section class="crud-form-section">
        <h2><?= $szerkesztendo_helyseg ? 'Helység szerkesztése' : 'Új helység hozzáadása' ?></h2>
        
        <form action="?crud" method="post" class="styled-form">
            <input type="hidden" name="form_mod" value="<?= $szerkesztendo_helyseg ? 'szerkeszt' : 'uj' ?>">

            <div class="form-group">
                <label for="az">Azonosító (ID):</label>
                <input type="number" id="az" name="az" 
                       value="<?= $szerkesztendo_helyseg ? htmlspecialchars($szerkesztendo_helyseg['az']) : '' ?>" 
                       <?= $szerkesztendo_helyseg ? 'readonly class="readonly-field"' : '' ?> placeholder="Pl. 5">
            </div>

            <div class="form-group">
                <label for="nev">Helység neve:</label>
                <input type="text" id="nev" name="nev" 
                       value="<?= $szerkesztendo_helyseg ? htmlspecialchars($szerkesztendo_helyseg['nev']) : '' ?>" 
                       placeholder="Pl. Kairó">
            </div>

            <div class="form-group">
                <label for="orszag">Ország:</label>
                <input type="text" id="orszag" name="orszag" 
                       value="<?= $szerkesztendo_helyseg ? htmlspecialchars($szerkesztendo_helyseg['orszag']) : '' ?>" 
                       placeholder="Pl. Egyiptom">
            </div>

            <div class="form-buttons">
                <button type="submit" name="crud_mentes" class="btn-submit">Mentés</button>
                <?php if ($szerkesztendo_helyseg): ?>
                    <a href="?crud" class="btn-cancel">Mégse / Új hozzáadása</a>
                <?php endif; ?>
            </div>
        </form>
    </section>

    <section class="crud-table-section">
        <h2>Aktuális helységek az adatbázisban</h2>
        
        <?php if (isset($helysegek_listaja) && !empty($helysegek_listaja)): ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Helység neve</th>
                        <th>Ország</th>
                        <th>Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($helysegek_listaja as $hely): ?>
                        <tr>
                            <td><?= htmlspecialchars($hely['az']) ?></td>
                            <td><strong><?= htmlspecialchars($hely['nev']) ?></strong></td>
                            <td><?= htmlspecialchars($hely['orszag']) ?></td>
                            <td class="actions-cell">
                                <a href="?crud&muvelet=szerkeszt&id=<?= $hely['az'] ?>" class="btn-edit" title="Szerkesztés">✏️ Szerkeszt</a>
                                <a href="?crud&muvelet=torol&id=<?= $hely['az'] ?>" class="btn-delete" onclick="return confirm('Biztosan törölni szeretné ezt a helységet?');" title="Törlés">❌ Töröl</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nincsenek helységek az adatbázisban.</p>
        <?php endif; ?>
    </section>
</div>