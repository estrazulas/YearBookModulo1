<?php     
    echo $this->Form->create('Participante'); 
    //campo nome completo da tabela de participantes
    echo $this->Form->input('nome', array('label'=>'Nome:' , 'autocomplete'=>'off','onkeydown' =>"pressionaenter('$urlajax',event);", 'placeholder' => $placehoder));

    echo '<div class="btaajax">';
    echo $this->Form->button('Clique aqui buscar', array('onclick'=>"buscaajax('$urlajax')", 'type'=>'button'));
    echo '</div>';
    echo $this->Form->end();

?>
<div id="buscaresultados">

</div>