<?php
    $history = $this->getModulo("Cronologia");
    if(is_array($history) && count($history) > 0) {
        $icon = $this->getProp("Icona Toggler", null);
        if($icon == null) {
            $icon = '<i class="fa-light fa-chevron-down"></i>';
        }
?>
<section class="block-history boxed">

    <h2 class="visibility-hidden">
        Date list
    </h2>


    <?php
        foreach($history as $year) {
    ?>
    <div class="block-history__row">
        <div class="block-history__heading">
            <div class="block-history__date">
                <?php if($year['Anno'] != ""){ ?>
                    <span><?php echo $year['Anno']; ?></span>
                <?php } ?>
                <?php if($year['Dicitura Anno'] != ""){ ?>
                    <span><?php echo $year['Dicitura Anno']; ?></span>
                <?php } ?>
            </div>
            <div class="block-history__cnt <?php if ($this->getProp("Allineamento freccia","column") == "row") {echo "row";} ?>">
                <h3 class="block-history__title"><?php echo $year['Titolo']; ?></h3>
                <div class="block-history__toggler" onclick="historyFilter(event);"><?php echo $icon; ?></div>
            </div>
        </div>
        <div class="block-history__row__description">
            
            <div class="block-history__row__description__content">
                <div class="block-history__desc">
                    <?php echo $year['Descrizione']; ?>
                </div>
                <?php
                    $childs = isset($year['Dettaglio']) && count($year['Dettaglio']) > 0 ? $year['Dettaglio'] : [];
                    foreach($childs as $child) {
                ?>
                <div class="block-history__row__description__content__nested">
                    <div class="block-history__row__description__content__nested__date">
                        <span><?php echo $child['Anno']; ?></span>
                    </div>
                    <div class="block-history__row__description__content__nested__description">
                        <h4 class="block-history__title block-history__subtitle"><?php echo $child['Titolo']; ?></h4>
                        <div class="block-history__desc">
                            <?php echo $child['Descrizione']; ?>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
</section>
<?php
    }
?>