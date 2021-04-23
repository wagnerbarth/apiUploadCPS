<?php

// para efeito de teste declaramos a variavel login
$login = "wagner.barth.com.br";

if ($_FILES) { // Assim como $_POST e $_GET recebem dados de formulário $_FILES recebe arquivos enviados

    if ($_FILES['arquivo']) { // Verifica se o campo não está vazio.

        $dir = './arquivos/'; // Diretório que vai receber o arquivo.
        //echo $dir . "<br />";
        $tmpName = $_FILES['arquivo']['tmp_name']; // Recebe o arquivo temporário.
        //echo $tmpName . "<br />";
        $name = $_FILES['arquivo']['name']; // Recebe o nome do arquivo.
        //echo $name . "<br />";


        /*
        * código que verifica e separa o nome do arquivo para 
        * salvar de forma correta
        */

        echo "Arquivo recebido: " .  $name . "<br />";

        $separa = explode(".", $name);
        echo "Array separado: ";
        print_r($separa);
        echo "<br />";

        $separa = array_reverse($separa);
        echo "Array invertido: ";
        print_r($separa);
        echo "<br />";

        $tipo = $separa[0];
        echo "Apenas o tipo do arquivo: " .  $tipo . "<br />";

        $avatar = $login . '.' . $tipo;
        echo "COncatena ao nome do login: " .  $avatar . "<br />";


        // move_uploaded_file( $arqTemporário, $nomeDoArquivo )
        // move_uploaded_file( $tmpName, $dir . $name );
        /*if (move_uploaded_file($tmpName, $dir . $name)) { // move_uploaded_file irá realizar o envio do arquivo.		
            header('Location: sucesso.php'); // Em caso de sucesso, retorna para a página de sucesso.			
        } else {
            header('Location: erro.php'); // Em caso de erro, retorna para a página de erro.			
        }*/
    }
}
