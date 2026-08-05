<?php 
$press = $this->getModulo("Pressroom");
//Opzione visibilità titolo
$hideTitle = $this->getProp("Visibilità titolo", "no") == "no" ? "visibility-hidden" : "";

$title = $this->getModulo("Titolo pressroom");

$removeAllButton = $this->getProp('Rimuovi Pulsante Tutte', 'no') === 'yes';
$hasStartCat = is_array($press) && isset($press['categorie']) && is_array($press['categorie']) && count($press['categorie']) > 0;
$startCat = (!$removeAllButton || !$hasStartCat) ? 0: $press['categorie'][0]['id_categoria'];
$buttonVariant = $this->getVariant('Tipologia Pulsanti Categorie');

if (
    is_array($press) &&
    isset($press['categorie']) &&
    is_array($press['categorie']) &&
    count($press['categorie']) > 0
) {
    $filters = $press['categorie'];
?>

<section class="basic-pressroom">

    <div class="basic-pressroom__wrapper">

        <h2 class="<?= $hideTitle; ?>">
            <?= $title != "" ? $title : "Pressroom articles list"; ?>
        </h2>

        <!-- filtri -->
        <?php if ($buttonVariant != "") { ?>

            <div class="basic-pressroom__filters" data-start-cat="<?php echo $startCat; ?>">

                <?php
                $index = 0;

          
                if (!$removeAllButton) {
                    ?>
                    <div class="basic-pressroom__filters__filter" data-cat="0" data-index="<?php echo $index; ?>">
                        <?php
                        echo '<span>' . $this->getComponente(
                            $buttonVariant,
                            [
                                'label' => $this->__('tutte'),
                                'link'  => "javascript:window.genericPressroomFilter($index,0)"
                            ],
                            'Tipologia pulsanti'
                        ) . '</span>';
                        ?>
                    </div>
                    <?php
                    $index++;
                }

    
                foreach ($filters as $filter) {
                    ?>
                    <div class="basic-pressroom__filters__filter"
                        data-cat="<?php echo $filter['id_categoria']; ?>"
                        data-index="<?php echo $index; ?>">
                        <?php
                        echo '<span>' . $this->getComponente(
                            $buttonVariant,
                            [
                                'label' => $filter['categoria'],
                                'link'  => "javascript:window.genericPressroomFilter($index,{$filter['id_categoria']})"
                            ],
                            'Tipologia pulsanti'
                        ) . '</span>';
                        ?>
                    </div>
                    <?php
                    $index++;
                }
                ?>

            </div>

        <?php } ?>

        <!-- Lista documenti -->
        <ul class="basic-pressroom__list">

            <?php
            if (
                isset($press['documenti']) &&
                is_array($press['documenti']) &&
                count($press['documenti']) > 0
            ) {
                foreach ($press['documenti'] as $catID => $documents) {

                    for ($i = 0; $i < count($documents); $i++) {
                        $doc = $documents[$i];
            ?>

                        <li class="basic-pressroom__list__el"
                            data-cat="<?php echo $catID; ?>">

                            <!-- Immagine -->
                            <div class="basic-pressroom__list__el__img">
                                <?php
                                if (
                                    isset($doc['contenuti']['anteprima'][0]['files']) &&
                                    $doc['contenuti']['anteprima'][0]['files'] != ""
                                ) {
                                    $pictureParams = [
                                        'image' => $doc['contenuti']['anteprima'][0]['files'],
                                        'priority' => false,
                                        'desktop' => 'full'
                                    ];
                                    echo $this->getComponente('basic-picture', $pictureParams);
                                }
                                ?>
                            </div>

                            <!-- Titolo -->
                            <h3 class="basic-pressroom__list__el__titolo"><?= $doc['titolo']; ?></h3>

                            <!-- Descrizione -->
                            <?php if ($doc['contenuti']['descrizione'] != "") { ?>
                                <div class="basic-pressroom__list__el__descrizione">
                                    <?= $doc['contenuti']['descrizione']; ?>
                                </div>
                            <?php } ?>

                            <!-- Link -->
                            <?php if (isset($doc['contenuti']['link'][0])) {
                                $linkButtonVariant = $this->getVariant(
                                    'Tipologia Pulsanti',
                                    'basic-button'
                                );?>
                                <div class="basic-pressroom__list__el__link">
                                    <?php
                                    $ariaLabel = $this->variabili_lingua('apri_link')." ".$doc['titolo'];
                                    if($doc['contenuti']['link'][0]['target'] == "_blank"){
                                        $ariaLabel = $ariaLabel." ".$this->variabili_lingua('alce-link_nuova_finestra');
                                    }                                    
                                    echo $this->getComponente(
                                        $linkButtonVariant,
                                        [
                                            'link' => $doc['contenuti']['link'][0]['link'],
                                            'label' => $doc['contenuti']['link'][0]['label'],
                                            'ariaLabel' => $ariaLabel,
                                            'target' => $doc['contenuti']['link'][0]['target']
                                        ],
                                        'Tipologia pulsanti'
                                    );
                                    ?>
                                </div>
                            <?php } ?>

                        </li>

            <?php
                    }
                }
            }
            ?>

        </ul>

    </div>

</section>

<?php } ?>
