<?php
    $titolo = $this->getModulo("Titolo");
    $sottotitolo = $this->getModulo("Sottotitolo");
    $testoBreve = $this->getModulo("Testo sx");
    $testo = $this->getModulo("Testo dx");
    $immagine = $this->getModulo("Immagine principale");
    $miniImmagine = $this->getModulo("Immagine secondaria");
    $link = $this->getModulo("Link");
    $reverseTitles = $this->getProp("Inverti titoli", "no") == "yes";
?>
<section class="page-title-text-2 boxed <?php if ($this->getProp("Disposizione Colonne", "Titolo - Testo") == "Testo - Titolo") { echo "reverse"; } ?>">
    <div class="page-title-text-2__sx">
        <div class="page-title-text-2__sx__titles <?php if($reverseTitles) { echo 'reverse'; } ?>">
            <?php if($titolo != '') { ?>
                <h2 class="page-title-text-2__title">
                    <?php echo $titolo; ?>
                </h2>
            <?php } ?>
            <?php if($sottotitolo != '') { ?>
                <h3 class="page-title-text-2__subtitle">
                    <?php echo $sottotitolo; ?>
                </h3>
            <?php } ?>
        </div>
        <?php if ($testoBreve != '') { ?>
            <div class="page-title-text-2__miniText">
                <?=$testoBreve;?>
            </div>
        <?php } ?>
        <?php if(is_array($link) && count($link) > 0) { ?>
            <div class="page-title-text-2__buttons">
                <?php 
                $ariaLabel = $link[0]['label'];       
                if($link[0]['target'] == "_blank"){
                    $ariaLabel = $ariaLabel." ".$this->variabili_lingua('alce-link_nuova_finestra');
                }                
                $buttonVariant = $this->getVariant('Tipologia pulsanti');
                if($buttonVariant != '') {
                    echo $this->getComponente($buttonVariant, [
                        'label' => $link[0]['label'],
                        'ariaLabel' => $ariaLabel,
                        'link' => $link[0]['link']
                    ], 'Tipologia pulsanti');
                } else { ?>
                    <a class="cta" href="#" aria-label="<?= $ariaLabel ?>">
                        <?php echo $link[0]['label']; ?>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
            
        <?php if(is_array($miniImmagine) && count($miniImmagine) > 0) { ?>
            <div class="page-title-text-2__miniPhoto">

                <?php if(isset($miniImmagine[0]['video']) && $miniImmagine[0]['video'] != "") { ?>
                    <div class="page-thumb">
                        <?php
                            echo $this->getVideo($miniImmagine[0]['video'],
                                [
                                    'class' => '',
                                    'poster' => $this->getVideoPoster($this->getImg($miniImmagine[0]['files'], 'thumbnail_mobile', true))
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
                <?php }else{ ?>
                    <?php $pictureParams = [
                        'image' => $miniImmagine[0]['files'],
                        'title' => $titolo,
                        'priority' => false,
                        'desktop' => 'medium'
                    ];?>
                    <div class="page-thumb"><?=$this->getComponente('basic-picture', $pictureParams);?></div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
       
    
    <div class="page-title-text-2__dx">
        <?php
            if(is_array($immagine) && count($immagine) > 0) {
        ?>
        <div class="page-title-text-2__photo">
            <?php 
            $pictureParams = [
                'image' => $immagine[0]['files'],
                'title' => $titolo,
                'priority' => false,
                'desktop' => 'medium'
            ];
            ?>
            <div class="page-thumb"><?=$this->getComponente('basic-picture', $pictureParams);?></div>
        </div>
        <?php
            }
        ?>
        <?php
            if($testo != '') {
        ?>
        <div class="page-title-text-2__text"><?php echo $testo; ?></div>
        <?php
            }
        ?>
    </div>
</section>