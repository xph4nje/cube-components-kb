<?php 
    $titolo = $this->getModulo("Titolo");
    $sottotitolo = $this->getModulo("Sottotitolo");
    $testo = $this->getModulo("Testo");
    $immagine = $this->getModulo("Immagine");
    $ctas = $this->getModulo("Link");
    $map = $this->getModulo("Mappa");
    $anteprimaMappa = $this->getProp("Anteprima Mappa", "");
    
    $tagTitolo = $this->getProp("Tag Titolo", "h2");
    $tagSottotitolo = $this->getProp("Tag Sottotitolo", "h3");
    
    $flexDirection = $this->getProp("Disposizione Box", "testo - foto") == "testo - foto" ? "row" : "row-reverse";
?>
<section class="box-mappa-offset">
    <div class="box-mappa-offset_box">
        <div class="box-mappa-offset_flex <?=$flexDirection;?>">
            <div class="box-mappa-offset_content">
                <?php if (isset($titolo) && $titolo != '') { ?><div class="box-mappa-offset_title"><<?php echo $tagTitolo; ?>><?=$titolo;?></<?php echo $tagTitolo; ?>></div><?php } ?>
                <?php if (isset($sottotitolo) && $sottotitolo != '') { ?><div class="box-mappa-offset_subtitle"><<?php echo $tagSottotitolo; ?>><?=$sottotitolo;?></<?php echo $tagSottotitolo; ?>></div><?php } ?>
                
                <?php if (isset($testo) && $testo != '') { ?><div class="box-mappa-offset_text"><?=$testo;?></div><?php } ?>
                <div class="box-mappa-offset_cta">
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
            <div class="box-mappa-offset_photo">
                <div class="page-thumb">
                    <?php
                        if(is_array($immagine) && count($immagine) > 0) {
                            $pictureParams = [
                                'image' => $immagine[0]['files'],
                                'title' => $titolo,
                                'priority' => false,
                                'desktop' => 'full'
                            ];
                            echo $this->getComponente('basic-picture', $pictureParams);
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box-mappa-offset_map">
        <?php if (!$map) { ?>
            <div class="box-mappa-offset_imagemap">
                <?php
                    $pictureParams = [
                        'image' => $anteprimaMappa,
                        'priority' => false,
                        'desktop' => 'full',
                    ];
                    echo $this->getComponente('basic-picture', $pictureParams);
                ?>
            </div>
        <?php } else { ?>
            <?php echo $this->getMappa($map); ?>
        <?php } ?>
    </div>
        
</section>