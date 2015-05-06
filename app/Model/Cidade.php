<?php
App::uses('AppModel', 'Model');
class Cidade extends AppModel {
    public $validate = array(
    
    	'idCidade' => array(
     		'required' => false
    	),
        'idEstado' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'O estado é necessário!'
            )
        ),
        'nomeCidade' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'O nome da cidade precisa ser preenchida!'
            )
        ),     
    );
}
?>