<?
ini_set("display_errors",1);
$conexao1 = mysql_connect("localhost","visitante","3199") or die("N&atilde;o foi poss&iacute;vel se conectar ao banco de dados");
mysql_select_db("suporte",$conexao1) or die($erro_banco.mysql_error());



$sql_suporte = "SELECT cd_usuarios_pk, nome, cpf FROM usuarios";
$resposta = mysql_query($sql_suporte);
$contador = 0;
while ($linha1 = mysql_fetch_array($resposta)) {
	$cd_usuarios_pk = $linha1["cd_usuarios_pk"];
	$nome = $linha1["nome"];
	$cpf = $linha1["cpf"];
	
	//echo "<br>$cd_usuarios_pk | $nome | $cpf";
	echo "<br><hr>$cpf";
	
	if(!is_null($cpf))
	{
		
		if(strlen($cpf) < 11)
		{
			$resta = (11 - strlen($cpf));
			
			for ($a = 1; $a<=$resta; $a++)
			{
				$cpf = "0".$cpf;
			}
			
		}
		
		$sql_update_cpf = "UPDATE usuarios SET cpf = '$cpf' WHERE cd_usuarios_pk = $cd_usuarios_pk";
		if(!mysql_query($sql_update_cpf))
		{
			$msg_erro = mysql_error();
			
			echo "<br>$sql_update_cpf";;
			echo "<br>Erro ao atualizar registro!!!   Motivo: ".$msg_erro;
			exit;
		}
		else 
		{
			$contador++;
		}
		
		
	}
	$comprimento = strlen($cpf);
	echo "<br>$cpf ($comprimento)<hr>";
	
}


echo "<br>$contador foram atualizados.";

?>