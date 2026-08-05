<?php 
$boxTriple = $this->getModulo("Box tripla foto");
$boxTripleTitle = $this->getModulo("Titolo box tripla foto");
$hideTitle = $this->getProp("Visibilità titolo", "no") == "no" ? "visibility-hidden" : "";
$hideImgs = $this->getProp("Visibilità immagini piccole mobile", "si") == "no" ? "hide" : "";
$even = $this->getProp("Inversione box pari", "yes");
$odd = $this->getProp("Inversione box dispari", "no");
$imgsDirection = $this->getProp("Immagini su una colonna mobile", "no") == "yes" ? "img-reverse" : "";



if (isset($boxTriple) && is_array($boxTriple) && count($boxTriple) > 0) {
?>
<section class="box-foto-triple">
    <h2 class="box-foto-triple__title <?= $hideTitle ?>">
                <?php
                    if ($boxTripleTitle != "") {
                        echo $boxTripleTitle;
                    } else {
                        echo $this->getTitolo() . " box list";
                    }
                ?>
    </h2> 
    <ul class="box-foto-triple__wrap">
        <?php foreach($boxTriple as $index => $b) { 
            $class = "";
            if($index % 2 !== 0 && $even == "yes") {
                $class = "reverse-even";
            } else if($index % 2 === 0 && $odd == "yes") {
                $class = "reverse-odd";
            }
            ?>
            <li class="box-foto-triple__row <?= $class;?>">
                <div class="box-foto-triple__sx">
                    <?php if (isset($b["Img big"]) && is_array($b["Img big"]) && count($b["Img big"]) > 0) { ?>
                    <div class="box-foto-triple__sx__img">
                        <figure class="image">
                            <?php
                                
                                    $pictureParams = [
                                        'image' => $b["Img big"][0]['files'],
                                        'priority' => false,
                                        'desktop' => 'full'
                                    ];
                                    echo $this->getComponente('basic-picture', $pictureParams);
                                
                            ?>
                        </figure>
                       
                    </div>
                    <?php } ?>
                </div>

                <div class="box-foto-triple__dx">
                    <div class="box-foto-triple__dx__text">
                        <?php if ($b["Titolo"]) { ?>
                            <h3 class="text-title">
                                <?= $b["Titolo"] ?>
                            </h3>
                        <?php } ?>
                        <?php if($b["Sottotitolo"] != "") {?>
                            <h4 class="text-subtitle">
                                <?= $b["Sottotitolo"] ?>
                            </h4>
                        <?php } ?>
                        <?php if ($b["Testo"] != '') { ?>
                            <div class="text-description">
                                <?= $b["Testo"] ?>
                            </div>
                        <?php } ?>

                        <?php if (isset($b['Link']) && is_array($b['Link']) && count($b['Link']) > 0) { ?>
                            <div class="text-link">
                            
                                <?php
                                if($b["Titolo"] != ""){
                                    $ariaLabel = $this->variabili_lingua('apri_link')." ".$b['Titolo'];
                                }else{
                                    $ariaLabel = $b['Link'][0]['label'];
                                }
                                
                                if($b['Link'][0]['target'] == "_blank"){
                                    $ariaLabel = $ariaLabel." ".$this->variabili_lingua('alce-link_nuova_finestra');
                                }
                                ?>
                            
                                <?php $buttonVariant = $this->getVariant('Tipologia pulsanti');
                                    echo $this->getComponente(
                                        $buttonVariant,
                                        [
                                            'link' => $b['Link'][0]['link'],
                                            'label' => $b['Link'][0]['label'],
                                            'target' => $b['Link'][0]['target'],
                                            'ariaLabel' => $ariaLabel,
                                        ],
                                        'Tipologia pulsanti'
                                    );
                                    ?>
                            </div>
                        <?php } ?>
                    </div>


                    <div class="box-foto-triple__dx__images <?= $imgsDirection; ?> <?= $hideImgs; ?>">
                        <?php if (isset($b["Img small 1"]) && is_array($b["Img small 1"]) && count($b["Img small 1"]) > 0) { ?>
                        <div class="box-foto-triple__dx__img-1">
                            <figure class="image">
                                <?php
                                    
                                        $pictureParams = [
                                            'image' => $b["Img small 1"][0]['files'],
                                            'priority' => false,
                                            'desktop' => 'full'
                                        ];
                                        echo $this->getComponente('basic-picture', $pictureParams);
                                    
                                ?>

                            </figure>
                          
                        </div>
                        <?php } ?>

                        <?php if (isset($b["Img small 2"]) && is_array($b["Img small 2"]) && count($b["Img small 2"]) > 0) { ?>
                        <div class="box-foto-triple__dx__img-2">
                            <figure class="image">
                                <?php
                                    
                                        $pictureParams = [
                                            'image' => $b["Img small 2"][0]['files'],
                                            'priority' => false,
                                            'desktop' => 'full'
                                        ];
                                        echo $this->getComponente('basic-picture', $pictureParams);
                                    
                                ?>
                            </figure>    
                        </div>
                        <?php } ?>
                    </div>
                       
                </div>
            </li>
        <?php }?>
    </ul>
</section>
<?php } ?>
