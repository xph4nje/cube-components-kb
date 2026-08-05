<?php
    $breadcrumbIcon = $this->getProp("Icona Home", "");
    
    $iconArrows = $this->getProp("Separatori","/") == ">" ? "arrows": "";
    
    $this->addHook("hook_impostaLivello_BreadCrumb", "modImpostaLivello_BreadCrumb");
    
    function modImpostaLivello_BreadCrumb($livello){
        return 0;
    }
?>
<nav class="base-breadcrumb boxed <?=$iconArrows;?>" aria-label="Breadcrumb">
    <span><a href="<?php echo $this->getLinkHome(); ?>"><?php echo $breadcrumbIcon != "" ? '<i class="' . $breadcrumbIcon . '"></i>' : "Home";?></a></span>
    <?php
        $breadCrumb = $this->getBreadCrumb();
        echo $breadCrumb;
    ?>  
</nav>