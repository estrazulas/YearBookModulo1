<?php
    // preciso indicar ao form o tipo de objeto participante, pois no contexto do ajax perdia o data Participante e ficava apenas com name idCidade
   $this->Form->create('Participante', array('type' => 'file'));
   echo $this->Form->input('cidade', 
            array(
                'type' => 'select',
                'label' => 'Cidade:',
                'options' => $cidades,
                'empty' => array("" => 'Selecione uma cidade')
            )
        );      
?> 