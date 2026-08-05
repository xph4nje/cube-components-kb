<?php 
    $blocco = $this->getBlocco("Banner"); 
    $hide = $this->getProp("Nascondi banner", "no") == "yes";
    $position = $this->getProp("Posizione", "bottom-right");
    $hideMobile = $this->getProp("Nascondi Mobile","no") == "yes";
?>
<?php 
    if (is_array($blocco) && isset($blocco) && !$hide) { 
    $links = $blocco['Link'];
    $hasLinks = is_array($links) && isset($links) && count($links) > 0;
    $link = $hasLinks ? $links[0]['link'] : '';
    $photos = $blocco['Immagini'];
    $hasPhotos = isset($photos) && is_array($photos) && count($photos) > 0;
    $photo = $hasPhotos ? $photos[0]['files'] : '';
?>
    <div class="banner <?=$position;?> <?php if ($hideMobile) { echo " hide-mobile"; } ?>">
        <?php 
            if ($hasLinks) { 
        ?>
            <a href="<?=$link;?>"> 
        <?php 
            }
        ?>
            <div class="banner__photo">
            <?php
                if($hasPhotos) {        
                    $pictureParams = [
                        'image' => $photo,
                        'title' => '',
                        'priority' => true,
                        'desktop' => 'full',
                    ];
                    echo $this->getComponente('basic-picture', $pictureParams);
                
                }
            ?>
            </div>
        <?php 
            if ($hasLinks) { 
        ?>
            </a> 
        <?php 
            }
        ?>
    </div>
<?php 
    } 
?>