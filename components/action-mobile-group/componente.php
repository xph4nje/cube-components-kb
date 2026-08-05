<?php
    $buttonBookingVariant = $this->getVariant('Tipologia Pulsante Prenota');
    $buttonBookingVariant = $buttonBookingVariant !== '' ? $buttonBookingVariant : 'button-basic';
    $buttonPosition = $this->getProp("Posizione Prenota", "right");
    $mobileDescount = $this->getProp("Applica Sconto Mobile", "no") == "yes";
    
    $groupIcon = $this->getProp("Icona Menu Strutture", "fa-light fa-hotel");
    
    $linkBe = $this->getProp("Schermata Apertura Be", "");
    
    if ($this->getProp("Link Booking esterno", "no") == "no") {
        $linkBooking = $this->getLinkBooking($linkBe) . ( $mobileDescount ? '&generic_codice=MOBILE' : '' );
    } else {
        $linkBooking = $this->__("Link booking esterno");
    }
    
    $menuAction = $this->getMenu("Action Mobile Extra");
    
    $strutture = [
        0 => [
            "id_struttura" => "1",
            "nome_struttura" => "Struttura 1",
        ],
        1 => [
            "id_struttura" => "1",
            "nome_struttura" => "Struttura 2",
        ] 
    ];

    if (is_array($this->getListaStrutture()) && count($this->getListaStrutture()) > 0) {
        $strutture = $this->getListaStrutture();
    };
?>
<div class="basic-footer-mobile hide-tablet hide-desktop pos-<?php echo $buttonPosition; ?>">
    <a class="basic-footer-mobile__icon basic-footer-mobile__tel" href="tel:<?php echo $this->getInfoStruttura('telefono'); ?>" aria-label="call"><?php echo $this->iconPreload("fa-light fa-phone"); ?></a>
    <a class="basic-footer-mobile__icon basic-footer-mobile__map" href="<?php echo $this->getInfoStruttura('google_map'); ?>" target="blank"  aria-label="navigate"><?php echo $this->iconPreload("fa-light fa-location-dot"); ?></a>
    <?php if (isset($menuAction) && is_array($menuAction) && count($menuAction) > 0) { foreach($menuAction as $voice) { ?>
       <?php if ($voice['testo_link'] != '') { ?><a class="basic-footer-mobile__icon" href="<?=$voice['link']?>" aria-label="<?=$voice['testo_link']?>"><?php echo $this->iconPreload($voice['icona']); ?></a><?php } ?>
    <?php } } ?>
    <div class="basic-footer-mobile__icon basic-footer-mobile__group">
        <span class="basic-footer-mobile__group__icon"><i class="<?=$groupIcon;?>"></i></span>
        <div class="basic-footer-mobile__group__cnt">
            <?php if (is_array($strutture) && count($strutture) > 0) { ?>
            <ul>
            <?php foreach($strutture as $s) { ?>
            <li class="strutture_children_list_item">
                <a href="<?=$this->getLinkHome($this->id_lingua, $s['id_struttura'])?>" aria-label="<?=$this->getInfoStruttura("nome_struttura", $s['id_struttura'])?>" title="<?=$this->getInfoStruttura("nome_struttura", $s['id_struttura'])?>" class="strutture_children_list_item__link <?php if ($this->id_struttura == $s['id_struttura']) { echo "active"; } ?>"><?=$this->getInfoStruttura("nome_struttura", $s['id_struttura'])?></a>
            </li>
            <?php } ?>
            </ul>
            <?php } ?>
        </div>
    </div>
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