<?php
    $icons = $this->getModulo("Lista Icone");
    $iconDisp = $this->getProp("Disposizione Icona", "block");
    $textTag = $this->getProp("Icon Text Tag", "h3");
    $title = $this->getModulo("Titolo Icone");
    $hasTitle = $this->getProp("Visibilità Titolo", "no") == "yes";
    $tagTitle = $this->getProp("Tag Titolo", "h2"); 
    
    if(is_array($icons) && count($icons) > 0) {
?>
<section class="base-icons-block boxed">
    <?php if ($hasTitle) { ?><div class="base-icons-block__title"><<?=$tagTitle;?>><?=$title;?></<?=$tagTitle;?>></div><?php } ?>
    <div class="base-icons-block__inner ">
        <?php
            foreach($icons as $icon) {
        ?>
        <div class="base-icons-block__item icon--<?php echo $iconDisp; ?>">
            <span class="icon"><i class="<?php echo $icon["Classe Icona"]; ?>"></i></span>
            <div class="icon-cnt">
            <<?php echo $textTag; ?> class="base-icons-block__text"><?php echo $icon["Titolo Icona"]; ?></<?php echo $textTag; ?>>
            <?php if (isset($icon["Sottotitolo Icona"]) && $icon["Sottotitolo Icona"] != '') { ?><div class="base-icons-block__label"><?php echo $icon["Sottotitolo Icona"]; ?></div><?php } ?>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</section>
<?php
    }
?>