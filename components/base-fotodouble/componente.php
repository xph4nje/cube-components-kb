<?php
    $mainImages = $this->getModulo("Foto Principale - Slider");
    $subImage = $this->getModulo("Foto Secondaria");
    $title = $this->getModulo("Titolo");
    $subtitle = $this->getModulo("Sottotitolo");
    $text = $this->getModulo("Testo");
    $ctas = $this->getModulo("Ctas");
    $direction = $this->getProp("Orientamento Contenuti", "foto - testi");
    $hiddenText = $this->getProp("Nascondi Testo", 'yes');
    if((is_array($mainImages) && count($mainImages) > 0) || (is_array($subImage) && count($subImage) > 0)) {
?>
<section class="base-fotodouble <?php if($direction != "foto - testi") { echo "base-fotodouble--inverse"; } ?> boxed">
    <div class="base-fotodouble__main">
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
    <div class="base-fotodouble__sub">
        <div class="base-fotodouble__sub__title">
            <h2><?php echo $title; ?></h2>
        </div>
        <div class="base-fotodouble__sub__subtitle">
            <h3><?php echo $subtitle; ?></h3>
        </div>
        <div class="base-fotodouble__sub__image pt-s">
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
        <?php if ($text != '' && $hiddenText == "no") { ?>
        <div class="base-fotodouble__text"><?=$text?></div>
        <?php } ?>
        <div class="pt-s buttons-cnt">
            <?php
                if(is_array($ctas)) {
                    foreach($ctas as $cta) {
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
                        } else {
            ?>
            <a class="cta" href="<?php echo $cta['link']; ?>" aria-label="<?php echo $ariaLabel; ?>">
                <?php echo $cta['label']; ?>
            </a>
            <?php
                        }
                    }
                }
            ?>
        </div>
    </div>
</section>
<?php
    }
?>