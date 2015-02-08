<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?
/*
ESTE SCRIPT VERIFICA A CRIPTOGRAFA DAS SENHAS DOS suporte.usuarios DO SISTEMA 

*/
include("conexao.php");
$query = "select * from suporte.usuarios";
$valor= "5523";
$senha = md5($valor);
$contador == "0";
$resposta = mysql_query($query,$conexao) or die("Erro (41) ao processar consulta do Tipo de Equipamento por suporte.usuarios.nome as nome_user, identificado como: ".mysql_error());
while($linha = mysql_fetch_array($resposta)) {
	$contador++;
	$cd_user = $linha['cd_usuarios_pk'];
	$user_pwl = $linha['pwl'];
	$nome = $linha['nome'];
	if ( $senha == $user_pwl ){
		echo "<br>O usuario $nome<br> <b>TEM PERMISSÃO PARA ENTRAR</b> no sistema";
	}else{
		echo "<br>O usuario $nome<br> <b>NA0 TEM NENHUMA PERMISSÃO PARA ENTRAR</b> no sistema";
	}

}


?>

</body>
</html>
