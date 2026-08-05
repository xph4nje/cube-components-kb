<?php
    $titolo = $this->getModulo("Titolo");
    $sottotitolo = $this->getModulo("Sottotitolo");
    $testo = $this->getModulo("Testo");
    $ctas = $this->getModulo('Ctas');
    $reverseTitle = $this->getProp("Inverti titoli", "no") == "yes";
    
    $tagTitolo = $this->getProp("Tag Titolo", "h2");
    $tagSottotitolo = $this->getProp("Tag Sottotitolo", "h3");
    
    $allineamentoGenerale = $this->getProp("Allineamento Generale");
    
    $columnLayout = $this->getProp("Layout a Colonne", "1");
    $columnActive = $this->getProp("Colonna Active","sx");
    
    switch($allineamentoGenerale) {
        case "var(--textalign-right)":
            $allineamentoGenerale = "right";
            break;
        case "var(--textalign-left)":
            $allineamentoGenerale = "left";
            break;
        case "var(--textalign-center)":
            $allineamentoGenerale = "center";
            break;
    };
    
    if(!(strip_tags($titolo) == '' && strip_tags($sottotitolo) == '' && strip_tags($testo) == '')) {
?>
<section class="blocco-testuale col-<?=$columnLayout;?> <?=$columnActive;?> <?=$allineamentoGenerale;?>">
    <div>
        <div class="blocco-testuale__titles boxed <?php if($reverseTitle) { echo "reverse"; } ?>">
            <div class="blocco-testuale__title">
                <?php if($titolo != '') { ?>
                    <<?=$tagTitolo?> class="title"><?php echo $titolo; ?></<?=$tagTitolo?>>
                <?php } ?>
            </div>
            <?php if($sottotitolo) { ?>
                <div class="blocco-testuale__subtitle">
                    <<?=$tagSottotitolo;?> class="subtitle"><?php echo $sottotitolo; ?></<?=$tagSottotitolo;?>>
                </div>
            <?php } ?>
        </div>
        <div class="blocco-testuale__texts boxed">
            <div class="blocco-testuale__text">
                <?php if($testo != '') { ?>
                    <div class="text"><?php echo $testo; ?></div>
                <?php } ?>
                <?php if(is_array($ctas) && count($ctas) > 0) { ?>
                    <div class="blocco-testuale__ctas">
                        <?php foreach($ctas as $cta) {
                            $buttonVariant = $this->getVariant('Tipologia pulsanti');
                            if($buttonVariant != '') {
                                echo $this->getComponente($buttonVariant, [
                                    'link' => $cta['link'],
                                    'label' => $cta['label'],
                                    'target' => $cta['target']
                                ], 'Tipologia pulsanti');
                            } else { ?>
                                <a class="cta" href="<?php echo $cta['link']; ?>">
                                    <?php echo $cta['label']; ?>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php
    }
?>