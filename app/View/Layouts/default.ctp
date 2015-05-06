<?php

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Yearbook  - Daniel Estrázulas
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('normalize');
		echo $this->Html->css('folhaestilo');
        echo $this->Html->css('loading');
        //echo $this->Html->css('cake.generic');
        echo $this->Html->css('forms');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    <header>            
        <h1>Projeto : Estrázulas Yearbook 2014</h1>
    </header>
    
    <main>
		<?php echo $this->Session->flash(); ?>

		<?php echo $this->fetch('content'); ?>    
    </main>
    
    <footer>
	    <!--Exemplo/teste de citação -->
	    <blockquote cite="http://karateoficialwkan.blogspot.com.br/p/caminho-das-maos-vazias.html">
	        <p>
	            "<strong>A bravata não é sinônimo de bravura</strong>. A bravura e a valentia são uma questão menos de forma que de espírito. <em>O homem bravo e consciente de seus deveres e da <b>justiça</b>, sabe bater-se pelos seus ideais fazendo dos obstáculos não uma perspectiva de derrota, mas sim um fator estímulo.</em>"
	        <strong>(Gichin Funakoshi)</strong>
	        </p>            
	    </blockquote>   
	    <p id="copyright">Copyright © 2014 - Daniel Severo Estrázulas</p>
	</footer>
	<div class="modal"><!-- Place at bottom of page --></div>
</body>
</html>
