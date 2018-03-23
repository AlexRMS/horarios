function atualizarTurmas() {
	$.ajax({
		url: "/master/cadastros/horarios/ajax/turmas.php?turno=" + $('#turno').val(),
		success: function(result) {
			var turmas = JSON.parse(result);
			var html = "";
			for (var x in turmas) {
				html += '<option value="' + turmas[x].id + '">' + turmas[x].nome + "</option>";
			}
			$("#turma").html(html);
		}
	});
}

function atualizarProfessores() {
	$.ajax({
		url: "/master/cadastros/horarios/ajax/professores.php",
		success: function(result) {
			var professores = JSON.parse(result);
			var html = "";
			for (var x in professores) {
				html += '<option value="' + professores[x].id + '">' + professores[x].nome + "</option>";
			}
			$("#professor").html(html);
		}
	});
}

function atualizarSalas() {
	$.ajax({
		url: "/master/cadastros/horarios/ajax/salas.php",
		success: function(result) {
			var salas = JSON.parse(result);
			var html = "";
			for (var x in salas) {
				html += '<option value="' + salas[x].id + '">' + salas[x].nome + "</option>";
			}
			$("#sala").html(html);
		}
	});
}

function atualizarTipos() {
	$.ajax({
		url: "/master/cadastros/horarios/ajax/tipos.php",
		success: function(result) {
			var tipos = JSON.parse(result);
			var html = "";
			for (var x in tipos) {
				html += '<option value="' + tipos[x].id + '">' + tipos[x].nome + "</option>";
			}
			$("#tipo").html(html);
		}
	});
}

function pesquisarTurma(id) {
	$.ajax({
		url: "/master/cadastros/horarios/ajax/pesquisarTurma.php?id=" + id,
		success: function(result) {
			var turmas = JSON.parse(result);
			var html = "";
			for (var x in turmas) {
				html += '<option value="' + turmas[x].id + '">' + turmas[x].nome + "</option>";
			}
			$("#turma").html(html);
		}
	});
}