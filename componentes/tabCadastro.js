function showMedico(){
  document.getElementById('divCRM').style.display = 'inline-table';
  document.getElementById('crm').value = '';
  document.getElementById('crm').required = true;
  document.getElementById('crm').disabled = false;
  
  document.getElementById('divCPF').style.display = 'none';
  document.getElementById('cpf').value = '';
  document.getElementById('cpf').required = false;
  document.getElementById('cpf').disabled = true;
  
  document.getElementById('divAreaAtuacao').style.display ='inline-table';
  document.getElementById('areaAtuacao').value = '';
  document.getElementById('areaAtuacao').required = true;
  
  document.getElementById('nomeCompleto').title = 'Dr João da Silva Filho (Apenas Letras)';
  
  document.getElementById('nomeCurto').placeholder = 'Para exibição no sistema, exemplo: Dr. Antônio Silva';
  document.getElementById('nomeCurto').title = 'Dr. João (Apenas Letras)';
}

function showSecretaria(){
  document.getElementById('divCPF').style.display ='inline-table';
  document.getElementById('cpf').value = '';
  document.getElementById('cpf').required = true;
  document.getElementById('cpf').disabled = false;
  
  document.getElementById('divCRM').style.display ='none';
  document.getElementById('crm').value = '';
  document.getElementById('crm').required = false;
  document.getElementById('crm').disabled = true;
  
  document.getElementById('divAreaAtuacao').style.display ='none';
  document.getElementById('areaAtuacao').value = '';
  document.getElementById('areaAtuacao').required = false;
  
  document.getElementById('nomeCompleto').title = 'Maria da Silva (Apenas Letras)';
  
  document.getElementById('nomeCurto').placeholder = 'Para exibição no sistema, exemplo: Maria Silva';
  document.getElementById('nomeCurto').title = 'Maria (Apenas Letras)';
}