<?php
    $minigallery = $this->getModulo("Minigallery");
    $iconPosition = $this->getVariantProp('Posizione Frecce','hidden');
    $icon = $this->getVariantProp('Icona Freccia Sinistra','fa-light fa-arrow-left');
    
    if(is_array($minigallery) && count($minigallery) > 0) {
        $isCentered = $this->getProp("Center Slides", "no") != "no";
?>
<section class="base-gallery-slider" data-align="<?php echo $isCentered ? "center" : "left"; ?>">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php
                foreach($minigallery as $image) {
            ?>
            <div class="swiper-slide base-gallery-slider__slide">
                <div class="base-gallery-slider__inner">
                    <div class="page-thumb">
                        <a class="bgsGallery" aria-label="<?php echo isset($image['titolo']) && $image['titolo'] != "" ? $image['titolo'] :  $this->__("Apri gallery"); ?>" href="<?php echo $this->getImg($image['files']); ?>">
                        <?php
                            $pictureParams = [
                                'image' => $image['files'],
                                'priority' => false,
                                'desktop' => 'medium'
                            ];
                            echo $this->getComponente('basic-picture', $pictureParams);
                        ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php
                } 
            ?>
        </div>
    </div>
    <?php
        if($iconPosition != 'hidden') {
    ?>
    <div class="pt-s base-gallery-slider__nav base-gallery-slider__nav--<?php echo $iconPosition; ?>">
        <span class="base-gallery-slider__nav__prev"><?php echo $this->iconPreload($icon); ?></span>
        <span class="base-gallery-slider__nav__next"><?php echo $this->iconPreload($icon); ?></span>
    </div>
    <?php
        }
    ?>
</section>
<?php
    }
?>