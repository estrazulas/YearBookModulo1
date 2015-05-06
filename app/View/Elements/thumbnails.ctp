<h2><?php echo $titulo ?></h2>
<div class="participantes">
    <?php
        $count = count($participantes);
        if(isset($estilo)){
            echo "<div class='listathumbs' style='$estilo'> ";
        }else{
            echo "<div class='listathumbs'>"; 
        }

        //na busca retira este p
        if(!isset($estiloli)){
            echo '
            <p class="minifonte">Passe o mouse sobre as imagens para visualizar os nomes dos parcipantes!</p>';
        }

        echo "<ul>";
        
        if($count == 0 ){
            echo "<li>Nenhum participante encontrado!</li>" ;   
        }
        foreach($participantes as $k => $participante)
        {
            $dirFoto = $participante['dirThumb'];
            $nome = $participante['nomeCompleto'];
            $login = $participante['login'];
            $url = $urlperfil.'/'.$login;
            $ignoreVisitado = false;
            // a busca muda o estilo da listagem e irá mostrar o nome ao lado da imagem thumb
            if(!isset($estiloli) || empty($estiloli)){
                $estiloli = "";
                $mostranome ="";
            }else if(isset($estiloli)){
                $mostranome = $nome;
            }
            
            if(isset($estilo) && ($k == 0)){
                echo "<li><font class='ultperf'>Último perfil visitado:</font><a href='$url' title='$nome'><img class='thumbnailsel' alt='' src='$dirFoto'/></a><font class='txnome'>$mostranome</font></li>";
            }else{
                echo "<li style='$estiloli'><a href='$url' title='$nome'><img class='thumbnail' alt='' src='$dirFoto'/></a><font class='txnome'>$mostranome</font></li>";
            }            

        }
        echo '</ul></div>';
    ?>
</div>