<div class="page-header text-center" style="margin-top:80px;">
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

<div class="modal fade" id="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Selecione a Aula</h3>
      </div>
      <div class="modal-body">
	      <form class="form-horizontal">
			<fieldset>
			<!-- Form Name -->
			<div class="form-group">
			  <div class="col-md-12">
			  <div class="radio">
			    <label for="radios-0">
			      <input name="radios" id="radios-0" value="Legislação" checked="checked" type="radio">
			      Legislação do Transito
			    </label>
				</div>
			  <div class="radio">
			    <label for="radios-1">
			      <input name="radios" id="radios-1" value="Direção Defensiva" type="radio">
			      Direção Defensiva
			    </label>
				</div>
			<div class="radio">
			    <label for="radios-2">
			      <input name="radios" id="radios-2" value="Primeiros Socorros" type="radio">
			      Noções de Primeiros Socorros
			    </label>
				</div>
			<div class="radio">
			    <label for="radios-3">
			      <input name="radios" id="radios-3" value="Meio Ambiente" type="radio">
			      Cidadania e Meio Ambiente
			    </label>
				</div>
			<div class="radio">
			    <label for="radios-4">
			      <input name="radios" id="radios-4" value="Mecânica Basica" type="radio">
			      Mecânica Basica e Manutenção de Veículos
			    </label>
				</div>
			<div class="radio">
			    <label for="radios-5">
			      <input name="radios" id="radios-5" value="Sem Aula" type="radio">
			      Sem Aula
			    </label>
				</div>
			<div class="radio">
			    <label for="radios-6">
			      <input name="radios" id="radios-6" value="Almoço" type="radio">
			      Almoço
			    </label>
				</div>	
			  </div>
			</div>
		</fieldset>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="ok">Salvar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->