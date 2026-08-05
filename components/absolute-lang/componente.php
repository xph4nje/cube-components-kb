<?php

    $position = $this->getProp("Posizione", "bottom-left");
    
    $visibilityDesktop = $this->getProp("Visibilità Desktop", "all");
    $visibilityMobile = $this->getProp("Visibilità Mobile", "all");
   
    /* varianti */
    $langVariant = $this->getVariant('Menu Lingue', 'languages-dropdown');
    

   
   
?>

<div class="absolute-lang <?=$position?> desktop-<?=$visibilityDesktop?> mobile-<?=$visibilityMobile?>">
    <div class="absolute-lang__cnt">
        <?php echo $this->getComponente($langVariant, [], 'Menu Lingue'); ?>
    </div>
</div>
       