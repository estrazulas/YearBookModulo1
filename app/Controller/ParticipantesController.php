<?php
App::import('Controller', 'Cidades');
class ParticipantesController extends AppController {
	public $helpers = array('Html', 'Form', 'Session', 'js');
	
	public $components = array('Session');
	

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('cadastro','login','index');
	}

	public function index() {
		$this->Participante->recursive = 0;
		$this->redirect(array('controller' => 'participantes', 'action' => 'principal'));
	}

	public function login() 
	{
		if ($this->request->is('post')) 
		{
			if ($this->Auth->login()) {

				$this->Session->write('Participante.login', $this->request->data['Participante']['login']);
				
				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash(__('Dados inválidos. Tente novamente.'));
		}
		
		$parametros = array(
			'limit' => 5,
			'order' => array('nomeCompleto' => 'asc'),
		);
		
		$participantes = $this->getParticipantes($parametros);
		
		$this->montaThumbNails($participantes,null,"../");
	}
	
	public function view($loginperfil){
		if(isset($loginperfil)){
			$loginsession =  $this->Session->read('Participante.login');
			if($loginperfil == $loginsession){
				$this->redirect(array('action' => 'principal'));
			}else{
				$this->criaDadosParticipante($loginperfil,"../../");
			}
		}else{
			$this->Session->setFlash(__('Participante não encontrado!'));	
		}
	}

    public function montaThumbNails($participantes,$ultimoPerfil,$raiz){
    	$arrayThumbNails = array();
    	$dirUploads = $raiz.WEBROOT_DIR."uploads/";
		    
    	//insere em primeiro lugar o ultimo perfil visitado
    	if(isset($ultimoPerfil)){
    		$nomeUsuario =  $ultimoPerfil['Participante']['login']."/".$ultimoPerfil['Participante']['arquivoFoto'];	 
    		array_push($arrayThumbNails, array( 'login' => $ultimoPerfil['Participante']['login'], 'dirThumb'=> $dirUploads.$nomeUsuario, 'nomeCompleto' => $ultimoPerfil['Participante']['nomeCompleto'], 'arquivoFoto' => $ultimoPerfil['Participante']['arquivoFoto']));
    	}
    	
    	foreach ($participantes as $k => $partipante){
    		if(isset($ultimoPerfil) && $partipante['Participante']['login'] == $ultimoPerfil['Participante']['login']){
    			continue;//ultimo participante já foi inserido antes, ignora
    		}
    		$nomeUsuario =  $partipante['Participante']['login']."/".$partipante['Participante']['arquivoFoto'];
    		array_push($arrayThumbNails,  array('login' => $partipante['Participante']['login'],'dirThumb'=> $dirUploads.$nomeUsuario, 'nomeCompleto' => $partipante['Participante']['nomeCompleto'], 'arquivoFoto' => $partipante['Participante']['arquivoFoto']));
    	}
    	$this->set('participantes',$arrayThumbNails);
    }
    
    private function criaDadosParticipante($login, $raiz)
    {
    	$cidades = new CidadesController;
    	$participante = $this->getParticipante($login);
    	if(isset($this->Session)){
    		if($participante['Participante']['login']!=$this->Session->read('Participante.login') ){
    			$this->Session->write('ultimoVisitado',$participante);
    		}
    	}
		$cidade = $cidades->getCidade($participante['Participante']['cidade']);
		$this->set('participante',$participante['Participante']);
		$this->set('foto',$this->getDirFoto($login,$participante['Participante']['arquivoFoto'],$raiz));
		$estado =  $this->getEstado($cidade['Cidade']['idEstado']);
		$this->set('estado', $estado['Estado']);
		$this->set('cidade', $cidade['Cidade']);
	
		
		$parametros = array(
			'limit' => 5,
			'order' => array('nomeCompleto' => 'asc'),
		);
		
    	if(isset($this->Session)){
    		$log = $this->Session->read('Participante.login');
    		$parametros['conditions'] = array('Participante.login != ' =>$log);
			$this->set('loginsession', $log);
		}
		
		$participantes = $this->getParticipantes($parametros);
		$this->montaThumbNails($participantes,$this->Session->read('ultimoVisitado'),$raiz);		
    }
    
	public function buscar($nome){
		$this->layout = 'ajax';
		
		
		$parametros = array(
			'conditions' => array('nomeCompleto LIKE ' => "%$nome%"),
			'order' => array('nomeCompleto' => 'asc'),
		);		
    	if(isset($this->Session)){
    		$log = $this->Session->read('Participante.login');
			$this->set('loginsession', $log);
		}
		
		$participantes = $this->getParticipantes($parametros);
		$this->montaThumbNails($participantes,$this->Session->read('ultimoVisitado'),"../");
	}
	
	public function principal(){
		$login = $this->Session->read('Participante.login');
		$this->criaDadosParticipante($login, "../");		
	}

	public function logout() {
		$this->Session->destroy();
		return $this->redirect($this->Auth->logout());
	}

	//editando um participante
	public function editar() {
		$login = $this->Session->read('Participante.login');

		//estamos editando
		if(isset($login)){
			
			$part = $this->getParticipante($login);
			
			if ($part==null) 
	        {
	             $this->Session->setFlash(__('Participante não encontrado!'));
	        }else{
        		$cidades = new CidadesController;
				$cidade = $cidades->getCidade($part['Participante']['cidade']);
				
	      		if ($this->request->is('post')) 
	      		{
    
	      			$this->Participante->setLogin($login);
					$this->Participante->set($this->request->data);
							
					//se está valido
		      		if ($this->Participante->validates()) 
		      		{
		      			$partdados = $this->Participante->getDados();
		      		
      	        		//necessário pois o metodo save sem um ID pk inteiro não faz update
				      	$setCampos = array(
			      			'Participante.nomeCompleto' => $partdados['Participante']['nomeCompleto'],
			      			'Participante.cidade' => $partdados['Participante']['cidade'],
			      			'Participante.descricao' => $partdados['Participante']['descricao'],
			      			'Participante.email' => $partdados['Participante']['email'],
				      		'Participante.arquivoFoto' => $partdados['Participante']['arquivoFoto']
				      	);	
					    
						if(!empty($partdados['Participante']['senha'])){
			      			//só adiciona nova senha se o usuário informar
			      			$setCampos['Participante.senha'] = $partdados['Participante']['senha'];
			      		}			
			      	
			      		foreach($setCampos as $k => $valor){
			      			//método updateAll é fraco, porém sem um campo ID numérico não foi possível usar o bom e prático save
			      			$setCampos[$k] = "'".$valor."'";
			      		}
		
			      		//executa update dos campos
		      			$this->Participante->updateAll(
						    $setCampos,   //campos para setar
						    array( 'Participante.login' => $login )  //condition
						);
						
		                $this->Session->setFlash(__('Os seus dados foram alterados com sucesso!'));
		                
		                $this->redirect(array('action' => 'principal'));
		                
		            } else {
		                $this->Session->setFlash(__('Dados inválidos. Tente novamente'));
		            }
		            
		        } else {
		            $this->request->data = $part;
		            if(!isset($this->request->data['Participante']['estado']))
		            	$this->request->data['Participante']['estado'] = $cidade['Cidade']['idEstado'];
		            
		            unset($this->request->data['Participante']['senha']);
		        }	
	        }        
		}
		
		$this->set('foto',$this->getDirFoto($login,$this->request->data['Participante']['arquivoFoto'],"../"));
		$this->set('modo',C_ACT_EDICAO);
		$this->set('idCidadeSelecionada', $this->data['Participante']['cidade']);
		$this->carregaEstados();
		$this->render('cadastro');
	}
	
	private function getDirFoto($login,$nomeFoto,$raiz){
		return $raiz.WEBROOT_DIR."uploads/".$login."/".$nomeFoto;
	}
	/**
	 * Procura um participante, o banco de dados do professor não tem um campo ID então várias funções
	 * do cake não podem ser utilizadas
	 * @param string $login
	 */
	public function getParticipante($login){
	 	$part = $this->Participante->find('first', array(
        'conditions' => array('Participante.login' => $login)
    	));
		return  $part;
	}
	
	public function getParticipantes($parametros){
		if(!isset($parametros)){
			return $this->Participante->find('all');
		}else{
			return $this->Participante->find('all',$parametros);
		}
	 	
	}
	

	//novo participante
	public function cadastro() {
		$login = $this->Session->read('Participante.login');
		if(isset($login)){
			$this->Session->setFlash(__('Para poder fazer um novo cadastro não é permitido estar online!'));
			$this->redirect(array('action' => 'principal'));	
		}else{
			if ($this->request->is('post')) {
				$this->Participante->create();
				
				$this->Participante->setLogin($this->request->data['Participante']['login']);
				if ($this->Participante->save($this->request->data)) {
					
					$this->Session->setFlash(__('Participante criado'));
					return $this->redirect(array('action' => 'index'));
				}else{
	
					$this->Session->setFlash(
					__('Dados inválidos. Tente novamente', true)
					);	
							
					// Se o usuário selecionou algum estado, carregamos a lista de cidades para a view
	                if(!empty($this->data['Participante']['estado'])){
	                    $this->loadModel('Cidade');
	                    $cidades = $this->Cidade->find('list', array(
	                            'conditions' => array(
	                                    'Cidade.idEstado' => $this->data['Participante']['estado']
	                                ),
	                            'fields' => array('idCidade', 'nomeCidade'))
	                        );
	                    $cidades = array('' => 'Selecione a cidade', $cidades);    // Adiciono o "Selecione a cidade" na lista de cidades
	                    $this->set('idCidadeSelecionada', $this->data['Participante']['cidade']);
	                    $this->set('cidades', $cidades);
	                }
				}
			}
			$this->set('modo',C_ACT_NOVO);
			$this->carregaEstados();
		}	
	}
	
	private function carregaEstados(){
 		$this->loadModel('Estado');
        $estados = $this->Estado->find('list', array('fields' => array('idEstado', 'nomeEstado')));
  
        $this->set('estados', $estados); 	
	}
	
	private function getEstado($idEstado){
	 	$this->loadModel('Estado');
        $estados = $this->Estado->find('first', array('fields' => array('idEstado', 'nomeEstado','sigaEstado'),
         'conditions' => array('Estado.idEstado' => $idEstado)));	
        return $estados;
	}
	


}
?>