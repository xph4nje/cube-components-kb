<?php
    $props = isset($props) && is_array($props) ? $props : [];
    $link = array_key_exists('link', $props) ? $props['link'] : 'javascript:openForm()';
    $label = array_key_exists('label', $props) && $props['label'] != "" ? $props['label'] : $this->__("Prenota");
    $labelOff = array_key_exists('labelOff', $props) && $props['labelOff'] != "" ? $props['labelOff'] : $this->__("Chiudi");  
    $isSubmit = array_key_exists('isSubmit', $props) && $props['isSubmit'] != "";
    $isOpenButtonQR = array_key_exists('isOpenButtonQR', $props) && $props['isOpenButtonQR'] != "";
    $noState = array_key_exists('noState', $props) && $props['noState'];
    
    $icon = array_key_exists('Icon', $props) && $props['Icon'] != "" ? $props['Icon'] : null;
    if($icon == null) {
        $icon = $this->getVariantProp('Icon', null);
    }
    
    $label = $icon != null ? ' <i class="' . $icon . '"></i>' . $label : $label;
    
    if($isSubmit) {
?>
    <button class="base-booking-button" type="submit">
        <?php echo $label; ?>
    </button>
    
    <?php } elseif($isOpenButtonQR) { ?>
        <button class="base-booking-button" onclick="<?php echo $link; ?>">
            <span class="on"><?php echo $label; ?>
            </span><span class="off"><?php echo $labelOff; ?></span>
        </button>  
    <?php } else { ?>
    
    <a class="base-booking-button <?php if($noState) { echo 'no-state'; } ?>" href="<?php echo $link; ?>">
        <span class="on"><?php echo $label; ?>
        </span><span class="off"><?php echo $labelOff; ?></span>
    </a>
<?php
    }
?>