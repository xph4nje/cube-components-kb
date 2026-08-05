<?php
    
    $headingTitle = $this->getProp('Heading Titolo', 'h2');
    $headingSubtitle = $this->getProp('Heading Sottotitolo', 'h3');
    
    $blocks = $this->getModulo("Box");
    
    $blur = $this->getProp("Sfondo Blur","no") == "yes" ? "blur" : "";
    
    $orientation = $this->getProp("Orientamento", "Foto - Testo") == "Foto - Testo" ? "row" : "row-reverse";
    $rev = $this->getProp("Orientamento titoli", "Normale") == "Invertito" ? "rev" : "";
    
    if(is_array($blocks) && count($blocks) > 0) {
?>
<section class="boxBg">
    <?php
        $index = 0;
        foreach($blocks as $block) {
            $images = $block['Immagine'];
            $bg = $block['Sfondo'];
            $ctas = $block['Ctas'];
            $hasCta = is_array($ctas) && count($ctas) > 0;
    ?>
    <div id="boxBg__item-<?=$index?>" class="boxBg__item <?=$orientation?>">
        <div class="boxBg__bg <?=$blur?>">
                <?php
                    if(count($bg) > 0) {
                       
                    if(isset($bg[0]['video']) && $bg[0]['video'] != "") {
                ?>
                <div class="page-thumb">
                    <?php
                        echo $this->getVideo($bg[0]['video'],
                            [
                                'id' => 'video',
                                'class' => '',
                                'poster' => $this->getVideoPoster($this->getImg($bg[0]['files'], 'thumbnail_mobile', true))
                            ],
                            [
                                'autoplay',
                                'loop',
                                'muted',
                                'playsinline',
                                'webkit-playsinline'
                            ]
                        ); 
                    ?>          
                </div>
                <?php
                    } else {
                ?>
                <div class="page-thumb">
                    
                    <?php
                        $title = $this->cleanTitle($block['Titolo'] . ( $block['Sottotitolo'] != "" ? " - " . $block['Sottotitolo'] : "" ));
                        $pictureParams = [
                            'image' => $bg[0]['files'],
                            'title' => $title,
                            'priority' => false,
                            'desktop' => 'medium'
                        ];
                        echo $this->getComponente('basic-picture', $pictureParams);
                    ?>
                    
                </div>
                <?php
                            
                        }
                    }
                ?>
            </div>
        <div class="boxBg__inner boxed">
            
            
            
            
            <div class="boxBg__image">
                <?php
                    if(count($images) > 0) {
                        $sliderVariant = $this->getVariant('Includi Slider');
                        if($sliderVariant != '' && count($images) > 1) {
                            echo $this->getComponente($sliderVariant, [
                                'Images' => $images
                            ], 'Includi Slider');
                        } else {
                            if(isset($images[0]['video']) && $images[0]['video'] != "") {
                ?>
                <div class="page-thumb">
                    <?php
                        echo $this->getVideo($images[0]['video'],
                            [
                                'id' => 'video',
                                'class' => '',
                                'poster' => $this->getVideoPoster($this->getImg($images[0]['files'], 'thumbnail_mobile', true))
                            ],
                            [
                                'autoplay',
                                'loop',
                                'muted',
                                'playsinline',
                                'webkit-playsinline'
                            ]
                        ); 
                    ?>          
                </div>
                <?php
                            } else {
                ?>
                <div class="page-thumb">
                    
                    <?php
                        $title = $this->cleanTitle($block['Titolo'] . ( $block['Sottotitolo'] != "" ? " - " . $block['Sottotitolo'] : "" ));
                        $pictureParams = [
                            'image' => $images[0]['files'],
                            'title' => $title,
                            'priority' => false,
                            'desktop' => 'medium'
                        ];
                        echo $this->getComponente('basic-picture', $pictureParams);
                    ?>
                    
                </div>
                <?php
                            }
                        }
                    }
                ?>
            </div>
            <div class="boxBg__content">
                <div class="boxBg__text">
                    <div class="boxBg__titles <?=$rev?>">
                    <div class="boxBg__title"><<?php echo $headingTitle; ?>><?php echo $block['Titolo']; ?></<?php echo $headingTitle; ?>></div>
                    <div class="boxBg__subtitle"><<?php echo $headingSubtitle; ?>><?php echo $block['Sottotitolo']; ?></<?php echo $headingSubtitle; ?>></div>
                    </div>
                    
                    <div class="boxBg__description"><?php echo $block['Testo']; ?></div>
                    <?php
                        if(is_array($ctas) && count($ctas) > 0) {
                    ?>
                    <div class="boxBg__ctas">
                        <?php
                            foreach($ctas as $cta) {
                                if($block['Titolo'] != ""){
                                    $ariaLabel = $this->variabili_lingua('apri_link')." ".$block['Titolo'];
                                }else{
                                    $ariaLabel = $cta['label'];
                                }
                                if($cta['target'] == "_blank"){
                                    $ariaLabel = $ariaLabel." ".$this->variabili_lingua('alce-link_nuova_finestra');
                                }                                
                                $buttonVariant = $this->getVariant('Tipologia pulsanti', 'basic-button'); 
                                if($buttonVariant != '') {
                                    echo $this->getComponente($buttonVariant, [
                                        'link' => $cta['link'],
                                        'label' => $cta['label'],
                                        'ariaLabel' => $ariaLabel,
                                        'target' => $cta['target']
                                    ], 'Tipologia pulsanti');
                                } else {
                        ?>
                        <a class="boxBg__cta cta" href="<?php echo $cta['link']; ?>"><?php echo $cta['label']; ?></a>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            
        </div>
    </div>
    <?php
                $index++;
            }
    ?>
</section>
<?php
    }
?>