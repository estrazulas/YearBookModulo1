<div class="participantes form">
    <section id="cadastro">
    <h2>Ainda não é participante?</h2>
    <nav>
    <ul>
        <li>
        <?php
            echo $this->Html->link("Quero ser um participante!",array('controller' => 'participantes', 'action' => 'cadastro')); 
        ?>
        </li>
    </ul>
    </nav>
    </section>

    <section id="login">
    <h2>Faça login:</h2>   
    <?php 
        echo $this->Form->create('Participante'); 
        $urlperfil = Router::url(array('controller'=>'participantes','action'=>'view')); 
    ?>
    <fieldset>
        <legend>
            <?php echo __('Digite seu login e senha'); ?>
        </legend>
        <?php 
            echo $this->Form->input('login', array('label'=>'Login:'));
            echo $this->Form->input('senha', array('label'=>'Senha:', 'type'=>'password'));
            echo $this->Form->end(__('Entrar'));
            ?>
    </fieldset>
    </section>
  
    <?php
        echo $this->element('thumbnails', array(
            "participantes" => $participantes,
            "urlperfil" => $urlperfil,
            "titulo" => "Conheça alguns usuários já cadastrados:"
        ));  
    ?>
</div>