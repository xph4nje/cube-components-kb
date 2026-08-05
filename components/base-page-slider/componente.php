<?php
    $title = $this->getModulo("Titolo Blocco");
    $subtitle = $this->getModulo("Sottotitolo Blocco");
    $blocks = $this->getModulo("Contenuto Blocchi Manuale");
    $boxed = $this->getProp("Boxed Size Slider");
    $invertTitles = $this->getProp("Inverti Titoli", "no") == "yes";
    if($boxed == "var(--size-full)") {
        $boxed = "";   
    }
    $isManual = count($blocks) > 0;
    $iconPosition = $this->getVariantProp('Posizione Frecce','hidden');
    if(!$isManual) {
        $menuChilds = $this->getModulo("Contenuto Blocchi Da Menu");
        $blocks = $this->menuVoicesToElenco($menuChilds);
    }
    
    $centraturaSlides = $this->getProp("Centratura Slides", 'no');
    $centraturaSlides = $centraturaSlides == "yes" ? "center" : "left";
    $iconArrow = $this->getVariantProp('Icona Freccia','fa-light fa-arrow-left');
    
    $scaleNotActive = $this->getProp("Scale Not Active", 'yes') == 'yes';
    
    $pagination = $this->getVariant("Pagination","pagination");
    $paginationPosition =  $this->getProp("Pagination Position", "none");
    
    if(count($blocks) > 0) {
?>

<div class="base-page-slider" data-align="<?php echo $centraturaSlides;?>">
    <div class="boxed base-page-slider__titles <?php if($invertTitles) { echo 'reverse'; } ?>">
        <?php
            if($title != '') {
        ?>
        <h2 class="base-page-slider__title"><?php echo $title; ?></h2>
        <?php
            }
        ?>
        <?php
            if($subtitle != '') {
        ?>
        <h3 class="base-page-slider__subtitle"><?php echo $subtitle; ?></h3>
        <?php
            }
        ?>
    </div>
    <div class="base-page-slider__slider">
        <div class="<?php echo $boxed != "" ? "boxed" : ""; ?>">
            <?php
                $cardVariant = $this->getVariant('Scheda Pagina');
                if($cardVariant == '') {
                    echo '<p>Selezionare una variante di scheda contenuto</p>';
                } else {
            ?>
            <div class="swiper-container">
                <div class="swiper-wrapper" style="display:flex;flex-wrap:nowrap;">
                    <?php
                        foreach($blocks as $block) {
                    ?>
                    <div class="swiper-slide <?php if($scaleNotActive) { echo 'slide-scale'; } ?>">
                        <?php
                            $files = isset($block['Gallery']) && count($block['Gallery']) > 0 ? $block['Gallery'][0]['files'] : '';
                            $titolo = isset($block['Titolo']) ? $block['Titolo'] : '';
                            $sottotitolo = isset($block['Sottotitolo']) ? $block['Sottotitolo'] : '';
                            $descrizione = isset($block['Testo']) ? $block['Testo'] : '';
                            $link = is_array($block['Ctas']) && isset($block['Ctas']) && count($block['Ctas']) > 0 ? $block['Ctas'][0] : [];
                            echo $this->getComponente($cardVariant, [
                                    'cardContent' => [
                                        'files' => $files,
                                        'titolo' => $titolo,
                                        'sottotitolo' => $sottotitolo,
                                        'descrizione' => !$isManual ? $this->tagliaStringa($descrizione, 150) : $descrizione,
                                        'link' => count($link) > 0 ? $link['link'] : '',
                                        'label' => count($link) > 0 ? $link['label'] : '',
                                        'target' => count($link) > 0 ? $link['target'] : ''
                                    ]
                                ], 'Scheda Pagina');
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
            
            <?php if ($paginationPosition != "none" && $paginationPosition != "between-arrows") { 
                echo $this->getComponente($pagination, [
                    'position' => $paginationPosition
                    
                ], 'Pagination');
            } ?>
            
            <?php
                if($iconPosition != 'hidden') {
            ?>
            <div class="pt-s pb-s base-page-slider__nav base-page-slider__nav--<?php echo $iconPosition; ?>">
                <span class="base-page-slider__nav__prev"><i class="<?php echo $iconArrow; ?>"></i></span>
                
                <span class="base-page-slider__nav__next"><i class="<?php echo $iconArrow; ?>"></i></span>
            </div>
            <?php
                }
            ?>
            
            
            
        </div>
    </div>
</div>
<?php
    }
?>