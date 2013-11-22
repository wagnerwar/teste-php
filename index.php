<?php
/*SCRIPT SIMPLES DE PAGINAÇÃO*/

/*EStabelendo conexão com base de dados paises no servidor local*/
$server = "localhost";
$user = "root";
$pass = "";
$db = "paises";

$conn = mysql_connect($server,$user,$pass);
mysql_select_db($db,$conn);

$total = mysql_query("SELECT count(*) as qtd from paises");



/*Se encontrou o total*/
if($t = mysql_fetch_assoc($total)){
	
	// Total de regstros
	$n = $t['qtd']; 
	
	// Limite máximo de registros por página
	$limite = 10; 
	/*
	 * A função round basicamente retorna, caso o número seja quebrado, o menor valor inteiro
	 * Retorna Quantidade de páginas, que é basicamente, a quantidade de agrupamentos possíveis com o total de  registros que temos
	 * Esta quantidade é obtida dividindo-se o total de registros pelo limite por página
	 * */
	$paginas = round($n/$limite); 
	
	/*Caso, na requisição, nenhuma página for especificada, será usada o valor padrão 1. Ou seja, obrigatoriamente estará na primeira página*/
	$pagina = empty($_REQUEST['pagina'])?1:$_REQUEST['pagina']; 
	
	/*Com base na página, é definido o registro de início para fazer a consulta*/
	$inicio = $pagina * $limite;  
	
	$sql = "SELECT * from paises limit $inicio,$limite"; /*Fazendo a consulta */
	
	$dados = mysql_query($sql);
	
	
	/*Montando a apresentação*/
	$saida = "<html><head><title>SCRIPT DE TESTE</title></head><body>";
	$saida .= "<table border='1'><tr><th colspan='2'>PAÍS</th></tr>";
	
	/*Percorrendo todos os registros*/
	while($d = mysql_fetch_assoc($dados)){
		$saida .="<tr ><td colspan='2'>".$d['nome']."</td></tr>";
	}
	
	$saida .= "<tr>";
	/*INcluindo paginação simples: Se houver próxima,, exibirá o link Próxima. Se houver página anterior, exibirá Anterior. Sendo assim, os dois links não são exibidos na primeira e nem na ultima página*/
	
	/*-----------------------------------RODAPÉ---------------------------------*/
	/*
	 * Caso a página atual não seja 1, mas um valor menor, aparecerá o link para a página anterior
	 * */
		/*Caso a página não tenha chegado na última, haverá um link para a próxima página*/
	
	if($pagina-1 > 0){
		$saida .= "<td><a href='?pagina=".($pagina - 1 )."'>Anterior</a></td>";	
	}else{
		$saida .= "<td>Está na primeira</td>";
	}
	
	if($pagina < $paginas){
		$saida .= "<td><a href='?pagina=".( $pagina + 1) ."'>Próxima</a></td>";
	}else{
		$saida .= "<td>Está na última</td>";
	}
	
	/*-----------------------------------FECHANDO O RODAPÉ---------------------------------*/
	
	/*
	 * Caso voçê queira uma paginação diferente, tipo, em que o usuário pode selecionar uma determinada página diretamente, é só comentar o trecho do rodapé acima e descomentar o trecho abaixo
	 * */
	/*-----------------------------------RODAPÉ---------------------------------*/
	/*$saida .= "<td colspan='2'>";
	for($x=1;$x<=$paginas;$x++){
		$saida .= ($pagina == $x?" <b> ":" ")."<a href ='?pagina=$x'>".$x."</a>".($pagina == $x?" </b> ":" ");
	}
	$saida .= "</td>";*/
	/*-----------------------------------FECHANDO O RODAPÉ---------------------------------*/
	$saida .= "</tr>";
	$saida .= "</table></body></html>";
}
echo $saida;
