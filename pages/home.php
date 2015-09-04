<div class="page-header text-center" style="margin-top:70px;">
	  		<h1>Tabela de Horários </h1>
	  		<h5>
		  		<button type="button" class="btn btn-default btn-xs anterior" aria-label="Left Align">
	 				 <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
				</button>
			<span class='periodo'></span>
			<button type="button" class="btn btn-default btn-xs proximo" aria-label="Left Align">
	 				 <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
				</button>		
	  		</h5>
</div>

<div class="row">
	<div class="col-md-12 tabela-horario">
	<?php printaTabela(resolveHorario());?>
	</div>
</div>