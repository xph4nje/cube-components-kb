<?php
    $props = isset($props) && is_array($props) ? $props : [];
    $link = array_key_exists('link', $props) ? $props['link'] : '#';
    $label = array_key_exists('label', $props) && $props['label'] != "" ? $props['label'] : $this->__("Scopri di più");
    $ariaLabel = array_key_exists('ariaLabel', $props) && $props['ariaLabel'] != "" ? $props['ariaLabel'] : $label;
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
<?php
    if(!$isSubmit) {
?>
<a class="button-basic" href="<?php echo $link; ?>" aria-label="<?php echo $ariaLabel; ?>" target="<?php echo $target; ?>"><?php echo $label; ?></a>
<?php
    } else {
?>
<button class="button-basic" type="submit"><?php echo $label; ?></button>
<?php
    }
?>