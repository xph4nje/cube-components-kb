<?php
    $titolo = $this->getTitolo();
    $sottotitolo = $this->getSottotitolo();
    $testo = $this->getTesto();
    $ctas = $this->getModulo("Bottoni");
    
    $columnLayout = $this->getProp("Layout a Colonne", "1");
    $columnActive = $this->getProp("Colonna Active","sx");
    
    $titleVariant = $this->getVariant('Decorazione Titoli', '');
?>
<section class="main-text col-<?=$columnLayout;?> <?=$columnActive?>">
    <div class="boxed">
        <div class="main-text__title <?php if ($this->getProp("Orientamento Titolo", "Titolo - Sottotitolo") == "Sottotitolo - Titolo") {echo "column-reverse";} ?>">
            <?php
                if($titolo != '') {
                    if($titleVariant != null) {
                        echo $this->getComponente($titleVariant, [
                            'content' => '<h1>' . $titolo . '</h1>',
                        ], 'Decorazione Titoli');
                    } else {
            ?>
            <h1><?php echo $titolo; ?></h1>
            <?php
                    }
                }
            ?>
            <?php
                if($sottotitolo != '') {
            ?>
            <h2><?php echo $sottotitolo; ?></h2>
            <?php
                }
            ?>
        </div>
        <?php
            if($testo != '') {
        ?>
        <div class="main-text__text"><?php echo $testo; ?></div>
        <?php
            }
        ?>
        <?php
            if(is_array($ctas) && count($ctas) > 0) {
        ?>
        <div class="main-text__ctas">
            <?php
                foreach($ctas as $cta) {
                    
                    $ariaLabel = $this->variabili_lingua('apri_link')." ".$cta['label'];
                    if($cta['target'] == "_blank"){
                        $ariaLabel = $ariaLabel." ".$this->variabili_lingua('alce-link_nuova_finestra');
                    }                    
                    
                    $buttonVariant = $this->getVariant('Tipologia pulsanti');
                    if($buttonVariant != '') {
                        echo $this->getComponente($buttonVariant, [
                            'link' => $cta['link'],
                            'label' => $cta['label'],
                            'ariaLabel' => $ariaLabel,
                            'target' => $cta['target']
                        ], 'Tipologia pulsanti');
                    } else {
            ?>
            <a class="cta" href="<?php echo $cta['link']; ?>" aria-label="<?php echo $ariaLabel; ?>">
                <?php echo $cta['label']; ?>
            </a>
            <?php
                    }
                }
            ?>
        </div>
        <?php
            }
        ?>
    </div>
</section>