<?
include("conexao.php");

$query = "select nome from suporte.usuarios order by nome asc";
$resultado = mysql_query($query,$conexao);

/**
 * while ($linha = mysql_fetch_array($resultado)) {
	$nome = $linha['nome'];
	echo $nome."<br>";
*  }
 * 
 * 
 * 
 */


?>