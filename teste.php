<?php
/*
 * Para maiores informações da classe resize2.php, visite o site: http://www.jarrodoberto.com/articles/2011/09/image-resizing-made-easy-with-php
 * Este é o site do autor do script resize2.php
 * */

if(isset($_POST['gravar']) && isset($_FILES['imagem'])){
	$imagem = $_FILES['imagem']['name']; // Nome originai da imagem
	
	
	$dir = "imagens"; // Diretório das imagens
	
	$salva = $dir."/".$imagem; // Caminho onde vai ficar a imagem no servidor

	move_uploaded_file($_FILES['imagem']['tmp_name'],$salva ); // Este comando move o arquivo do diretório temporário para o caminho especificado acima
	
	
	$info_imagem = pathinfo($salva); // Resgatando extensão do arquivo recém-baixado
	
	$nova_imagem = time().rand(1000,5000).".".$info_imagem['extension']; // Nome da imagem redimensionada
	
	// *** Include the class
	// ESte arquivo está no arquivo ZIPADO do artigo
	require_once "resize2.php"; 

	// *** 1) Initialise / load image
	$resizeObj = new resize($salva);

	// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
	$resizeObj -> resizeImage(200, 200, 'crop');
	/* Especificando que a nova imagem terá 200 px de largura e altura. E utilizando a opção CROP, que é considerada a melhor
	pois, recorta a imagem na medida sem distorção
	Se quizer ver outras opções, visite o site do desenvolvedor de resize2.php (http://www.jarrodoberto.com/articles/2011/09/image-resizing-made-easy-with-php)
	
	*/

	// *** 3) Save image
	$resizeObj -> saveImage($dir."/".$nova_imagem, 100);
	
	// O arquivo-base é removido
	unlink($salva);
	
	
	// Exibindo mensagem, se tudo correu bem
	echo "UPLOAD REALIZADA COM SUCESSO";
	
}
?>
<html>
	<head>
		<title>Upload com redimensionamento</title>	
	</head>
	<body>
		<form action="teste.php" method="post" enctype="multipart/form-data">
			<input type="file" name="imagem" id="imagem" />
			<input type="submit" name="gravar" value="Gravar" id="gravar" />
			
		</form>
	</body>
</html>