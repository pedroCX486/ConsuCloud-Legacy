function showNome(){
  document.getElementById('divNOME').style.display = 'inline-table';
  document.getElementById('divRG').style.display = 'none';
  document.getElementById('rgPaciente').value = '';
}

function showRG(){
  document.getElementById('divNOME').style.display ='none';
  document.getElementById('divRG').style.display ='inline-table';
  document.getElementById('nomePaciente').value = '';
}