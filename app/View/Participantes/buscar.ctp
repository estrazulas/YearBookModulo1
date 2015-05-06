<section id="buscaresult">
    <?php
        $urlperfil = Router::url(array('controller'=>'participantes','action'=>'view')); 
        echo $this->element('thumbnails', array(
            "participantes" => $participantes,
            "urlperfil" => $urlperfil,
            "titulo" => "Resultados da pesquisa:",
            "estilo" => "width:100%;",
            "estiloli" => "display: inline;"
        ));  
    ?>
</section>