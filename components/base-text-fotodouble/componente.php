<?php
    $mainImages = $this->getModulo("Foto Principale - Slider");
    $subImage = $this->getModulo("Foto Secondaria");
    $title = $this->getModulo("Titolo");
    $subtitle = $this->getModulo("Sottotitolo");
    $text = $this->getModulo("Testo");
    $ctas = $this->getModulo("Ctas");
    $direction = $this->getProp("Orientamento Contenuti", "testi - foto");
    $invertTitles = $this->getProp("Inverti Titoli", "no") == "yes";
?>
<section class="base-text-fotodouble <?php if($direction != "testi - foto") { echo "base-text-fotodouble--inverse"; } ?> boxed">
    <div class="relative">
        <div class="base-text-fotodouble__titles <?php if($invertTitles) { echo 'reverse'; } ?>">
            <h2 class="base-text-fotodouble__titles__title">
                <?php echo $title; ?>
            </h2>
            <?php if($subtitle != "") { ?>
                <h3 class="base-text-fotodouble__titles__subtitle">
                    <?php echo $subtitle; ?>
                </h3>
            <?php } ?>
        </div>
        <div class="base-text-fotodouble__content">
            <div class="base-text-fotodouble__content__text">
                <div class="pt-s">
                    <?php echo $text; ?>
                </div>
                
                <?php if(is_array($ctas) && count($ctas) > 0) { ?>
                    <div class="base-text-fotodouble__content__text__ctas">
                        <?php foreach($ctas as $cta) {
                            $ariaLabel = $this->variabili_lingua('apri_link')." ".$cta['label'];
                            if($cta['target'] == "_blank"){
                                $ariaLabel = $ariaLabel." ".$this->variabili_lingua('alce-link_nuova_finestra');
                            }                            
                            $buttonVariant = $this->getVariant('Tipologia pulsanti');
                            if($buttonVariant != '') {
                                echo $this->getComponente($buttonVariant, [
                                    'link' => $cta['link'],
                                    'label' => $cta['label'],
                                    'ariaLabel' => $ariaLabel,
                                    'target' => $cta['target']
                                ], 'Tipologia pulsanti');
                            } else { ?>
                                <a class="cta" href="<?php echo $cta['link']; ?>" aria-label="<?php echo $ariaLabel; ?>">
                                    <?php echo $cta['label']; ?>
                                </a>
                            <?php }
                        } ?>
                    </div>
                <?php } ?>
                
            </div>
            <div class="base-text-fotodouble__content__images">
                <div class="base-text-fotodouble__content__images__main">
                    <?php
                        if(count($mainImages) > 0) {
                            $sliderVariant = $this->getVariant('Includi Slider');
                            if($sliderVariant != '' && count($mainImages) > 1) {
                                echo $this->getComponente($sliderVariant, [
                                    'Images' => $mainImages
                                ], 'Includi Slider');
                            } else {
                    ?>
                    <div class="page-thumb">
                        
                        <?php 
                        $hasVideo = $mainImages[0]['video'] != '';
                        if ($hasVideo) {
                            echo $this->getVideo($mainImages[0]['video'],
                            [
                                'id' => 'video',
                                'class' => '',
                                'poster' => $this->getVideoPoster($this->getImg($mainImages[0]['files'], 'medium'))
                            ],
                            [
                                'autoplay',
                                'loop',
                                'muted',
                                'playsinline',
                                'webkit-playsinline'
                            ]); 
                        } else {
                            $pictureParams = [
                                'image' => $mainImages[0]['files'],
                                'title' => $mainImages[0]['titolo'],
                                'priority' => false,
                                'desktop' => 'medium',
                            ];
                            echo $this->getComponente('basic-picture', $pictureParams); 
                        }?>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
                <div class="base-text-fotodouble__content__images__side">
                    <?php
                        if(count($subImage) > 0) {
                    ?>
                    <div class="page-thumb">
                        
                            
                            <?php 
                            $hasVideo = $subImage[0]['video'] != '';
                            if ($hasVideo) {
                                echo $this->getVideo($subImage[0]['video'],
                                [
                                    'id' => 'video',
                                    'class' => '',
                                    'poster' => $this->getVideoPoster($this->getImg($subImage[0]['files'], 'medium'))
                                ],
                                [
                                    'autoplay',
                                    'loop',
                                    'muted',
                                    'playsinline',
                                    'webkit-playsinline'
                                ]); 
                            } else {
                                $pictureParams = [
                                    'image' => $subImage[0]['files'],
                                    'title' => $subImage[0]['titolo'],
                                    'priority' => false,
                                    'desktop' => 'medium',
                                ];
                                echo $this->getComponente('basic-picture', $pictureParams); 
                            }?>
                        </div>
                    <?php
                        }
                    ?>
                </div>
                
            </div>
        </div>
    </div>
</section>