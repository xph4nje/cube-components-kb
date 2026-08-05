<?php
    $props = isset($props) && is_array($props) ? $props : [];
    $link = array_key_exists('link', $props) ? $props['link'] : '#';
    $label = array_key_exists('label', $props) && $props['label'] != "" ? $props['label'] : $this->__("Scopri di più");
    $ariaLabel = array_key_exists('ariaLabel', $props) && $props['ariaLabel'] != "" ? $props['ariaLabel'] : $label;
    $target = array_key_exists('target', $props) ? $props['target'] : '_self';
    $icon = array_key_exists('Icon', $props) ? $props['Icon'] : null;
    
    $icon = array_key_exists('Icon', $props) && $props['Icon'] != "" ? $props['Icon'] : null;
    if($icon == null) {
        $icon = $this->getVariantProp('Icon', null);
    }
    
    $label = $icon != null ? $label . ' <i class="' . $icon . '"></i>' : $label;
?>
<?php
    if($link !== 'submit') {
?>
<a class="button-alternate" href="<?php echo $link; ?>" aria-label="<?php echo $ariaLabel; ?>" target="<?php echo $target; ?>"><?php echo $label; ?></a>
<?php
    } else {
?>
<button class="button-alternate" type="submit"><?php echo $label; ?></button>
<?php
    }
?>