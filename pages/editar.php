<?php 
	$wk_number=date('W');

	if(isset($_GET['wk_number']) and isset($_GET['year'])){
		$wk_number=$_GET['wk_number']; //
		$ano_atual=$_GET['year'];

		if($wk_number<10)
			$wk_number="0".$wk_number;


		$stringData=$ano_atual."W".$wk_number; // Formato 2015W35

		$inicioSemana= date('d-m-Y',strtotime($stringData));

		$finalSemana= date('d-m-Y',strtotime("+6 day", strtotime($inicioSemana)));

		$data_editando='Correspondente a <strong>'.$inicioSemana.'</strong> a <strong>'.$finalSemana.'</strong>';

	}

	else{
		$numeroSemana= date('W');
		$ano=date('Y');

		$stringData=$ano."W".$numeroSemana; // Formato 2015W35

		$inicioSemana= date('d-m-Y',strtotime($stringData));

		$finalSemana= date('d-m-Y',strtotime("+6 day", strtotime($inicioSemana)));

		$data_editando='Correspondente a <strong>'.$inicioSemana.'</strong> a <strong>'.$finalSemana.'</strong>';
	}
?>

<div class="col-md-12">
	<div class="form-group text-center" style="margin-top:70px;">
		<legend><h3>Editando:  <strong>Semana <?=$wk_number?></strong></legend></h3>
			<h5><a href="<?php echo voltaSemana();?>"><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
		 				 <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
					</button></a>   <?=$data_editando?>   
						<a href="<?php echo avancaSemana();?>"><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
		 				 <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
					</button></a>
		 	</h5>
		 </legend>
	</div>

	<div class="col-md-12">
		<div class='col-md-3 pull-right' style="margin-bottom:20px;">
			<input type="submit" class="btn btn-md btn-success pull-right" value="Salvar Alterações" name="enviaAlteracoes"></input>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<?php 
					if(isset($_GET['wk_number']) and isset($_GET['year'])) 	
						geraEdicao($_GET['wk_number'],$_GET['year']);

					else
						geraEdicao(date('W'),date('Y'));
					
					
				?>
			</div>
		</div>
	</div>
	</form>

</div>
