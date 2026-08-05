<?php $blocks = $this->getModulo("Box Foto Doppia"); ?>
<?php if (is_array($blocks) && count($blocks) > 0) { ?>
    <section class="box-double-photo boxed">
        <ul class="box-double-photo__list">
            <?php foreach ($blocks as $block) { ?>
            <li class="box-double-photo__item">
                <div class="box-double-photo__sx">
                    <?php if(is_array($block['Immagine']) && count($block['Immagine']) > 0) { ?>
                    <div class="box-double-photo__photo">
                        <div class="page-thumb">  
                            <?php $pictureParams = [
                                'image' => $block['Immagine'][0]['files'],
                                'title' => $block['Titolo'],
                                'priority' => false,
                                'desktop' => 'medium',
                            ];
                            echo $this->getComponente('basic-picture', $pictureParams); ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="box-double-photo__content">
                        <?php if ($block['Titolo'] != '') { ?><h2 class="box-double-photo__title"><?=$block['Titolo']?></h2><?php } ?>
                        <?php if ($block['Sottotitolo'] != '') { ?><h3 class="box-double-photo__subtitle"><?=$block['Sottotitolo']?></h3><?php } ?>
                        <?php if ($block['Testo'] != '') { ?><div class="box-double-photo__text"><?=$block['Testo']?></div><?php } ?>
                        <?php if (is_array($block['Link']) && count($block['Link']) > 0) { ?>
                        <div class="box-double-photo__cta">
                            <?php $buttonVariant = $this->getVariant('Tipologia Pulsanti'); 
                            foreach($block['Link'] as $link) {
                                if($block['Titolo'] != ""){
                                    $ariaLabel = $this->variabili_lingua('apri_link')." ".$block['Titolo'];
                                }else{
                                    $ariaLabel = $link['label'];
                                }
                                if($link['target'] == "_blank"){
                                    $ariaLabel = $ariaLabel." ".$this->variabili_lingua('alce-link_nuova_finestra');
                                }                                
                                if($buttonVariant != '') {
                                    echo $this->getComponente($buttonVariant, [
                                        'link' => $link['link'],
                                        'label' => $link['label'],
                                        'ariaLabel' => $ariaLabel,
                                        'target' => $link['target']
                                    ], 'Tipologia pulsanti');
                                } else { ?>
                                    <a class="cta" href="<?php echo $link['link']; ?>"><?php echo $link['label']; ?></a>
                                <?php }
                            } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="box-double-photo__dx">
                    <?php if(is_array($block['Immagine Dettaglio']) && count($block['Immagine Dettaglio']) > 0) { ?>
                        <div class="box-double-photo__detail">
                            <div class="page-thumb">  
                                <?php $pictureParams = [
                                    'image' => $block['Immagine Dettaglio'][0]['files'],
                                    'title' => $block['Titolo'],
                                    'priority' => false,
                                    'desktop' => 'medium',
                                ];
                                echo $this->getComponente('basic-picture', $pictureParams); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </li>
            <?php } ?>
        </ul>
    </section>
<?php } ?>