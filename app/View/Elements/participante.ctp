<?php
    $nome = $participante['nomeCompleto'];
    $descricao = $participante['descricao'];
    $email = $participante['email'];
    $login = $participante['login'];
    $cid = $cidade['nomeCidade'];
    $est = $estado['nomeEstado'];
    $uf = $estado['sigaEstado'];
    echo $this->Html->script('participantes', array('inline'=>false));
?>
<dl>
    <dt><?php echo $tituloperfil."[".$login."]" ?></dt>
    <dd>
        <figure class="caixafotoaluno">
                <img src="<?php echo $foto?>" title="<?php echo $nome ?>" alt="<?php echo $nome ?>" />
        </figure> 
        <div id="menu">
        <?php
            if(isset($loginsession) && ($login == $loginsession))
                echo $this->Html->link("Alterar Meus Dados",array('controller' => 'participantes', 'action' => 'editar'));
        ?>
        </div>
    </dd>
    <dt>Nome:</dt>
    <dd>
        <?php echo $nome ?>
    </dd>
    <dt>Cidade:</dt>
    <dd>
        <?php echo $cid ?>
    </dd>
    <dt>UF:</dt>
    <dd>
        <?php echo $est."/".$uf ?>
    </dd>                
    <dt>E-mail:</dt>
    <dd>
        <a href="mailto:<?php echo $participante['email']?>"><?php echo $participante['email']?></a>
    </dd>                 
</dl>   
<aside>
    <h2>Descrição fornecida pelo participante</h2>
    <p><?php echo $participante['descricao']?></p>
</aside>

<section id="usuariosexistentes">
    <?php
        echo $this->element('thumbnails', array(
            "participantes" => $participantes,
            "urlperfil" => $urlperfil,
            "titulo" => "Selecione um participante para ver seus dados:",
            "estilo" => "width:100%"
        ));  
    ?>
</section>
