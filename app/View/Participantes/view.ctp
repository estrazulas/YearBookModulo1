<section id="dadosperfil">
    <h2>Perfil do Participante</h2>
    <?php
        echo $this->element('participante', array(
            "participante" => $participante,
            "urlperfil" => Router::url(array('controller'=>'participantes','action'=>'view')),
            "tituloperfil" => "Dados do colega selecionado:",
            "loginsession" => $loginsession
        ));
    ?>
    <nav>
    <ul>
    <li>
    <?php
        echo $this->Html->link("Retornar a página principal",array('controller' => 'participantes', 'action' => 'principal')); 
    ?>
    </li>        
    <li>
    <?php
        echo $this->Html->link("Sair",array('controller' => 'participantes', 'action' => 'logout')); 
    ?>
    </li>
    </ul>
    </nav>
</section>