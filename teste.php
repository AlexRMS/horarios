<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<?php
	if($_POST) {
		$turmas = $_POST['turma'];
		$turnos = $_POST['turno'];
		$turmas = split(",",$turmas);
		$turnos = split(",",$turnos);
		$i = 0;
		foreach ($turmas as $turma) {
			echo "Turma: " . $turma . "Turno: " . $turnos[$i] . "<br>";
			$i++;
		}
	}
?>
<form method="POST">
	<input type="hidden" id="turma" name="turma">
	<input type="hidden" id="turno" name="turno">
	<input type="submit" value="Enviar">
</form>


<script>
	function gambiarra() {
		$.ajax({
			url: "/master/lib/ambientes.php",
			success: function(result) {
				var turmas = JSON.parse(result);
				var html = "";
				var i = "";
				var turno[0] = "Matutino";
				var turno[1] = "Vespertino";
				var turno[2] = "Noturno";
				for (var x in turmas) {
					html += turmas[x].nome + ",";
					i += turno[(Math.floor(Math.random() * 3))] + ",";
				}
				$("#turma").val(html);
				$("#turno").val(i);
			}
		});
	}
	gambiarra();
</script>