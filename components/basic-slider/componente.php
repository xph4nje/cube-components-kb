<?php 
    $images = isset($props['Images']) ? $props['Images'] : [];
    $inheritSize = $this->getVariantProp('Eredita Dimesione Foto','no') == 'yes';
    $iconArrow = $this->getVariantProp('Icona Freccia Sinistra (classe)','fa-light fa-arrow-left');
    $iconPosition = $this->getVariantProp('Posizione Frecce','hidden');
    $desktopImageFormat = $this->getVariantProp('Desktop Image Format','medium');
    $tabletImageFormat = $this->getVariantProp('Tablet Image Format','medium');
    $mobileImageFormat = $this->getVariantProp('Mobile Image Format','thumbnail_mobile');
    
    if(count($images) > 0) {
?>
<div class="basic-slider test-edo">
    <div class="basic-slider__images <?php echo $inheritSize != '' ? "inheritSize" : "hasSize" ?>">
        <div class="swiper-container">
            <ul class="swiper-wrapper">
                <?php
                    foreach($images as $image) {
                ?>
                <li class="swiper-slide">
                    <div class="page-thumb <?php echo $inheritSize != '' ? "inheritSize" : "hasSize" ?>">
                        <?php
                            $pictureParams = [
                                'image' => $image['files'],
                                'title' => isset($image['title']) ? $image['title'] : '',
                                'priority' => false,
                                'desktop' => $desktopImageFormat,
                                'tablet' => $tabletImageFormat,
                                'mobile' => $mobileImageFormat,
                            ];
                            echo $this->getComponente('basic-picture', $pictureParams);
                        ?>
                    </div>
                </li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
    <?php
        if($iconPosition != 'hidden') {
    ?>
    <div class="pt-s pb-s basic-slider__nav basic-slider__nav--<?php echo $iconPosition; ?>">
        <span class="basic-slider__nav__prev"><i class="<?php echo $iconArrow; ?>"></i></span>
        <span class="basic-slider__nav__next"><i class="<?php echo $iconArrow; ?>"></i></span>
    </div>
    <?php
        }
    ?>
</div>
<?php
    }
?>