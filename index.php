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
	$n = $t['qtd']; // Total de regstros
	$limite = 10; // Limite máximo de registros por página
	$paginas = round($n/$limite); // Quantidade de páginas, que é basicamente, a quantidade de agrupamentos possíveis com o total de  registros que temos
	$pagina = empty($_REQUEST['pagina'])?1:$_REQUEST['pagina']; /*Caso, na requisição, nenhuma página for especificada, será usada o valor padrão 1. Ou seja, obrigatoriamente estará na primeira página*/
	$inicio = $pagina * $limite; /*Com base na página, é definido o registro de início para fazer a consulta*/ 
	$sql = "SELECT * from paises limit $inicio,$limite";
	$dados = mysql_query($sql);

	$saida = "<html><head><title>SCRIPT DE TESTE</title></head><body>";
	$saida .= "<table border='1'><tr><th colspan='2'>PAÍS</th></tr>";
	/*Percorrendo todos os registros*/
	while($d = mysql_fetch_assoc($dados)){
		$saida .="<tr ><td colspan='2'>".$d['nome']."</td></tr>";
	}
	
	/*INcluindo paginação simples: Se houver próxima,, exibirá o link Próxima. Se houver página anterior, exibirá Anterior. Sendo assim, os dois links não são exibidos na primeira e nem na ultima página*/
	$saida .= "<tr>";
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
	$saida .= "</tr>";
	$saida .= "</table></body></html>";
}
echo $saida;
