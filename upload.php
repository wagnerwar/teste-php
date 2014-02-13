<?php/*
if(isset($_POST) && isset($_FILES)){
	$imagem = $_FILES['imagem']['name'];
	
	$dir = "imagems";
	
	if(!is_dir($dir)){
		@mkdir($dir,0775);
	}
	
	$salva = $dir."/".$imagem;
	
	move_uploaded_file($_FILES['imagem']['tmpName'],$salva );
	
	
	$info_imagem = pathinfo($salva);
	
	$nova_imagem = time().rand(1000,5000).".".$info_imagem['extension'];
	
	// *** Include the class
	include("resize-class.php");

	// *** 1) Initialise / load image
	$resizeObj = new resize($salva);

	// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
	$resizeObj -> resizeImage(200, 200, 'crop');

	// *** 3) Save image
	$resizeObj -> saveImage($dir."/".$nova_imagem, 100);
	
	// O arquivo-base é removido
	unlink($salva);
	
	echo "UPLOAD REALIZADA COM SUCESSO";
	
}*/
echo "YES";
?>
<html>
	<head>
		<title>Upload com redimensionamento</title>	
	</head>
	<body>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="imagem" id="imagem" />
			<input type="submit" name="gravar" value="Gravar" id="gravar" />
			
		</form>
	</body>
</html>