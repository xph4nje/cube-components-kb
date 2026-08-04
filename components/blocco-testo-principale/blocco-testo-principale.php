<?php
    $titolo = $this->getTitolo();
    $sottotitolo = $this->getSottotitolo();
    $testo = $this->getTesto();
    $ctas = $this->getModulo("Bottoni");

    $columnLayout = $this->getProp("Layout a Colonne", "1");
    $columnActive = $this->getProp("Colonna Active","sx");
    
    $tagTitle = $this->getProp("Tag Titolo", "h1");
    $tagSubtitle = $this->getProp("Tag Sottotitolo", "h2");

?>

<section class="main-text main-text--columns-<?=$columnLayout;?> main-text--active-<?=$columnActive;?>">
    <div class="main-text__container boxed">

        <div class="main-text__header">

            <?php
                if ($titolo != '') {
            ?>
                <<?=$tagTitle?> class="main-text__heading"><?php echo $titolo; ?></<?=$tagTitle?>>
            <?php   
                }
            ?>

            <?php
                if ($sottotitolo != '') {
            ?>
                <<?=$tagSubtitle?> class="main-text__subheading"><?php echo $sottotitolo; ?></<?=$tagSubtitle?>>
            <?php
                }
            ?>

        </div>

        <?php
            if ($testo != '') {
        ?>
            <div class="main-text__text">
                <?php echo $testo; ?>
            </div>
        <?php
            }
        ?>

        <?php
            if (is_array($ctas) && count($ctas) > 0) {
        ?>
            <div class="main-text__ctas">

                <?php
                    foreach ($ctas as $cta) {

                        $ariaLabel = $this->variabili_lingua('apri_link')." ".$cta['label'];

                        if ($cta['target'] == "_blank") {
                            $ariaLabel .= " ".$this->variabili_lingua('alce-link_nuova_finestra');
                        }

                        $buttonVariant = $this->getVariant('Tipologia pulsanti');

                        if ($buttonVariant != '') {

                            echo $this->getComponente($buttonVariant, [
                                'link' => $cta['link'],
                                'label' => $cta['label'],
                                'ariaLabel' => $ariaLabel,
                                'target' => $cta['target']
                            ], 'Tipologia pulsanti');

                        } 
                    }
                ?>

            </div>
        <?php
            }
        ?>

    </div>
</section>
