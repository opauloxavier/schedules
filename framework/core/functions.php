<?php
	require_once("framework/core/core.php");

	function setCodeAlerta($numeroCodigo){
		if($numeroCodigo==4)
			header("location:sucesso/".$numeroCodigo);
		else
			header("location:error/".$numeroCodigo);
		//$_SESSION['status'] = $numeroCodigo;
	}

function connect_db(){

		$mysqli = new mysqli(db_user, db_login, db_password, db_name);
		mysqli_set_charset($mysqli,"utf8");

		if ($mysqli->connect_errno) {
   			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		return $mysqli;
	}


	function check_double($email) {

		$mysqli = connect_db();

		$table = db_table;

		$result = mysqli_query($mysqli,"SELECT * FROM px_eventos WHERE email = '$email'");

		$num = mysqli_num_rows($result);

		if ($num==0){
			$sql = "INSERT INTO users (email) VALUES ('$email')";

			mysqli_query($mysqli,$sql);

			return 1;
		}

		else{
			return 2;
		}

	}


	function check_double_referral($email,$id) {

		$mysqli = connect_db();

		$result = mysqli_query($mysqli,"SELECT * FROM `px_referral` WHERE Referred_Email = '$email' AND RefereeID = '$id' ");

		$num = mysqli_num_rows($result);

		if ($num==0){

			return 1;
		}

		else{
			return 2;
		}

	}


	function check_double_evento($nome_evento) {

		$mysqli = connect_db();

		$result = mysqli_query($mysqli,"SELECT * FROM px_eventos WHERE nome_evento = '$nome_evento'");

		$num = mysqli_num_rows($result);

		if ($num==0){

			return false;
		}

		else{
			return true;
		}

	}

	function check_double_participante($nome_participante,$id_evento) {

		$mysqli = connect_db();

		$result = mysqli_query($mysqli,"SELECT * FROM px_participantes WHERE ID_evento = '$id_evento' and nome_participante = '$nome_participante'");

		$num = mysqli_num_rows($result);

		if ($num==0){

			return false;
		}

		else{
			return true;
		}

	}




		function check_Referral_True($id) {

		$mysqli = connect_db();

		$result = mysqli_query($mysqli,"SELECT * FROM `px_referral` WHERE RefereeID = '$id' AND Status = '1' ");

		$num = mysqli_num_rows($result);

		return $num;

	}


	function autentica($login,$senha){

		$mysqli = connect_db();

		$result = mysqli_query($mysqli,"SELECT * FROM px_user WHERE email = '$login' AND password='$senha' ");

		//echo mysqli_num_rows($result);
		if(mysqli_num_rows($result)!=false){
			$nome = mysqli_query($mysqli,"SELECT nome FROM px_user WHERE email = '$login'");
			$row = mysqli_fetch_array($nome);

			return $row['nome'];
		}

		else{
			setCodeAlerta(2);
			return false;
		}

		//header('Location: home');
	}

	function criaCadastro($nomeCadastro,$emailCadastro,$passwordCadastro,$refereeID=0){
		$mysqli = connect_db();

		if(check_double($emailCadastro)==1){

			if ($refereeID!=0){

				$result = mysqli_query($mysqli,"UPDATE px_referral SET `Status` = '1' WHERE `Referred_email`='$emailCadastro' and `RefereeID`='$refereeID'");

				if (mysqli_num_rows($result)==false)
					criaReferral($emailCadastro,1);
				//;
			}


			$result = mysqli_query($mysqli,"INSERT INTO px_user (email, nome, password) VALUES ('$emailCadastro','$nomeCadastro', '$passwordCadastro')");	
			
			return true;
			}
		
		else{
		
			setCodeAlerta(6);

			return false;
		}
	}

	function entrarSistema($email,$senha){
		if(isset($email) and (autentica($email,$senha)!=false)){

		$mysqli = connect_db();

		$result = mysqli_query($mysqli,"SELECT ID FROM px_user WHERE email = '$email'");

		$id = mysqli_fetch_array($result);

		$_SESSION['nome'] = autentica($email,$senha);
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $senha;
		$_SESSION['ID'] = $id[0];
		$_SESSION['logado'] = true;

		}

		else{

			if(check_double($email)==1){
				echo "entrei aqui";
				setCodeAlerta(1);
			}

			else {
				setCodeAlerta(2);
			}
		}

	}

	function headerLogin($logado){


		if($logado){
					include_once PAGES_URL."logado.php";
			}

		else{
				include_once PAGES_URL."form-login.php";
		
		}	
	}

function areaCadastro($logado){

	if($logado){
			include_once PAGES_URL."indica.php";
		}

	else{
			include_once PAGES_URL."form-cadastro.php";    
	}	
	
	}


	function displayAlerta($alertClass,$textoAlerta,$codAlerta){
		if($codAlerta!=0)
			echo '
				<div class="row">
					<div class="col-md-offset-6 col-md-2 text-center">
						<div class="alert '.$alertClass.' alert-dismissable alertas">
	   						<button type="button" name="buttonAlert" class="close" data-dismiss="alert" aria-hidden="true">&times; </button>
	   						'.$textoAlerta.'
						</div>
					</div>
				</div>
			';

			//unset($_SESSION['status']);
	}

	function enviaMail($to,$subject,$nome_evento,$data,$uuid_evento,$uuid_participante){

			$url=url.'certificado/'.$uuid_evento.'/'.$uuid_participante;

			$message = file_get_contents('framework/template/email/certificado.html');

			// Replace the % with the actual information
			$message = str_replace('%evento%', $nome_evento, $message);
			$message = str_replace('%data%', $data, $message);
			$message = str_replace('%url%', $url, $message);


			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->CharSet = 'UTF-8';
			$mail->Host = 'smtp.mandrillapp.com';
			$mail->SMTPAuth= true;
			$mail->Username= MAIL_USERNAME;
			$mail->Password = MAIL_PASSWORD;
			$mail->SMTPSecure= 'tls';
			$mail->Port = 587;
			$mail->From = MAIL_FROM;
			$mail->FromName = MAIL_FROM_NAME;
			$mail->addAddress($to);
			$mail->Subject = $subject;
			$mail->MsgHTML($message);
			//$mail->AltBody(strip_tags($message));

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}
	}


	function geraPdf($content,$autor,$tituloCertificado,$subject,$keywords,$nome_evento,$nome_participante,$local_evento,$data_evento,$uuid_participante){
		// create new PDF document
		$html = $content;
		//$html = "<h1>mensagem de teste</h1>";

		$html = str_replace('%name%',$nome_participante, $html);
		$html = str_replace('%local%', $local_evento, $html);
		$html = str_replace('%evento%', $nome_evento, $html);
		$html = str_replace('%data%',$data_evento, $html);

		$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator("Certified - Certificados Automatizados");
		$pdf->SetAuthor($autor);
		$pdf->SetTitle($tituloCertificado);
		$pdf->SetSubject($subject);
		$pdf->SetKeywords($keywords);
		$pdf->SetPrintFooter(false);
		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Certificado Teste", "por Paulo", array(0,64,255), array(0,64,128));
		$pdf->setFooterData(array(0,64,0), array(0,64,128));
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/bra.php')) {
			require_once(dirname(__FILE__).'/lang/bra.php');
			$pdf->setLanguageArray($l);
		}

		$pdf->setFontSubsetting(true);

		$pdf->SetFont('helvetica', '', 14, '', true);
		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();
		// set text shadow effect
		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

		$pdf->writeHTML($html, true, false, true, false, '');

		ob_end_clean();

		$pdf->Output($uuid_participante.'.pdf', 'D');
	}

	function importCSV($file_path){
	
		$file = fopen($file_path,"r");
		if($file!=NULL)
			  while (($result = fgetcsv($file)) !== false)
				{
				    $data[] = $result;
				}

		fclose($file);
		
		return $data;
	}

	function uuidGen($echo=false) {
			if($echo)
				echo md5(uniqid(rand(), true));

			return md5(uniqid(rand(), true));
	}

	function validaCertificado($uuid_evento,$uuid_participante){

		$mysqli = connect_db();

		$result = mysqli_query($mysqli,"SELECT * FROM px_eventos WHERE uuid = '$uuid_evento'");
		$event_data = mysqli_fetch_array($result);
		$id_evento = $event_data['ID'];

		$result2 = mysqli_query($mysqli,"SELECT * FROM px_participantes WHERE uuid_cert = '$uuid_participante' and ID_evento = '$id_evento'");
		$participante_data = mysqli_fetch_array($result2);

		$result3= mysqli_query($mysqli,"SELECT * FROM px_templates WHERE ID_evento='$id_evento'");
		$content_data = mysqli_fetch_array($result3);

		if(mysqli_num_rows($result)>0 and mysqli_num_rows($result2)>0)
			geraPdf($content_data['content'],'Marcos A. Caldas',$event_data['nome_evento'],$event_data['nome_evento'],'Evento,Certificado,Direitos Humanos,Debate',$event_data['nome_evento'],$participante_data['nome_participante'],$event_data['local_evento'],'29/09/2014',$participante_data['uuid_cert']);

		else
			echo "Erro 404";

	}

	//function mysqli_fetch_all($result){
      //    while($row = $result->fetch_array())
		//	{
		//		$rows[] = $row;
		//	}

		//	return $rows;
    //}

	function insereEvento($id_owner,$nome_evento,$data_evento,$duracao_evento,$local_evento){
		$mysqli = connect_db();

		$id_owner = $_SESSION['ID'];
		$uuid_evento = uuidGen();

		if(!check_double_evento($nome_evento)){

			$result = mysqli_query($mysqli,"INSERT INTO px_eventos (`ID_owner`, `nome_evento`, `data_evento`, `tempo_evento`, `local_evento`, `uuid`) VALUES ('$id_owner', '$nome_evento', '$data_evento', '$duracao_evento', '$local_evento', '$uuid_evento')");

			$result2 = mysqli_query($mysqli,"SELECT * FROM px_eventos WHERE nome_evento = '$nome_evento'");
			$data = mysqli_fetch_array($result2);

			return $data['ID'];
		}

		else
			return false;

	}


	function insereParticipante($id_owner,$id_evento,$nome_participante,$email_participante){
		$mysqli = connect_db();
		$uuid_participante = uuidGen();

		if(!check_double_participante($nome_participante,$id_evento)){
			$result = mysqli_query($mysqli,"INSERT INTO px_participantes (`ID_owner`, `ID_evento`, `nome_participante`, `email_participante`, `uuid_cert`) VALUES ('$id_owner', '$id_evento', '$nome_participante', '$email_participante', '$uuid_participante')");

		if($result)
			return true;
		else
			return false;
		}

		else 
			echo "Erro: Usuário já cadastrado no evento";
	}

	function sanitizeDate($data){
		$dia = ($data[0].$data[1]);
		$mes = ($data[3].$data[4]);
		$ano = ($data[6].$data[7].$data[8].$data[9]);

		return ($ano.'-'.$mes.'-'.$dia);

	}

	function reSanitizeDate($data){
		$dia = ($data[8].$data[9]);
		$mes = ($data[5].$data[6]);
		$ano = ($data[0].$data[1].$data[2].$data[3]);

		return ($dia.'/'.$mes.'/'.$ano);

	}

	function dadosEvento($id){

		$mysqli = connect_db();

		$result = mysqli_query($mysqli,"SELECT * FROM px_eventos WHERE id = '$id'");
		$event_data = mysqli_fetch_array($result);

		return $event_data;
	}
function printaTabela(){

		$horarios = array('7:00h às 8:00h','8:00h às 9:00h','9:00h às 10:00h',
			'10:00h às 11:00h','11:00h às 12:00h','12:00h às 14:00h','14:00h às 15:00h',		
			'15:00h às 16:00h','16:00h às 17:00h','17:00h às 18:00h','18:00h às 19:00h',
			'19:00h às 20:00h','20:00h às 21:00h');

		echo '<table class="table table-striped text-center"><tr><th>Horário</th>
		<th>Segunda-Feira</th><th>Terça-Feira</th><th>Quarta-Feira</th>
		<th>Quinta-Feira</th><th>Sexta-Feira</th><th>Sábado</th></tr>';

		for($i=0;$i<13;$i++)
		{
				echo "<tr >";
				echo "<td>".$horarios[$i]."</td>";
				//cada td é uma materia do horario
				echo "<td>"."0"."</td>";
				echo "<td>"."1"."</td>";
				echo "<td>"."2"."</td>";
				echo "<td>"."3"."</td>";
				echo "<td>"."4"."</td>";
				echo "<td>"."5"."</td>";
				echo "</tr>";
		}

	}

?>