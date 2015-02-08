<?

// ini_set("smpt","10.1.17.4");
//  ENVIAR E-MAIL PARA USUARIO COM O PROCEDIMENTO ADOTADO. 
	
	// $email_destino = $email;
	$email_destino = "douglas@far.fiocruz.br";
	
	//formada data para exibição
	list($ano_a, $mes_a, $dia_a) = explode("-", $data_procedimento);
	$data_procedimento = $dia_a."-".$mes_a."-".$ano_a;
		
	//echo "O email de destino é [$email_destino]";
	$msg = "<img src='http://intranet.far.fiocruz.br/www/eurisko.jpg' border='0'><br />";
	$msg = $msg."<b>Aprovação da Requisição de Doação<b><br><br> ";
	$msg = $msg."Acesse o módulo PCP - Requisição Produto - Para autorizar o atendimento da requisição..<br><br>";
	$msg = $msg."<br> ";
	$msg = $msg."Nº Requisição: <strong>Requisição 0000<strong><br><br> ";
	$msg = $msg."[ $problema ]<br><br>";
	$msg = $msg."Obrigado(a),<br><br>";
	$msg = $msg."Equipe de Suporte / Desenvolvimento";
	$mensagem = '<font size="2" face="Verdana, Arial, Helvetica, sans-serif">'."<p>$msg</p>"."</font>";
	
	
	$assunto = "Aprovação da Requisição de Doação";
	
	
	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	
	
	$headers .= "To: Douglas <douglas@far.fiocruz.br>, Adriana <drica@far.fiocruz.br>\r\n";
	$headers .= "From: Servidor Web <srv-web@far.fiocruz.br>\r\n";
	//$headers .= "Cc: <douglas73@ibest.com.br>\r\n";
	//$headers .= "Bcc: Douglas <douglas@far.fiocruz.br>, srv-web <srv-web@far.fiocruz.br>\r\n";
	
	if(mail($email_destino,$assunto,$mensagem,$headers))
	{
		echo "<script>alert('Email enviado com sucesso')</script>";
	}
	else 
	{
		echo "<script>alert('Erro ao enviar e-mail')</script>";
	}

	
//  FIM DE ENVIAR E-MAIL PARA USUARIO COM O PROCEDIMENTO ADOTADO.


?>