<?
ini_set("display_errors",0);
session_start();

//verifica  se inforamações de conta estao validadas
if($_SESSION["usuario"] == "" || $_SESSION["nivel_usuario"] == "" || $_SESSION["id_usuario"]==""){
		echo "<script>alert ('NAO FOI IDENTIFICADO USUARIO PARA ESTE SISTEMA.   TALVEZ VOCÊ TENHA DEIXADO A SESSÃO ABERTA POR MAIS DE 30 MINUTOS SEM ATIVIDADE E POR ESTE MOTIVO, É NECESSÁRIO LOGAR-SE NOVAMENTE!')</script>";
		//header("Location: login.php");
		echo "<meta http-equiv='REFRESH' content='0;URL=login.php'>";
		exit;
}
?>
<html>
<title>Verificador de Pendencias</title>
<link href="farmanguinhos.css" rel="stylesheet" type="text/css">
<?
include("conexao.php");
$arquivo = "verifica_pendencias.php";
//	include("autentica.php");
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {
	color: #000000;
	font-weight: bold;
	font-style: italic;
}
-->
</style>
<body leftmargin="0" topmargin="0">
<table width="777" border="0">
  <tr>
    <td colspan="4"><img src="imagens/titulo.jpg" width="792" height="129"></td>
  </tr>
  <tr>
    <td width="58"><a href="javascript:history.back(-1)" target="_parent"><img src="imagens/voltar.jpg" width="39" height="57" border="0"></a></td>
    <td width="92"><a href="menu.php"><img src="imagens/menu.jpg" alt="Retornar ao Menu de Sistema" width="42" height="53" border="0"></a></td>
    <td width="587">&nbsp;</td>
    <td width="43"><a href="logout.php"><img src="imagens/logout.jpg" alt="Sair do Sistema" width="39" height="33" border="0"></a></td>
  </tr>
</table>
<table width="759" border="0" class="subtitulo">
  <tr>
    <td colspan="6" class="subtitulo"><center class="titulos">
      <p><strong><font size="2">Verificador de Pendencias </font></strong></p>
      </center></td>
  </tr>

  <tr bgcolor="#076938">
    <td width="35" bgcolor="#FFFFFF" class="subtitulo"><span class="style1"></span></td>
    <td colspan="5"><span class="style1"><strong>Usu&aacute;rios bloqueados (3 OS&acute;S conclu&iacute;das por t&eacute;cnicos sem fechamento da Ordem de Servi&ccedil;o pelo Usu&aacute;rio) </strong></span></td>
  </tr>
  <tr>
    <td class="subtitulo">&nbsp;</td>
    <td width="24">&nbsp;</td>
    <td width="263">&nbsp;</td>
    <td width="88">&nbsp;</td>
    <td width="223">&nbsp;</td>
    <td width="100">&nbsp;</td>
  </tr>
  <tr>
    <td class="subtitulo">&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>Usu&aacute;rio:</strong></td>
    <td><strong>OS Conclu&iacute;das </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<?
// USUARIOS BLOQUEADOS COM 2 ORDENS DE SERVIÇO EM CONCLUIDAS MAS NÃO RESPONDIDA NO QUESTIONARIO
$query = "SELECT suporte.usuarios.nome as nome_user, count(*) as qtd from chamadotecnico inner join suporte.usuarios on cd_usuarios_pk = id_usuarios_fk where pendente = 'N' and osstatus = 'F' group by suporte.usuarios.nome order by qtd desc, suporte.usuarios.nome asc";
$resposta = mysql_query($query,$conexao) or die("Erro ao processar consulta: Mod 57: Consulta dos Usuários que ainda não responderam ao questionario de satisfação, identidificado como: ".mysql_error());
while ($linha = mysql_fetch_array($resposta)) {
	$nome = $linha['nome_user'];
	$num_os = $linha['qtd'];
	if($num_os >= 3){

?>
  <tr class="subtitulo">
    <td class="subtitulo">&nbsp;</td>
    <td bgcolor="#FFFFFF"><font color="#000000">&nbsp;</font></td>
    <td bgcolor="#FFFFFF"><font color="#000000"><em><? echo $nome; ?></em></font></td>
    <td bgcolor="#FFFFFF"><center>
      <font color="#000000"><em><strong><? echo $num_os; ?></strong></em>
      </font>
    </center></td>
    <td bgcolor="#FFFFFF"><font color="#000000">&nbsp;</font></td>
    <td><font color="#000000">&nbsp;</font></td>
  </tr>
<?
	} // fim de if >=3
}
?>
  <tr>
    <td class="subtitulo">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<td bgcolor="#FFFFFF" class="subtitulo"><span class="style1"></span></td>
    <td colspan="5" bgcolor="#076938"><span class="style1"><strong>Usu&aacute;rios mais problem&aacute;ticos</strong></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="subtitulo">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="subtitulo">&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>Usu&aacute;rio</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>Qtd OS&acute;s</strong></td>
  </tr>
	<?
	// USUARIOS  COM MAIS PROBLEMAS
	$ano = date("Y");
	$contador_a = 0;
	$query = "SELECT id_usuarios_fk, suporte.usuarios.nome as nome_user, count(*) as qtd from chamadotecnico inner join suporte.usuarios on cd_usuarios_pk = id_usuarios_fk where ano = '$ano' group by suporte.usuarios.nome asc order by qtd desc";
	$resposta = mysql_query($query,$conexao) or die("Erro ao processar consulta: Mod 120: Consulta dos Usuários com maiores problemas, identidificado como: ".mysql_error());
	while ($linha = mysql_fetch_array($resposta)) {
		$contador_a++;
		if ($contador_a > 10){
			break;
		}
		$nome = $linha['nome_user'];
		$qtd_os = $linha['qtd'];
		$id_user_fk = $linha['id_usuarios_fk'];
	?>
  <tr valign="bottom">
    <td bgcolor="#FFFFFF" class="subtitulo">&nbsp;</td>
    <td class="titulos"><b><i><font color="#000000" size="2"><? echo $contador_a; ?><hr></font></i></b></td>
    <td class="titulos"><b><i><font color="#000000" size="2"><? echo $nome; ?><hr></font></i></b></td>
    <td class="titulos"><center class="style1">
      <font size="2"><font size="2"></font></font>        
          </center></td>
    <td class="titulos"><font size="2">&nbsp;</font></td>
    <td class="titulos"><b><i><font color="#000000" size="2"><? echo $qtd_os." OS´s"; ?><hr></font></i></b></td>
  </tr>
<?
$query_c = "SELECT equipamentotipo, equiptipo.nome as tipo_problema, count(equipamentotipo) as contagem FROM chamadotecnico inner join suporte.usuarios on id_usuarios_fk = cd_usuarios_pk inner join equiptipo on equipamentotipo = id_equiptipo_pk where chamadotecnico.id_usuarios_fk ='$id_user_fk' group by equipamentotipo order by contagem desc";
$resposta_a = mysql_query($query_c,$conexao);
$valor = 0;
while ($linha_a = mysql_fetch_array($resposta_a)) {
	$contagem = $linha_a['contagem'];
	$tipo_problema = $linha_a['nome'];

	/*
	echo "<script>";
	echo "alert ('AVISO: O VALOR DE VALOR = $valor  VALOR REAL DE CONTAGEM = $contagem!')";
	echo "</script>";
	*/
?>
 
  <tr>
    <td class="subtitulo">&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="style1"></span></td>
    <td>&nbsp;</td>
    <td><i><? echo $tipo_problema; ?></i></td>
    <td><i><? echo $contagem." ocorrência(s)"; ?></i></td>
  </tr>
 <?
} //fim do while que exibe os maiores tipo de problema por usuario.
 ?>
<?
	} // fecha while dos maiores problemas
?>
 
  <tr bgcolor="#076938">
    <td height="20" bgcolor="#FFFFFF" class="subtitulo style1">&nbsp;</td>
    <td colspan="5"><span class="style1"><strong>Usu&aacute;rios que ainda n&atilde;o responderam o questionario</strong></span></td>
  </tr>
  <tr>
    
  </tr>

  <tr>
    <td class="subtitulo">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="subtitulo"><div align="center"></div></td>
    <td><strong>OS</strong></td>
    <td><strong>Usu&aacute;rio</strong></td>
    <td><strong>Conclu&iacute;do:</strong></td>
    <td><strong>Dias</strong></td>
    <td>&nbsp;</td>
  </tr>
<?
$conta = 0;
$query = "select id_chamadotecnico_pk, email, id_usuarios_fk, suporte.usuarios.nome as nome_user, suporte.departamento.nome as nome_dpto, equipamentotipo, dtchamado, hrchamado, chamadotecnico.nome as problema,  ano, dtconclusao, DATEDIFF(current_date(), dtconclusao) as dias_passados from chamadotecnico inner join suporte.usuarios on cd_usuarios_pk = id_usuarios_fk inner join suporte.departamento on id_departamento_pk = id_departamento_fk inner join datasatendimento on id_chamadotecnico_fk = id_chamadotecnico_pk where pendente = 'C' and id_chamadotecnico_pk not in (select id_chamadotecnico_fk from sac) order by id_chamadotecnico_pk";
$resposta = mysql_query($query,$conexao) or die("Erro ao processar consulta: Mod 57: Consulta dos Usuários que ainda não responderam ao questionario de satisfação, identidificado como: ".mysql_error());
while ($linha = mysql_fetch_array($resposta)) {
	$conta++;
	$email_user_a = $linha['email'];
	$cod_user = $linha['id_usuarios_fk'];
	$os = $linha['id_chamadotecnico_pk'];
	$ano_os = $linha['ano'];
	$dpto = $linha['nome_dpto'];
	$user = $linha['nome_user'];
	$dtconclusao = $linha['dtconclusao'];
	$dias = $linha['dias_passados'];
	$descricao = $linha['problema'];
	$aspas = chr(34);
	$descricao = str_replace("$aspas", " ", $descricao);
	$descricao = str_replace("'", " ", $descricao);
	//formada data para exibição
	list($ano_a, $mes_a, $dia_a) = explode("-", $dtconclusao);
	$dtconclusao = $dia_a."-".$mes_a."-".$ano_a;
?>

  <tr bgcolor="#80B09A">
    <td bgcolor="#FFFFFF" class="subtitulo"><div align="center" class="style2"><font color="#000000"></font></div></td>
    <td bgcolor="#FFFFFF"><font color="#000000"><i><b><? echo $os; ?></b></i></font></td>
    <td bgcolor="#FFFFFF"><font color="#000000"><em><? echo $user." ( $dpto )"; ?></em></font></td>
    <td bgcolor="#FFFFFF"><center>
        <font color="#000000"><em><? echo $dtconclusao; ?></em>
        </font>
    </center></td>
    <td bgcolor="#FFFFFF"><font color="#000000"><em><? echo $dias." dias passados"; ?></em></font></td>
    <td bgcolor="#FFFFFF"><form name="form<? echo $conta; ?>" method="post" action="">
      <font color="#000000">
      <input type="submit" name="Submit1" value="NU">
      <input name="usuario_name" type="hidden" id="usuario_name" value="<? echo $user; ?>">      
      <input name="os_cod" type="hidden" id="os_cod" value="<? echo $os; ?>">
      <input name="ano_os" type="hidden" id="ano_os" value="<? echo $ano_os; ?>">
      <input name="descr_problema" type="hidden" id="descr_problema" value="<? echo $descricao; ?>">
      <input name="id_cod_usuario" type="hidden" id="id_cod_usuario" value="<? echo $cod_user; ?>">
      <input name="email_user_b" type="hidden" id="email_user_b" value="<? echo $email_user_a; ?>">
      <input name="envia" type="hidden" id="envia" value="sim">    
        </font>
    </form>      
      <font color="#000000"><em><? echo //$email_user_a; ?></em></font></td>
  </tr>


  <tr>
<?
}
?>
</table>


<?
if ($envia =="sim"){
	// envia e-mail para usuario informando sobre o fechamento e o preenchimento do formulario SAC
	// ENVIO DO E-MAIL PARA O USUÁRIO ATENDIDO
	$descr_problema = $_POST['problema'];
	echo "Resumo:  Usuário [ $usuario_name ], Os_cod [ $os_cod ], Ano_os [ $ano_os ], Descrição [ $descr_problema ], Id_cod_usuario  [ $id_cod_usuario ], E-mail_user [ $email_user_b ]!";
	//exit;
	/*	$query_tecnico = "";
	$resultado = mysql_query($query,$conexao);
	$problema = mysql_result($resultado,0,"descr_problema");
	*/
	$email_destino = $email_user_b;
	$msg = "Prezado(a):<br><b>";
	$msg = $msg."$usuario_name</b><br><br>";
	$msg = $msg."O sistema acusa o não preenchimento do formulário de SAC para OS <b> $os_cod/$ano_os</b> de descrição:<br><br>";
	$msg = $msg."[ $descr_problema ]<br><br>";
	$msg = $msg."A Manutenção precisa avaliar seus técnicos e seu atendimento, mas para isso, necessita da cooperação de todos no preenchimento do formulário que é bem resumido.<br><br>";
	$msg = $msg."<center><b>Por este motivo, avalie o nosso trabalho.</b></center><br><br> ";
	$msg = $msg."Com sua opinião,  poderemos melhorar nosso atendimento e adequar o serviço às suas necessidades.<br>";
	$msg = $msg."Basta clicar no link abaixo para opinar:<br><br>";
	$msg = $msg."<a href='http://suporte.far.fiocruz.br/satisfacao.php?id_req=$os_cod&ano_os=$anotxt&id_usuario=$id_cod_usuario' target='_blank'> Clique aqui para fazer avaliação de atendimento </a>";
	//$msg = $msg."<a href='http://localhost/satisfacao.php?id_req=$val_id_req&anoreq=$anotxt&id_usuario=$cod_usuario' target='_blank'> Clique aqui para fazer avaliação de atendimento </a>";
	$msg = $msg."<br><br>Caso não queira opinar,  por favor acesse o formulário e clique em <b>[Não desejo opinar] </b> para que não receber mais esta mensagem. <br><br>";
	$msg = $msg."Obrigado(a),<br><br>";
	$msg = $msg."Equipe de Suporte";
	$mensagem = '<font size="2" face="Verdana, Arial, Helvetica, sans-serif">'.$divisao_1."<p>$msg</p>"."</font>";
	$assunto = "Aviso de não preenchimento do SAC da OS $os_cod / $ano_os";
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

	$headers .= "From: Servidor Web <srv-web@far.fiocruz.br>\r\n";

	mail($email_destino,$assunto,$mensagem,$headers);

	// fim do envio de e-mail para o Usuario
	echo "<script>";
	echo "alert ('AVISO: UM E-MAIL FOI ENVIADO PARA O USUARIO $usuario_name SOLICITANDO QUE PREENCHA O FORMULÁRIO DE SAC!')";
	echo "</script>";
}
?>


</body>
</html>
