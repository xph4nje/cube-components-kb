<?php
$boxF = $this->getModulo('Box hover img riduzione');
?>


<?php if (is_array($boxF) && count($boxF) > 0) { ?>
    <section class="box-images-shrink">
    
        <div class="box-images-shrink__inner">
            <?php foreach($boxF as $el) {?>
                <div class="box-images-shrink__box">
                    <div class="box-images-shrink__image">
                          
                        <?php 
                            if (
                                isset($el['Immagine'][0]['files']) &&
                               $el['Immagine'][0]['files'] != ""
                            ) {
                                $pictureParams = [
                                    'image' => $el['Immagine'][0]['files'],
                                    'priority' => false,
                                    'desktop' => 'full'
                                ];
                                echo $this->getComponente('basic-picture', $pictureParams);
                            }
                          ?>

                    </div>
                    
                    
                     <div class="box-images-shrink__text">
                        <?php if(!empty($el['Titolo'])) {?>
                            <h2 class="title <?php if($this->getProp("Visibilità Titolo Card") == "Solo Hover"){ echo "mod--only-hover"; } ?>"><?= $el['Titolo']; ?></h2>
                        <?php }?>
                        
                        <div class="box-images-shrink__text__bottom">
                            <div class="description"><?= $el['Testo breve']; ?></div>
                            
                            <?php 
                           
                            if (isset($el['Link'][0]['label']) && $el['Link'][0]['label'] != "") {
                                $cta = $el['Link'][0];
                                $ariaLabel = $this->variabili_lingua('apri_link')." ".$cta['label'];
                                
                                if($cta['target'] == "_blank"){
                                    $ariaLabel = $ariaLabel." ".$this->variabili_lingua('alce-link_nuova_finestra');
                                }  
                                
                               
                                $buttonVariant = $this->getVariant('Tipologia pulsanti', 'basic-button'); 
                                $buttonVariant2 = $this->getVariant('Tipologia pulsanti hover', 'basic-button'); 
                                ?>
                              
                                
                                <div class="link">
                                    <?php
                                    if($buttonVariant != '') {
                                        echo $this->getComponente($buttonVariant, [
                                            'link' => $cta['link'],
                                            'label' => $cta['label'],
                                            'ariaLabel' => $ariaLabel,
                                            'target' => $cta['target']
                                        ], 'Tipologia pulsanti');
                                    } else {
                                    ?>
                                        <a class="cta" title="<?=$cta['label']?>" aria-label="<?php echo $ariaLabel; ?>" target="<?=$cta['target']?>" href="<?php echo $cta['link']; ?>">
                                            <?php echo $cta['label']; ?>
                                        </a>
                                    <?php     
                                    }
                                    ?>
                                </div>

                               
                                <div class="link-hover">
                                    <?php
                                    if($buttonVariant2 != '') {
                                        echo $this->getComponente($buttonVariant2, [
                                            'link' => $cta['link'],
                                            'label' => $cta['label'],
                                            'ariaLabel' => $ariaLabel,
                                            'target' => $cta['target']
                                        ], 'Tipologia pulsanti hover');
                                    } else {
                                    ?>
                                        <a class="cta" title="<?=$cta['label']?>" aria-label="<?php echo $ariaLabel; ?>" target="<?=$cta['target']?>" href="<?php echo $cta['link']; ?>">
                                            <?php echo $cta['label']; ?>
                                        </a>
                                    <?php     
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                        </div> 
                    </div> 
                </div> 
            <?php } ?>
        </div> 
    </section>
    
<?php }?>