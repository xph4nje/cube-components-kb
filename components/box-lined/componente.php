<?php
    $childsContent = $this->getProp("Contenuto Blocchi da Figli");
    $textBefore = $this->getProp("Testo prima della foto", "no") == "yes";
    $titleAfter = $this->getProp("Titoli dopo la foto", "no") == "yes";
    
    $blocks = [];
    
    if($childsContent == 'yes') {
        $menuSecondario = $this->getMenuSecondario();
        $blocks = $this->menuVoicesToElenco($menuSecondario);
    } else if($childsContent == 'menu') {
        $menuChilds = $this->getModulo("Contenuto Blocchi da Menu");
        $blocks = $this->menuVoicesToElenco($menuChilds);
    }
    
    
    $manualBlocks = $this->getModulo('Blocchi contenuto manuale');
    
    if(is_array($manualBlocks) && count($manualBlocks) > 0) {
        $blocks = array_merge($blocks, $manualBlocks);
    }

    $line = $this->getProp('Linea titolo', 'yes') === 'yes';
?>

<?php if (is_array($blocks) && count($blocks) > 0) { ?>
<section class="box-lined">
    <?php foreach($blocks as $el) { ?>
    <div class="box-lined__inner">
        <div class="box-lined__row"> 
            <div class="box-lined__grp-titles <?= $titleAfter ? "grid-titles" : "";?>">
             <?php if(isset($el['Titolo']) && $el['Titolo'] != '') { ?>
                <div class="box-lined__title <?php echo $line ? ' title-hyphen' : ''; ?>">
                    <?php if($line): ?>
                        <span class="hyphen"></span>
                    <?php endif; ?>
                    <h2><?= $el['Titolo']; ?></h2>
                </div>
            <?php } ?>
            
            
            <?php if(isset($el['Sottotitolo']) && $el['Sottotitolo'] != '') { ?>
                <h3 class="box-lined__subtitle"><?= $el['Sottotitolo']; ?></h3>
            <?php } ?>
            </div>
    
            <div class="box-lined__image">
                <?php
                if (
                    isset($el['Immagine'][0]['files']) &&
                    $el['Immagine'][0]['files'] != ""
                ) {
                    $pictureParams = [
                        'image' => $el['Immagine'][0]['files'],
                        'priority' => false,
                        'desktop' => 'full'
                    ];
                    echo $this->getComponente('basic-picture', $pictureParams);
                }
                ?>
            </div>
            
            <div class="box-lined__text <?= $textBefore ? "grid-text" : ""; ?>">
                <?= isset($el['Testo']) ? $el['Testo'] : ''; ?>         
            </div>
          
            
            <?php if (isset($el['Link'][0]['label']) && $el['Link'][0]['label'] != "") {
                $linkButtonVariant = $this->getVariant(
                    'Tipologia Pulsanti',
                    'basic-button'
                ); ?>
                <div class="box-lined__link">
                    <?php
                    echo $this->getComponente(
                        $linkButtonVariant,
                        [
                            'link' => $el['Link'][0]['link'],
                            'label' => $el['Link'][0]['label'],
                            'target' => $el['Link'][0]['target']
                        ],
                        'Tipologia pulsanti'
                    );
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>        
    <?php } ?>
</section>   
<?php } ?>