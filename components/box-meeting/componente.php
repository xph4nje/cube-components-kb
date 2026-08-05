<?php 
    $meeting = $this->getModulo("Box Meeting");
    $path = $this->cdnPath();
    $rooms = [
        ["Dicitura" => "Boardroom", "Icona" => "boardroom.svg"],
        ["Dicitura" => "Classroom", "Icona" => "classroom.svg"],
        ["Dicitura" => "Cocktail",  "Icona" => "cocktail.svg"],
        ["Dicitura" => "Party",  "Icona" => "cocktail.svg"],
        ["Dicitura" => "Dinner",    "Icona" => "dinner.svg"],
        ["Dicitura" => "Theatre",   "Icona" => "theatre.svg"],
        ["Dicitura" => "Ushape",    "Icona" => "ushape.svg"]
    ];
?>

<?php if (is_array($meeting) && count($meeting) > 0) { ?>
    <section class="meeting boxed">
        <ul class="meeting_list">
            <?php foreach ($meeting as $element) { 
                $titolo = $element['Nome sala'];
                $area = $element['Capienza'];
                $testo = $element['Descrizione'];
                $links = $element['Links'];
                $immagine = $element['Immagine'];
            ?>
            <li class="meeting_item">
                <div class="meeting_photo page-thumb">
                    <?php
                        $pictureParams = [
                            'image' => $immagine[0]['files'],
                            'title' => $titolo,
                            'priority' => false,
                            'desktop' => 'medium'
                        ];
                        echo $this->getComponente('basic-picture', $pictureParams);
                    ?>
                </div>
                <div class="meeting_content">
                    <div class="meeting_title"><?=$titolo?></div>
                    <div class="meeting_area"><?=$area?></div>
                    <div class="meeting_text"><?=$testo?></div>
                </div>
                <div class="meeting_detail">
                    <div>
                        <div class="meeting_label"><?=$this->__("Capienza")?></div>
                        <ul class="meeting_icons">
                            <?php foreach ($rooms as $room) { 
                                if (!empty($element[$room['Dicitura']])) { ?>
                                <li class="meeting_value col-<?= $this->getProp("Colonne", "4");?>">
                                    <span class="meeting_icon" style="mask: url('<?= $path.'/externalmedia/meeting/'.$room['Icona'] ?>') no-repeat center; -webkit-mask: url('<?= $path.'/externalmedia/meeting/'.$room['Icona'] ?>') no-repeat center;"></span>
                                    <span class="meeting_number"><?=$element[$room['Dicitura']]?></span>
                                </li>
                                <?php } 
                            } ?>
                        </ul>
                    </div>
                    <?php if (is_array($links) && count($links) > 0) { ?>
                    <div class="meeting_buttons">
                        <?php
                                foreach($links as $cta) {
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
                            <a class="cta" title="<?=$cta['label']?>" aria-label="<?php echo $ariaLabel; ?>" target="<?=$cta['target']?>" href="<?php echo $cta['link']; ?>">
                                <?php echo $cta['label']; ?>
                            </a>
                            <?php
                                    }
                                }
                            ?>
                    </div>
                    <?php } ?>
                </div>
            </li>
            <?php } ?>
        </ul>
    </section>
<?php } ?>