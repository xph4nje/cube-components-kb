<?php
$box = $this->getModulo('Box fisarmonica');
$titleTag = $this->getProp('Tag Titolo', 'h2');
$subtitleTag = $this->getProp('Tag Sottotitolo', 'h3');
if (is_array($box) && count($box) > 0) :
    $count = count($box);
?>
    <section class="box-fisarmonica">
        <div class="box-fisarmonica__list">
            <?php foreach ($box as $k => $b) : ?>
                <div class="box-fisarmonica__item <?= $k === 0 ? 'active' : '' ?>" style="--count: <?= $count ?>;">
                    <?php if ($b['immagine'] != '') : ?>
                        <div class="box-fisarmonica__pic">
                            <?php $imgOpen   = [
                                'image' => $b['immagine'][0]['files'],
                                'priority' => false,
                                'desktop' => 'full'
                            ];
                            echo $this->getComponente('basic-picture', $imgOpen);
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($b['immagine chiusa'] != '') : ?>
                        <div class="box-fisarmonica__pic--closed">
                            <?php $imgClose   = [
                                'image' => $b['immagine chiusa'][0]['files'],
                                'priority' => false,
                                'desktop' => 'full'
                            ];
                            echo $this->getComponente('basic-picture', $imgClose);
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($b['titolo'] != '') : ?>
                        <div class="box-fisarmonica__title--vert"><?= $b['titolo'] ?></div>
                    <?php endif; ?>
                    <div class="box-fisarmonica__cnt">
                        <div>
                            <?php if ($b['titolo'] != '') : ?>
                                <<?= $titleTag ?> class="box-fisarmonica__title"><?= $b['titolo'] ?></<?= $titleTag ?>>
                            <?php endif; ?>
                            <?php if ($b['sottotitolo'] != '') : ?>
                                <<?= $subtitleTag ?> class="box-fisarmonica__subtitle"><?= $b['sottotitolo'] ?></<?= $subtitleTag ?>>
                            <?php endif; ?>
                            <?php if ($b['testo'] != '') : ?>
                                <div class="box-fisarmonica__text"><?= $b['testo'] ?></div>
                            <?php endif; ?>
                            <?php if (is_array($b['links']) && count($b['links']) > 0) : ?>
                                <div class="box-fisarmonica__links">
                                    <?php foreach ($b['links'] as $l) : ?>
                                        <div class="box-fisarmonica__link">
                                            <?php
                                            $linkButtonVariant = $this->getVariant(
                                                'Tipologia Pulsanti',
                                                'basic-button'
                                            );
                                            $ariaLabel = $this->variabili_lingua('apri_link') . " " . $b['titolo'];
                                            if ($l['target'] == "_blank") {
                                                $ariaLabel = $ariaLabel . " " . $this->variabili_lingua('alce-link_nuova_finestra');
                                            }
                                            echo $this->getComponente(
                                                $linkButtonVariant,
                                                [
                                                    'link' => $l['link'],
                                                    'label' => $l['label'],
                                                    'ariaLabel' => $ariaLabel,
                                                    'target' => $l['target']
                                                ],
                                                'Tipologia pulsanti'
                                            );
                                            ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php
endif;
?>