

<section id="principal">
    <h2>Página principal</h2>
    <?php
        echo $this->element('participante', array(
            "participante" => $participante,
            "urlperfil" => Router::url(array('controller'=>'participantes','action'=>'view')), 
            "tituloperfil" => 'Meu perfil de participante:',
            "loginsession" => $loginsession,
        ));
    ?>
    <section id="busca">
        <h2>Pesquisa/Busca por participantes (por Nome):</h2>
        <?php
            echo $this->Html->script('participantes', array('inline'=>false));
            $urlajax = Router::url(array('controller'=>'participantes','action'=>'buscar'));
            echo $this->element('pesquisa', array(
                "placehoder" => 'Nome do participante',
                "urlajax" => $urlajax
            ));
        ?>
    </section>    
    <nav>
    <ul>
    <li>
    <?php
        echo $this->Html->link("Sair",array('controller' => 'participantes', 'action' => 'logout')); 
    ?>
    </li>
    </ul>
    </nav>
</section>