<?php
    $content = $this->getBlocco("Blocco Offerte");
    $title = isset($content['Titolo']) ? $content['Titolo'] : '';
    $subtitle = isset($content['Sottotitolo']) ? $content['Sottotitolo'] : '';
    $text = isset($content['Testo']) ? $content['Testo'] : '';
    $offers = isset($content['Offerte']) ? $content['Offerte'] : [];
    $hideIncurrentComposition = $this->getProp('Hide in composition', 'no') != "no";
    $iconPosition = $this->getProp('Posizione Icone', 'hidden');
    $hideText = $this->getProp('Nascondi Testo', 'no') != "no";
    $iconArrow = $this->getVariantProp('Icona Freccia Sinistra (classe)','fa-light fa-arrow-left');
    $slideLinkTarget = $this->getProp("Slide Link Target", "_self");
    $reverseTitles = $this->getProp("Inverti titoli", "no") == "yes";
    
    if(!$hideIncurrentComposition && is_array($offers) && count($offers) > 0) {
?>
<section class="base-offers-columns boxed">
    <div class="base-offers-columns__text">
        <div class="base-offers-columns__text__titles <?php if($reverseTitles) { echo "reverse"; } ?>">
            <?php
                if($title !== '') {
            ?>
            <h2 class="base-offers-columns__text__titles__title"><?php echo $title; ?></h2>
            <?php
                }
            ?>
            <?php
                if($subtitle !== '') {
            ?>
            <h3 class="base-offers-columns__text__titles__subtitle"><?php echo $subtitle; ?></h3>
            <?php
                }
            ?>
        </div>
        <?php
            if($text !== '') {
        ?>
        <div class="base-offers-columns__text__text"><?php echo $text; ?></div>
        <?php
            }
        ?>
    </div>
    <div class="base-offers-columns__slides">
        <div class="base-offers-columns__list">
            <?php
                $cardVariant = $this->getVariant('Scheda Offerta');
                if($cardVariant == '') {
                    echo '<p>Selezionare una variante di scheda contenuto</p>';
                } else {
            ?>
            <div class="swiper-container">
                <div class="swiper-wrapper" data-length="<?php echo count($offers); ?>">
                    <?php
                        foreach($offers as $offer) {
                            $id_albergo = isset($offer['offerta_id_albergo']) ? $offer['offerta_id_albergo'] : '';
                            $id_prodotto = isset($offer['offerta_id_prodotto']) ? $offer['offerta_id_prodotto'] : '';
                            $titolo = isset($offer['offerta_titolo']) ? $offer['offerta_titolo'] : $offer['titolo'];
                            $descrizione = isset($offer['offerta_descrizione']) ? $offer['offerta_descrizione'] : $offer['descrizione'];
                            $image = isset($offer['files']) ? $offer['files'] : $this->getImgOfferta($id_albergo, $id_prodotto, 'main'); 
                            $ariaLabel = $this->variabili_lingua('apri_link')." ".$titolo;
                    ?>
                    <div class="swiper-slide">
                        <?php
                            echo $this->getComponente($cardVariant, [
                                    'cardContent' => [
                                        'imgSrc' => $image,
                                        'imgTitle' => strip_tags($titolo),
                                        'titolo' => $this->tagliaStringa($titolo, 25),
                                        'sottotitolo' => '',
                                        'descrizione' => $hideText ? '' : $this->tagliaStringa($descrizione, 150),
                                        'link' => $this->getLinkOfferte($id_prodotto, $id_albergo),
                                        'label' => $this->__('Scopri di più'),
                                        'ariaLabel' => $ariaLabel,
                                        'target' => $slideLinkTarget
                                    ]
                                ], 'Scheda Offerta');
                        ?>
                    </div>
                    <?php
                        } 
                    ?>
                </div>
            </div>
            <?php
                }
            ?>
            <?php
                if($iconPosition != 'hidden') {
            ?>
            <div class="pt-s pb-s base-offers-columns__nav">
                <span class="base-offers-columns__nav__prev"><i class="<?php echo $iconArrow; ?>"></i></span>
                <span class="base-offers-columns__nav__next"><i class="<?php echo $iconArrow; ?>"></i></span>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</section>
<?php
    }
?>