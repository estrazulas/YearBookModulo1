<?php
class CidadesController extends AppController
{
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('listar');
	}

	public function getCidade($idCidade){
	   $cit =$this->Cidade->find('first', array(
        'conditions' => array('Cidade.idCidade' => $idCidade)
       ));
       return $cit;
	}
	public function listar($estado_id = 1){
	 $this->layout = 'ajax';
	 $this->set('cidades', $this->Cidade->find('list', array(
	    'conditions' => array(
	      'Cidade.idEstado' => $estado_id      
	 ),
	    'fields' => array(
	      'idCidade', 'nomeCidade'
	      ),
     )));
	}
}