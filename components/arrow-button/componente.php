<?php
    $props = isset($props) && is_array($props) ? $props : [];
    $link = array_key_exists('link', $props) ? $props['link'] : '#';
    $label = array_key_exists('label', $props) && $props['label'] != "" ? $props['label'] : $this->__("Scopri di più");
    $ariaLabel = array_key_exists('titolo', $props) && $props['titolo'] != "" ? $props['titolo'] : $label;
    $target = array_key_exists('target', $props) ? $props['target'] : '_self';
    $isSubmit = array_key_exists('isSubmit', $props) && $props['isSubmit'] != "";
    
    $icon = array_key_exists('Icon', $props) && $props['Icon'] != "" ? $props['Icon'] : null;
    if($icon == null) {
        $icon = $this->getVariantProp('Icon', null);
    }
    
    $iconPosition = array_key_exists('Icon Position', $props) && $props['Icon Position'] != "" ? $props['Icon Position'] : null;
    if($iconPosition == null) {
        $iconPosition = $this->getVariantProp('Icon Position', 'after');
    }
    
    if($icon != null) {
        $label = $iconPosition == 'after' ? $label . ' <i class="' . $icon . ' ' . $iconPosition . '"></i>' : '<i class="' . $icon . ' ' . $iconPosition . '"></i> ' . $label;
    }
?>

<?php if(!$isSubmit) { ?>
    <a class="arrow-button" href="<?php echo $link; ?>" aria-label="<?php echo $this->variabili_lingua('apri_link')." ".$ariaLabel; ?>" target="<?php echo $target; ?>">
        <?php echo $label; ?>
        <span class="arrow"><i class="fa-light fa-angle-right"></i></span>
    </a>
<?php } else { ?>
    <button class="arrow-button" type="submit">
        <?php echo $label; ?>
        <span class="arrow"><i class="fa-light fa-angle-right"></i></span>
    </button>
<?php } ?>