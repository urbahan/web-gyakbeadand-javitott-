<?php if(!defined('ANONYMOUS')) { exit; } ?>

<div class="messages-list-container" style="font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto;">
    <h1 style="color: #333; border-bottom: 2px solid #ff9900; padding-bottom: 10px;">Vendégkönyv / Elküldött üzenetek</h1>
    <p style="color: #666; margin-bottom: 25px;">Itt láthatók a látogatók és bejelentkezett felhasználók által küldött legfrissebb üzenetek.</p>

    <?php if (isset($uzenetek_listaja) && !empty($uzenetek_listaja)): ?>
        <div class="messages-grid" style="display: flex; flex-direction: column; gap: 15px;">
            <?php foreach ($uzenetek_listaja as $uzi): ?>
                <div class="message-card" style="background: #fff; border: 1px solid #ddd; border-left: 5px solid #ff9900; padding: 15px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    <div class="message-header" style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.9em; color: #777; border-bottom: 1px dashed #eee; padding-bottom: 5px;">
                        <span>Küldő: <strong style="color: #333;"><?= htmlspecialchars($uzi['nev']) ?></strong></span>
                        <span>Időpont: <strong><?= htmlspecialchars($uzi['idopont']) ?></strong></span>
                    </div>
                    <div class="message-body" style="color: #444; line-height: 1.5; white-space: pre-wrap;"><?= htmlspecialchars($uzi['szoveg']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div style="background-color: #fff3cd; color: #856404; padding: 15px; border: 1px solid #ffeeba; border-radius: 4px; text-align: center; font-weight: bold;">
            Még nem érkezett üzenet az adatbázisba.
        </div>
    <?php endif; ?>
</div>