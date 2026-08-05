<?php 
    $blocco = $this->getBlocco("Banner"); 
    $hide = $this->getProp("Nascondi banner", "no") == "yes";
    
    
    
?>
<?php if (is_array($blocco) && isset($blocco) && !$hide) { 
    $title = isset($blocco['Titolo']) ? $blocco['Titolo'] : '';
    $hasTitle = $title != '';
    $text = isset($blocco['Testo']) ? $blocco['Testo'] : '';
    $hasText = $text != '';
    $icon = $this->getProp("Icona", "");
    $hasIcon = $icon != "";
    
?>
    <div class="bannerHover <?=$this->getProp("Posizione", "bottom-left")?>">
        <?php if ($hasTitle) { ?>
        <div class="bannerHover__label">
            <?php if ($hasIcon) { ?><span class="icon"><i class="<?=$icon;?>"></i></span><?php } ?>
            <span class="text"><?=$title?></span>
            <?php if ($hasText) { ?><span class="arrow"><i class="fa-light fa-angle-down"></i></span><?php } ?>
        </div>
        <?php } ?>
        <?php if ($hasText) { ?>
        <div class="bannerHover__cnt">
            <?=$text?>
        </div>
        <?php } ?>
    </div>
    
<?php } ?>