<?php
    $content = $this->getBlocco("Blocco Offerte");
    $title = isset($content['Titolo']) ? $content['Titolo'] : '';
    $subtitle = isset($content['Sottotitolo']) ? $content['Sottotitolo'] : '';
    $text = isset($content['Testo']) ? $content['Testo'] : '';
    $offers = isset($content['Offerte']) ? $content['Offerte'] : [];
    $hideIncurrentComposition = $this->getProp('Hide in composition', 'no') != "no";
    $hideText = $this->getProp('Nascondi Testo', 'no') != "no";
    $iconArrow = $this->getVariantProp('Icona Freccia Sinistra (classe)','fa-light fa-arrow-left');
    $iconPosition = $this->getVariantProp('Posizione Frecce','hidden');
    $sliderIsBoxed = $this->isBoxed($this->getProp('Boxed Size Slider', ''));
    $slideLinkTarget = $this->getProp("Slide Link Target", "_self");
    $titleTrim = (int)$this->getVariantProp('Taglia Titolo','25');
    $reverseTitle = $this->getProp("Inverti Titoli", "no") == "yes";
    $centerSlides = $this->getProp("Center Slides", "yes") == "yes";
    $pagination = $this->getVariant("Pagination", "pagination");
    $paginationPosition =  $this->getProp("Pagination Position", "none");
    $buttonVariant = $this->getVariant("Tipologia pulsante offerte", "basic-button");
    
    
    
    $hasLink = isset($content['Link']) && $content['Link'] != '' ? true : false;
    
    if(!$hideIncurrentComposition && is_array($offers) && count($offers) > 0) {
?>
<section class="base-offers-slider" data-center="<?php echo $centerSlides ? "true" : "false"; ?>">
    <div class="base-offers-slider__content boxed">
        <div class="base-offers-slider__content__titles <?php if($reverseTitle) { echo 'reverse'; } ?>">
            <?php
                if($title !== '') {
            ?>
            <h2 class="base-offers-slider__content__titles__title"><?php echo $title; ?></h2>
            <?php
                }
            ?>
            <?php
                if($subtitle !== '') {
            ?>
            <h3 class="base-offers-slider__content__titles__subtitle"><?php echo $subtitle; ?></h3>
            <?php
                }
            ?>
        </div>
        <?php
            if($text !== '') {
        ?>
        <div class="base-offers-slider__content__text"><?php echo $text; ?></div>
        <?php
            }
        ?>
    </div>
    <div class="base-offers-slider__slides">
        <div class="base-offers-slider__list <?php if($sliderIsBoxed) { echo "boxed";} ?>">
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
                    ?>
                    <div class="swiper-slide <?php if(count($offers) == 1) { echo "no-border";  } ?>">
                        <?php
                            echo $this->getComponente($cardVariant, [
                                    'cardContent' => [
                                        'imgSrc' => $image,
                                        'imgTitle' => strip_tags($titolo),
                                        'titolo' => $this->tagliaStringa($titolo, $titleTrim),
                                        'sottotitolo' => '',
                                        'descrizione' => $hideText ? '' : $this->tagliaStringa($descrizione, 150),
                                        'link' => $this->getLinkOfferte($id_prodotto, $id_albergo),
                                        'label' => $this->__('Scopri di più'),
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
            <?php if (count($offers) > 1 && $paginationPosition != "none" && $paginationPosition != "between-arrows") { 
                echo $this->getComponente($pagination, [
                    'position' => $paginationPosition
                    
                ], 'Pagination');
            } ?>
            <?php
                if(count($offers) > 1 && $iconPosition != 'hidden') {
            ?>
            <div class="pt-s pb-s base-offers-slider__nav basic-slider__nav--<?php echo $iconPosition; ?>">
                <span class="base-offers-slider__nav__prev"><i class="<?php echo $iconArrow; ?>"></i></span>
                <?php if ($paginationPosition == "between-arrows") { 
                    echo $this->getComponente($pagination, [
                        'position' => $paginationPosition
                        
                    ], 'Pagination');
                } ?>
                <span class="base-offers-slider__nav__next"><i class="<?php echo $iconArrow; ?>"></i></span>
            </div>
            <?php
                }
            ?>
            
            
        </div>
    </div>
    <?php if ($hasLink) { 
        $link = $this->trovaAncora($content['Link']) != "" ? $this->trovaAncora($content['Link']) : "demo";
        $label = $this->__("Tutte le offerte");
        $ariaLabel = $this->variabili_lingua('apri_link')." ".$this->__("Tutte le offerte");     
    ?>
    <div class="base-offers-slider__buttons">
        <?php if($buttonVariant != '') {
            echo $this->getComponente($buttonVariant, [
                'link' => $link,
                'label' => $label,
                'ariaLabel' => $ariaLabel,
                'target' => "_self"
            ], 'Tipologia pulsante prenota');
        } else { ?>
            <a href="<?=$link;?>" title="<?=$label;?>" class="button" aria-label="<?php echo $ariaLabel; ?>">
                <?=$label;?>
            </a>
        <?php } ?>
    </div>
    <?php } ?>
</section>
<?php
    }
?>
