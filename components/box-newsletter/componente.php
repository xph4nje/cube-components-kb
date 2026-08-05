<?php
    $display = $this->getProp("Display", "inline");
    $showEmail = $this->getProp("Show Email Field", "yes") == "yes";
    $buttonVariant = $this->getVariant('Pulsante Invio', 'basic-button');
?>
<section class="box-newsletter box-newsletter--<?php echo $display; ?> boxed">
    <div class="box-newsletter__text">
        <div class="box-newsletter__text__title"><h2><?php echo $this->__("Iscriviti alla newsletter"); ?></h2></div>
        <div class="box-newsletter__text__subtitle"><h3><?php echo $this->__("Rimani aggiornato sulle novità di "); ?> <?php echo $this->getInfoStruttura('nome_struttura'); ?></h3></div>
    </div>
    <div class="box-newsletter__form">
        <form action="<?php echo $this->trovaAncora('newsletter'); ?>">
            <?php
                if($showEmail) {
            ?>
            <div>
                <label class="visibility-hidden" for="newsletter-email">Email</label>
                <input id="newsletter-email" type="email" name="email" autocomplete="email" placeholder="email" required />
            </div>
            <?php
                }
            ?>
            <div class="box-newsletter__form__button">
                <?php
                    if($buttonVariant != "") {
                        echo $this->getComponente($buttonVariant, [
                            'isSubmit' => true,
                            'label' => $this->__('Iscriviti')
                        ], 'Pulsante Invio');
                    }
                ?>
            </div>
        </form>
    </div>
</section>