<?php
    $buttonBookingVariant = $this->getVariant('Tipologia Pulsante Prenota');
    $buttonBookingVariant = $buttonBookingVariant !== '' ? $buttonBookingVariant : 'button-basic';
    $buttonPosition = $this->getProp("Posizione Prenota", "right");
    $mobileDescount = $this->getProp("Applica Sconto Mobile", "no") == "yes";
    $linkBe = $this->getProp("Schermata Apertura Be", "");
    
    if ($this->getProp("Link Booking esterno", "no") == "no") {
        $linkBooking = $this->getLinkBooking($linkBe) . ( $mobileDescount ? '&generic_codice=MOBILE' : '' );
    } else {
        $linkBooking = $this->__("Link booking esterno");
    }
    
    $menuAction = $this->getMenu("Action Mobile Extra");
?>
<div class="basic-footer-mobile hide-tablet hide-desktop pos-<?php echo $buttonPosition; ?>">
    <a class="basic-footer-mobile__icon basic-footer-mobile__tel" href="tel:<?php echo $this->getInfoStruttura('telefono'); ?>" aria-label="call"><?php echo $this->iconPreload("fa-light fa-phone"); ?></a>
    <a class="basic-footer-mobile__icon basic-footer-mobile__map" href="<?php echo $this->getInfoStruttura('google_map'); ?>" target="blank"  aria-label="navigate"><?php echo $this->iconPreload("fa-light fa-location-dot"); ?></a>
    <?php if (isset($menuAction) && is_array($menuAction) && count($menuAction) > 0) { foreach($menuAction as $voice) { ?>
       <?php if ($voice['testo_link'] != '') { ?><a class="basic-footer-mobile__icon" href="<?=$voice['link']?>" aria-label="<?=$voice['testo_link']?>"><?php echo $this->iconPreload($voice['icona']); ?></a><?php } ?>
    <?php } } ?>
    <span class="basic-footer-mobile__button">
        <?php
            echo $this->getComponente($buttonBookingVariant, [
                'link' => $linkBooking,
                'label' => $this->__('Prenota'),
                'noState' => true
            ], 'Tipologia Pulsante Prenota');
        ?>
    </span>
</div>