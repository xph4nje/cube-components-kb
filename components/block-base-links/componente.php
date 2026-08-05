<?php
    $ctas = $this->getModulo("Ctas");
    if(is_array($ctas) && count($ctas) > 0) {
?>
<div class="block-base-links boxed">
    <?php
        foreach($ctas as $cta) {
            $buttonVariant = $this->getVariant('Tipologia Pulsanti');
            if($buttonVariant != '') {
                echo '<div>' . $this->getComponente($buttonVariant, [
                    'link' => $cta['link'],
                    'label' => $cta['label'],
                    'target' => $cta['target']
                ], 'Tipologia Pulsanti') . '</div>';
            } else {
    ?>
    <div><a class="cta" href="<?php echo $cta['link']; ?>"><?php echo $cta['label']; ?></a></div>
    <?php
            }
        }
    ?>
</div>
<?php
    }
?>
