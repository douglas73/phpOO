<?
ini_set("display_errors",1);
if($_POST["envia_form"] == "sim"){
	$arquivotxt = $_POST["arquivotxt"];
	$tipo_arquivo = $arquivotxt_type;
	$nome = $arquivotxt_name;
	$nome_do_arquivo = basename($arquivotxt);
	
	echo "o tipo de arquivo enviado �: $tipo_arquivo <br />e o seu basename �: $nome_do_arquivo  <br /> e o seu nome �: $nome";
	 
		
	if(($arquivotxt_type <> 'image/gif') AND ($arquivotxt_type <> 'image/jpeg') AND ($arquivotxt_type <> 'application/vnd.ms-excel') AND ($arquivotxt_type <> 'application/msword') AND ($arquivotxt_type <> 'application/pdf') ){
		echo "<script>alert('ARQUIVO N�O SUPORTADO!!!')</script>";		
	}else{
		//se  � um tipo suportado, verifica o tamanho que n�o pode ser maior 150 kb
		if ($arquivotxt_size > 150000){
			echo "<script>alert('OS ARQUIVOS N�O PODEM UTRAPASSAR 150 Kb!!!')</script>";
		}else{
			// se for menor que 150 kb, tenta enviar o arquivo
			
			$filename = "/var/www/htdocs/far/suporte/arquivos/".$_FILES['arquivotxt']['name'];
			
			if (file_exists($filename)) {
			    print "";
			    echo "<script>alert('O arquivo $filename j� existe!!!')</script>";
			    exit;
			}

			
			
			$uploaddir = '/var/www/htdocs/far/suporte/arquivos/';
			$uploadfile = $uploaddir . $_FILES['arquivotxt']['name'];
			if (move_uploaded_file($_FILES['arquivotxt']['tmp_name'], $uploaddir . $_FILES['arquivotxt']['name'])) {
			    echo "<script>alert('ARQUIVO ENVIADO COM SUCESSO!!!')</script>";

			} else {
			    echo "<script>alert('ERRO: O ARQUIVO N�O PODE SER ENVIADO!!!')</script>";

			}
			
			//$ch = chmod($upfile,0777);

		}		
	}
}


?>

<HTML>
<HEAD><TITLE>Envio de arquivos</TITLE>
</HEAD>
<BODY>

<form action="" method="post" enctype="multipart/form-data">
<table width="400" border="0">
  <tr>
    <th scope="row">Imgem</th>
    <td><input type="file" name="arquivotxt" /></td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th><INPUT type="hidden" name="envia_form" value="sim" />
    <td><input type="submit" name="Submit" value="Eniva o arquivo" /></td>
  </tr>
</table>
</form>

</BODY>
</HTML>

