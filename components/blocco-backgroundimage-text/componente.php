<?php
    $data = $this->getModulo("Immagine Blocco Sfondo Testo");
    $parallax = $this->getProp("Parallax", "no");
    $reverse = $this->getProp("Inverti Titoli", "no") == "yes";
    $verticalAlignment = $this->getProp("Allineamento Verticale Testo", "center");
    
    $cutout = $this->getProp("Testo bucato", "no") == "yes" ? 'cutout' : '';
    
    $fixedHeight = $this->getProp("Altezza Parallax fissa", "yes") == "no" ? 'auto' : '';
    
    if(is_array($data) && count($data) > 0) {
        $block = $data[0];
?>
<div class="page-bg-image-text <?=$fixedHeight?> <?=$cutout?>" data-parallax="<?php echo $parallax; ?>">
    <?php
        if(isset($block['immagine']) && is_array($block['immagine']) && count($block['immagine']) > 0) {
            $title = $block['titolo'] != "" ? $this->cleanTitle($block['titolo']) : $block['immagine'][0]['title'];
    ?>
    <div class="page-bg-image-text__parallax" data-parallax-img="<?php echo $parallax; ?>">
        <?php
            $pictureParams = [
                'image' => $block['immagine'][0]['files'],
                'title' => $title,
                'priority' => false,
                'desktop' => 'full',
                'tablet' => 'full',
                'mobile' => 'medium'
            ];
            echo $this->getComponente('basic-picture', $pictureParams);
        ?>
    </div>
    <?php
        }
    ?>
    <div class="page-bg-image-text__cover"></div>
    <div class="page-bg-image-text__text valign-<?php echo $verticalAlignment; ?>">
        <div class="page-bg-image-text__text__titles <?php if($reverse) { echo 'reverse'; } ?>">
            <?php
                if(isset($block['titolo']) && $block['titolo'] != "") {
            ?>
            <h2><?php echo $block['titolo']; ?></h2>
            <?php
                }
            ?>
            <?php
                if(isset($block['sottotitolo']) && $block['sottotitolo'] != "") {
            ?>
            <h3><?php echo $block['sottotitolo']; ?></h3>
            <?php
                }
            ?>
        </div>
        <?php
            if(isset($block['descrizione']) && $block['descrizione'] != "") {
        ?>
        <div class="page-bg-image-text__text__desc">
            <?php echo $block['descrizione']; ?>
        </div>
        <?php
            }
        ?>
        <div class="page-bg-image-text__text__ctas">
            <?php
                if(isset($block['ctas']) && is_array($block['ctas']) && count($block['ctas']) > 0) {
                    foreach($block['ctas'] as $button) {
                        $buttonVariant = $this->getVariant('Tipologia pulsanti');
                        if($buttonVariant != '') {
                            echo $this->getComponente($buttonVariant, [
                                'link' => $button['link'],
                                'label' => $button['label'],
                                'target' => $button['target']
                            ], 'Tipologia pulsanti');
                        } else {
                    ?>
                    <a class="cta" href="<?php echo $button['link']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['label']; ?></a>
                    <?php
                        }
                    }
                }
            ?>
        </div>
    </div>
</div>
<?php
    }
?>