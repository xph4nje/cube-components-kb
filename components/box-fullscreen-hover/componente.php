<?php $box = $this->getModulo("Box Fullscreen Hover"); ?>
<?php $tagTitoli = $this->getProp("Tag Titoli", "h2"); ?>
<?php $tagSottotitoli = $this->getProp("Tag Sottotitoli", "h3"); ?>
<?php $visibilityLogo = $this->getProp("Visibilità Logo", "no") == "yes"; ?> 

<?php if(isset($box) && is_array($box) && count($box) > 0 ){ ?>
    <section class="box-fullscreen-hover">
        <div class="cont-absolute">
            <?php foreach($box as $elemento){ ?>
                <div class="box-fullscreen-hover__element <?php if ($this->getProp("Linee Separatrici","no") == "yes") { echo "lines";} ?>">
                    
                    <div class="box-fullscreen-hover__element__text">
                        <?php if (isset($elemento['Logo']) && is_array($elemento['Logo']) && count($elemento['Logo']) > 0 && $visibilityLogo) { ?>
                        <div class="box-fullscreen-hover__element__logo">
                            <?php
                                $pictureParams = [
                                    'image' => $elemento['Logo'][0]['files'],
                                    'priority' => false,
                                    'desktop' => 'full',
                                    'mobile' => 'full'
                                ];
                                echo $this->getComponente('basic-picture', $pictureParams);
                            ?>
                        </div>
                        <?php } ?>
                        <<?php echo $tagTitoli; ?> class="box-fullscreen-hover__element__text__titolo">
                            <?= $elemento['Titolo'] ?>
                        </<?php echo $tagTitoli; ?>>
                        <?php if($elemento['Sottotitolo'] != ""){ ?>
                            <<?php echo $tagSottotitoli; ?> class="box-fullscreen-hover__element__text__sottotitolo">
                                <?= $elemento['Sottotitolo'] ?>
                            </<?php echo $tagSottotitoli; ?>>
                        <?php } ?>
                        <?php if($elemento['Testo'] != ""){ ?>
                            <div class="box-fullscreen-hover__element__text__descrizione">
                                <?= $elemento['Testo'] ?>
                            </div>
                        <?php } ?>  
                        <?php
                            if(isset($elemento['Link']) && is_array($elemento['Link']) && count($elemento['Link']) > 0 ) { ?>
                                <div class="box-fullscreen-hover__element__text__links">
                                    <div class="box-fullscreen-hover__element__text__links__wrapper">
                                        <?php foreach($elemento['Link'] as $cta) {
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
                                        } ?>
                                    </div>
                                </div>
                            <?php }
                        ?>          
                    </div>
                    <?php if (is_array($elemento['Immagine']) && count($elemento['Immagine']) > 0) { ?>
                    <div class="box-fullscreen-hover__element__immagine">
                        <?php
                            $pictureParams = [
                                'image' => $elemento['Immagine'][0]['files'],
                                'priority' => false,
                                'desktop' => 'full',
                                'mobile' => 'vertical_mobile'
                            ];
                            echo $this->getComponente('basic-picture', $pictureParams);
                        ?>
                    </div> 
                    <?php } ?>
                </div> 
            <?php } ?>
        </div>
    </section> 
<?php } ?> 