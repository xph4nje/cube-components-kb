<?php
    $offers = $this->getModulo("Offerte");
    if(is_array($offers) && count($offers) > 0) {
        $linkTarget = $this->getProp("Link Target", "_self");
?>

<section>

    <h2 class="visibility-hidden">
        <?= $this->__("lista-offerte"); ?>
    </h2>
    
    <ul class="base-offers-list boxed">
        <?php
            foreach($offers as $offer) {
                $id_albergo = isset($offer['offerta_id_albergo']) ? $offer['offerta_id_albergo'] : '';
                $id_prodotto = isset($offer['offerta_id_prodotto']) ? $offer['offerta_id_prodotto'] : '';
                $titolo = isset($offer['offerta_titolo']) ? $offer['offerta_titolo'] : $offer['titolo'];
                $descrizione = isset($offer['offerta_descrizione']) ? $offer['offerta_descrizione'] : $offer['descrizione'];
                $image = isset($offer['files']) ? $offer['files'] : $this->getImgOfferta($id_albergo, $id_prodotto, 'main'); 
        ?>
        <li class="base-offers-list__element">
            <div class="base-offers-list__element__image">
                <div class="page-thumb">
                    <img alt="<?php echo $this->cleanTitle($titolo); ?>" title="<?php echo $this->cleanTitle($titolo); ?>" class="lazy sigle" data-src="<?php echo $image; ?>">    
                </div>
            </div>
            <div class="base-offers-list__element__text">
                <div>
                    <h3 class="base-offers-list__element__text__title bordered"><?php echo $this->tagliaStringa($titolo, 20); ?></h3>
                    <div class="base-offers-list__element__text__description pt-s">
                        <div>
                            <?php echo $this->tagliaStringa($descrizione, 150); ?>
                        </div>
                        <div class="pt-s">
                            <?php
                                $ariaLabel = $this->variabili_lingua('apri_link')." ".$titolo;
                                if($linkTarget == "_blank"){
                                    $ariaLabel = $ariaLabel." ".$this->variabili_lingua('alce-link_nuova_finestra');
                                }                            
                                $buttonVariant = $this->getVariant('Tipologia pulsanti', 'basic-button');
                                if($buttonVariant != '') {
                                    echo $this->getComponente($buttonVariant, [
                                        'link' => $this->getLinkOfferte($id_prodotto, $id_albergo),
                                        'label' => $this->__('Scopri di più'),
                                        'ariaLabel' => $ariaLabel,
                                        'target' => $linkTarget
                                    ], 'Tipologia pulsanti');
                                } else {
                            ?>
                            <a class="cta" href="<?php echo $cta['link']; ?>" aria-label="<?php echo $ariaLabel; ?>">
                                <?php echo $cta['label']; ?>
                            </a>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php
            }
        ?>
    </ul>

</section>

<?php
    }
?>