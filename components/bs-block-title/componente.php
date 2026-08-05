<?php
    $titolo = $this->getModulo("Titolo");
    $line = $this->getProp('Linea', 'no') === 'yes';
    if(strip_tags($titolo) != '') {
?>
<section class="bs-block-title">
    <div class="boxed">
        
        <div class="bs-block-title__text<?php echo $line ? ' title-hyphen' : ''; ?>">
            
            <?php if($line): ?>
                <span class="hyphen"></span>
            <?php endif; ?>
            
            <<?php echo $this->getProp("Heading", 'h2'); ?>><?php echo $titolo; ?></<?php echo $this->getProp("Heading", 'h2'); ?>>
        </div>
    </div>
</section>
<?php
    }
?>