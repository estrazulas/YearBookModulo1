<?php
    echo $this->Html->script('participantes', array('inline'=>false));
    $urlajaxcidades= Router::url(array('controller'=>'cidades','action'=>'listar'));
    $idCidadeSelecionada = isset($idCidadeSelecionada)?$idCidadeSelecionada:'';
?>
<script>
    var urlAjaxEstado = '<?php echo $urlajaxcidades?>';
</script>

<div class="participantes form">
    <?php 
           
        echo $this->Form->create('Participante', array('type' => 'file')); 
    ?>
    <fieldset>
        <legend><?php if($modo == C_ACT_EDICAO) { echo __('Alteração de dados'); } else if($modo == C_ACT_NOVO){ echo __('Cadastrar novo participante'); }?></legend>
        <?php 
         
        if($modo == C_ACT_EDICAO){
            echo "<div class='adir'>
            <img class='fotopart' src='$foto'/>
            </div>";
        }
		
        //campo nome completo da tabela de participantes
        echo $this->Form->input('nomeCompleto', array('label'=>'Nome Completo:' , 'autocomplete'=>'off'));   
        
        //campo para seleção do estado via ajax
        echo $this->Form->input('estado', 
                        array(
                            'options' => $estados, 
                            'empty' => 'Selecione o estado',
                            'label' => 'Estado:',
                            'onChange' => "ajaxGetCidades('ParticipanteEstado','$urlajaxcidades')"
                        )
                    ); 

        //campo para listagem de cidades povoado com ajax
        echo'<div id="listacidades"></div>';
        
        //campo para envio da foto
        echo $this->Form->input('arquivoFoto',array( 'type' => 'file', 'label' => 'Foto[240x320 px]:'));
        
        //campo para descrição
        echo $this->Form->input('descricao', array('type' => 'textarea' ,'label' => 'Descrição:'));

        if($modo == C_ACT_EDICAO){
          //campo para entrar com login
		  echo $this->Form->input('login', array('label'=>'Login: ', 'disabled'=>'disabled', 'autocomplete'=>'off'));        
        }else{
          //campo para entrar com login
		  echo $this->Form->input('login', array('label'=>'Login: ', 'autocomplete'=>'off'));
        }

        //campo para entrar com o email valido
        echo $this->Form->input('email', array('label'=>'E-mail: ', 'autocomplete'=>'off'));
        
        //campo para entrar com a senha
        echo $this->Form->input('senha', array('label'=>'Senha: ' , 'type' =>'password' , 'autocomplete'=>'off'));
          
        echo $this->Form->input('cidadeSel', 
                    array(
                        'type' => 'hidden',
                        'value' => $idCidadeSelecionada
                    ));
        
        //botão do input
        echo $this->Form->end(__(($modo == C_ACT_EDICAO)?'Alterar':'Criar'),true); 
    ?>
    </fieldset>
    <nav>
    <ul>
        <li>
        <?php
            echo $this->Html->link("Voltar",array('controller' => 'participantes', 'action' => 'index')); 
        ?>
        </li>
    </ul>
    </nav>
    

</div>