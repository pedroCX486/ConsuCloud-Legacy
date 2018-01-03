var limit = 30; //Máximo de linhas contando a partir de zero
var textarea = document.getElementById("receita");
var spaces = textarea.getAttribute("cols");

textarea.onkeyup = function () {
  var lines = textarea.value.split("\n");

  for (var i = 0; i < lines.length; i++) {
    if (lines[i].length <= spaces) continue;
    var j = 0;

    var space = spaces;

    while (j++ <= spaces) {
      if (lines[i].charAt(j) === " ") space = j;
    }
    lines[i + 1] = lines[i].substring(space + 1) + (lines[i + 1] || "");
    lines[i] = lines[i].substring(0, space);
  }
  if (lines.length > limit) {
    textarea.style.color = 'red';
    setTimeout(function () {
      textarea.style.color = '';
    }, 500);
  }
  textarea.value = lines.slice(0, limit).join("\n");
};