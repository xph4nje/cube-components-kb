<?php
    $icons = $this->getModulo("Lista Icone Descrizione");
    $title = $this->getModulo("Titolo Lista Icone Descrizione");
    $hideTitle = $this->getProp("Visibilità Titolo", "no") == "no" ? "visibility-hidden" : "";
?>
    
<?php if(is_array($icons) && count($icons) > 0) { ?>
    <section class="base-icons-description boxed">
        <h2 class="base-icons-description__title <?= $hideTitle; ?>"><?= $title; ?></h2>
        <div class="base-icons-description__inner ">
            <?php foreach($icons as $icon) { ?>
                <div class="base-icons-description__item">
                    <div class="base-icons-description__icon">
                        <i class="<?php echo $icon["Classe Icona"]; ?>"></i>
                    </div>
                    <div class="base-icons-description__text">
                        <?php echo $icon["Descrizione Icona"]; ?>
                    </div>  
                    
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>