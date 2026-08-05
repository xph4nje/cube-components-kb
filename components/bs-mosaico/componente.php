<?php
    $images = $this->getModulo("Immagini");
    $columnLayout = $this->getProp("Layout a Colonne", "1");
    $columnActive = $this->getProp("Colonna Active","sx");
    
    if(is_array($images) && count($images) > 0) {
?>
<section class="bs-mosaico boxed col-<?=$columnLayout;?> <?=$columnActive?>">
<?php
    $mosaicoVariant = $this->getVariant('Tipologia Mosaico', 'mosaico-full-2-1-2');
    
    echo $this->getComponente($mosaicoVariant, [
        'images' => $images,
        'addGallery' => true
    ], 'Tipologia Mosaico');
?>
</section>
<?php
    }
?>