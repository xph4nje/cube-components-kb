<?php
    $oddAlign = $this->getProp("Allineamento Foto Testo Dispari", "Foto - Testo") == "Foto - Testo" ? "row" : "row-reverse";
    $evenAlign = $this->getProp("Allineamento Foto Testo Pari", "Foto - Testo") == "Foto - Testo" ? "row" : "row-reverse";
    $extraFieldVariant = $this->getVariant('Dati Aggiuntivi', '');
    $childsContent = $this->getModulo("Contenuto Blocchi da Figli");
    $noPaddingMobile = $this->getProp("No Padding Mobile") == "yes";
    $headingTitle = $this->getProp('Heading Titolo', 'h2');
    $headingSubtitle = $this->getProp('Heading Sottotitolo', 'h3');
    $ctaOnImage = $this->getProp("CTA on image") == "yes";
    $overlap = $this->getProp("Sovrapposizione Elementi", "none");
    $hasDifferentImageFormat = $this->getProp("Formato Foto Pari", "") != "";
    $imageTablet = $this->getProp("Formato Foto Tablet", "") != "";
    $imageMobile = $this->getProp("Formato Foto Mobile", "") != "";
    $reverseTitles = $this->getProp("Inverti titoli", "no") == "yes";
    
    $blocks = [];
    if($childsContent == 'yes') {
        $menuSecondario = $this->getMenuSecondario();
        $blocks = $this->menuVoicesToElenco($menuSecondario);
    } else if($childsContent == 'menu') {
        $menuChilds = $this->getModulo("Contenuto Blocchi da Menu");
        $blocks = $this->menuVoicesToElenco($menuChilds);
    } else {
        $blocks = $this->getModulo("Contenuto Blocchi Manuale");
    }
    if(is_array($blocks) && count($blocks) > 0) {
?>
<div class="base-block-list">
    <?php
        $index = 0;
        foreach($blocks as $block) {
            $images = $block['Gallery'];
            $ctas = $block['Ctas'];
            $hasCta = is_array($ctas) && count($ctas) > 0;
    ?>
    <div class="base-block-list__element <?php echo $index%2==0 ? $oddAlign : $evenAlign; ?> <?php if($overlap != "none") { echo "overlap-" . $overlap; } ?> <?php echo $index%2==1 && $hasDifferentImageFormat ? 'even-image' : '' ?>">
        <div class="boxed <?php if($noPaddingMobile) { echo "boxed--mobileno"; } ?>">
            <?php
                if(isset($block["Separatore"]) && $block["Separatore"] != "") {
            ?>
            <div class="base-block-list__element__sep">
                <?php echo $block["Separatore"]; ?>
            </div>
            <?php
                }
            ?>
            <div class="base-block-list__element__inner">
                <div class="base-block-list__element__image">
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
                    <div class="page-thumb <?php if($imageTablet) { echo 'tablet'; } ?> <?php if($imageMobile) { echo 'mobile'; } ?>">
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
                    <div class="page-thumb <?php if($imageTablet) { echo 'tablet'; } ?> <?php if($imageMobile) { echo 'mobile'; } ?>">
                        <?php
                            if($ctaOnImage && $hasCta) {
                        ?>
                        <a href="<?php echo $ctas[0]['link'] ?>" target="<?php echo $ctas[0]['target'] ?>">
                        <?php
                            }
                        ?>
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
                        <?php
                            if($ctaOnImage && $hasCta) {
                        ?>
                        </a>
                        <?php
                            }
                        ?>
                    </div>
                    <?php
                                }
                            }
                        }
                    ?>
                </div>
                <div class="base-block-list__element__text">
                    <div class="base-block-list__element__text__inner">
                        <div class="base-block-list__element__text__inner__titles <?php if($reverseTitles) { echo 'reverse'; } ?>">
                        <<?php echo $headingTitle; ?> class="base-block-list__element__text__title"><?php echo $block['Titolo']; ?></<?php echo $headingTitle; ?>>
                        <<?php echo $headingSubtitle; ?> class="base-block-list__element__text__subtitle"><?php echo $block['Sottotitolo']; ?></<?php echo $headingSubtitle; ?>>
                        </div>
                        <?php
                            if($extraFieldVariant != '') {
                                echo $this->getComponente($extraFieldVariant, isset($block["PageId"]) ? ['idPagina' => $block["PageId"]] : [], 'Dati Aggiuntivi');
                            }
                        ?>
                        <div class="pt-s base-block-list__element__text__content"><?php echo $block['Testo']; ?></div>
                        <?php
                            if(is_array($ctas) && count($ctas) > 0) {
                        ?>
                        <div class="base-block-list__element__text__ctas">
                            <?php
                                foreach($ctas as $cta) {
                                    $buttonVariant = $this->getVariant('Tipologia pulsanti');
                                    if($buttonVariant != '') {
                                        echo $this->getComponente($buttonVariant, [
                                            'link' => $cta['link'],
                                            'label' => $cta['label'],
                                            'target' => $cta['target']
                                        ], 'Tipologia pulsanti');
                                    } else {
                            ?>
                            <a class="cta" href="<?php echo $cta['link']; ?>"><?php echo $cta['label']; ?></a>
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
    </div>
    <?php
                $index++;
            }
    ?>
</div>
<?php
    }
?>