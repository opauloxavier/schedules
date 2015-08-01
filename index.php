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

	include_once THEME_URL."header.php";

	//include_once PAGES_URL."featured.php";

	//include_once PAGES_URL."status.php";

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

	}
	
	else{
		include_once PAGES_URL."home.php";
	}


	//include_once THEME_URL."footer.php";

?>
