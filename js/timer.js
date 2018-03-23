function atualizar(ms){
  var matutino = 86400000;
  var vespertino = 43200000;
  var noturno = 64800000;
  var troca;
  
  if(ms < vespertino) {
    troca = vespertino - ms;
  } else if(ms < noturno) {
    troca = noturno - ms;
  } else {
    troca = matutino - ms;
  }
  window.setInterval(function(){window.location.reload();}, troca);
}