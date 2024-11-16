<h1>Editar Consulta</h1>
<?php
	$sql = "SELECT * FROM consulta 
			WHERE id_consulta = ".$_REQUEST['id_consulta'];

	$res = $conn->query($sql);

	$row = $res->fetch_object();
?>
<form action="?page=salvar-consulta" method="POST">
	<input type="hidden" name="acao" value="editar">
	<input type="hidden" name="id_consulta" value="<?php echo $row->id_consulta; ?>">

    <div class="mb-3">
		<label>Data da Consulta</label>
		<input type="date" name="data_consulta" class="form-control" value="<?php echo $row->data_consulta?>">
	</div>
	<div class="mb-3">
		<label>Horário da Consulta</label>
		<input type="time" name="hora_consulta" class="form-control"  value="<?php echo $row->hora_consulta?>">
	</div>
	<div class="mb-3">
		<label>Faça uma breve descrição</label>
        <textarea name="descricao_consulta"  rows="5" class="form-control"  value="<?php echo $row->descricao_consulta?>"></textarea>
	</div>
	<div class="mb-3">
		<button type="submit" class="btn btn-success">Salvar</button>
	</div>

</form> 
