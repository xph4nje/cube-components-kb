<?php 
    $vantaggi = $this->getBlocco("Blocco Vantaggi");
    $icon = $this->getVariantProp("Icona Vantaggi", "fa-light fa-star");
    
    $positionOverlay = $this->getVariantProp("Allineamento Tendina","center");
    $positionOverlayMobile = $this->getVariantProp("Allineamento Tendina Mobile","center");

    
    if (isset($vantaggi) && is_array($vantaggi) && count($vantaggi) > 0) { 
        
?>
<div class="advantages">
    <div class="advantages__title" tabindex="0" aria-describedby="lista-vantaggi">
        <span class="advantages__icon"><?php echo $this->iconPreload($icon); ?></span>
        <div class="advantages__label">
            <?=$vantaggi['Titolo'];?>
        </div>
    </div>
    <div id="lista-vantaggi" class="advantages__cnt <?=$positionOverlay?> mob-<?=$positionOverlayMobile?>">
        <ul class="advantages__list">
            <?php if (isset($vantaggi['Vantaggi']) && is_array($vantaggi['Vantaggi']) && count($vantaggi['Vantaggi']) > 0) { foreach($vantaggi['Vantaggi'] as $elemento) { ?>
            <li class="advantages__item ">
                <span class="icon" aria-hidden="true"><i class="<?= $elemento['Icona'] ?>"></i></span>
                <div class="text"><?= $elemento['Vantaggio'] ?></div>
            </li>
            <?php } } ?>
        </ul>
    </div>
</div>

<?php } ?>