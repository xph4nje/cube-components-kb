<?php
    $gallery = $this->getModulo("Gallery");
    $removeAllButton = $this->getProp("Rimuovi Pulsante Tutte", "no") == "yes";
    $sticky = $this->getProp("Sticky", "no") == "yes";
    $printTitle = $this->getProp("Stampa titolo su immagini", "no") == "yes";
    
    

    if(is_array($gallery) && array_key_exists('immagini', $gallery) && is_array($gallery['immagini']) && count($gallery['immagini']) > 0){
?>
<div class="block-generic-page-galllery ">
    <?php
        if(array_key_exists('categorie', $gallery) && is_array($gallery['categorie']) && count($gallery['categorie']) > 0){

    ?>
    <div class="block-generic-page-galllery__cats <?php if($sticky) { echo "sticky"; } ?>" data-startCat="<?php echo !$removeAllButton ? "0" : $gallery['categorie'][0]['id_categoria'];  ?>">
        <?php
            $buttonVariant = $this->getVariant('Tipologia Pulsanti Categorie');
            if($buttonVariant != '') {
                if(!$removeAllButton) {
                    echo '<span>' . $this->getComponente($buttonVariant, [
                        'link' => "javascript:genericGalleryFilter(0,'0')",
                        'label' => $this->__('tutte')
                    ], 'Tipologia Pulsanti Categorie') . '</span>';
                }
                $index = $removeAllButton ? 0 : 1;
                foreach($gallery['categorie'] as $cat) {
                    echo '<span>' . $this->getComponente($buttonVariant, [
                        'link' => 'javascript:genericGalleryFilter(' . $index . ',' . $cat['id_categoria'].')',
                        'label' => $cat['categoria']
                    ], 'Tipologia pulsanti') . '</span>';
                    $index++;
                }
            } else {
                echo "<p>Selezionare una variante di pulsanti per visualizzare il menu categorie</p>";
            }
        ?>
    </div>
    <?php
        }
    ?>
    <div class="block-generic-page-galllery__box boxed">
        <div class="block-generic-page-galllery__images">
            <?php
                $mosaicoVariant = $this->getVariant('Tipologia Mosaico');
                if($mosaicoVariant != "") {
                    echo $this->getComponente($mosaicoVariant, [
                        'images' => $gallery['immagini'],
                        'addCategory' => true,
                        'addGallery' => true,
                        'printTitle' => $printTitle
                    ], 'Tipologia Mosaico');
                } else {
                    echo "<p>Selezionare una variante di mosaico per visualizzare le immagini</p>";
                }
            ?>
        </div>
    </div>
</div>
<?php
    }
?>