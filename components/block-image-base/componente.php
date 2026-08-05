<?php
    $image = $this->getModulo("Immagine");
    $imageFit = $this->getProp('Image Fit', 'cover');
    $boxed = $this->getProp('Larghezza', '');
?>

<?php if(is_array($image) && count($image) > 0) { ?>
    <section class="block-image-base <?php if($boxed != "") { echo "boxed"; } ?>">
        <div class="block-image-base__inner">
            <div class="page-thumb page-thumb--<?php echo $imageFit; ?>">
                <?php
                    if(isset($image[0]['video']) && $image[0]['video'] != "" && $this->getImg($image[0]['video'])) {
                        echo $this->getVideo($image[0]['video'],
                            [
                                'class' => 'block-image-base__video',
                                'poster' => $this->getVideoPoster($this->getImg($image[0]['files'], 'thumbnail_mobile', true))
                            ],
                            [
                                'autoplay',
                                'loop',
                                'muted',
                                'playsinline',
                                'webkit-playsinline'
                            ]
                            );
                    } else {
                ?>
                <img alt="<?php echo $image[0]['title']; ?>" title="<?php echo $image[0]['title']; ?>" class="lazy" data-src="<?php echo $this->getImg($image[0]['files'], 'full'); ?>">
                <?php
                    }
                ?>
            </div>
        </div>
        
    </section>
<?php } ?>