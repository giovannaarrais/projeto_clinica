<h1>Cadastrar Consulta</h1>
<form action="?page=salvar-consulta" method="POST">
	<input type="hidden" name="acao" value="cadastrar">

	<div class="mb-3">
		<label>Nome do Paciente</label>
		<input type="text" name="paciente_id_paciente" class="form-control">
	</div>
	<div class="mb-3">
		<label>Nome do Médico</label>
		<input type="text" name="medico_id_medico" class="form-control">
	</div>
	<div class="mb-3">
		<label>Data da Consulta</label>
		<input type="date" name="data_consulta" class="form-control">
	</div>
	<div class="mb-3">
		<label>Horário da Consulta</label>
		<input type="time" name="hora_consulta" class="form-control">
	</div>
	<div class="mb-3">
		<label>Faça uma breve descrição</label>
        <textarea name="descricao_consulta" id="" rows="5" class="form-control"></textarea>
	</div>
	<div class="mb-3">
		<button type="submit" class="btn btn-success">Salvar</button>
	</div>
</form>