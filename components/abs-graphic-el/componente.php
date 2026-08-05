<?php
$svg = $this->getProp("SVG", '');
$png = $this->getProp("PNG", '');
$link = $this->getProp("Link", '');
$hCenter = $this->getProp('Center Horizional', 'No');
$vCenter = $this->getProp('Center Vertical', 'No');
$transform = "translate(" . ($hCenter == 'Yes' ? "-50%" : '0px') . "," . ($vCenter == 'Yes' ? "-50%" : '0px') . ")";
$hideMobile = $this->getProp('Hide Mobile', 'no') == 'yes';
$boxed = $this->getProp('Boxed Size');
$isFixed = $this->getProp('Fixed', 'no') == 'yes';

$insideMenu = $this->getProp("Dentro menu", "no") == "yes" ? 'menu-visible' : '';
$insideQR = $this->getProp("Dentro QR", "no") == "yes" ? "qr-visible" : '';

$animationLoop = $this->getProp("Animazione loop", "none");

/* Modificatori */
$mh = $hideMobile ? 'mh' : '';
$anchor = !empty($link) ? 'anchor' : '';

if ($svg != '' || $png != '') {
?>
    <div class="abs-graphic-el <?= $animationLoop; ?> <?= $insideMenu; ?> <?= $insideQR; ?> <?= $mh; ?> <?= $anchor; ?>" aria-hidden="true">
        <div class="abs-graphic-el__inner <?= !empty($boxed) ? 'boxed' : '' ?>">
            <div class="abs-graphic-el__elcontainer">
                <div class="abs-graphic-el__elcontainer__inner">
                    <div class="abs-graphic-el__elcontainer__inner__el <?= $isFixed ? 'fixed' : '' ?>" style="transform: <?= $transform; ?>">
                        <a href="<?= $link ?: '#'; ?>" target="_blank" rel="noopener noreferrer" style="<?= empty($link) ?  'pointer-events: none;' : ''; ?>">
                            <?php
                            if ($svg != "") {
                                echo $svg;
                            } else if ($png != "") {
                            ?>
                                <img class="abs-graphic-el__png" src="<?= $png; ?>" loading="lazy" decoding="async">
                            <?php } ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
