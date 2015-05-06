<?php
App::uses('AppModel', 'Model');
class Estado extends AppModel {
    public $validate = array(
    	'idEstado' => array(
     		'required' => false
    	),
        'nomeEstado' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'O nome do estado é necessário!'
            )
        ),
        'sigaEstado' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A sigla é necessária!'
            )
        ),     
    );
}
?>