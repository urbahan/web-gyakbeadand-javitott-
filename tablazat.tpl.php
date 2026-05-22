<div class="offers-container">
    <h1>Aktuális Tavaszi Ajánlataink (2011)</h1>
    <p>Az alábbi táblázatban láthatja a mentett adatbázisunkban elérhető tavaszi turnusokat.</p>

    <?php if (isset($ajanlatok) && !empty($ajanlatok)): ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Szálloda neve</th>
                    <th>Besorolás</th>
                    <th>Helység / Ország</th>
                    <th>Indulási időpont</th>
                    <th>Időtartam (nap)</th>
                    <th>Félpanzió</th>
                    <th>Ár (Ft)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ajanlatok as $ut): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($ut['szalloda_nev']) ?></strong></td>
                        <td><?= str_repeat('★', $ut['besorolas']) ?></td>
                        <td><?= htmlspecialchars($ut['helyseg_nev'] . ' (' . $ut['orszag'] . ')') ?></td>
                        <td><?= htmlspecialchars($ut['indulas']) ?></td>
                        <td><?= htmlspecialchars($ut['idotartam']) ?> nap</td>
                        <td><?= $ut['felpanzio'] ? 'Van' : 'Nincs' ?></td>
                        <td class="price-cell"><?= number_format($ut['ar'], 0, ',', ' ') ?> Ft</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="warning-msg">Jelenleg nincsenek betöltött ajánlatok az adatbázisban.</p>
    <?php endif; ?>
</div>