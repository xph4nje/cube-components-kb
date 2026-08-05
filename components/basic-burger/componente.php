<button class="basic-burger" onclick="openMenu();" aria-expanded="false" aria-label="<?= $this->variabili_lingua('alce-apri_menu') ?>">
    <div class="cnt">
        <div class="basic-burger__line basic-burger__top">&nbsp;</div>
        <div class="basic-burger__line basic-burger__inner">&nbsp;</div>
        <div class="basic-burger__line basic-burger__bottom">&nbsp;</div>
    </div>
    <?php if ($this->getVariantProp("Dicitura","no") == "yes") {?><span class="basic-burger__label"><?=$this->__("menu")?></span><?php } ?>
</button>