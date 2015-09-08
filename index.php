<?php if( !isset($_SESSION) ){ session_start(); }

	require_once('framework/core/functions.php');

	if(isset($_SESSION["nome"])){
		$_SESSION['logado'] = true;
	}

	else{
		$_SESSION['logado'] = false;
	}

	if (isset($_POST['submitLogin'])){
		entrarSistema($_POST['emailLogin'],$_POST['passwordLogin']);
	}
	
	require_once 'vendor/autoload.php';

	if($_GET['to']!='data' and $_GET['to']!='tabela'){
		include_once THEME_URL."header.php";

		if(isset($_GET['to'])){
			if($_GET['to']=='home'){
				include_once PAGES_URL."home.php";
			}

			elseif($_GET['to']=='logout'){
				include_once PAGES_URL."logout.php";
			}

			elseif($_GET['to']=='error'){
				include_once PAGES_URL."home.php";
			}

			elseif($_GET['to']=='editar'){
				include_once PAGES_URL."editar.php";
			}

			elseif($_GET['to']=='finalizaEdicao'){
				include_once PAGES_URL."finaliza.php";
			}
		}
		
		else{
			include_once PAGES_URL."home.php";
		}
	}

	else if($_GET['to']=='tabela'){
				include_once PAGES_URL."tabela.php";
	}

	else if($_GET['to']=='data'){
				include_once PAGES_URL."data.php";
	}

	

?>
