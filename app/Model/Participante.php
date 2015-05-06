<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class Participante extends AppModel {
	var $login = '';
	var $name = 'Participante';
	var $dados = null;
	
    public $validate = array(
	    'arquivoFoto' => array(
    		'extensao' => array (
		        'rule'    => array(
		           'extension',
		            array('gif', 'jpeg', 'png', 'jpg')
		        ),
	        	'message' => 'Selecione uma foto, extensões aceitas [gif,jpeg,png,jpg] de 240 por 320 px!'
	    	),

	     ), 
	    
        'cidade'=>array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Escolha uma cidade'
            )
        ),         
        
        'descricao' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A descrição precisa ser informada!'
            )
        ),
        'email'=>array(
            'emailValido'=>array(
                'rule'=>array('email'),
                'message'=>'Entre com um email válido'
        	) 
        ),                
    	'login' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'O usuário deve ser preenchido!'
            ),
            'pattern'=>array(
	             'rule'      => '/^[A-Za-z]+$/',
	             'message'   => 'Somente letras!',
	        ),  
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'O usuário já existe!'   
             ),
        ),
          
        'nomeCompleto' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'O nome precisa ser informado!'
            )
        ),
              
        'senha' => array(
            'required' => array(
        		"on" => "create",
                'rule' => array('notEmpty'),
                'message' => 'A senha precisa ser informada!',
            )
        ),
 
    );
	 /**
     * Para validar a dimensão no modelo, usei no campo imagem
     * Acessado pelo framework
     * @param $data
     * @param $width
     * @param $height
     */
	public function dimension($field,$width = 100, $height = null) {
		if (empty($field['tmp_name'])) {
			return false;
		} else {
			$file = getimagesize($field['tmp_name']);
			
			if (!$file) {
				return false;
			}
			
			$w = $file[0];
			$h = $file[1];
			$width = intval($width);
			$height = intval($height);

			if ($width > 0 && $height > 0) {
				return ($w > $width || $h > $height) ? false : true;
				
			} else if ($width > 0 && !$height) {
				return ($w > $width) ? false : true;
				
			} else if ($height > 0 && !$width) {
				return ($h > $height) ? false : true;
				
			} else {
				return false;
			}
		}
		return true;
	}
	
	public function setLogin($login){
		$this->login = $login;
	}
	
	public function beforeValidate($options = array())
	{
		if(isset($this->data[$this->alias]["arquivoFoto"])){
			//somente imagens de até 240x 320px
			if(!$this->dimension($this->data[$this->alias]['arquivoFoto'],240,320))
			{
				//não passou na validação retira para gerar erro de required
				$this->data[$this->alias]['arquivoFoto']=null;
			}			
		}	
	}
	
	
	public function afterValidate($options = array()) {
		if(isset($this->data[$this->alias]["arquivoFoto"])){
			//validou então manda só o nome do arquivo para o banco, depois será capturado na pasta do usuário
			$nomeArquivo = $this->trataUpload($this->data[$this->alias]);
			$this->data[$this->alias]['arquivoFoto'] = $nomeArquivo;
		}
				
	    if (isset($this->data[$this->alias]['senha'])) {
	        $passwordHasher = new SimplePasswordHasher();
	        $this->data[$this->alias]['senha'] = $passwordHasher->hash(
	            $this->data[$this->alias]['senha']
	        );
	    }
	    $this->dados = $this->data;
	}

	public function getDados(){
		return $this->dados;
	}
	/**
	 * Faz todo o tratamento e salva a foto no devido diretório
	 * @param $participante
	 */
	public function trataUpload($participante){

		$arquivo = $participante['arquivoFoto'];
		
		if($arquivo!=null)
		{
			//var_dump($campoPost);
			$dirUploads = WEBROOT_DIR."uploads/";
		    $nomeUsuario = $this->login."/";	  
			  
			if(!file_exists( $dirUploads ))
				mkdir($dirUploads, 0500);  //permissao de leitura e execucao
			  
			$caminhoUpload = $dirUploads.$nomeUsuario;
			if(!file_exists($caminhoUpload ))
				mkdir($caminhoUpload, 0700);  //permissoes de escrita, leitura e execucao
					
			$pathCompleto = $caminhoUpload.$arquivo['name'];

			if(file_exists($pathCompleto))
			{
			    chmod($pathCompleto,0755); 
			    unlink($pathCompleto);
			}
			
			if(!move_uploaded_file($arquivo['tmp_name'], $pathCompleto))
		    {
    			$this->Session->setFlash(__('Problemas ao armazenar o arquivo. Tente novamente e verifique se as permissões foram setadas corretamente', true)
				);	
		    }
		    
		    return $arquivo['name'];		
		}
	}	
}
?>