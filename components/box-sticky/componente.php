<?php 
$boxSticky = $this->getModulo("Box sticky");


if (is_array($boxSticky) && count($boxSticky) > 0) {
?>
<section class="box-sticky">
   
    <?php foreach($boxSticky as $b) { ?>
        <div class="box-sticky__wrap">
           
                <div class="box-sticky__sx" >
                 
                          <?php if($b['Titolo'] != "") { ?>
                            <h2 class="box-sticky__title" ><?= $b['Titolo'] ?></h2>
                            <?php } ?>
                        
                            <?php if($b['Sottotitolo'] != "") { ?>
                                <h2 class="box-sticky__subtitle" ><?= $b['Sottotitolo'] ?></h2>
                            <?php } ?>

                            <?php if($b['Testo'] != "") {?>
                                <div class="box-sticky__text">
                                    <?= $b['Testo']; ?> 
                                </div>
                            <?php }?>

                            <?php if (isset($b['Link'][0])) {
                                $linkButtonVariant = $this->getVariant(
                                    'Tipologia Pulsanti',
                                    'basic-button'
                                );?>
                                <div class="box-sticky__link">
                                    <?php
                                    if($b['Titolo'] != ""){
                                        $ariaLabel = $this->variabili_lingua('apri_link')." ".$b['Titolo'];
                                    }else{
                                        $ariaLabel = $b['Link'][0]['label'];
                                    }      
                                    if($b['Link'][0]['target'] == "_blank"){
                                        $ariaLabel = $ariaLabel." ".$this->variabili_lingua('alce-link_nuova_finestra');
                                    }                                    
                                    echo $this->getComponente(
                                        $linkButtonVariant,
                                        [
                                            'link' => $b['Link'][0]['link'],
                                            'label' => $b['Link'][0]['label'],
                                            'ariaLabel' => $ariaLabel,
                                            'target' => $b['Link'][0]['target']
                                        ],
                                        'Tipologia pulsanti'
                                    );
                                    ?>
                                </div>
                            <?php } ?>

                </div>

                <ul class="box-sticky__dx">
                    <?php foreach($b['Immagini'] as $img) {?>
                        <li class="box-sticky__dx__img">
                            <?php
                            if (
                                isset($img['files']) &&
                                $img['files'] != ""
                            ) {
                                $pictureParams = [
                                    'image' => $img['files'],
                                    'priority' => false,
                                    'desktop' => 'full'
                                ];
                                echo $this->getComponente('basic-picture', $pictureParams);
                            }
                            ?>
                          
                        </li>

                   <?php } ?>
                     
                </ul>
            
        </div>
    <?php }?>

    </section>
<?php } ?>
