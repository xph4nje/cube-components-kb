<?php
    $props = isset($props) && is_array($props) ? $props : [];
    $link = array_key_exists('link', $props) ? $props['link'] : '#';
    $label = array_key_exists('label', $props) && $props['label'] != "" ? $props['label'] : $this->__("Scopri di più");
    $ariaLabel = array_key_exists('ariaLabel', $props) && $props['ariaLabel'] != "" ? $props['ariaLabel'] : $label;
    $target = array_key_exists('target', $props) ? $props['target'] : '_self';
    $isSubmit = array_key_exists('isSubmit', $props) && $props['isSubmit'] != "";
    $forma = $this->getVariantProp("Pulsante Forma","tondo");    
    $icona = array_key_exists('Icona', $props) && $props['Icona'] != "" ? $props['Icona'] : "fa-light fa-arrow-right";
    if($icona == "fa-light fa-arrow-right") {
        $icona = $this->getVariantProp('Icona', "fa-light fa-arrow-right");
    }    
    
?>

<?php if(!$isSubmit) { ?>
    <a class="background-button forma--<?= $forma ?>" href="<?php echo $link; ?>" aria-label="<?php echo $ariaLabel; ?>" target="<?php echo $target; ?>">
        <div class="background-button__cont">
            <i class="background-button__cont__icona <?= $icona ?>"></i>
        </div>
        <?php echo $label; ?>
    </a>
<?php } else { ?>
    <button class="background-button" type="submit">
        <div class="background-button__cont">
            <i class="background-button__cont__icona <?= $icona ?>"></i>
        </div>
        <?php echo $label; ?>
    </button>
<?php } ?>